<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengirim extends Model
{
    use HasFactory;
    protected $primaryKey = 'kode_pengirim';
    protected $table = 'pengirim';

    protected $fillable = [
        'nama_pengirim',
        'telp_pengirim',
        'status_pengirim'
    ];
}
