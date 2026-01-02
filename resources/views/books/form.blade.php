<div class="mb-3">
    <label class="form-label">Kategori</label>
    <select name="category_id" class="form-control">
        <option value="">-- Pilih Kategori --</option>
        @foreach ($categories as $cat)
            <option value="{{ $cat->id }}" @selected(old('category_id', $book->category_id ?? '') == $cat->id)>
                {{ $cat->name }}
            </option>
        @endforeach
    </select>
</div>
<div class="mb-3">
    <label class="form-label">Judul Buku</label>
    <input type="text" name="judul" class="form-control" value="{{ old('judul', $book->judul ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Penulis</label>
    <input type="text" name="penulis" class="form-control" value="{{ old('penulis', $book->penulis ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Penerbit</label>
    <input type="text" name="penerbit" class="form-control" value="{{ old('penerbit', $book->penerbit ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Tahun</label>
    <input type="number" name="tahun" class="form-control" value="{{ old('tahun', $book->tahun ?? '') }}">
</div>
<div class="mb-3">
    <label class="form-label">Deskripsi Buku</label>
    <textarea name="deskripsi" class="form-control" rows="4">{{ old('deskripsi', $book->deskripsi ?? '') }}</textarea>
</div>
<div class="mb-3">
    <label class="form-label">Foto Buku</label>
    <input type="file" name="cover" class="form-control">
    @isset($book)
        @if ($book->cover)
            <img src="{{ asset('covers/' . $book->cover) }}" width="120" class="mt-2">
        @endif
    @endisset
</div>
