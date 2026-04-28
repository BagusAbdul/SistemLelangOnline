<?php

// app/Http/Controllers/KatalogController.php
namespace App\Http\Controllers;

use App\Models\Lelang;
use App\Models\HistoryLelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KatalogController extends Controller
{
    public function index(Request $request)
    {
        $query = Lelang::with(['barang.kategori'])->where('status', 'dibuka');

        // Fitur Filter Kategori
        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('barang', function($q) use ($request) {
                $q->where('id_kategori', $request->kategori);
            });
        }

        // Gunakan paginate(8) untuk 8 barang per halaman
        $lelangs = $query->latest()->paginate(8);
        $kategoris = \App\Models\Kategori::all();

        return view('frontend.landing', compact('lelangs', 'kategoris'));
        }

    public function detail($id)
    {
        $lelang = Lelang::with(['barang', 'history.user'])->findOrFail($id);
        return view('masyarakat.detail', compact('lelang'));
    }

    public function bid(Request $request, $id)
    {
        $lelang = Lelang::findOrFail($id);

        // KUNCI UTAMA: Cek apakah lelang masih dibuka
        if ($lelang->status !== 'dibuka') {
            return back()->with('error', 'Maaf, penawaran tidak dapat diterima karena lelang sudah ditutup.');
        }

        $harga_tertinggi = $lelang->history()->max('penawaran_harga') ?? $lelang->barang->harga_awal;

        $request->validate([
            'penawaran_harga' => 'required|numeric|gt:' . $harga_tertinggi,
        ], [
            'penawaran_harga.gt' => 'Tawaran Anda harus lebih tinggi dari Rp ' . number_format($harga_tertinggi)
        ]);

        HistoryLelang::create([
            'id_lelang' => $lelang->id,
            'id_barang' => $lelang->id_barang,
            'id_user' => Auth::id(),
            'penawaran_harga' => $request->penawaran_harga,
        ]);

        return back()->with('success', 'Penawaran Anda berhasil dikirim!');
    }

    public function history()
    {
        $history = HistoryLelang::with('barang', 'lelang')
                    ->where('id_user', Auth::id())
                    ->orderBy('created_at', 'desc')
                    ->get();

        return view('masyarakat.history', compact('history'));
    }
}
