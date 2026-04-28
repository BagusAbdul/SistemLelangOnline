<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class UserController extends Controller
{
    public function index()
    {
    if (auth()->user()->role_id != 1) {
        return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
    }

    $users = User::whereIn('role_id', [1, 2])->get();
    return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required|string|max:255',
            'username'     => 'required|string|unique:users|max:255',
            'password'     => 'required|min:6',
            'role_id'      => 'required|in:1,2', // Hanya boleh pilih Admin atau Petugas
        ]);

        User::create([
            'nama_lengkap' => $request->nama_lengkap,
            'username'     => $request->username,
            'password'     => Hash::make($request->password),
            'role_id'      => $request->role_id,
            'telp'         => '0000', // Default untuk petugas
        ]);

        return back()->with('success', 'Akun petugas berhasil dibuat!');
    }

    public function masyarakat()
    {
        // Proteksi: Hanya Admin (1) yang bisa akses
        if (auth()->user()->role_id != 1) {
            return redirect()->route('dashboard')->with('error', 'Akses ditolak!');
        }

        // Ambil user dengan role Masyarakat (3)
        $masyarakat = User::where('role_id', 3)->latest()->get();

        return view('admin.user.masyarakat', compact('masyarakat'));
    }

    public function destroy($id) // Kita gunakan ID langsung agar lebih fleksibel
{
    $user = \App\Models\User::findOrFail($id);

    // 1. Proteksi: Jangan hapus diri sendiri
    if ($user->id == auth()->id()) {
        return back()->with('error', 'Anda tidak bisa menghapus akun sendiri!');
    }

    try {
        // 2. BERSIHKAN JEJAK DI TABEL HISTORY
        // Hapus semua tawaran yang pernah dibuat oleh user ini (jika masyarakat)
        \App\Models\HistoryLelang::where('id_user', $user->id)->delete();

        // 3. BERSIHKAN JEJAK DI TABEL LELANG
        // Jika dia petugas, kita tidak hapus lelangnya (nanti datanya hilang),
        // tapi kita kosongkan id_petugas-nya saja.
        \App\Models\Lelang::where('id_petugas', $user->id)->update(['id_petugas' => null]);

        // Jika dia pemenang lelang, kita kosongkan id_user di tabel lelang.
        \App\Models\Lelang::where('id_user', $user->id)->update(['id_user' => null]);

        // 4. EKSEKUSI HAPUS USER
        $user->delete();

        return back()->with('success', 'User berhasil dihapus beserta seluruh riwayatnya.');

    } catch (\Exception $e) {
        // Jika masih error, tampilkan pesan error aslinya untuk diagnosa
        return back()->with('error', 'Gagal menghapus: ' . $e->getMessage());
    }
}
}
