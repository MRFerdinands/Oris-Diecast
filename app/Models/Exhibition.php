<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exhibition extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_event',
        'tgl_mulai_event',
        'tgl_selesai_event',
        'alamat_event',
        'lokasi_booth',
        'nama_eo',
        'gambar_banner_1',
        'gambar_banner_2',
    ];
}