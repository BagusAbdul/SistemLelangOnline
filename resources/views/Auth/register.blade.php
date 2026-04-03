@extends('layouts.auth')
@section('title', 'Daftar Akun')

@section('content')
<div class="w-full max-w-lg bg-white rounded-2xl shadow-xl border border-slate-100 p-8">
    <h2 class="text-2xl font-bold text-slate-800 mb-6">Buat Akun Masyarakat</h2>
    @if ($errors->any())
        <div class="mb-4 p-4 bg-red-100 border-l-4 border-red-500 text-red-700">
            <ul class="list-disc ml-5">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('register.post') }}" method="POST" class="grid grid-cols-1 md:grid-cols-2 gap-4">
        @csrf
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-1">Nama Lengkap</label>
            <input type="text" name="nama_lengkap" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-orange-400" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Username</label>
            <input type="text" name="username" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-orange-400" required>
        </div>
        <div>
            <label class="block text-sm font-semibold text-slate-700 mb-1">Nomor Telp</label>
            <input type="text" name="telp" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-orange-400" required>
        </div>
        <div class="md:col-span-2">
            <label class="block text-sm font-semibold text-slate-700 mb-1">Password</label>
            <input type="password" name="password" class="w-full px-4 py-2 rounded-lg border border-slate-200 outline-none focus:ring-2 focus:ring-orange-400" required>
        </div>
        <div class="md:col-span-2 mt-4">
            <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl shadow-lg transition-all">
                DAFTAR SEKARANG
            </button>
            <a href="{{ route('login') }}" class="block text-center mt-4 text-sm text-slate-500 hover:text-blue-600">Sudah punya akun? Kembali ke Login</a>
        </div>
    </form>
</div>
@endsection
