<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StoreLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_toko',
        'alamat_toko',
        'contact_person',
        'phone_number',
        'gambar_toko_1',
        'gambar_toko_2',
        'gambar_toko_3',
        'gambar_toko_4'
    ];
}