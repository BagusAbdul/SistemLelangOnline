@extends('layouts.admin')
@section('title', 'Manajemen Kategori')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

    <div class="lg:col-span-2">
        <div class="mb-6">
            <h1 class="text-3xl font-extrabold text-slate-800">Kategori Barang</h1>
            <p class="text-slate-500">Kelompokkan barang lelang agar mudah dicari.</p>
        </div>

        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest border-b border-slate-100">
                        <th class="px-8 py-5">Nama Kategori</th>
                        <th class="px-6 py-5 text-center">Jumlah Barang</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($kategoris as $k)
                    <tr class="hover:bg-slate-50/50 transition-colors group">
                        <td class="px-8 py-5">
                            <span class="font-bold text-slate-700">{{ $k->nama_kategori }}</span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            <span class="bg-blue-50 text-blue-600 px-3 py-1 rounded-lg font-bold text-xs">
                                {{ $k->barang_count }} Barang
                            </span>
                        </td>
                        <td class="px-6 py-5">
                            <div class="flex items-center justify-center space-x-2">

                                <form action="{{ route('kategori.destroy', $k->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-500 hover:bg-red-50 rounded-lg transition-all">
                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="3" class="px-8 py-10 text-center text-slate-400">Belum ada kategori.</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 sticky top-24">
            <h3 class="text-xl font-bold text-slate-800 mb-6 flex items-center">
                <i data-lucide="plus-circle" class="w-5 h-5 mr-2 text-orange-500"></i> Tambah Baru
            </h3>
            <form action="{{ route('kategori.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                        <input type="text" name="nama_kategori" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all placeholder-slate-300 font-medium" placeholder="Misal: Elektronik" required>
                    </div>
                    <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-1">
                        SIMPAN KATEGORI
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
