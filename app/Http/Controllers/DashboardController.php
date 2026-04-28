<?php

namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

            if ($user->role_id == 1) { // ADMIN
                $stats = [
                    'total_barang'   => Barang::count(),
                    'lelang_aktif'   => Lelang::where('status', 'dibuka')->count(),
                    'total_masyarakat' => User::where('role_id', 3)->count(),
                    'pendapatan'     => Lelang::where('status', 'ditutup')->sum('harga_akhir'),
                ];
            } else { // PETUGAS
                $stats = [
                    'lelang_saya'   => Lelang::where('id_petugas', $user->id)->count(),
                    'perlu_ditutup' => Lelang::where('id_petugas', $user->id)->where('status', 'dibuka')->count(),
                    'total_barang'  => Barang::count(),
                    'terjual'       => Lelang::where('id_petugas', $user->id)->where('status', 'ditutup')->count(),
                ];
            }

            $lelang_terbaru = Lelang::with('barang', 'user')->latest()->take(5)->get();

            return view('admin.dashboard', compact('stats', 'lelang_terbaru'));
            }
}
