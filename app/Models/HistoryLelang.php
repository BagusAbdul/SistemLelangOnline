<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HistoryLelang extends Model
{
    use HasFactory;

    protected $table = 'history_lelang';
    protected $fillable = ['id_lelang', 'id_barang', 'id_user', 'penawaran_harga'];

    // Relasi ke Barang
    public function barang()
    {
        return $this->belongsTo(Barang::class, 'id_barang');
    }

    // Relasi ke Lelang
    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'id_lelang');
    }

    // Relasi ke User (Masyarakat yang menawar)
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
