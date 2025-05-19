@extends('app')

@section('content')
    <h2>Login</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    <form method="POST" action="/login">
        @csrf
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <a href="/forgot-password">Esqueci minha senha</a>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
@endsection
