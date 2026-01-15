<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id"
        class="form-control @error('category_id') is-invalid @enderror">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}"
                {{ old('category_id', $book->category_id ?? '') == $cat->id ? 'selected' : '' }}>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
    @error('category_id')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Judul Buku</label>
    <input type="text" name="judul"
        class="form-control @error('judul') is-invalid @enderror"
        value="{{ old('judul', $book->judul ?? '') }}">
    @error('judul')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Penulis</label>
    <input type="text" name="penulis"
        class="form-control @error('penulis') is-invalid @enderror"
        value="{{ old('penulis', $book->penulis ?? '') }}">
    @error('penulis')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Penerbit</label>
    <input type="text" name="penerbit"
        class="form-control @error('penerbit') is-invalid @enderror"
        value="{{ old('penerbit', $book->penerbit ?? '') }}">
    @error('penerbit')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Tahun</label>
    <input type="number" name="tahun"
        class="form-control @error('tahun') is-invalid @enderror"
        value="{{ old('tahun', $book->tahun ?? '') }}">
    @error('tahun')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi Buku</label>
    <textarea name="deskripsi"
        class="form-control @error('deskripsi') is-invalid @enderror"
        rows="4">{{ old('deskripsi', $book->deskripsi ?? '') }}</textarea>
    @error('deskripsi')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">Foto Buku</label>
    <input type="file" name="cover"
        class="form-control @error('cover') is-invalid @enderror">

    @error('cover')
        <div class="text-danger small mt-1">{{ $message }}</div>
    @enderror

    @isset($book)
        @if ($book->cover)
            <img src="{{ asset('covers/' . $book->cover) }}" width="120" class="mt-2">
        @endif
    @endisset
</div>
