@extends('app')

@section('content')
    <h2>Administração de Usuários</h2>

    <form method="GET" class="row mb-4">
        <div class="col">
            <input type="text" name="email" class="form-control" placeholder="Filtrar por email" value="{{ request('email') }}">
        </div>
        <div class="col">
            <input type="text" name="city" class="form-control" placeholder="Filtrar por cidade" value="{{ request('city') }}">
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Filtrar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nome</th>
                <th>Email</th>
                <th>Cidade</th>
                <th>Perfil</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->city }}</td>
                    <td>{{ $user->role }}</td>
                    <td class="d-flex gap-1">
                        <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-sm btn-info">Editar</a>
                        <form action="/users/{{ $user->id }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" onclick="return confirm('Excluir este usuário?')">Excluir</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $users->withQueryString()->links() }}
@endsection