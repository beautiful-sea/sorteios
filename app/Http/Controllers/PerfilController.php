<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PerfilController extends Controller
{
    public function index(Request $request)
    {
        if($request->expectsJson()){
            return response()->json(auth()->user());
        }
        return view('pages.admin.perfil');
    }

    public function update(Request $request){
        $user = auth()->user();
        //Validação
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:6|confirmed',
        ],[
            'name.required' => 'O campo nome é obrigatório',
            'email.required' => 'O campo email é obrigatório',
            'email.email' => 'O campo email deve ser um email válido',
            'email.unique' => 'O email informado já está em uso',
            'password.min' => 'O campo senha deve ter no mínimo 6 caracteres',
            'password.confirmed' => 'O campo senha não confere com a confirmação de senha',
        ]);
        $data = $request->all();
        if($request->password){
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        return response()->json($user,200);
    }
}
