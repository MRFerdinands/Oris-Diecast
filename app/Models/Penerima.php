<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penerima extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_penerima';
    protected $table = 'penerima';

    protected $fillable = [
        'nama_penerima',
        'alamat_penerima_1',
        'alamat_penerima_2',
        'alamat_penerima_3',
        'alamat_penerima_4',
        'kode_pos_penerima',
        'telp_penerima',
    ];
}