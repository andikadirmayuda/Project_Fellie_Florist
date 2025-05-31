<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class VariasiProduk extends Model
{
    protected $table = 'variasi_produk';
    protected $fillable = [
        'id_produk',
        'tipe_variasi',
        'harga',
        'stok'
    ];

    public function produk(): BelongsTo
    {
        return $this->belongsTo(Produk::class, 'id_produk');
    }

    public function inventaris(): HasMany
    {
        return $this->hasMany(Inventaris::class, 'id_variasi');
    }
}
