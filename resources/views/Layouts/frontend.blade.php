<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PPLG Lelang - @yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
    <style>body { font-family: 'Plus Jakarta Sans', sans-serif; }</style>
</head>
<body class="bg-white text-slate-900">

    <nav class="sticky top-0 z-50 bg-white/80 backdrop-blur-lg border-b border-slate-100">
        <div class="max-w-7xl mx-auto px-6 h-20 flex items-center justify-between">
            <div class="flex items-center space-x-3">
                <img src="{{ asset('img/logo-pplg.png') }}" class="w-10 h-10">
                <span class="font-extrabold text-xl tracking-tighter text-slate-800">PPLG<span class="text-orange-500">LELANG</span></span>
            </div>

            <div class="hidden md:flex items-center space-x-8 text-sm font-bold tracking-wide text-slate-600">
                <a href="/" class="hover:text-orange-500 transition-colors">Beranda</a>
                <a href="#katalog" class="hover:text-orange-500 transition-colors">Katalog</a>
                <a href="#" class="hover:text-orange-500 transition-colors">Tentang Kami</a>
            </div>

            <div class="flex items-center space-x-4">
                @auth
                    <a href="{{ route('masyarakat.history') }}" class="text-sm font-bold text-slate-600 hover:text-orange-500 mr-4">Tawaran Saya</a>
                    <div class="text-right mr-3 hidden sm:block">
                        <p class="text-xs font-bold text-slate-800">{{ Auth::user()->nama_lengkap }}</p>
                        <p class="text-[10px] text-orange-500 font-bold uppercase">Masyarakat</p>
                    </div>

                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="bg-slate-900 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-slate-800 transition-all shadow-lg shadow-slate-200">Keluar</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="text-sm font-bold text-slate-600 hover:text-orange-500 transition-colors">Masuk</a>
                    <a href="{{ route('register') }}" class="bg-orange-500 text-white px-6 py-2.5 rounded-full text-sm font-bold hover:bg-orange-600 transition-all shadow-lg shadow-orange-200">Daftar Sekarang</a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="bg-slate-900 text-white py-16">
        <div class="max-w-7xl mx-auto px-6 grid grid-cols-1 md:grid-cols-3 gap-12">
            <div class="space-y-4">
                <img src="{{ asset('img/logo-sekolah.png') }}" class="w-16 h-16 grayscale brightness-200">
                <h3 class="text-xl font-bold">SMKN 7 BALEENDAH</h3>
                <p class="text-slate-400 text-sm leading-relaxed">Platform lelang online edukatif untuk memajukan kreativitas siswa PPLG dalam membangun ekosistem digital.</p>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-orange-500 uppercase tracking-widest text-xs">Navigasi</h4>
                <ul class="space-y-4 text-slate-400 text-sm">
                    <li><a href="#" class="hover:text-white transition-colors">Syarat & Ketentuan</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Cara Kerja Lelang</a></li>
                    <li><a href="#" class="hover:text-white transition-colors">Bantuan Pelanggan</a></li>
                </ul>
            </div>
            <div>
                <h4 class="font-bold mb-6 text-orange-500 uppercase tracking-widest text-xs">Lokasi</h4>
                <p class="text-slate-400 text-sm leading-relaxed italic text-balance">
                    Jl. Siliwangi Km.15, Kel. Manggahang,  Kec. Baleendah, Bandung
                </p>
            </div>
        </div>
        <div class="max-w-7xl mx-auto px-6 mt-16 pt-8 border-t border-slate-800 text-center text-slate-500 text-xs">
            &copy; {{ date('Y') }} PPLG SMKN 7 BALEENDAH. All Rights Reserved.
        </div>
    </footer>

    <script>lucide.createIcons();</script>
</body>
</html>
