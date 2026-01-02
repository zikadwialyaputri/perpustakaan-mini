<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control"
        value="{{ old('name', $user->name ?? '') }}">
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control"
        value="{{ old('email', $user->email ?? '') }}">
</div>

@if(!isset($user))
<div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control">
</div>
@endif

<div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control">
        @foreach($roles as $role)
            <option value="{{ $role->name }}"
                {{ isset($user) && $user->hasRole($role->name) ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Foto Profil</label>
    <input type="file" name="photo" class="form-control">
</div>

