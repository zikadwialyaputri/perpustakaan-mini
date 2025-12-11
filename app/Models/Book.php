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
    ];
}
