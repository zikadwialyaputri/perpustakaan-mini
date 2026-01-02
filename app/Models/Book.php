<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $table = 'books';

    // Mass assignment fields
    protected $fillable = [
        'judul',
        'penulis',
        'penerbit',
        'tahun',
        'cover',
        'category_id',
        'deskripsi',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
