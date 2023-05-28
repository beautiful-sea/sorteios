<?php

namespace App\Http\Controllers;

use App\Models\Rifa;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class CotaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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

    public function all(Request $request, Rifa $rifa){
        if($request->expectsJson()){
            $cotas = collect(Rifa::getCotasNoCache($rifa->id));
            $cotas= $cotas->map(function($cota){
                $cota['numero_formatado'] = str_pad($cota['numero'], 4, '0', STR_PAD_LEFT);
                return $cota;
            });
//            $cotas = $rifa->cotas()->paginate($request->per_page);
            //Cria a paginação manualmente
            $cotas = new LengthAwarePaginator(
                $cotas->forPage($request->page, $request->per_page)->values(),
                $cotas->count(),
                $request->per_page,
                $request->page,
                ['path' => $request->url()]
            );
            return response()->json($cotas);
        }
    }
}
