<?php

namespace App\Http\Controllers;

use App\Models\MercadoPago;
use App\Models\Pedido;
use App\Models\Rifa;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        if(auth()->check() and auth()->user()->isAdmin()){
            $rifas = Rifa::all();
            return view('pages.admin.rifas.index')->with(['rifas'=>$rifas]);
        }else{
            if($request->expectsJson()){
                $status = [
                    'EM_ANDAMENTO'  =>  0,
                     'ENCERRADO'    => 1
                ];
                //Rifas filtrada por status
                $rifas = Rifa::where('status', '=', $status[$request->status])->get();
                return response()->json($rifas);
            }else{
                return view('pages.public.sorteios');
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
        if(auth()->user()->isAdmin()){
            return view('pages.admin.rifas.create');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if(auth()->user()->isAdmin()){

            $validate = Validator::make($request->all(),[
                'titulo' => 'required',
                'descricao' =>  'required',
                'premio'    =>  'required',
                'periodo'   =>  'required',
                'valor_por_numero'  =>  'required',
                'quantidade_de_numeros' =>  'required',
                'quantidade_maxima_de_numeros'  =>'required',
                'porcentagem_comissao_vendas'    =>'required',
                'contato_whatsapp'   =>'required',
                'files.*'  =>  'image|required'
            ],
                [
                    'titulo.required' => 'Título obrigatório',
                    'descricao.required' =>  'Descrição obrigatória',
                    'premio.required'    =>  'Prêmio obrigatório',
                    'periodo.required'   =>  'Período obrigatório',
                    'valor_por_numero.required'  =>  'Valor por número obrigatório',
                    'quantidade_de_numeros.required' =>  'Quantidade de números obrigátorio',
                    'quantidade_maxima_de_numeros.required'  =>'Quantidade máxima de números obrigatório',
                    'porcentagem_comissao_vendas.required'    =>'Porcentagem da comissão de vendas obrigatório',
                    'files.*.required'   =>'Imagem obrigatória',
                    'files.*.image'   =>'Arquivo deve ser uma imagem válida',
                    'contato_whatsapp.required'   =>'Contato do whatsapp obrigatório',
                ])->validate();
            DB::beginTransaction();
            try{
                $data = collect($request->all())->filter(function($value, $key) {
                    return  $value != null;
                })->toArray();
//                dd($data,
//                Carbon::parse($data['periodo']));
                $data['periodo'] = Carbon::parse($data['periodo']);
                $data['valor_por_numero'] =(float) $data['valor_por_numero'];
//                dd(Carbon::parse($data['periodo'])->format('Y-m-d\TH:i'));
//                $periodo = Carbon::createFromLocaleFormat('Y-m-d\TH:i','pt_BR',$data['periodo']);
//                $data['periodo'] = $periodo;
//                dd($data);

                $rifa = Rifa::create($data);
                for ($i=1; $i <= $data['quantidade_de_numeros']; $i++ ){
                    $rifa->cotas()->create([
                        'numero'    =>$i
                    ]);
                }
                if($request->has('files')){
                    $files = $request->file('files');
                    foreach($files as $file){
                        $path = $file ->store('rifas_imagens','public');
                        $rifa->imagens()->create([
                            'path'  =>  $path,
                        ]);
                    }
                }
                DB::commit();
                return redirect()->to('/rifas')->with(['message'=>'Rifa cadastrada com sucesso']);
            }catch(\Exception $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
            }

           dd($request->all());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function show(Request $request, Rifa $rifa)
    {
        if(auth()->check() && auth()->user()->isAdmin()){

        }
//        dd($rifa);
        $mercado_pago = new MercadoPago();

        return view('pages.public.sorteio')->with(['rifa'=>$rifa,'mp_public_key'   =>  $mercado_pago->public_key]);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit( $id)
    {
        if(auth()->user()->isAdmin()){
            $rifa = Rifa::find($id);
            return view('pages.admin.rifas.edit')->with(['rifa'=>$rifa]);
        }

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        if(auth()->user()->isAdmin()){
            $rifa = Rifa::find($id);
            Validator::make($request->all(),[
                'titulo' => 'required',
                'descricao' =>  'required',
                'premio'    =>  'required',
                'periodo'   =>  'required',
                'valor_por_numero'  =>  'required',
                'quantidade_de_numeros' =>  'required',
                'quantidade_maxima_de_numeros'  =>'required',
                'porcentagem_comissao_vendas'    =>'required',
                'contato_whatsapp'   =>'required',
                'files.*'  =>  'image|required'
            ],
                [
                    'titulo.required' => 'Título obrigatório',
                    'descricao.required' =>  'Descrição obrigatória',
                    'premio.required'    =>  'Prêmio obrigatório',
                    'periodo.required'   =>  'Período obrigatório',
                    'valor_por_numero.required'  =>  'Valor por número obrigatório',
                    'quantidade_de_numeros.required' =>  'Quantidade de números obrigátorio',
                    'quantidade_maxima_de_numeros.required'  =>'Quantidade máxima de números obrigatório',
                    'porcentagem_comissao_vendas.required'    =>'Porcentagem da comissão de vendas obrigatório',
                    'files.*.required'   =>'Imagem obrigatória',
                    'files.*.image'   =>'Arquivo deve ser uma imagem válida',
                    'contato_whatsapp.required'   =>'Contato do whatsapp obrigatório',
                ])->validate();
            DB::beginTransaction();
            try{
                $data = collect($request->all())->filter(function($value, $key) {
                    return  $value != null;
                })->toArray();
//                dd($data,
//                Carbon::parse($data['periodo']));
                $data['periodo'] = Carbon::parse($data['periodo']);
                $data['valor_por_numero'] =(float) $data['valor_por_numero'];
//                dd(Carbon::parse($data['periodo'])->format('Y-m-d\TH:i'));
//                $periodo = Carbon::createFromLocaleFormat('Y-m-d\TH:i','pt_BR',$data['periodo']);
//                $data['periodo'] = $periodo;
//                dd($data);

                $rifa->update($data);
                if($request->has('files')){
                    $files = $request->file('files') ;
                    foreach($files as $file){
                        $path = $file->store('rifas_imagens','public');
                        $rifa->imagens()->create([
                            'path'  =>  $path,
                        ]);
                    }
                }
                DB::commit();
                return redirect()->to('/rifas')->with(['message'=>'Rifa editada com sucesso']);
            }catch(\Exception $e){
                return redirect()->back()->withErrors($e->getMessage())->withInput($request->all());
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Rifa $rifa)
    {
        DB::beginTransaction();
        try{
            $imagens = $rifa->imagens();
            $pedidos = $rifa->pedidos();
            $cotas = $rifa->cotas();

            $pedidos->delete();
            $cotas->delete();
            $imagens->delete();
            foreach($imagens->get() as $imagem){
                Storage::delete($imagem->path);
            }
            $rifa->delete();
            DB::commit();
            return redirect()->to('/rifas')->with(['message'=>'Rifa deletada com sucesso!']);
        }catch(\Exception $e){
            DB::rollback();
            return redirect()->to('/rifas')->withErrors($e->getMessage());
        }

    }

    public function meusNumeros(){
        return view('pages.public.meus_numeros');
    }

    public function buscarRifasPorTelefoneDoPedido(Request $request){
        $telefone = $request->get('telefone');
        $pedidos = Pedido::where('telefone_cliente',$telefone)->with('rifa.cotas')->get();
        //Retorna o nome do usuario, o numero, valor da compra,data da compra,status da compra, titulo da rifa e numero das rifas
        $pedidos = $pedidos->map(function($pedido){
            //valor_da_compra em formato de moeda real com R$
            $pedido->valor_da_compra = number_format($pedido->valor_da_compra,2,',','.');
            $pedido->valor_da_compra = 'R$ '.$pedido->valor_da_compra;
            //data_da_compra em formato de data
            $pedido->data_da_compra = Carbon::parse($pedido->created_at)->format('d/m/Y');
            //status da compra
            $pedido->status_da_compra = $pedido->status;

            return $pedido;
        });
        return response()->json($pedidos);
    }


}
