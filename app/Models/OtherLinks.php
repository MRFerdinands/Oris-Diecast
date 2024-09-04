<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherLinks extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_link',
        'alamat_link',
        'gambar_link',
    ];
}