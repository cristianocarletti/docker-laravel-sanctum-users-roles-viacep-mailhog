<?php
// app/Http/Controllers/Web/AdminUserController.php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::query();

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $users = $query->paginate(10);

        // Métricas básicas
        $totalUsers = User::count();
        $usersByCity = User::select('city')->groupBy('city')->selectRaw('count(*) as total, city')->get();

        return view('dashboard', compact('users', 'totalUsers', 'usersByCity'));
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.edit', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|confirmed|min:6',
            'zipcode' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'role' => 'required|in:admin,user'
        ]);

        $dados = $request->all();
        $dados['password'] = bcrypt($dados['password']);

        User::create($dados);

        return redirect('/admin/users')->with('success', 'Usuário criado com sucesso.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'zipcode' => 'required|string',
            'street' => 'required|string',
            'number' => 'required|string',
            'neighborhood' => 'required|string',
            'city' => 'required|string',
            'state' => 'required|string',
            'role' => 'required|in:admin,user',
            'password' => 'nullable|string|confirmed|min:6',
        ]);

        $user = User::findOrFail($id);

        $data = $request->only([
            'name',
            'email',
            'zipcode',
            'street',
            'number',
            'neighborhood',
            'city',
            'state',
            'role'
        ]);

        if ($request->filled('password')) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);

        return redirect('/dashboard')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function dashboard(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            return view('dashboard');
        }

        $query = User::query();

        if ($request->filled('email')) {
            $query->where('email', 'like', '%' . $request->email . '%');
        }

        if ($request->filled('city')) {
            $query->where('city', 'like', '%' . $request->city . '%');
        }

        $users = $query->orderBy('id', 'desc')->paginate(10);

        // Métricas básicas
        $totalUsers = User::count();
        $usersByCity = User::select('city')->groupBy('city')->selectRaw('count(*) as total, city')->get();

        return view('dashboard', compact('users', 'totalUsers', 'usersByCity'));
    }

    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->back()->with('error', 'Usuário não encontrado.');
        }

        $user->delete();

        return redirect()->back()->with('success', 'Usuário excluído com sucesso.');
    }
}
