<?php
// app/Http/Controllers/LelangController.php
namespace App\Http\Controllers;

use App\Models\Barang;
use App\Models\Lelang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LelangController extends Controller
{
    public function index()
    {
        // Menampilkan barang yang sudah masuk ke list lelang
        $lelangs = Lelang::with('barang', 'petugas')->orderBy('tgl_lelang', 'desc')->get();
        return view('admin.lelang.index', compact('lelangs'));
    }

    public function create()
    {
        // Hanya ambil barang yang BELUM ada di list lelang
        $barangs = Barang::doesntHave('lelang')->get();
        return view('admin.lelang.create', compact('barangs'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_barang' => 'required|exists:barang,id',
            'tgl_lelang' => 'required|date',
        ]);

        Lelang::create([
            'id_barang' => $request->id_barang,
            'tgl_lelang' => $request->tgl_lelang,
            'id_petugas' => Auth::id(),
            'status' => 'dibuka', // Otomatis langsung dibuka
        ]);

        return redirect()->route('lelang.index')->with('success', 'Lelang berhasil dibuka!');
    }

    public function destroy(Lelang $lelang)
    {
        $lelang->delete();
        return redirect()->route('lelang.index')->with('success', 'Data lelang berhasil dihapus.');
    }

    public function tutupLelang($id)
    {
        $lelang = Lelang::with(['history' => function($query) {
            $query->orderBy('penawaran_harga', 'desc');
        }])->findOrFail($id);

        // Ambil penawar tertinggi
        $pemenang = $lelang->history->first();

        if ($pemenang) {
            // Update data lelang
            $lelang->update([
                'status' => 'ditutup',
                'id_user' => $pemenang->id_user,
                'harga_akhir' => $pemenang->penawaran_harga
            ]);

            // Update status barang menjadi terjual
            $lelang->barang->update(['status' => 'terjual']);

            return back()->with('success', 'Lelang ditutup! Pemenang: ' . $pemenang->user->nama_lengkap);
        }

        // Jika tidak ada yang menawar, lelang tetap ditutup tanpa pemenang
        $lelang->update(['status' => 'ditutup']);
        $lelang->barang->update(['status' => 'tersedia']); // Barang bisa dilelang lagi nanti

        return back()->with('info', 'Lelang ditutup tanpa pemenang karena tidak ada tawaran.');
    }

    public function laporan()
    {
        // Hanya ambil lelang yang sudah selesai/ditutup (sudah terjual)
        $laporan = Lelang::with('barang', 'user', 'petugas')
                    ->where('status', 'ditutup')
                    ->get();

        return view('admin.lelang.laporan', compact('laporan'));
    }
}
