@extends('layouts.admin')
@section('title', 'Manajemen Petugas')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
    <div class="lg:col-span-2">
        <h1 class="text-3xl font-extrabold text-slate-800 mb-6">Manajemen Staf</h1>
        <div class="bg-white rounded-[2rem] shadow-sm border border-slate-100 overflow-hidden">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50 text-slate-400 text-[10px] uppercase font-black tracking-widest border-b">
                        <th class="px-8 py-5">Nama Lengkap</th>
                        <th class="px-6 py-5">Username</th>
                        <th class="px-6 py-5">Role</th>
                        <th class="px-6 py-5 text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50">
                    @foreach($users as $u)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-8 py-5 font-bold text-slate-700">{{ $u->nama_lengkap }}</td>
                        <td class="px-6 py-5 text-slate-500 text-sm">{{ $u->username }}</td>
                        <td class="px-6 py-5">
                            <span class="px-3 py-1 rounded-full text-[10px] font-black uppercase {{ $u->role_id == 1 ? 'bg-purple-100 text-purple-600' : 'bg-blue-100 text-blue-600' }}">
                                {{ $u->role_id == 1 ? 'Admin' : 'Petugas' }}
                            </span>
                        </td>
                        <td class="px-6 py-5 text-center">
                            @if($u->id != auth()->id())
                            <form action="{{ route('user.destroy', $u->id) }}" method="POST" onsubmit="return confirm('Hapus akun ini?')">
                                @csrf @method('DELETE')
                                <button class="text-red-400 hover:text-red-600 transition-colors">
                                    <i data-lucide="trash-2" class="w-5 h-5"></i>
                                </button>
                            </form>
                            @else
                                <span class="text-[10px] font-bold text-slate-300 italic">Akun Anda</span>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div>
        <div class="bg-white rounded-[2rem] shadow-xl border border-slate-100 p-8 sticky top-24">
            <h3 class="text-xl font-bold text-slate-800 mb-6">Generate Akun</h3>
            <form action="{{ route('user.store') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Nama Lengkap</label>
                    <input type="text" name="nama_lengkap" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all" placeholder="Nama Staf" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Username</label>
                    <input type="text" name="username" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all" placeholder="User ID" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Password</label>
                    <input type="password" name="password" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all" placeholder="******" required>
                </div>
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase mb-2">Role Akses</label>
                    <select name="role_id" class="w-full px-5 py-4 bg-slate-50 border-none rounded-2xl focus:ring-2 focus:ring-blue-400 outline-none transition-all font-bold">
                        <option value="2">Petugas</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-slate-900 text-white font-black py-4 rounded-2xl shadow-lg hover:bg-slate-800 transition-all pt-4">
                    BUAT AKUN SEKARANG
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
