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
    <label class="form-label">Foto Buku</label>
    <input type="file" name="cover" class="form-control">

    @isset($book)
        @if ($book->cover)
            <img src="{{ asset('covers/' . $book->cover) }}" width="120" class="mt-2">
        @endif
    @endisset
</div>
