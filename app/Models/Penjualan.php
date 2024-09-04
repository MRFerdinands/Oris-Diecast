<?php

namespace App\Models;

use App\Models\Product;
use App\Models\MetodePembayaran;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Penjualan extends Model
{
    use HasFactory;

    protected $primaryKey = 'no_urut';

    protected $fillable = [
        'tgl_penjualan',
        'kode_product',
        'harga_jual',
        'qty',
        'kode_bayar'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class, 'kode_product', 'kode_product');
    }
    public function metodepembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'kode_bayar', 'kode_bayar');
    }
}