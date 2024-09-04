<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_bayar';
    protected $keyType = 'string';

    protected $fillable = [
        'kode_bayar',
        'nama_bayar',
        'potongan'
    ];
}