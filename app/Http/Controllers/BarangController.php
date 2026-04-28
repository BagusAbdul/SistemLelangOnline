<?php


namespace App\Http\Controllers;

use App\Models\Barang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BarangController extends Controller
{
    public function index() {
        $barangs = Barang::all();
        return view('admin.barang.index', compact('barangs'));
    }

    public function create() {
        return view('admin.barang.create');
    }

    public function store(Request $request) {
        $request->validate([
            'nama_barang' => 'required',
            'harga_awal' => 'required|numeric',
            'deskripsi' => 'required',
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();
        $data['tgl'] = now();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        }

        Barang::create($data);
        return redirect()->route('barang.index')->with('success', 'Barang berhasil ditambahkan!');
    }

        public function edit(Barang $barang)
    {
        // Menampilkan halaman form edit dengan data barang yang dipilih
        return view('admin.barang.edit', compact('barang'));
    }

    public function update(Request $request, Barang $barang)
    {
        $request->validate([
            'nama_barang' => 'required|string|max:100',
            'harga_awal'  => 'required|numeric|min:1',
            'deskripsi'   => 'required',
            'foto'        => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada foto baru yang diupload
            if ($barang->foto) {
                \Storage::disk('public')->delete($barang->foto);
            }
            $data['foto'] = $request->file('foto')->store('barang', 'public');
        } else {
            // Jika tidak upload foto baru, gunakan foto lama
            $data['foto'] = $barang->foto;
        }

        $barang->update($data);

        return redirect()->route('barang.index')->with('success', 'Data barang berhasil diperbarui!');
    }
    public function destroy(Barang $barang)
    {
        // 1. Hapus foto dari folder storage jika ada
        if ($barang->foto) {
            \Storage::disk('public')->delete($barang->foto);
        }

        // 2. Hapus data dari database
        $barang->delete();

        // 3. Kembali dengan pesan sukses
        return redirect()->route('barang.index')->with('success', 'Barang telah berhasil dihapus dari sistem.');
    }
}
