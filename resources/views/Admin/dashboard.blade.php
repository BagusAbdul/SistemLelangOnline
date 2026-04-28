@extends('layouts.admin')
@section('title', 'Dashboard')

@section('content')
<div class="mb-10">
    <h1 class="text-3xl font-extrabold text-slate-800">Selamat Datang, {{ Auth::user()->nama_lengkap }}!</h1>
    <p class="text-slate-500">Berikut adalah ringkasan performa lelang Anda hari ini.</p>
</div>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    @php
        $cards = [
            ['label' => 'Total Barang', 'value' => $stats['total_barang'], 'icon' => 'package', 'color' => 'blue'],
            ['label' => 'Lelang Aktif', 'value' => $stats['lelang_aktif'], 'icon' => 'gavel', 'color' => 'orange'],
            ['label' => 'Masyarakat', 'value' => $stats['total_masyarakat'], 'icon' => 'users', 'color' => 'green'],
            ['label' => 'Total Penjualan', 'value' => 'Rp ' . number_format($stats['pendapatan']), 'icon' => 'banknote', 'color' => 'indigo'],
        ];
    @endphp

    @foreach($cards as $c)
    <div class="bg-white p-6 rounded-[2rem] shadow-sm border border-slate-100">
        <div class="w-12 h-12 bg-{{ $c['color'] }}-100 text-{{ $c['color'] }}-600 rounded-2xl flex items-center justify-center mb-4">
            <i data-lucide="{{ $c['icon'] }}" class="w-6 h-6"></i>
        </div>
        <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{ $c['label'] }}</p>
        <p class="text-2xl font-black text-slate-800 mt-1">{{ $c['value'] }}</p>
    </div>
    @endforeach
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
    <div class="p-8 border-b border-slate-50">
        <h3 class="font-bold text-slate-800">Lelang Terbaru</h3>
    </div>
    <table class="w-full text-left">
        <tbody class="divide-y divide-slate-50">
            @foreach($lelang_terbaru as $lt)
            <tr class="hover:bg-slate-50/50 transition-colors">
                <td class="px-8 py-5">
                    <p class="font-bold text-slate-800 text-sm">{{ $lt->barang->nama_barang }}</p>
                    <p class="text-[10px] text-slate-400 font-medium uppercase">{{ $lt->status }}</p>
                </td>
                <td class="px-8 py-5 text-right">
                    <p class="font-black text-slate-700 text-sm">Rp {{ number_format($lt->harga_akhir ?? $lt->barang->harga_awal) }}</p>
                    <p class="text-[10px] text-slate-400">{{ $lt->user->nama_lengkap ?? 'Belum ada pemenang' }}</p>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
