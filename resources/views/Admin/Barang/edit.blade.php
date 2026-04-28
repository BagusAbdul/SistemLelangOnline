@extends('layouts.admin')
@section('title', 'Edit Barang')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="mb-8">
        <a href="{{ route('barang.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center font-semibold text-sm transition-all group">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform"></i>
            Batal dan Kembali
        </a>
        <h1 class="text-3xl font-extrabold text-slate-800 mt-4">Edit Data Barang</h1>
        <p class="text-slate-500">Perbarui informasi barang inventaris lelang Anda.</p>
    </div>

    <form action="{{ route('barang.update', $barang->id) }}" method="POST" enctype="multipart/form-data" class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-8 md:p-12">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
            <div class="space-y-4">
                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider">Foto Barang</label>
                <div class="relative group border-2 border-dashed border-slate-200 rounded-3xl p-4 transition-all hover:border-blue-400">
                    <input type="file" name="foto" id="fotoInput" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" onchange="previewImage()">

                    <div id="previewContainer" class="{{ $barang->foto ? 'hidden' : '' }} flex flex-col items-center justify-center py-10">
                        <i data-lucide="image-plus" class="w-12 h-12 text-slate-300 mb-3"></i>
                        <p class="text-xs text-slate-400 text-center">Klik untuk ganti foto</p>
                    </div>

                    <img id="imagePreview" src="{{ $barang->foto ? asset('storage/'.$barang->foto) : '#' }}"
                         class="{{ $barang->foto ? '' : 'hidden' }} w-full h-48 object-cover rounded-2xl shadow-md">
                </div>
                <p class="text-[10px] text-slate-400 font-medium italic">*Kosongkan jika tidak ingin mengubah foto</p>
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
                    <input type="text" name="nama_barang" value="{{ $barang->nama_barang }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all font-medium" required>
                </div>

                <div>
                    <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Harga Awal (IDR)</label>
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 font-bold text-slate-400">Rp</span>
                        <input type="number" name="harga_awal" value="{{ $barang->harga_awal }}" class="w-full pl-12 pr-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all font-bold text-blue-600" required>
                    </div>
                </div>
            </div>

            <div class="md:col-span-2">
                <label class="block text-sm font-bold text-slate-700 uppercase tracking-wider mb-2">Deskripsi</label>
                <textarea name="deskripsi" rows="4" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all font-medium" required>{{ $barang->deskripsi }}</textarea>
            </div>
        </div>

        <div class="mt-12 flex items-center justify-end space-x-4 border-t border-slate-50 pt-8">
            <button type="submit" class="bg-orange-500 hover:bg-orange-600 text-white px-10 py-4 rounded-2xl shadow-xl shadow-orange-200 transition-all transform hover:-translate-y-1 font-bold uppercase tracking-widest">
                Simpan Perubahan
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
