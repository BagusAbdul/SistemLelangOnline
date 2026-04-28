@extends('layouts.admin')
@section('title', 'Edit Kategori')

@section('content')
<div class="max-w-md mx-auto">
    <div class="mb-8">
        <a href="{{ route('kategori.index') }}" class="text-slate-400 hover:text-slate-600 flex items-center font-bold text-xs uppercase tracking-widest transition-all">
            <i data-lucide="arrow-left" class="w-4 h-4 mr-2"></i> Kembali
        </a>
        <h1 class="text-3xl font-extrabold text-slate-800 mt-4">Edit Kategori</h1>
    </div>

    <form action="{{ route('kategori.update', $kategori->id) }}" method="POST" class="bg-white rounded-[2.5rem] shadow-xl border border-slate-100 p-10">
        @csrf @method('PUT')
        <div class="space-y-6">
            <div>
                <label class="block text-xs font-black text-slate-400 uppercase tracking-widest mb-2">Nama Kategori</label>
                <input type="text" name="nama_kategori" value="{{ $kategori->nama_kategori }}" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all font-bold" required>
            </div>
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-black py-4 rounded-2xl shadow-lg shadow-blue-200 transition-all">
                PERBARUI KATEGORI
            </button>
        </div>
    </form>
</div>
@endsection
