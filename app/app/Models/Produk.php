<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Produk extends Model
{
    protected $table = 'produk';
    protected $fillable = [
        'id_kategori',
        'nama_produk',
        'kode_produk',
        'deskripsi',
        'gambar',
        'status_produk',
        'dibuat_oleh'
    ];

    public function kategori(): BelongsTo
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }

    public function variasi(): HasMany
    {
        return $this->hasMany(VariasiProduk::class, 'id_produk');
    }
}
