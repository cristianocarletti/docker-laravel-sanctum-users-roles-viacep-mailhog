@extends('app')

@section('content')
    <h2>Cadastro</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/register">
        @csrf
        <div class="mb-3">
            <label>Nome completo</label>
            <input type="text" name="name" class="form-control" required value="{{ old('name') }}">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required value="{{ old('email') }}">
        </div>
        <div class="mb-3">
            <label>Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Confirmação da Senha</label>
            <input type="password" name="password_confirmation" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>CEP</label>
            <input type="text" name="zipcode" class="form-control" required value="{{ old('zipcode') }}">
        </div>
        <div class="mb-3">
            <label>Rua</label>
            <input type="text" name="street" class="form-control" required value="{{ old('street') }}">
        </div>
        <div class="mb-3">
            <label>Número</label>
            <input type="text" name="number" class="form-control" required value="{{ old('number') }}">
        </div>
        <div class="mb-3">
            <label>Bairro</label>
            <input type="text" name="neighborhood" class="form-control" required value="{{ old('neighborhood') }}">
        </div>
        <div class="mb-3">
            <label>Cidade</label>
            <input type="text" name="city" class="form-control" required value="{{ old('city') }}">
        </div>
        <div class="mb-3">
            <label>Estado</label>
            <input type="text" name="state" class="form-control" required value="{{ old('state') }}">
        </div>
        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>
@endsection