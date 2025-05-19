@php
    $editing = isset($user);
@endphp

<div class="mb-3">
    <label>Nome completo</label>
    <input type="text" name="name" class="form-control" value="{{ old('name', $editing ? $user->name : '') }}"
        required>
</div>
<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" value="{{ old('email', $editing ? $user->email : '') }}"
        required>
</div>
@if (!$editing)
    <div class="mb-3">
        <label>Senha</label>
        <input type="password" name="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label>Confirmação da Senha</label>
        <input type="password" name="password_confirmation" class="form-control" required>
    </div>
@else
    <div class="mb-3">
        <label>Nova Senha (opcional)</label>
        <input type="password" name="password" class="form-control">
    </div>
    <div class="mb-3">
        <label>Confirmação da Nova Senha</label>
        <input type="password" name="password_confirmation" class="form-control">
    </div>
@endif

<div class="mb-3">
    <label>CEP</label>
    <input type="text" name="zipcode" id="cep" class="form-control"
        value="{{ old('zipcode', $editing ? $user->zipcode : '') }}" required>
</div>
<div class="mb-3">
    <label>Rua</label>
    <input type="text" name="street" id="street" class="form-control"
        value="{{ old('street', $editing ? $user->street : '') }}" required>
</div>
<div class="mb-3">
    <label>Número</label>
    <input type="text" name="number" class="form-control" value="{{ old('number', $editing ? $user->number : '') }}"
        required>
</div>
<div class="mb-3">
    <label>Bairro</label>
    <input type="text" name="neighborhood" id="neighborhood" class="form-control"
        value="{{ old('neighborhood', $editing ? $user->neighborhood : '') }}" required>
</div>
<div class="mb-3">
    <label>Cidade</label>
    <input type="text" name="city" id="city" class="form-control"
        value="{{ old('city', $editing ? $user->city : '') }}" required>
</div>
<div class="mb-3">
    <label>Estado</label>
    <input type="text" name="state" id="state" class="form-control"
        value="{{ old('state', $editing ? $user->state : '') }}" required>
</div>
<div class="mb-3">
    <label>Perfil</label>
    <select name="role" class="form-control">
        <option value="user" {{ old('role', $editing ? $user->role : '') === 'user' ? 'selected' : '' }}>User
        </option>
        <option value="admin" {{ old('role', $editing ? $user->role : '') === 'admin' ? 'selected' : '' }}>Admin
        </option>
    </select>
</div>
