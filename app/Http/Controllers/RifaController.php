<?php

namespace App\Http\Controllers;

use App\Jobs\CadastrarCotasEmLoteJob;
use App\Models\Configuration;
use App\Models\Cota;
use App\Models\MercadoPago;
use App\Models\Pedido;
use App\Models\Rifa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class RifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if (auth()->check() and auth()->user()->isAdmin()) {
            $rifas = Rifa::query();
            //Filtrar por status, rifa,pedido_id,search ou numero_sorteado
            $rifas->when($request->status, function ($q) use ($request) {
                return $q->where('status', '=', $request->status);
            });
            $rifas->when($request->rifa, function ($q) use ($request) {
                return $q->where('id', '=', $request->rifa);
            });
            $rifas->when($request->pedido_id, function ($q) use ($request) {
                return $q->whereHas('pedidos', function($q) use($request){
                    $q->where('id', '=', $request->pedido_id);
                });
            });
            $rifas->when($request->search, function ($q) use ($request) {
                 $q->where(function($q) use($request){
                     $q->where('titulo', 'like', '%' . $request->search . '%');
                     $q->orWhere('descricao', 'like', '%' . $request->search . '%');
                     $q->orWhere('premio', 'like', '%' . $request->search . '%');
                 });
            });
            $rifas->when($request->numero_sorteado, function ($q) use ($request) {
                //Remove os '0' a esquerda
                $numero_sorteado = ltrim($request->numero_sorteado, '0');
                return $q->where('numero_sorteado', '=', $numero_sorteado);
            });
            $rifas = $rifas->orderBy('created_at', 'desc');
            if($request-> expectsJson()){
                return response()->json($rifas->paginate($request->perPage??10));
            }
            return view('pages.admin.rifas.index')->with(['rifas' => $rifas->get()])->withInput($request->all());
        } else {
            if ($request->expectsJson()) {
                //Rifas filtrada por status
                $rifas = Rifa::when($request->status,function($q) use($request){
                    return $q->where('status', '=', $request->status);
                })->
                //Ordena por mais antiga primeiro
                orderBy('created_at', 'desc')->
                get();
                return response()->json($rifas);
            } else {
                $perguntas_frequentes = Configuration::where('key','perguntas_frequentes')->first();
                if(!$perguntas_frequentes){
                    $perguntas_frequentes = new Configuration();
                    $perguntas_frequentes->key = 'perguntas_frequentes';
                    $perguntas_frequentes->value = json_encode([]);
                    $perguntas_frequentes->save();
                }
                $perguntas_frequentes = json_decode($perguntas_frequentes->value);
                return view('pages.public.sorteios',[
                    'perguntas_frequentes' => $perguntas_frequentes
                ]);
            }

        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->isAdmin()) {
            return view('pages.admin.rifas.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if (auth()->user()->isAdmin()) {

            $validate = Validator::make($request->all(), [
                'titulo' => 'required',
                'descricao' => 'required',
                'premio' => 'required',
                'periodo' => 'required',
                'valor_por_numero' => 'required',
                'quantidade_de_numeros' => 'required',
                'quantidade_maxima_de_numeros' => 'required',

                'files.*' => 'image|required'
            ],
                [
                    'titulo.required' => 'Título obrigatório',
                    'descricao.required' => 'Descrição obrigatória',
                    'premio.required' => 'Prêmio obrigatório',
                    'periodo.required' => 'Período obrigatório',
                    'valor_por_numero.required' => 'Valor por número obrigatório',
                    'quantidade_de_numeros.required' => 'Quantidade de números obrigátorio',
                    'quantidade_maxima_de_numeros.required' => 'Quantidade máxima de números obrigatório',
                    'quantidade_minima_de_numeros' => 'Quantidade mínima de números obrigatório',

                    'files.*.required' => 'Imagem obrigatória',
                    'files.*.image' => 'Arquivo deve ser uma imagem válida',

                ])->validate();
            DB::beginTransaction();
            try {
                $data = collect($request->all())->filter(function ($value, $key) {
                    return $value != null;
                })->toArray();
                $data['slug'] = str_slug($data['titulo']);

                //Verifica se o slug já existe
                if (Rifa::where('slug', $data['slug'])->first()) {
                    $data['slug'] = $data['slug'] . '-' . uniqid();
                }
                $data['periodo'] = Carbon::parse($data['periodo']);
                //Remove mascara do valor
                $data['valor_por_numero'] = str_replace(['.', ',','R$',' '], ['', '.','',''], $data['valor_por_numero']);
                $data['valor_por_numero'] = (float)$data['valor_por_numero'];


                $rifa = Rifa::create($data);

                //Se a rifa is_principal for true, todas as outras serão false
                if ($request->has('is_principal')) {
                    Rifa::where('id', '!=', $rifa->id)->update(['is_principal' => false]);
                }

                //Criação das imagens
                $files = $request->file('files');
                foreach ($files as $key => $file) {
                    $path = $file->store('rifas_imagens', 'public');
                    $rifa->imagens()->create([
                        'path' => $path,
                        'is_principal' => $request->imagem_principal_index == $key ? true : false,
                    ]);
                }
                //Se a quantidade de cotas for maior que 100mil, usa o job CadastrarCotasEmLoteJob
                if($data['quantidade_de_numeros'] > 100000){
                    CadastrarCotasEmLoteJob::dispatch($data['quantidade_de_numeros'],$rifa->id);
                }else{
                    //Divide a criação das cotas de 10000 em 10000
                    $quantidade_de_numeros = $data['quantidade_de_numeros'];
                    $quantidade_de_numeros_por_vez = 10000;
                    $quantidade_de_vezes = ceil($quantidade_de_numeros/$quantidade_de_numeros_por_vez);
                    $cotas_to_cache = [];
                    for($i = 0; $i < $quantidade_de_vezes; $i++){
                        $cotas = [];
                        for($j = 0; $j < $quantidade_de_numeros_por_vez; $j++){
                            $cotas[] = [
                                'pedido_id' => null,
                                'numero' => $i*$quantidade_de_numeros_por_vez + $j + 1,
                                'status'    =>  'DISPONIVEL'
                            ];
                        }
                        Cota::insert($cotas);
                        $cotas_to_cache = array_merge($cotas_to_cache,$cotas);
                    }
                    Rifa::criarCotasNoCache($cotas_to_cache, $rifa->id); //Coloca as cotas em cache
                }

                DB::commit();



                return redirect()->to('/rifas')->with(['message' => 'Rifa cadastrada com sucesso']);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, $slug)
    {
        $rifa = Rifa::where('slug', '=', $slug)->firstOrFail();
        $ganhador = $rifa->pedidos()->where('is_ganhador', '=', 1)->first();
        return view('pages.public.sorteio')->with(['rifa' => $rifa ,'ganhador'=>$ganhador]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (auth()->user()->isAdmin()) {
            $rifa = Rifa::findOrFail($id);
            return view('pages.admin.rifas.edit')->with(['rifa' => $rifa]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if (auth()->user()->isAdmin()) {
            $rifa = Rifa::find($id);
            Validator::make($request->all(), [
                'titulo' => 'required',
                'descricao' => 'required',
                'premio' => 'required',
                'periodo' => 'required',
                'valor_por_numero' => 'required',
                'quantidade_de_numeros' => 'required',
                'quantidade_maxima_de_numeros' => 'required',
                'quantidade_minima_de_numeros' => 'required',
                'files.*' => 'image|required'
            ],
                [
                    'titulo.required' => 'Título obrigatório',
                    'descricao.required' => 'Descrição obrigatória',
                    'premio.required' => 'Prêmio obrigatório',
                    'periodo.required' => 'Período obrigatório',
                    'valor_por_numero.required' => 'Valor por número obrigatório',
                    'quantidade_de_numeros.required' => 'Quantidade de números obrigátorio',
                    'quantidade_maxima_de_numeros.required' => 'Quantidade máxima de números obrigatório',
                    'quantidade_minima_de_numeros.required' => 'Quantidade mínima de números obrigatório',
                    'files.*.required' => 'Imagem obrigatória',
                    'files.*.image' => 'Arquivo deve ser uma imagem válida',
                ])->validate();
            DB::beginTransaction();
            try {
                $data = collect($request->all())->filter(function ($value, $key) {
                    return $value != null;
                })->toArray();

                //Não permite alterar a quantidade de numeros, retorna erro
                if($data['quantidade_de_numeros'] != $rifa->quantidade_de_numeros){
                    return redirect()->back()->withErrors('Não é possível alterar a quantidade de números')->withInput($request->all());
                }


                if(isset($data['numero_sorteado']) && $data['numero_sorteado'] != null ){
                    $cota_sorteada = $rifa->cotas() ->where('numero', $data['numero_sorteado'])->first();
                    if(!$cota_sorteada){
                        return redirect()->back()->withErrors('Número sorteado não existe')->withInput($request->all());
                    }
                    $pedido_sorteado = $cota_sorteada->pedido;
                    if($pedido_sorteado){
                        $pedido_sorteado->update([
                            'is_ganhador' => true
                        ]);
                    }
                    $data['status'] = 'ENCERRADO';
                }

                //Se a rifa ja tiver sido encerrada e já tiver sido definido um ganhador, não pode mais ser editada, a nao ser que o numero sorteado seja alterado ou removido
                if($rifa->status == 'ENCERRADO' && $rifa->numero_sorteado != null
                    && isset($data['numero_sorteado'])
                    && $rifa->numero_sorteado != $data['numero_sorteado']){
                    return redirect()->back()->withErrors('Rifa já encerrada e com ganhador definido, não pode mais ser editada')->withInput($request->all());
                }

                //Se o numero sorteado esta sendo atualizado para null, o pedido sorteado deve ser atualizado para is_ganhador = false e o status da rifa deve ser alterado para EM ANDAMENTO e
                //o numero sorteado deve ser atualizado para null
                if($rifa->status == 'ENCERRADO' && $rifa->numero_sorteado != null
                    && !isset($data['numero_sorteado']) ){
                    $pedido_sorteado = $rifa->pedidos()->where('is_ganhador', true)->first();
                    if($pedido_sorteado){
                        $pedido_sorteado->update([
                            'is_ganhador' => false
                        ]);
                    }
                    $data['status'] = 'EM_ANDAMENTO';
                    $data['numero_sorteado'] = null;
                }

                $data['periodo'] = Carbon::parse($data['periodo']);
                //Remove mascara do valor
                $data['valor_por_numero'] = str_replace(['.', ',','R$',' '], ['', '.','',''], $data['valor_por_numero']);
                $data['valor_por_numero'] = (float)$data['valor_por_numero'];
                $data['slug'] = str_slug($data['titulo']);
                //Verifica se o slug já existe
                if (Rifa::where('slug', $data['slug'])->where('id','!=',$rifa->id)->first()) {
                    $data['slug'] = $data['slug'] . '-' . uniqid();
                }
                if(!$request->mostrar_data_sorteio){
                    $data['mostrar_data_sorteio'] = false;
                }
                if(!$request->has_compra_minima){
                    $data['has_compra_minima'] = false;
                }
                if(!$request->is_compra_automatica){
                    $data['is_compra_automatica'] = false;
                }
                if(!$request->is_principal){
                    $data['is_principal'] = false;
                }

                $rifa->update($data);

                //Se a rifa is_principal for true, todas as outras serão false
                if ($request->has('is_principal')) {
                    Rifa::where('id', '!=', $rifa->id)->update(['is_principal' => false]);
                }

                if ($request->has('files')) {
                    $files = $request->file('files');
                    foreach ($files as $key => $file) {
                        $path = $file->store('rifas_imagens', 'public');
                        $rifa->imagens()->create([
                            'path' => $path,
                            'is_principal' => $request->imagem_principal_index == $key ? true : false,
                        ]);
                    }
                }
                DB::commit();
                return redirect()->back()->with(['message' => 'Rifa editada com sucesso']);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Rifa $rifa)
    {
        DB::beginTransaction();
        try {
            $imagens = $rifa->imagens();
            $cotas = $rifa->cotas();
            $pedidos = $rifa->pedidos();

            $cotas->delete();
            //Deleta o cache das cotas
            Rifa::deletarCotasNoCache($rifa->id);
            $pedidos->delete();
            $imagens->delete();
            foreach ($imagens->get() as $imagem) {
                Storage::delete($imagem->path);
            }
            $rifa->delete();
            DB::commit();
            return redirect()->to('/rifas')->with(['message' => 'Rifa deletada com sucesso!']);
        } catch (\Exception $e) {
            DB::rollback();
            return redirect()->to('/rifas')->withErrors($e->getMessage());
        }

    }

    public function meusNumeros()
    {
        return view('pages.public.meus_numeros');
    }

    public function buscarRifasPorTelefoneDoPedido(Request $request)
    {
        $telefone = $request->get('telefone');
        $pedidos = Pedido::where('telefone_cliente', $telefone)->with('rifa.cotas')->get();

        //Retorna o nome do usuario, o numero, valor da compra,data da compra,status da compra, titulo da rifa e numero das rifas
        $pedidos = $pedidos->map(function ($pedido) {
            //valor_da_compra em formato de moeda real com R$
            $pedido->valor_da_compra = number_format($pedido->valor_da_compra, 2, ',', '.');
            $pedido->valor_da_compra = 'R$ ' . $pedido->valor_da_compra;
            //data_da_compra em formato de data
            $pedido->data_da_compra = Carbon::parse($pedido->created_at)->format('d/m/Y');
            //status da compra
            $pedido->status_da_compra = $pedido->status;

            return $pedido;
        });
        return response()->json($pedidos);
    }

    public function ganhadores(){
        $ganhadores = Pedido::where('status', 'pago')->where('is_ganhador', true)->get();
        return view('pages.public.ganhadores',[
            'ganhadores' => $ganhadores
        ]);
    }

}
