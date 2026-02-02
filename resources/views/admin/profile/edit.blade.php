@extends('layouts.admin')

@section('content')
<div class="max-w-3xl mx-auto px-4">
    <div class="bg-gradient-to-b from-white to-slate-50/20 rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <!-- Compact Header -->
        <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center bg-white">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-500 shadow-inner shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900 tracking-tight uppercase">Pengaturan Profil</h2>
                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Kelola informasi akun Anda</p>
                </div>
            </div>
            
            @if(session('success'))
            <div class="px-4 py-1.5 bg-emerald-50 rounded-full border border-emerald-100 text-[9px] font-black text-emerald-600 uppercase tracking-widest animate-in fade-in slide-in-from-right-4 duration-500">
                Data Disimpan ✨
            </div>
            @endif
        </div>

        <form action="{{ route('profile.update') }}" method="POST" class="p-8">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Data Pribadi Section -->
                <div class="md:col-span-2">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                        <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Informasi Utama</h3>
                    </div>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap</label>
                    <input type="text" name="name" value="{{ old('name', $user->name) }}" required
                        class="w-full bg-slate-50 border border-slate-100 py-3 px-5 rounded-xl font-bold text-slate-900 text-xs outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                    <x-input-error :messages="$errors->get('name')" class="mt-1" />
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                    <input type="email" name="email" value="{{ old('email', $user->email) }}" required
                        class="w-full bg-slate-50 border border-slate-100 py-3 px-5 rounded-xl font-bold text-slate-900 text-xs outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                    <x-input-error :messages="$errors->get('email')" class="mt-1" />
                </div>

                <!-- Keamanan Section -->
                <div class="md:col-span-2 mt-4">
                    <div class="flex items-center gap-2 mb-4">
                        <span class="w-1.5 h-4 bg-rose-500 rounded-full"></span>
                        <h3 class="text-[10px] font-black text-slate-800 uppercase tracking-widest">Keamanan Akun</h3>
                    </div>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mb-4 ml-3.5 opacity-60">* Kosongkan password jika tidak ingin mengganti</p>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Password Baru</label>
                    <input type="password" name="password" placeholder="••••••••"
                        class="w-full bg-white border border-slate-200 py-3 px-5 rounded-xl font-bold text-slate-900 text-xs outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition">
                    <x-input-error :messages="$errors->get('password')" class="mt-1" />
                </div>

                <div class="md:col-span-1">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Ulangi Password</label>
                    <input type="password" name="password_confirmation" placeholder="••••••••"
                        class="w-full bg-white border border-slate-200 py-3 px-5 rounded-xl font-bold text-slate-900 text-xs outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition">
                </div>
            </div>

            <div class="mt-10 flex justify-end">
                <button type="submit" class="w-full sm:w-auto min-w-[200px] bg-slate-900 text-white py-3.5 px-8 rounded-xl font-black text-[9px] uppercase tracking-[0.3em] hover:bg-black hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-slate-200/50">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
