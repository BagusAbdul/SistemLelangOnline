@extends('layouts.auth') @section('title', 'Katalog Lelang')

@section('content')
<div class="max-w-7xl mx-auto w-full px-4 py-12">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h1 class="text-4xl font-black text-slate-800 tracking-tight">Cari Barang Impian <span class="text-orange-500">Anda</span></h1>
            <p class="text-slate-500 mt-2">Daftar lelang barang berkualitas dari SMKN 7 Baleendah.</p>
        </div>
        <div class="flex items-center space-x-4">
             <span class="text-sm font-bold text-slate-700">{{ Auth::user()->nama_lengkap }}</span>
             <form action="{{ route('logout') }}" method="POST">@csrf <button type="submit" class="text-red-500 text-sm font-bold">Keluar</button></form>
        </div>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-8">
        @foreach($lelangs as $l)
        <div class="bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-slate-200/50 border border-slate-100 group transition-all hover:-translate-y-2">
            <div class="h-56 overflow-hidden relative">
                <img src="{{ asset('storage/' . $l->barang->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                <div class="absolute top-4 left-4">
                    <span class="bg-orange-500 text-white text-[10px] font-black px-3 py-1.5 rounded-full uppercase tracking-widest shadow-lg">Lelang Terbuka</span>
                </div>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-bold text-slate-800 line-clamp-1">{{ $l->barang->nama_barang }}</h3>
                <div class="mt-4 flex flex-col">
                    <span class="text-xs text-slate-400 font-bold uppercase tracking-wider">Harga Awal</span>
                    <span class="text-lg font-black text-blue-600">Rp {{ number_format($l->barang->harga_awal, 0, ',', '.') }}</span>
                </div>
                <div class="mt-6">
                    <a href="{{ route('katalog.detail', $l->id) }}" class="block w-full bg-slate-900 hover:bg-orange-500 text-white text-center font-bold py-4 rounded-2xl transition-all shadow-lg">
                        Lihat & Tawar
                    </a>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
