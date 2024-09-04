<?php

namespace App\Models;

use App\Models\Penerima;
use App\Models\Pengirim;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Pengiriman extends Model
{
    use HasFactory;
    protected $table = 'pengiriman';
    protected $primaryKey = 'no_trx';

    protected $fillable = [
        'kode_pengirim',
        'kode_penerima',
        'nama_penerima',
        'telp_penerima',
        'alamat_penerima_1',
        'alamat_penerima_2',
        'alamat_penerima_3',
        'alamat_penerima_4',
        'kode_pos_penerima',
        'jenis_pengiriman',
        'catatan',
        'no_resi',
        'tgl_resi',
    ];

    public function penerima()
    {
        return $this->belongsTo(Penerima::class, 'kode_penerima', 'kode_penerima');
    }

    public function pengirim()
    {
        return $this->belongsTo(Pengirim::class, 'kode_pengirim', 'kode_pengirim');
    }
}
