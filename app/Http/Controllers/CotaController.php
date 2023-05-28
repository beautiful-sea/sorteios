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
            if($request->filter){
                $cotas = $cotas->filter(function($cota) use ($request){
                    return $cota['status'] == $request->filter;
                });
            }
            $count = $cotas->count();
            $items = $cotas->forPage($request->page, $request->per_page)->values();
            //Cria a paginação manualmente
            $cotas = new LengthAwarePaginator(
                $items,
                $count,
                $request->per_page,
                $request->page,
                ['path' => $request->url()]
            );
            return response()->json($cotas);
        }
    }

    public function getTotalComStatusPago(Request $request){
        if($request->expectsJson()){
            $total_pago = Rifa::where('id',$request->rifa_id)->withCount(['cotas as total_pago' => function($query){
                $query->where('status','PAGO');
            }])->first()->total_pago;
            return response()->json($total_pago);
        }
    }

    public function getTotalComStatusReservado(Request $request){
        if($request->expectsJson()){
            $total_reservado = Rifa::where('id',$request->rifa_id)->withCount(['cotas as total_reservado' => function($query){
                $query->where('status','RESERVADO');
            }])->first()->total_reservado;
            return response()->json($total_reservado);
        }
    }

    public function getTotalComStatusDisponivel(Request $request){
        if($request->expectsJson()){
            $total_disponivel = Rifa::where('id',$request->rifa_id)->withCount(['cotas as total_disponivel' => function($query){
                $query->where('status','DISPONIVEL');
            }])->first()->total_disponivel;
            return response()->json($total_disponivel);
        }
    }
}
