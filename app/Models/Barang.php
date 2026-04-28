<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    protected $fillable = ['nama_barang', 'tgl', 'harga_awal', 'deskripsi', 'foto', 'id_kategori'];

    public function lelang()
    {
        return $this->hasOne(Lelang::class, 'id_barang');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori');
    }
}
