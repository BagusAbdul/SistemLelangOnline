<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
// app/Http/Controllers/KategoriController.php

    public function index() {
        $kategoris = Kategori::withCount('barang')->get();
        return view('admin.kategori.index', compact('kategoris'));
    }

    public function store(Request $request) {
        $request->validate([
            'nama_kategori' => 'required|unique:kategoris,nama_kategori|max:50'
        ]);
        Kategori::create($request->all());
        return back()->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    public function destroy(Kategori $kategori) {
        // Cek jika kategori masih digunakan oleh barang
        if ($kategori->barang()->count() > 0) {
            return back()->with('error', 'Kategori tidak bisa dihapus karena masih digunakan oleh beberapa barang.');
        }
        $kategori->delete();
        return back()->with('success', 'Kategori berhasil dihapus.');
    }
}
