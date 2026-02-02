@extends('layouts.admin')

@section('content')
<div class="space-y-6 animate-in fade-in duration-700">
    <!-- Compact Header -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-5 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-slate-100 rounded-xl flex items-center justify-center text-slate-500 shadow-inner shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900 tracking-tight uppercase">Pengaturan Sistem</h2>
                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Konfigurasi parameter global Schola CBT</p>
                </div>
            </div>
            
            @if(session('success'))
            <div class="px-4 py-1.5 bg-emerald-50 rounded-full border border-emerald-100 text-[9px] font-black text-emerald-600 uppercase tracking-widest animate-in fade-in slide-in-from-right-4 duration-500">
                🚀 {{ session('success') }}
            </div>
            @endif
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        <!-- Left: Branding -->
        <div class="col-span-full lg:col-span-7 space-y-6">
            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-1.5 h-4 bg-indigo-500 rounded-full"></span>
                    <h3 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Identitas Visual Utama</h3>
                </div>
                
                <form action="#" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[8px] uppercase tracking-[0.2em] ml-1">Nama Aplikasi</label>
                        <input type="text" value="Schola CBT Secure" class="w-full rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-3 px-5 font-bold text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition text-xs shadow-inner">
                    </div>

                    <div>
                        <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[8px] uppercase tracking-[0.2em] ml-1">Slogan Sistem</label>
                        <input type="text" value="Premium Anti-Cheat Secure Gateway" class="w-full rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-3 px-5 font-bold text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition text-xs shadow-inner">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 pt-2">
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700 text-center">
                            <div class="w-12 h-12 bg-white dark:bg-slate-900 rounded-xl mx-auto mb-3 flex items-center justify-center shadow-sm border border-slate-100 dark:border-slate-800">
                                 <img src="{{ asset('assets/images/logo.png') }}" class="w-8">
                            </div>
                            <div class="text-[9px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-1">Logo Sistem</div>
                            <button type="button" class="text-[8px] font-bold text-blue-600 uppercase hover:underline">Ganti</button>
                        </div>
                        <div class="p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-dashed border-slate-200 dark:border-slate-700 text-center">
                            <div class="w-full h-12 bg-slate-900 rounded-xl mx-auto mb-3 flex items-center justify-center shadow-sm">
                                 <span class="text-white font-black text-[10px] tracking-tighter italic">Codifi<span class="text-blue-500">.id</span></span>
                            </div>
                            <div class="text-[9px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-1">Branding Footer</div>
                            <button type="button" class="text-[8px] font-bold text-blue-600 uppercase hover:underline">Ganti</button>
                        </div>
                    </div>

                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-[9px] uppercase tracking-[0.3em] shadow-lg shadow-slate-200 dark:shadow-none hover:bg-black transition-all active:scale-95">Simpan Perubahan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Right: Maintenance & Security -->
        <div class="col-span-full lg:col-span-5 space-y-6">
            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-1.5 h-4 bg-rose-500 rounded-full"></span>
                    <h3 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Keamanan & Maintenance</h3>
                </div>

                <div class="space-y-4">
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <div>
                            <div class="text-[9px] font-black text-slate-900 dark:text-white uppercase tracking-tight">Maintenance Mode</div>
                            <div class="text-[8px] font-bold text-slate-400 uppercase mt-0.5">Nonaktifkan akses publik</div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <div>
                            <div class="text-[9px] font-black text-slate-900 dark:text-white uppercase tracking-tight">Registration Mode</div>
                            <div class="text-[8px] font-bold text-slate-400 uppercase mt-0.5">Izinkan pendaftaran baru</div>
                        </div>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" checked class="sr-only peer">
                            <div class="w-9 h-5 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                        </label>
                    </div>

                    <div class="p-4 bg-rose-50 dark:bg-rose-900/10 rounded-2xl border border-rose-100 dark:border-rose-900/30">
                        <div class="text-[9px] font-black text-rose-600 dark:text-rose-500 uppercase tracking-tight mb-1">Danger Zone</div>
                        <p class="text-[8px] font-bold text-rose-400 uppercase mb-4 leading-relaxed">Fitur ini akan menghapus cache seluruh sistem dan mereset session user.</p>
                        <button class="w-full bg-white dark:bg-slate-900 text-rose-600 border border-rose-200 dark:border-rose-900/50 px-6 py-2.5 rounded-xl font-black text-[8px] uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all shadow-sm">Reset System Cache</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
