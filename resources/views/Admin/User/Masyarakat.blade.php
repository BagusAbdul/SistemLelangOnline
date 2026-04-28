@extends('layouts.admin')
@section('title', 'Manajemen Masyarakat')

@section('content')
<div class="mb-10 flex justify-between items-end">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">Data Masyarakat</h1>
        <p class="text-slate-500">Daftar pengguna yang terdaftar sebagai peserta lelang.</p>
    </div>
    <div class="bg-blue-500 text-white px-6 py-3 rounded-2xl font-bold text-sm shadow-lg shadow-blue-200">
        Total: {{ $masyarakat->count() }} Pengguna
    </div>
</div>

<div class="bg-white rounded-[2.5rem] shadow-sm border border-slate-100 overflow-hidden">
    <table class="w-full text-left">
        <thead>
            <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-black tracking-widest border-b">
                <th class="px-8 py-5">Nama Lengkap</th>
                <th class="px-6 py-5">Username</th>
                <th class="px-6 py-5 text-center">No. Telepon</th>
                <th class="px-6 py-5 text-center">Tanggal Gabung</th>
                <th class="px-6 py-5 text-center">Aksi</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @forelse($masyarakat as $m)
            <tr class="hover:bg-slate-50/50 transition-colors group">
                <td class="px-8 py-5">
                    <div class="flex items-center space-x-3">
                        <div class="w-8 h-8 bg-slate-100 rounded-full flex items-center justify-center text-slate-400 font-bold text-xs uppercase">
                            {{ substr($m->nama_lengkap, 0, 1) }}
                        </div>
                        <span class="font-bold text-slate-700">{{ $m->nama_lengkap }}</span>
                    </div>
                </td>
                <td class="px-6 py-5 text-slate-500 text-sm italic">{{ $m->username }}</td>
                <td class="px-6 py-5 text-center text-slate-600 font-medium">{{ $m->telp }}</td>
                <td class="px-6 py-5 text-center text-slate-400 text-xs">
                    {{ $m->created_at->format('d M Y') }}
                </td>
                <td class="px-6 py-5 text-center">
                    <form action="{{ route('user.destroy', $m->id) }}" method="POST" onsubmit="return confirm('Hapus pengguna ini? Semua data penawarannya juga akan terhapus.')">
                        @csrf @method('DELETE')
                        <button class="p-2 text-slate-300 hover:text-red-500 hover:bg-red-50 rounded-xl transition-all">
                            <i data-lucide="user-minus" class="w-5 h-5"></i>
                        </button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="px-8 py-20 text-center text-slate-400">Belum ada masyarakat yang mendaftar.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
