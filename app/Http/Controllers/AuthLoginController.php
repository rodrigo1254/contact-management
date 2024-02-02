<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Autenticação bem-sucedida
            // Modificar a variável de ambiente aqui
            // Exemplo: config(['app.authenticated' => true]);
            return response()->json(['message' => 'Autenticação bem-sucedida'], 200);
        } else {
            // Falha na autenticação
            return response()->json(['message' => 'Credenciais inválidas'], 401);
        }
    }
}
