<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            if (Auth::check()) {
                return redirect('/');
            }
        } else {
            // Falha na autenticação
            return redirect()->route('contacts.index')->with('error', 'Credenciais inválidas');
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
