<div class="mb-3">
    <label class="form-label">Nama Kategori</label>
    <input type="text" name="name" class="form-control"
           value="{{ old('name', $category->name ?? '') }}" required>
</div>
