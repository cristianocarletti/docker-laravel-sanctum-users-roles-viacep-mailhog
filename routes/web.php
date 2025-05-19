<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\Web\AdminUserController;
use App\Http\Controllers\Web\LoginController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;








/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

/* Route::get('/register', function () {
    return view('auth.register');
})->name('register'); */

Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::get('/logout', [LoginController::class, 'logout'])->middleware('auth');

Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'forgotPassword'])->name('password.email');
Route::get('/reset-password', function () {
    return view('auth.reset-password');
})->name('password.reset');

Route::post('/reset-password', function (Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:6',
    ]);

    $user = User::where('email', $request->email)->first();

    if (!$user || !Password::tokenExists($user, $request->token)) {
        return back()->withErrors(['token' => 'Token inválido ou expirado.']);
    }

    $user->update(['password' => Hash::make($request->password)]);

    return redirect('/login')->with('status', 'Senha redefinida com sucesso.');
});

Route::middleware(['auth:sanctum', 'is.admin'])->group(function () {

    Route::get('/admin/users', [AdminUserController::class, 'index']);
    Route::get('/admin/users/{id}/edit', [AdminUserController::class, 'edit']);
    Route::put('/admin/users/{id}', [AdminUserController::class, 'update']);
    Route::get('/admin/users/create', function () {
        return view('user.create');
    });
    Route::post('/admin/users', [AdminUserController::class, 'store']);
    Route::delete('/users/{id}', [AdminUserController::class, 'destroy']);

    /* Route::get('/dashboard', [AdminUserController::class, 'dashboard'])->middleware('auth')->name('dashboard'); */
    Route::get('/dashboard', function () {
        return auth()->user()->role === 'admin'
            ? app(AdminUserController::class)->dashboard(request())
            : view('dashboard');
    })->middleware('auth')->name('dashboard');
});
