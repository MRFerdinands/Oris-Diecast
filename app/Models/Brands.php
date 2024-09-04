<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brands extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_brand';
    protected $keyType = 'string';

    protected $fillable = [
        'nama_brand',
        'logo_brand',
        'gambar_produk_1',
        'gambar_produk_2',
        'gambar_produk_3',
        'gambar_produk_4',
    ];
}