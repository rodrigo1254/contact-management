<!-- resources/views/home/index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Bem-vindo à Página Inicial</h1>

        <!-- Formulário de Login Rápido -->
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <input type="hidden" name="email" value="rodrigo1254@gmail.com">
            <input type="hidden" name="password" value="123456">
            <button type="submit">Entrar com Login Rápido</button>
        </form>

        <!-- Link para Entrar sem Logar -->
        <a href="{{ route('contacts.index') }}">Entrar sem Logar</a>
    </div>
@endsection
