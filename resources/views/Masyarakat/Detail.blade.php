@extends('layouts.auth')
@section('title', $lelang->barang->nama_barang)

@section('content')
<div class="max-w-6xl mx-auto w-full px-4 py-12">
    <a href="{{ route('katalog') }}" class="inline-flex items-center text-slate-500 hover:text-orange-500 font-bold mb-8 transition-colors">
        <i data-lucide="arrow-left" class="w-5 h-5 mr-2"></i> Kembali ke Katalog
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
        <div class="space-y-6">
            <div class="bg-white p-4 rounded-[3rem] shadow-2xl shadow-slate-200 border border-slate-100">
                <img src="{{ asset('storage/' . $lelang->barang->foto) }}" class="w-full h-[450px] object-cover rounded-[2.5rem]">
            </div>
            <div class="bg-white p-8 rounded-[2.5rem] shadow-sm border border-slate-100">
                <h2 class="text-sm font-black uppercase tracking-widest text-slate-400 mb-2">Deskripsi Barang</h2>
                <p class="text-slate-600 leading-relaxed">{{ $lelang->barang->deskripsi }}</p>
            </div>
        </div>

        <div class="space-y-8">
            <div>
                <h1 class="text-4xl font-black text-slate-800 leading-tight">{{ $lelang->barang->nama_barang }}</h1>
                <div class="flex items-center mt-4 space-x-3">
                    <span class="bg-green-100 text-green-600 text-[10px] font-black px-3 py-1 rounded-full uppercase">Harga Awal: Rp {{ number_format($lelang->barang->harga_awal) }}</span>
                    <span class="bg-blue-100 text-blue-600 text-[10px] font-black px-3 py-1 rounded-full uppercase italic">Buka: {{ \Carbon\Carbon::parse($lelang->tgl_lelang)->format('d M Y') }}</span>
                </div>
            </div>

        @if($lelang->status == 'dibuka')
            <div class="bg-orange-500 p-8 rounded-[2.5rem] shadow-xl shadow-orange-200 text-white">
                <h3 class="font-bold mb-4 flex items-center">
                    <i data-lucide="trending-up" class="w-5 h-5 mr-2"></i> Ajukan Penawaran Anda
                </h3>
                <form action="{{ route('lelang.bid', $lelang->id) }}" method="POST" class="space-y-4">
                    @csrf
                    <div class="relative">
                        <span class="absolute left-5 top-1/2 -translate-y-1/2 font-black text-orange-600">Rp</span>
                        <input type="number" name="penawaran_harga" class="w-full pl-12 pr-5 py-4 rounded-2xl text-slate-800 font-black focus:ring-4 focus:ring-orange-300 outline-none transition-all" placeholder="Masukkan harga..." required>
                    </div>
                    <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-white font-black py-4 rounded-2xl transition-all transform hover:scale-[1.02] active:scale-95 shadow-lg">
                        KIRIM PENAWARAN
                    </button>
                </form>
            </div>
        @else
            <div class="bg-slate-100 p-8 rounded-[2.5rem] border-2 border-dashed border-slate-200 text-center">
                <div class="w-16 h-16 bg-slate-200 text-slate-500 rounded-full flex items-center justify-center mx-auto mb-4">
                    <i data-lucide="lock" class="w-8 h-8"></i>
                </div>
                <h3 class="text-xl font-black text-slate-800 uppercase">Lelang Ditutup</h3>
                <p class="text-slate-500 text-sm mt-1">Barang ini sudah terjual atau masa lelang telah berakhir.</p>

                @if($lelang->id_user)
                    <div class="mt-4 p-4 bg-white rounded-2xl border border-slate-200">
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Pemenang:</p>
                        <p class="font-bold text-slate-800">{{ $lelang->user->nama_lengkap }}</p>
                        <p class="text-blue-600 font-black">Rp {{ number_format($lelang->harga_akhir) }}</p>
                    </div>
                @endif
            </div>
        @endif

            <div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
                <div class="p-6 border-b border-slate-50 bg-slate-50/50">
                    <h3 class="font-bold text-slate-800 flex items-center">
                        <i data-lucide="history" class="w-5 h-5 mr-2 text-blue-500"></i> Riwayat Penawaran
                    </h3>
                </div>
                <div class="max-h-[300px] overflow-y-auto">
                    @forelse($lelang->history as $h)
                    <div class="p-5 flex justify-between items-center border-b border-slate-50 last:border-0">
                        <div class="flex items-center space-x-3">
                            <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 font-bold text-xs uppercase">
                                {{ substr($h->user->nama_lengkap, 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-slate-800">{{ $h->user->nama_lengkap }}</p>
                                <p class="text-[10px] text-slate-400">{{ $h->created_at->diffForHumans() }}</p>
                            </div>
                        </div>
                        <span class="font-black text-slate-700">Rp {{ number_format($h->penawaran_harga) }}</span>
                    </div>
                    @empty
                    <div class="p-10 text-center text-slate-400 text-sm">Belum ada penawaran. Jadi yang pertama!</div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>

<script>lucide.createIcons();</script>
@endsection
