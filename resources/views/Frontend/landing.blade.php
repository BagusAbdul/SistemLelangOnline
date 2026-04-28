@extends('layouts.frontend')
@section('title', 'Selamat Datang')

@section('content')
<section class="relative py-20 overflow-hidden bg-slate-50">
    <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">
        <div class="relative z-10">
            <span class="inline-block px-4 py-2 bg-orange-100 text-orange-600 rounded-full text-xs font-black uppercase tracking-widest mb-6">Lelang Online Terpercaya</span>
            <h1 class="text-6xl font-extrabold text-slate-900 leading-[1.1] tracking-tighter">
                Dapatkan Barang <span class="text-orange-500 underline decoration-blue-500">Impian</span> Dengan Harga Terbaik.
            </h1>
            <p class="mt-8 text-lg text-slate-500 leading-relaxed max-w-lg">
                Ikuti keseruan lelang barang-barang pilihan koleksi SMKN 7 Baleendah. Aman, transparan, dan kompetitif.
            </p>
            <div class="mt-10 flex items-center space-x-6">
                <a href="#katalog" class="bg-slate-900 text-white px-10 py-4 rounded-2xl font-bold hover:bg-slate-800 transition-all shadow-xl shadow-slate-300">Mulai Menjelajah</a>
                <div class="flex -space-x-3">
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-blue-500"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-orange-500"></div>
                    <div class="w-10 h-10 rounded-full border-2 border-white bg-slate-300 flex items-center justify-center text-[10px] font-bold">1k+</div>
                </div>
            </div>
        </div>
        <div class="relative hidden lg:block">
            <div class="absolute -top-20 -right-20 w-96 h-96 bg-orange-200 rounded-full blur-3xl opacity-30"></div>
            <img src="{{ asset('img/hero-image.png') }}" class="relative z-10 w-full animate-pulse-slow"> </div>
    </div>
</section>

<section id="katalog" class="py-24 max-w-7xl mx-auto px-6">
    <div class="flex flex-col md:flex-row md:items-end justify-between mb-16">
        <div>
            <h2 class="text-4xl font-black text-slate-900 tracking-tight">Katalog Lelang Terbaru</h2>
            <p class="text-slate-500 mt-2">Barang-barang yang sedang dibuka penawarannya hari ini.</p>
        </div>
        <div class="mt-6 md:mt-0">
            <div class="flex flex-wrap gap-2">
                <a href="{{ route('landing') }}"
                class="px-6 py-2 rounded-xl text-sm font-bold transition-all {{ !request('kategori') ? 'bg-orange-500 text-white shadow-lg' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                Semua
                </a>
                @foreach($kategoris as $kat)
                <a href="{{ route('landing', ['kategori' => $kat->id]) }}"
                class="px-6 py-2 rounded-xl text-sm font-bold transition-all {{ request('kategori') == $kat->id ? 'bg-orange-500 text-white shadow-lg' : 'bg-slate-100 text-slate-500 hover:bg-slate-200' }}">
                {{ $kat->nama_kategori }}
                </a>
                @endforeach
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
        @forelse($lelangs as $l)
        <div class="group bg-white rounded-[2.5rem] border border-slate-100 shadow-sm hover:shadow-2xl hover:shadow-slate-200 transition-all duration-500 overflow-hidden">
            <div class="relative h-64 overflow-hidden">
                <img src="{{ asset('storage/' . $l->barang->foto) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            <div class="p-8">
                <h3 class="text-lg font-bold text-slate-800 line-clamp-1">{{ $l->barang->nama_barang }}</h3>
                <div class="mt-4 flex justify-between items-end">
                    <div>
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Harga Awal</p>
                        <p class="text-xl font-black text-blue-600">Rp {{ number_format($l->barang->harga_awal) }}</p>
                    </div>
                    <span class="text-[10px] font-bold bg-green-100 text-green-600 px-3 py-1 rounded-full uppercase tracking-tighter">Dibuka</span>
                </div>

                @auth
                    <a href="{{ route('katalog.detail', $l->id) }}" class="mt-8 block w-full bg-slate-900 text-white text-center py-4 rounded-2xl font-bold hover:bg-orange-500 transition-all shadow-lg">Tawar Sekarang</a>
                @else
                    <a href="{{ route('login') }}" class="mt-8 block w-full bg-slate-100 text-slate-400 text-center py-4 rounded-2xl font-bold hover:bg-orange-500 hover:text-white transition-all">Masuk Untuk Menawar</a>
                @endauth
            </div>
        </div>
        @empty
            <div class="col-span-full py-20 text-center text-slate-400 font-medium">Belum ada barang yang sedang dilelang.</div>
        @endforelse
        <div class="mt-16">
            {{ $lelangs->links() }}
        </div>
    </div>
    <div class="mt-16 flex justify-center">
    <div class="bg-white p-4 rounded-3xl shadow-sm border border-slate-100">
        {{ $lelangs->links() }}
    </div>
</div>
</section>
@endsection
