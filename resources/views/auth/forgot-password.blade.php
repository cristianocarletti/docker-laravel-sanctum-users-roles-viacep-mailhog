@extends('app')

@section('content')
    <h2>Recuperar Senha</h2>

    @if(session('status'))
        <div class="alert alert-success">{{ session('status') }}</div>
    @endif

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="/forgot-password">
        @csrf
        <div class="mb-3">
            <label>Email cadastrado</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-warning">Enviar link de redefinição</button>
    </form>
@endsection
