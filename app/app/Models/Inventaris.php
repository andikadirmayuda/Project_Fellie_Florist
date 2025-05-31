<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Inventaris extends Model
{
    protected $table = 'inventaris';
    protected $fillable = [
        'id_variasi',
        'jenis',
        'jumlah',
        'tanggal',
        'id_user',
        'keterangan'
    ];

    public function variasiProduk(): BelongsTo
    {
        return $this->belongsTo(VariasiProduk::class, 'id_variasi');
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
