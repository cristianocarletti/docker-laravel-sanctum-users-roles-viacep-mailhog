@extends('app')

@section('content')
    <h2>Cadastrar Novo Usuário</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/admin/users">
        @csrf

        @include('components.form-user-fields')

        <button type="submit" class="btn btn-success">Cadastrar</button>
    </form>

    @include('components.script-viacep')
@endsection