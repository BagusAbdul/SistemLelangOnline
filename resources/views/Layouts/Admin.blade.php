<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Lelang - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="bg-slate-50 flex min-h-screen">

    <aside class="w-72 bg-slate-900 text-white flex flex-col shadow-2xl fixed h-full z-20">
        <div class="p-6 border-b border-slate-800 flex items-center space-x-3">
            <div class="bg-white p-1 rounded-lg shadow-inner">
                <img src="{{ asset('img/logo-pplg.png') }}" class="w-10 h-10 object-contain">
            </div>
            <div>
                <h1 class="text-sm font-bold tracking-wider text-orange-400 leading-tight">PPLG LELANG</h1>
                <p class="text-[10px] text-slate-400 tracking-tighter">SMKN 7 BALEENDAH</p>
            </div>
        </div>

        <nav class="flex-1 p-4 space-y-2 mt-4">
            <a href="{{ route('DashboardAdmin') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('dashboard*') ? 'bg-orange-500 text-white shadow-lg shadow-orange-900/40' : 'hover:bg-slate-800 text-slate-400' }} transition-all">
                <i data-lucide="layout-dashboard" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Dashboard</span>
            </a>

            <div class="text-[10px] font-bold text-slate-500 uppercase px-3 mt-8 mb-2 tracking-[0.2em]">Master Data</div>
            @if(Auth::user()->role_id == 1)

            <a href="{{ route('kategori.index') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('kategori*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                <i data-lucide="tag" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Kategori Barang</span>
            </a>

            <a href="{{ route('user.index') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('user-management*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Manajemen User</span>
            </a>

            <a href="{{ route('user.masyarakat') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('masyarakat-management*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                <i data-lucide="shield-check" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Manajemen Masyarakat</span>
            </a>

            @endif
            <a href="{{ route('barang.index') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('barang*') ? 'bg-blue-600 text-white shadow-lg shadow-blue-900/40' : 'hover:bg-slate-800 text-slate-400' }} transition-all">
                <i data-lucide="package" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Data Barang</span>
            </a>

            <a href="{{ route('lelang.index') }}" class="flex items-center space-x-3 p-3 rounded-xl hover:bg-slate-800 text-slate-400 transition-all">
                <i data-lucide="gavel" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Aktivasi Lelang</span>
            </a>

            <div class="text-[10px] font-bold text-slate-500 uppercase px-3 mt-8 mb-2 tracking-[0.2em]">Laporan</div>

            <a href="{{ route('lelang.laporan') }}" class="flex items-center space-x-3 p-3 rounded-xl {{ Request::is('laporan*') ? 'bg-blue-600 text-white' : 'hover:bg-slate-800 text-slate-400' }}">
                <i data-lucide="file-text" class="w-5 h-5"></i>
                <span class="font-medium text-sm">Laporan Hasil</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="flex items-center space-x-3 p-3 w-full rounded-xl hover:bg-red-500/10 text-red-400 transition-all group">
                    <i data-lucide="log-out" class="w-5 h-5 group-hover:-translate-x-1 transition-transform"></i>
                    <span class="font-medium text-sm">Keluar Sistem</span>
                </button>
            </form>
        </div>
    </aside>

    <main class="flex-1 ml-72 flex flex-col">
        <header class="bg-white/90 backdrop-blur-md sticky top-0 z-10 h-20 border-b border-slate-100 flex items-center justify-between px-10">
            <h2 class="text-slate-400 font-medium text-xs tracking-widest uppercase">
                Panel <span class="text-slate-800 font-bold">@yield('title')</span>
            </h2>

            <div class="flex items-center space-x-4 border-l pl-6 border-slate-200">
                <div class="text-right">
                    <p class="text-sm font-bold text-slate-800 leading-none mb-1">{{ Auth::user()->nama_lengkap }}</p>
                    <span class="text-[9px] bg-blue-100 text-blue-600 px-2 py-0.5 rounded font-black uppercase tracking-widest">
                        {{ Auth::user()->role->nama_role }}
                    </span>
                </div>
                <div class="bg-orange-100 p-1 rounded-full border-2 border-orange-200">
                    <img src="{{ asset('img/logo-sekolah.png') }}" class="w-10 h-10 rounded-full object-cover">
                </div>
            </div>
        </header>

        <div class="p-10">
            @if(session('success'))
                <div class="mb-6 p-4 bg-green-100 border-l-4 border-green-500 text-green-700 rounded-r-xl shadow-sm flex items-center">
                    <i data-lucide="check-circle" class="w-5 h-5 mr-3"></i>
                    {{ session('success') }}
                </div>
            @endif

            @yield('content')
        </div>
    </main>

    <script>
        lucide.createIcons();
    </script>
</body>
</html>
