<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_barang'   => Barang::count(),
            'lelang_aktif'   => Lelang::where('status', 'dibuka')->count(),
            'total_masyarakat' => User::where('role_id', 3)->count(),
            'pendapatan'     => Lelang::where('status', 'ditutup')->sum('harga_akhir'),
        ];

        // Ambil data terbaru untuk tabel ringkasan
        $lelang_terbaru = Lelang::with('barang', 'user')->latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'lelang_terbaru'));
    }
}
