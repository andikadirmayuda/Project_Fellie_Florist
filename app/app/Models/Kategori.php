<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Kategori extends Model
{    protected $table = 'kategori';
    protected $fillable = ['kode_kategori', 'nama_kategori'];

    public function produk(): HasMany
    {
        return $this->hasMany(Produk::class, 'id_kategori');
    }
}
