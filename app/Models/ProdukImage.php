<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukImage extends Model
{
    protected $fillable = [
        'user_id',
        'url',
    ];

    public function produk() {
        return $this->belongsTo('App\Produk', 'produk_id');
    }
}
