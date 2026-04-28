@extends('layouts.frontend')
@section('title', 'Riwayat Tawaran Saya')

@section('content')
<section class="py-16 bg-slate-50 min-h-screen">
    <div class="max-w-5xl mx-auto px-6">
        <div class="mb-10">
            <h1 class="text-3xl font-extrabold text-slate-800">Aktivitas Penawaran</h1>
            <p class="text-slate-500">Pantau semua barang yang telah Anda tawar.</p>
        </div>

        <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-bold tracking-widest">
                        <th class="px-8 py-6">Barang</th>
                        <th class="px-6 py-6 text-center">Tawaran Anda</th>
                        <th class="px-6 py-6 text-center">Waktu</th>
                        <th class="px-6 py-6 text-center">Status</th>
                        <th class="px-6 py-6 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @forelse($history as $h)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-6">
                            <div class="flex items-center space-x-4">
                                <img src="{{ asset('storage/' . $h->barang->foto) }}" class="w-12 h-12 rounded-xl object-cover">
                                <span class="font-bold text-slate-800">{{ $h->barang->nama_barang }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-6 text-center">
                            <span class="text-blue-600 font-black">Rp {{ number_format($h->penawaran_harga) }}</span>
                        </td>
                        <td class="px-6 py-6 text-center text-slate-400 text-xs">
                            {{ $h->created_at->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-6 text-center">
                            @if($h->lelang->status == 'ditutup')
                                @if($h->lelang->id_user == Auth::id())
                                    <span class="bg-green-100 text-green-600 px-3 py-1 rounded-full font-black text-[10px] uppercase">
                                        Selamat! Anda Menang
                                    </span>
                                @else
                                    <span class="bg-slate-100 text-slate-400 px-3 py-1 rounded-full font-black text-[10px] uppercase">
                                        Kalah
                                    </span>
                                @endif
                            @else
                                <span class="bg-blue-100 text-blue-600 px-3 py-1 rounded-full font-black text-[10px] uppercase animate-pulse">
                                    Berlangsung
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-6 text-center">
                            <a href="{{ route('katalog.detail', $h->id_lelang) }}" class="text-orange-500 font-bold text-xs hover:underline">Lihat Lelang</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="px-8 py-20 text-center text-slate-400">Anda belum melakukan penawaran apapun.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</section>
@endsection
