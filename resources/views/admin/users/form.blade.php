<div class="mb-3">
    <label>Nama</label>
    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
        value="{{ old('name', $user->name ?? '') }}">
    @error('name')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
        value="{{ old('email', $user->email ?? '') }}">
    @error('email')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

@if (!isset($user))
    <div class="mb-3">
        <label>Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
        @error('password')
            <div class="text-danger small mt-1">{{ $message }}</div>
        @enderror
    </div>
@endif

<div class="mb-3">
    <label>Role</label>
    <select name="role" class="form-control @error('role') is-invalid @enderror">
        <option value="">-- Pilih Role --</option>
        @foreach ($roles as $role)
            <option value="{{ $role->name }}"
                {{ old('role', $user->roles[0]->name ?? '') == $role->name ? 'selected' : '' }}>
                {{ ucfirst($role->name) }}
            </option>
        @endforeach
    </select>
    @error('role')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Foto Profil</label>
    <input type="file" name="photo" class="form-control @error('photo') is-invalid @enderror">

    @error('photo')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror

    @isset($user)
        @if ($user->photo)
            <img src="{{ asset('profiles/' . $user->photo) }}" width="100" class="mt-2 rounded">
        @endif
    @endisset
</div>
