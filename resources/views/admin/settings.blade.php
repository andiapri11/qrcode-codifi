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
                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Konfigurasi parameter global Schola Exambro</p>
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
        <!-- Left: Download Center Configuration -->
        <div class="col-span-full lg:col-span-7 space-y-6">
            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6">
                <div class="flex items-center gap-2 mb-6">
                    <span class="w-1.5 h-4 bg-blue-500 rounded-full"></span>
                    <h3 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Pusat Unduhan (Download Center)</h3>
                </div>
                
                <form action="{{ route('admin.settings.update') }}" method="POST" class="space-y-4">
                    @csrf
                    <div>
                        <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[8px] uppercase tracking-[0.2em] ml-1">Link Download Windows (.exe)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M0 3.449L9.75 2.1V11.59H0V3.449zm0 8.891h9.75v9.491L0 20.461v-8.121zm10.549-10.435L24 0v11.431h-13.451V1.905zm13.451 10.435L24 24l-13.451-1.939v-9.626H24z"/></svg>
                            </span>
                            <input type="url" name="download_link_windows" value="{{ $settings['download_link_windows'] ?? '' }}" placeholder="https://github.com/.../release/Exambro.exe" class="w-full rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-3 pl-12 pr-5 font-bold text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition text-xs shadow-inner uppercase tracking-wider">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[8px] uppercase tracking-[0.2em] ml-1">Link Download Android (.apk)</label>
                        <div class="relative">
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-slate-400">
                                <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.3414C17.0456 15.3414 16.6585 14.9543 16.6585 14.4769C16.6585 13.9995 17.0456 13.6124 17.523 13.6124C18.0004 13.6124 18.3875 13.9995 18.3875 14.4769C18.3875 14.9543 18.0004 15.3414 17.523 15.3414ZM6.47699 15.3414C5.99958 15.3414 5.61251 14.9543 5.61251 14.4769C5.61251 13.9995 5.99958 13.6124 6.47699 13.6124C6.95439 13.6124 7.34146 13.9995 7.34146 14.4769C7.34146 14.9543 6.95439 15.3414 6.47699 15.3414ZM17.8631 6.01429L19.6826 2.86282C19.7828 2.68916 19.7233 2.46746 19.5497 2.36712C19.376 2.26685 19.1543 2.32634 19.054 2.49993L17.2104 5.6946C15.6841 5.00048 13.9213 4.6094 12.0001 4.6094C10.0788 4.6094 8.31603 5.00048 6.78972 5.6946L4.94611 2.49993C4.84584 2.32634 4.62414 2.26685 4.45048 2.36712C4.27681 2.46746 4.21733 2.68916 4.3176 2.86282L6.13706 6.01429C2.6953 7.85409 0.341461 11.4287 0.341461 15.5841H23.6585C23.6585 11.4287 21.3047 7.85409 17.8631 6.01429Z"/></svg>
                            </span>
                            <input type="url" name="download_link_android" value="{{ $settings['download_link_android'] ?? '' }}" placeholder="https://github.com/.../release/Exambro.apk" class="w-full rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-3 pl-12 pr-5 font-bold text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition text-xs shadow-inner uppercase tracking-wider">
                        </div>
                    </div>

                    <div>
                        <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[8px] uppercase tracking-[0.2em] ml-1">Versi Aplikasi Saat Ini</label>
                        <input type="text" name="app_version" value="{{ $settings['app_version'] ?? '1.0.0' }}" class="w-full rounded-xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-3 px-5 font-bold text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 focus:border-blue-500 transition text-xs shadow-inner">
                    </div>

                    <div class="pt-6 border-t border-slate-100 dark:border-slate-800 flex justify-end">
                        <button type="submit" class="bg-slate-900 text-white px-8 py-3 rounded-xl font-black text-[9px] uppercase tracking-[0.3em] shadow-lg shadow-slate-200 dark:shadow-none hover:bg-black transition-all active:scale-95">Simpan Link Unduhan</button>
                    </div>
                </form>
            </div>

            <!-- Client Branding Instructions -->
            <div class="bg-indigo-50 border border-indigo-100 rounded-[2rem] p-6">
                <div class="flex gap-4">
                    <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-indigo-600 shadow-sm shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h4 class="text-[10px] font-black text-indigo-900 uppercase tracking-widest mb-1">Informasi Link</h4>
                        <p class="text-[9px] font-bold text-indigo-700/70 leading-relaxed uppercase">Gunakan link permanen (Direct Download) dari GitHub Releases atau Cloud Storage lainnya agar siswa dapat mengunduh langsung tanpa hambatan. Halaman publik unduhan tersedia di <a href="/download" target="_blank" class="text-indigo-600 underline">/download</a>.</p>
                    </div>
                </div>
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
