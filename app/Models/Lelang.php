<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lelang extends Model
{
    protected $table = 'lelang';
    protected $fillable = [
        'id_barang', 'tgl_lelang', 'harga_akhir', 'id_user', 'id_petugas', 'status'
    ];

    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    public function pemenang() // Masyarakat yang menang
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function petugas() // Petugas yang membuka lelang
    {
        return $this->belongsTo(User::class, 'id_petugas');
    }

    public function history()
    {
        return $this->hasMany(HistoryLelang::class, 'id_lelang')->orderBy('penawaran_harga', 'desc');
    }
}
