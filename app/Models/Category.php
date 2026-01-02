<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = ['name'];

    //RELASI: 1 KATEGORI PUNYA BANYAK BUKU
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
