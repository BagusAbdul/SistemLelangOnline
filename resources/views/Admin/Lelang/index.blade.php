@extends('layouts.admin')
@section('title', 'Aktivasi Lelang')

@section('content')
<div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800 tracking-tight">Daftar Lelang</h1>
        <p class="text-slate-500 mt-1">Kelola status pembukaan dan penutupan lelang barang.</p>
    </div>
    <a href="{{ route('lelang.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-2xl shadow-lg font-bold transition-all">
        Buka Lelang Baru
    </a>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left border-collapse">
        <thead>
            <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                <th class="px-8 py-5">Barang</th>
                <th class="px-6 py-5">Tgl Buka</th>
                <th class="px-6 py-5">Harga Awal</th>
                <th class="px-6 py-5">Status</th>
                <th class="px-6 py-5">Petugas</th>
                <th class="px-6 py-5 text-center" colspan="2">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50 text-sm">
            @forelse($lelangs as $item)
            <tr class="hover:bg-slate-50 transition-colors">
                <td class="px-8 py-5 font-bold text-slate-800">{{ $item->barang->nama_barang }}</td>
                <td class="px-6 py-5">{{ \Carbon\Carbon::parse($item->tgl_lelang)->format('d/m/Y') }}</td>
                <td class="px-6 py-5 text-orange-600 font-bold">Rp {{ number_format($item->barang->harga_awal, 0, ',', '.') }}</td>
                <td class="px-6 py-5">
                    <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $item->status == 'dibuka' ? 'bg-green-100 text-green-600' : 'bg-red-100 text-red-600' }}">
                        {{ $item->status }}
                    </span>
                </td>
                <td class="px-6 py-5 text-slate-500">{{ $item->petugas->nama_lengkap }}</td>
                <td class="px-6 py-5 text-center">
                    @if($item->status == 'dibuka')
                        <form action="{{ route('lelang.tutup', $item->id) }}" method="POST" onsubmit="return confirm('Tutup lelang sekarang dan tentukan pemenang?')">
                            @csrf
                            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl text-xs font-bold transition-all shadow-md shadow-red-200">
                                Tutup Lelang
                            </button>
                        </form>
                    @else
                        <span class="text-slate-400 font-medium italic text-xs">Selesai</span>
                    @endif
                </td>
                <td class="px-6 py-5 text-center">
                    <form action="{{ route('lelang.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Hapus data lelang ini?')">
                        @csrf @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-700">
                            <i data-lucide="trash-2" class="w-5 h-5"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="6" class="px-8 py-20 text-center text-slate-400">Belum ada lelang yang diaktivasi.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
