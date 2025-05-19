@extends('app')

@section('content')
    <h1>Bem-vindo, {{ auth()->user()->name }}!</h1>
    <p class="text-muted">Você está autenticado como <strong>{{ auth()->user()->role }}</strong>.</p>
    <div class="text-center mt-5">
        <h1 class="display-4 text-danger">🚫 Acesso Negado</h1>
        <p class="lead">Você não tem permissão para acessar esta página.</p>
        <a href="{{ url()->previous() }}" class="btn btn-outline-secondary mt-3">Voltar</a>
    </div>
@endsection
