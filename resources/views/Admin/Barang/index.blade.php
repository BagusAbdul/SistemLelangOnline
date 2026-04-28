@extends('layouts.admin')
@section('title', 'Manajemen Barang')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Data Barang</h1>
        <p class="text-slate-500 mt-1">Daftar inventaris barang yang akan dilelang.</p>
    </div>
    <a href="{{ route('barang.create') }}" class="flex items-center justify-center space-x-2 bg-orange-500 hover:bg-orange-600 text-white px-6 py-3 rounded-2xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-1 active:scale-95 font-bold">
        <i data-lucide="plus-circle" class="w-5 h-5"></i>
        <span>Tambah Barang</span>
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50/50 border-b border-slate-100 text-slate-400 text-[10px] uppercase font-bold tracking-[0.15em]">
                <th class="px-8 py-5">Barang</th>
                <th class="px-6 py-5">Tanggal Masuk</th>
                <th class="px-6 py-5">Harga Awal</th>
                <th class="px-6 py-5 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 text-sm">
            @forelse($barangs as $item)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex items-center space-x-4">
                        <div class="w-14 h-14 rounded-2xl bg-slate-100 flex-shrink-0 overflow-hidden border border-slate-200 shadow-sm">
                            @if($item->foto)
                                <img src="{{ asset('storage/' . $item->foto) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-slate-400">
                                    <i data-lucide="image" class="w-6 h-6"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <p class="font-bold text-slate-800 text-base leading-tight">{{ $item->nama_barang }}</p>
                            <p class="text-xs text-slate-400 mt-1 line-clamp-1 max-w-[250px]">{{ $item->deskripsi }}</p>
                        </div>
                    </div>
                </td>
                <td class="px-6 py-5 text-slate-500 font-medium">
                    {{ \Carbon\Carbon::parse($item->tgl)->format('d M Y') }}
                </td>
                <td class="px-6 py-5">
                    <span class="bg-green-50 text-green-600 px-3 py-1 rounded-full font-bold text-xs border border-green-100">
                        Rp {{ number_format($item->harga_awal, 0, ',', '.') }}
                    </span>
                </td>
                <td class="px-6 py-5">
                    <div class="flex items-center justify-center space-x-2">
                        <a href="{{ route('barang.edit', $item->id) }}" class="p-2 text-blue-500 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                            <i data-lucide="edit-3" class="w-5 h-5"></i>
                        </a>
                        <form action="{{ route('barang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus barang ini? Semua data terkait barang ini akan hilang.')" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-red-500 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                <i data-lucide="trash-2" class="w-5 h-5"></i>
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="4" class="px-8 py-20 text-center">
                    <div class="flex flex-col items-center">
                        <i data-lucide="inbox" class="w-12 h-12 text-slate-200 mb-4"></i>
                        <p class="text-slate-400 font-medium">Belum ada data barang tersedia.</p>
                    </div>
                </td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
