<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoryLelang extends Model
{
    protected $table = 'history_lelang';
    protected $fillable = ['id_lelang', 'id_barang', 'id_user', 'penawaran_harga'];

    public function lelang()
    {
        return $this->belongsTo(Lelang::class, 'id_lelang');
    }

    public function user() // Masyarakat yang menawar
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
