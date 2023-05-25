<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        if($request->expectsJson()){
            return response()->json(\App\Models\User::all());
        }
        return view('pages.admin.usuarios.index');
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
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ],
        [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'O email já está cadastrado',
            'password.required' => 'A senha é obrigatória',

        ]);
        $data = $request->all();
        $data['password'] = bcrypt($data['password']);
        $user = \App\Models\User::create($data);

        return response()->json($user);
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
    public function update(Request $request, $usuario)
    {
        //
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$usuario,
        ],
        [
            'name.required' => 'O nome é obrigatório',
            'email.required' => 'O email é obrigatório',
            'email.email' => 'O email deve ser válido',
            'email.unique' => 'O email já está cadastrado',
        ]);
        $data = $request->all();
        if($request->password){
            $data['password'] = bcrypt($data['password']);
        }else{
            unset($data['password']);
        }
        $user = \App\Models\User::find($usuario);
        $user->update($data);

        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($usuario)
    {
        //
        $user = \App\Models\User::find($usuario);
        //Nao permite deletar o usuario logado, nem o ultimo usuario
        if($user->id == auth()->user()->id || count(\App\Models\User::all()) == 1){
            return response()->json(['message' => 'Não é possível deletar o usuário logado ou o último usuário'], 400);
        }
        $user->delete();
        return response()->json($user);
    }
}
