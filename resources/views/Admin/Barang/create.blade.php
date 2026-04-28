@extends('layouts.admin')
@section('title', 'Tambah Barang Baru')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('barang.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center font-semibold text-sm transition-all group">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Kembali ke Daftar Barang
        </a>
        <h1 class="text-3xl font-extrabold text-slate-800 mt-4">Input Inventaris Barang</h1>
        <p class="text-slate-500">Pastikan data barang sudah benar sebelum dipublikasikan ke sistem lelang.</p>
    </div>

    @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border-l-4 border-red-500 text-red-700 rounded-r-xl">
            <p class="font-bold">Terjadi kesalahan input:</p>
            <ul class="list-disc ml-5 text-sm mt-1">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('barang.store') }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 md:p-12">
        @csrf
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

            <div class="space-y-4">
                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Foto Produk</label>
                <div class="relative group border-2 border-dashed border-slate-200 rounded-3xl p-4 transition-all hover:border-orange-400">
                    <input type="file" name="foto" id="fotoInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage()">
                    <div id="previewContainer" class="flex flex-col items-center justify-center py-10">
                        <i data-lucide="image-plus" class="w-12 h-12 text-slate-300 mb-3 group-hover:scale-110 transition-transform"></i>
                        <p class="text-xs text-slate-400 text-center font-medium">Klik atau tarik gambar ke sini<br><span class="text-[10px]">(Max 2MB: JPG, PNG, JPEG)</span></p>
                    </div>
                    <img id="imagePreview" class="hidden w-full h-48 object-cover rounded-2xl shadow-md border border-slate-100">
                </div>
            </div>

            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Kategori</label>
                    <select name="id_kategori" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach(\App\Models\Kategori::all() as $kat)
                            <option value="{{ $kat->id }}">{{ $kat->nama_kategori }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Nama Barang</label>
                    <input type="text" name="nama_barang" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all placeholder-slate-300 font-medium" placeholder="Contoh: Laptop MacBook Pro" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Harga Awal (IDR)</label>
                    <div class="relative">

                        <input type="number" name="harga_awal" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all placeholder-slate-300 font-bold text-orange-600" placeholder="0" required>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi Barang</label>
                <textarea name="deskripsi" rows="4" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all placeholder-slate-300 font-medium" placeholder="Tuliskan detail kondisi barang..." required></textarea>
            </div>
        </div>

        <div class="mt-12 flex items-center justify-end space-x-4 border-t border-slate-50 pt-8">
            <button type="reset" class="px-8 py-4 text-slate-400 font-bold hover:text-slate-600 transition-colors">Reset</button>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-10 py-4 rounded-2xl shadow-xl shadow-blue-200 transition-all transform hover:-translate-y-1 active:scale-95 font-bold">
                SIMPAN BARANG
            </button>
        </div>
    </form>
</div>

<script>
function previewImage() {
    const input = document.getElementById('fotoInput');
    const preview = document.getElementById('imagePreview');
    const container = document.getElementById('previewContainer');

    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = function(e) {
            preview.src = e.target.result;
            preview.classList.remove('hidden');
            container.classList.add('hidden');
        }
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endsection
