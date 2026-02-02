@extends('layouts.admin')

@section('content')
<div class="mb-8 items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Pengaturan Sistem</h2>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-1 uppercase tracking-wider">Konfigurasi parameter global dan branding utama Schola CBT.</p>
    </div>
</div>

<div class="grid grid-cols-12 gap-8">
    <!-- Left: Branding -->
    <div class="col-span-full lg:col-span-7 space-y-8">
        <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8">
            <h3 class="text-xs font-black text-slate-900 dark:text-white mb-8 uppercase tracking-[0.2em]">Identitas Visual Utama</h3>
            
            <form action="#" method="POST" class="space-y-6">
                <div>
                    <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Aplikasi</label>
                    <input type="text" value="Schola CBT Secure" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
                </div>

                <div>
                    <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Slogan Sistem</label>
                    <input type="text" value="Premium Anti-Cheat Secure Gateway" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4">
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-dashed border-slate-200 dark:border-slate-700 text-center">
                        <div class="w-16 h-16 bg-white dark:bg-slate-900 rounded-2xl mx-auto mb-4 flex items-center justify-center shadow-sm border border-slate-100 dark:border-slate-800">
                             <img src="{{ asset('assets/images/logo.png') }}" class="w-10">
                        </div>
                        <div class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-1">Logo Sistem</div>
                        <button type="button" class="text-[9px] font-bold text-blue-600 uppercase hover:underline">Ganti Icon</button>
                    </div>
                    <div class="p-6 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-dashed border-slate-200 dark:border-slate-700 text-center">
                        <div class="w-full h-16 bg-slate-900 rounded-2xl mx-auto mb-4 flex items-center justify-center shadow-sm">
                             <span class="text-white font-black text-xs tracking-tighter italic">Codifi<span class="text-blue-500">.id</span></span>
                        </div>
                        <div class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-widest mb-1">Branding Footer</div>
                        <button type="button" class="text-[9px] font-bold text-blue-600 uppercase hover:underline">Ganti Teks</button>
                    </div>
                </div>

                <div class="pt-6 border-t border-slate-50 dark:border-slate-800">
                    <button type="submit" class="bg-blue-600 text-white px-8 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all active:scale-95">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Right: Maintenance & Security -->
    <div class="col-span-full lg:col-span-5 space-y-8">
        <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8">
            <h3 class="text-xs font-black text-slate-900 dark:text-white mb-8 uppercase tracking-[0.2em]">Keamanan & Maintenance</h3>

            <div class="space-y-6">
                <div class="flex items-center justify-between p-5 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <div>
                        <div class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-tight">Maintenance Mode</div>
                        <div class="text-[9px] font-bold text-slate-400 uppercase mt-1">Nonaktifkan akses publik sementara</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="flex items-center justify-between p-5 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <div>
                        <div class="text-[10px] font-black text-slate-900 dark:text-white uppercase tracking-tight">Registration Mode</div>
                        <div class="text-[9px] font-bold text-slate-400 uppercase mt-1">Izinkan pendaftaran instansi baru</div>
                    </div>
                    <label class="relative inline-flex items-center cursor-pointer">
                        <input type="checkbox" checked class="sr-only peer">
                        <div class="w-11 h-6 bg-slate-200 peer-focus:outline-none rounded-full peer dark:bg-slate-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                    </label>
                </div>

                <div class="p-5 bg-rose-50 dark:bg-rose-900/10 rounded-3xl border border-rose-100 dark:border-rose-900/30">
                    <div class="text-[10px] font-black text-rose-600 dark:text-rose-500 uppercase tracking-tight mb-2">Danger Zone</div>
                    <p class="text-[9px] font-bold text-rose-400 uppercase mb-4">Fitur ini akan menghapus cache seluruh sistem dan mereset session user.</p>
                    <button class="bg-white dark:bg-slate-900 text-rose-600 border border-rose-200 dark:border-rose-900/50 px-6 py-3 rounded-xl font-black text-[9px] uppercase tracking-widest hover:bg-rose-600 hover:text-white transition-all">Reset System Cache</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
