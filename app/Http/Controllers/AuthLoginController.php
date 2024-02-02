<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthLoginController extends Controller
{
    public function login(Request $request)
    {
        try{
            $credentials = $request->only('email', 'password');

            if (Auth::attempt($credentials)) {
                if (Auth::check()) {
                    return response()->json(['message' => 'Autenticação bem-sucedida'], 200);
                }
            } else {
                return response()->json(['status' => false],500);
            }
            
        }catch (\Exception $e){
            return response()->json(['status' => false, 'message' => $e->getMessage()], 500);
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
