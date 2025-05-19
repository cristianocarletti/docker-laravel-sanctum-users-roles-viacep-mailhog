@extends('app')

@section('content')
    <h1>Bem-vindo, {{ auth()->user()->name }}!</h1>
    <p class="text-muted">Você está autenticado como <strong>{{ auth()->user()->role }}</strong>.</p>

    @if (auth()->user()->role === 'admin')

        <div class="row g-3 mb-3">
            <div class="col-md-4">
                
                    <div class="alert alert-info">
                    <strong>Total de Usuários:</strong>
                    <h3>{{ $totalUsers }}</h3>
                    </div>
                
            </div>
            <div class="col-md-8">
                
                    <div class="alert alert-info">
                    <strong>Usuários por Cidade:</strong>
                    <ul class="mb-0">
                        @foreach ($usersByCity as $city)
                            <li>{{ $city->city }}: {{ $city->total }}</li>
                        @endforeach
                    </ul>
                    </div>
                
            </div>

            <div class="col-md-3">
                <a href="/admin/users/create" class="btn btn-success mb-3">Cadastrar Novo Usuário</a>
            </div>
        </div>

        <form method="GET" id="filter-form" class="row mb-4">
            <div class="col">
                <input type="text" name="email" class="form-control filter-field" placeholder="Filtrar por email"
                    value="{{ request('email') }}">
            </div>
            <div class="col">
                <input type="text" name="city" class="form-control filter-field" placeholder="Filtrar por cidade"
                    value="{{ request('city') }}">
            </div>
            <div class="col-auto">
                <button type="submit" class="btn btn-primary">Filtrar</button>
            </div>
        </form>

        <div class="d-flex justify-content-center mb-3">
            {{ $users->withQueryString()->onEachSide(1)->links('vendor.pagination.bootstrap-4-pt-br') }}
        </div>

        <table class="table table-bordered" style="padding: 12px">
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
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->city }}</td>
                        <td>
                            <span
                                class="badge bg-{{ $user->role === 'admin' ? 'danger' : 'secondary' }}">{{ $user->role }}</span>
                        </td>
                        <td class="d-flex gap-1">
                            <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-sm btn-info">Editar</a>
                            <form action="/users/{{ $user->id }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-sm btn-danger"
                                    onclick="return confirm('Excluir este usuário?')">Excluir</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="d-flex justify-content-center mt-4">
            {{ $users->withQueryString()->onEachSide(1)->links('vendor.pagination.bootstrap-4-pt-br') }}
        </div>

        <script>
            document.querySelectorAll('.filter-field').forEach(field => {
                field.addEventListener('blur', () => {
                    document.getElementById('filter-form').submit();
                });
            });
        </script>
    @else
        <div class="alert alert-success">Área de usuário comum</div>
    @endif
@endsection
