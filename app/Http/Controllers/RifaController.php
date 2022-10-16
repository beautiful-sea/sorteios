<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class RifaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->isAdmin()){
            return view('pages.admin.rifas.index');
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
                if($request->has('files')){
                    $files = $request->files;
                    foreach($files as $file){
                        $path = $file->store('rifas_imagens');
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
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
