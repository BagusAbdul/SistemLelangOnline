@extends('layouts.admin')
@section('title', 'Laporan Hasil Lelang')

@section('content')
<div class="flex justify-between items-center mb-8 no-print">
    <div>
        <h1 class="text-3xl font-extrabold text-slate-800">Laporan Penjualan</h1>
        <p class="text-slate-500 text-sm">Data seluruh barang yang telah terjual melalui lelang.</p>
    </div>
    <button onclick="window.print()" class="bg-slate-900 text-white px-8 py-3 rounded-2xl font-bold flex items-center hover:bg-slate-800 transition-all shadow-lg">
        <i data-lucide="printer" class="w-5 h-5 mr-2"></i> Cetak Laporan
    </button>
</div>

<div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 p-10 print:p-0 print:border-none print:shadow-none">

    <div class="kop-surat">
        <h2 class="text-2xl font-black uppercase">Laporan Hasil Lelang Online</h2>
        <p class="text-md font-bold uppercase tracking-widest text-slate-700">SMKN 7 BALEENDAH - JURUSAN PPLG</p>
        <p class="text-xs text-slate-500 mt-2">Jl. Siliwangi Km.15, Kel. Manggahang,  Kec. Baleendah, Bandung</p>
        <hr class="mt-4 border-t-2 border-slate-900">
        <p class="text-[10px] text-right mt-1 italic text-slate-400">Dicetak pada: {{ date('d/m/Y H:i') }}</p>
    </div>

    <table class="w-full text-sm">
        <thead>
            <tr class="border-b-2 border-slate-100 text-slate-400 text-[10px] uppercase font-black tracking-widest">
                <th class="px-4 py-4 text-left">No</th>
                <th class="px-4 py-4 text-left">Barang</th>
                <th class="px-4 py-4 text-left">Pemenang</th>
                <th class="px-4 py-4 text-center">Harga Awal</th>
                <th class="px-4 py-4 text-right">Harga Akhir</th>
            </tr>
        </thead>
        <tbody class="divide-y divide-slate-50">
            @foreach($laporan as $key => $l)
            <tr>
                <td class="px-4 py-4">{{ $key + 1 }}</td>
                <td class="px-4 py-4 font-bold">{{ $l->barang->nama_barang }}</td>
                <td class="px-4 py-4">{{ $l->user->nama_lengkap }}</td>
                <td class="px-4 py-4 text-center">Rp {{ number_format($l->barang->harga_awal) }}</td>
                <td class="px-4 py-4 text-right font-black text-blue-600">Rp {{ number_format($l->harga_akhir) }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr class="border-t-2 border-slate-900">
                <td colspan="4" class="px-4 py-6 font-black text-right uppercase tracking-widest text-xs">Total Pendapatan</td>
                <td class="px-4 py-6 text-right font-black text-lg">Rp {{ number_format($laporan->sum('harga_akhir')) }}</td>
            </tr>
        </tfoot>
    </table>
</div>

<style>
    /* CSS UNTUK TAMPILAN CETAK */
    @media print {
        /* Pengaturan Ukuran Kertas A4 */
        @page {
            size: A4;
            margin: 20mm; /* Margin standar dokumen resmi */
        }

        /* Sembunyikan elemen yang tidak perlu dicetak */
        .no-print, nav, aside, footer, .sidebar-mobile {
            display: none !important;
        }

        /* Reset layout utama agar tidak terpotong */
        body {
            background-color: white !important;
            margin: 0 !important;
            padding: 0 !important;
            -webkit-print-color-adjust: exact; /* Agar warna background tampil saat di-print */
        }

        .container, main {
            margin: 0 !important;
            padding: 0 !important;
            width: 100% !important;
            max-width: none !important;
        }

        /* Styling Tabel agar rapi di kertas */
        table {
            width: 100% !important;
            border-collapse: collapse !important;
            margin-top: 10px;
        }

        th {
            background-color: #f8fafc !important; /* Slate 50 */
            color: #475569 !important; /* Slate 600 */
            border-bottom: 2px solid #000 !important;
        }

        td, th {
            padding: 10px 12px !important;
            border-bottom: 1px solid #e2e8f0 !important;
        }

        /* Tambahan garis pembatas untuk total di paling bawah */
        tfoot tr td {
            border-top: 2px solid #000 !important;
            padding-top: 15px !important;
        }
    }

    /* Styling tambahan untuk logo/kop surat jika diperlukan */
    .kop-surat {
        display: none;
    }

    @media print {
        .kop-surat {
            display: block;
            margin-bottom: 30px;
            text-align: center;
        }
    }
</style>
@endsection
