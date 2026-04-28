@extends('layouts.admin')
@section('title', 'Buka Lelang')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8 text-center">
        <h1 class="text-3xl font-extrabold text-slate-800">Aktivasi Lelang</h1>
        <p class="text-slate-500 mt-2">Pilih barang yang sudah siap untuk ditawarkan kepada masyarakat.</p>
    </div>

    <form action="{{ route('lelang.store') }}" method="POST" class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-10">
        @csrf
        <div class="space-y-6">
            <div>
                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Pilih Barang</label>
                <select name="id_barang" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all appearance-none" required>
                    <option value="">-- Pilih Barang Tersedia --</option>
                    @foreach($barangs as $b)
                        <option value="{{ $b->id }}">{{ $b->nama_barang }} - (Harga Awal: Rp {{ number_format($b->harga_awal) }})</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-bold text-slate-700 uppercase mb-2">Tanggal Lelang</label>
                <input type="date" name="tgl_lelang" value="{{ date('Y-m-d') }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-orange-400 outline-none transition-all" required>
            </div>

            <div class="pt-6">
                <button type="submit" class="w-full bg-orange-500 hover:bg-orange-600 text-white font-black py-4 rounded-2xl shadow-lg shadow-orange-200 transition-all transform hover:-translate-y-1">
                    BUKA LELANG SEKARANG
                </button>
            </div>
        </div>
    </form>
</div>
@endsection
