@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <div class="bg-white rounded-[2.5rem] shadow-xl border border-slate-200/60 overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-slate-200/50">
        <!-- Premium Header Section -->
        <div class="relative px-6 md:px-12 py-10 md:py-14 bg-slate-900 overflow-hidden">
            <!-- Decorative Background Elements -->
            <div class="absolute top-0 right-0 w-64 h-64 bg-indigo-500/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-emerald-500/10 rounded-full -ml-32 -mb-32 blur-3xl"></div>
            
            <div class="relative z-10 flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="flex items-center gap-6">
                    <div class="w-16 h-16 md:w-20 md:h-20 bg-white/10 backdrop-blur-md rounded-3xl flex items-center justify-center text-white border border-white/20 shadow-2xl shrink-0 group hover:scale-110 transition-transform duration-500">
                        <svg class="w-8 h-8 md:w-10 md:h-10 text-indigo-400 group-hover:text-indigo-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                        </svg>
                    </div>
                    <div>
                        <div class="flex flex-wrap items-center gap-3">
                            <h2 class="text-2xl md:text-3xl font-black text-white tracking-tight uppercase italic underline decoration-indigo-500 decoration-4 underline-offset-8">PROFIL INSTANSI</h2>
                            @if($school->subscription_type === 'lifetime')
                                <span class="px-4 py-1.5 bg-gradient-to-r from-amber-400 to-amber-600 text-slate-900 text-[10px] md:text-[12px] font-black rounded-full uppercase tracking-widest shadow-lg shadow-amber-500/20 border-2 border-white/20">
                                    ⚡ EXCLUSIVE TIER
                                </span>
                            @endif
                        </div>
                        <p class="text-[10px] md:text-[12px] text-slate-400 font-bold uppercase tracking-[0.3em] mt-4 flex items-center gap-2">
                            <span class="w-2 h-2 bg-emerald-500 rounded-full animate-pulse"></span>
                            MANAJEMEN IDENTITAS & BRANDING SEKOLAH
                        </p>
                    </div>
                </div>
                
                <div class="flex gap-3">
                    <a href="{{ url()->previous() }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl border border-white/10 transition-all flex items-center gap-3">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18"/></svg>
                        KEMBALI
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data" class="bg-white">
            @csrf
            @method('PUT')
            
            <!-- Main Content Grid -->
            <div class="grid grid-cols-12">
                <!-- Left Sidebar: Assets Management -->
                <div class="col-span-12 lg:col-span-4 bg-slate-50/50 border-r border-slate-100 p-8 md:p-12 space-y-12">
                    <!-- section: Logo -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-indigo-500 rounded-full"></span>
                                Logo Instansi
                            </h3>
                            @php
                                $isTrial = $school->subscription_type === 'trial';
                                $isLifetime = $school->subscription_type === 'lifetime';
                            @endphp
                        </div>
                        
                        <div class="relative group max-w-[280px] mx-auto lg:mx-0">
                            <div id="preview-box" class="aspect-square w-full bg-white rounded-[2.5rem] border-2 border-dashed {{ $school->logo ? 'border-indigo-200' : 'border-slate-200' }} flex flex-col items-center justify-center transition-all duration-500 overflow-hidden relative shadow-inner {{ $isTrial ? 'opacity-70 bg-slate-50 cursor-not-allowed' : 'hover:border-indigo-400 group-hover:shadow-indigo-100/50' }}">
                                @if($school->logo)
                                    <img id="preview-img" src="{{ Storage::disk('public')->url($school->logo) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                                @else
                                    <div id="preview-placeholder" class="text-center p-8">
                                        <div class="w-14 h-14 bg-slate-50 rounded-2xl flex items-center justify-center text-slate-300 mx-auto mb-4 border border-slate-100">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Klik / Drag Foto</p>
                                    </div>
                                    <img id="preview-img" class="hidden w-full h-full object-cover">
                                @endif

                                @if(!$isTrial)
                                <input type="file" name="logo" id="logo-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewLogo(this)">
                                @endif
                            </div>

                            @if($isTrial)
                            <div class="absolute inset-x-2 -bottom-4 z-20">
                                <span class="w-full bg-slate-900/90 backdrop-blur-md text-white text-[8px] font-black px-4 py-3 rounded-xl uppercase tracking-widest flex items-center justify-center gap-3 border border-white/10 shadow-xl">
                                    <svg class="w-3.5 h-3.5 text-amber-400" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/></svg>
                                    UPGRADE UNTUK LOGO
                                </span>
                            </div>
                            @endif
                        </div>
                        <p class="text-[10px] text-slate-400 font-bold uppercase italic tracking-tight text-center lg:text-left mt-4 px-2">Format PNG Transparent disarankan untuk hasil premium</p>
                    </div>

                    <!-- section: Wallpaper -->
                    <div class="space-y-6">
                        <div class="flex items-center justify-between">
                            <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em] flex items-center gap-3">
                                <span class="w-1.5 h-6 bg-emerald-500 rounded-full"></span>
                                Background App
                            </h3>
                            @if($isLifetime)
                                <span class="bg-indigo-100 text-indigo-700 px-3 py-1 rounded-full text-[8px] font-black uppercase tracking-widest border border-indigo-200">Lifetime Active</span>
                            @endif
                        </div>
                        
                        <div class="relative group max-w-[200px] mx-auto lg:mx-0">
                            <!-- Premium Phone Frame -->
                            <div class="absolute -inset-3 border-[8px] border-slate-900 rounded-[3rem] shadow-2xl z-0 pointer-events-none transition-transform duration-500 group-hover:scale-[1.02]"></div>
                            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-24 h-6 bg-slate-900 rounded-b-3xl z-20 pointer-events-none"></div>
                            
                            <div id="bg-preview-box" class="aspect-[9/19.5] bg-slate-100 rounded-[2.5rem] border-2 border-dashed {{ $school->custom_background ? 'border-transparent' : 'border-slate-300' }} flex flex-col items-center justify-center transition-all duration-500 overflow-hidden relative shadow-inner z-10 {{ !$isLifetime && strtolower(Auth::user()->role) !== 'superadmin' ? 'opacity-90 bg-slate-200 cursor-not-allowed' : 'hover:bg-slate-50 group-hover:shadow-indigo-100/30' }}">
                                @if($school->custom_background)
                                    <img id="bg-preview-img" src="{{ Storage::disk('public')->url($school->custom_background) }}" class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-700">
                                @else
                                    <div id="bg-preview-placeholder" class="text-center p-8">
                                        <div class="w-14 h-14 bg-white rounded-2xl flex items-center justify-center text-slate-300 mx-auto mb-4 border border-slate-100 shadow-sm">
                                            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                        </div>
                                        <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest leading-tight">Pilih Foto<br>Background</p>
                                    </div>
                                    <img id="bg-preview-img" class="hidden w-full h-full object-cover">
                                @endif

                                @if($isLifetime || strtolower(Auth::user()->role) === 'superadmin')
                                <input type="file" name="custom_background" id="bg-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-30" onchange="previewBg(this)">
                                @endif

                                <!-- Subtle Client Sign -->
                                <div class="absolute inset-x-0 bottom-0 h-28 bg-gradient-to-t from-black/60 to-transparent z-20 flex flex-col items-center justify-end pb-8 font-black text-[8px] text-white uppercase tracking-[0.2em] opacity-80 backdrop-blur-[1px]">
                                    Schola Client v5.1
                                </div>
                            </div>

                            @if(!$isLifetime && strtolower(Auth::user()->role) !== 'superadmin')
                            <div class="absolute inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-[6px] rounded-[2.8rem] z-40 transform transition-all duration-500 group-hover:bg-slate-900/40">
                                <div class="flex flex-col items-center gap-4">
                                    <span class="bg-amber-500 text-slate-900 text-[9px] font-black px-6 py-3 rounded-2xl uppercase tracking-widest shadow-2xl flex items-center gap-3 border border-amber-400 animate-bounce">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" /></svg>
                                        EXCLUSIVE ONLY
                                    </span>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Right Side: Form Details -->
                <div class="col-span-12 lg:col-span-8 p-8 md:p-12 lg:p-16 space-y-16">
                    <!-- section: General Info -->
                    <div class="space-y-10">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" /></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest leading-none">Identitas Publik</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight mt-2">Informasi dasar yang akan muncul di aplikasi</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div class="sm:col-span-1">
                                @php
                                    $canEditCode = strtolower(Auth::user()->role) === 'superadmin' || $school->subscription_type === 'lifetime';
                                    $codeLength = $school->subscription_type === 'lifetime' ? 10 : 5;
                                @endphp
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Kode Instansi</label>
                                @if($canEditCode)
                                    <div class="relative group">
                                        <input type="text" name="school_code" value="{{ old('school_code', $school->school_code) }}" maxlength="{{ $codeLength }}" placeholder="SMKN1" style="text-transform: uppercase;"
                                            class="w-full bg-slate-50 border-2 border-slate-100 py-4 px-6 rounded-2xl font-black text-slate-800 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-inner group-hover:bg-white group-hover:border-slate-200 uppercase tracking-widest">
                                        <div class="absolute right-4 top-1/2 -translate-y-1/2 flex items-center gap-2">
                                            <span class="text-[10px] font-black text-indigo-400 opacity-60">{{ $codeLength }} CHAR</span>
                                        </div>
                                    </div>
                                    <p class="text-[9px] text-indigo-500 mt-3 ml-1 italic font-bold tracking-tight">* Gunakan singkatan keren (Contoh: SMKN1JKT)</p>
                                @else
                                    <div class="w-full bg-slate-100/80 border-2 border-slate-200 py-4 px-6 rounded-2xl font-black text-slate-500 text-sm cursor-not-allowed flex items-center gap-4">
                                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                        {{ $school->school_code ?? 'BELUM DISET' }}
                                        <span class="ml-auto text-[9px] bg-slate-200 px-3 py-1 rounded-full opacity-60">PERMANEN</span>
                                    </div>
                                    <p class="text-[9px] text-rose-500 mt-3 ml-1 italic font-bold uppercase tracking-widest">Hanya untuk Paket EXCLUSIVE</p>
                                @endif
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Nama Instansi</label>
                                <input type="text" name="name" required value="{{ old('name', $school->name) }}" placeholder="SMA Negeri 1 Jakarta"
                                    class="w-full bg-slate-50 border-2 border-slate-100 py-4 px-6 rounded-2xl font-black text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-inner hover:bg-white hover:border-slate-200 tracking-tight">
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Email Resmi</label>
                                <div class="relative group">
                                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/></svg>
                                    </div>
                                    <input type="email" name="email" value="{{ old('email', $school->email) }}" placeholder="info@sekolah.sch.id"
                                        class="w-full bg-slate-50 border-2 border-slate-100 py-4 pl-14 pr-6 rounded-2xl font-black text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-inner hover:bg-white hover:border-slate-200">
                                </div>
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Nomor Telepon</label>
                                <div class="relative group">
                                    <div class="absolute left-6 top-1/2 -translate-y-1/2 text-slate-400">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                                    </div>
                                    <input type="text" name="phone" value="{{ old('phone', $school->phone) }}" placeholder="(021) 1234567"
                                        class="w-full bg-slate-50 border-2 border-slate-100 py-4 pl-14 pr-6 rounded-2xl font-black text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-inner hover:bg-white hover:border-slate-200">
                                </div>
                            </div>

                            <div class="sm:col-span-2">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Alamat Lengkap</label>
                                <textarea name="address" rows="3" placeholder="Jl. Raya Utama No. 123, Kota Administrasi..."
                                    class="w-full bg-slate-50 border-2 border-slate-100 py-4 px-6 rounded-2xl font-black text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition-all shadow-inner hover:bg-white hover:border-slate-200 resize-none">{{ old('address', $school->address) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <!-- section: Security & Policy -->
                    <div class="space-y-10 pt-4">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-rose-50 text-rose-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest leading-none">Keamanan & Sesi</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight mt-2">Kontrol akses mandiri aplikasi siswa</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div class="group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Password Keluar App</label>
                                <input type="text" name="exit_password" value="{{ old('exit_password', $school->exit_password) }}" placeholder="admin123"
                                    class="w-full bg-rose-50/20 border-2 border-rose-100/50 py-4 px-6 rounded-2xl font-black text-rose-600 text-sm outline-none focus:ring-4 focus:ring-rose-500/10 focus:border-rose-300 transition-all shadow-inner hover:bg-white uppercase tracking-widest">
                                <p class="text-[9px] text-slate-400 mt-3 ml-1 italic font-bold tracking-tight">* Diminta saat ingin menutup Web Ujian</p>
                            </div>

                            <div class="group">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Password Pelanggaran</label>
                                <input type="text" name="violation_password" value="{{ old('violation_password', $school->violation_password) }}" placeholder="admin123"
                                    class="w-full bg-rose-50/20 border-2 border-rose-100/50 py-4 px-6 rounded-2xl font-black text-rose-600 text-sm outline-none focus:ring-4 focus:ring-rose-500/10 focus:border-rose-300 transition-all shadow-inner hover:bg-white uppercase tracking-widest">
                                <p class="text-[9px] text-slate-400 mt-3 ml-1 italic font-bold tracking-tight">* Diminta jika siswa mencoba curang (Unpin)</p>
                            </div>
                        </div>
                    </div>

                    <!-- section: Branding & Web Access -->
                    <div class="space-y-10 pt-4">
                        <div class="flex items-center gap-5">
                            <div class="w-12 h-12 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center shadow-inner">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/></svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest leading-none">Warna & Whitelist</h3>
                                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-tight mt-2">Kustomisasi visual dan pembatasan domain</p>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                            <div class="sm:col-span-1">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Whitelist Domain</label>
                                <textarea name="domain_whitelist" rows="2" placeholder="docs.google.com, forms.gle, sekolah.sch.id"
                                    class="w-full bg-slate-50 border-2 border-slate-100 py-4 px-6 rounded-2xl font-black text-slate-700 text-sm outline-none focus:ring-4 focus:ring-emerald-500/10 focus:border-emerald-500 transition-all shadow-inner hover:bg-white hover:border-slate-200 resize-none">{{ old('domain_whitelist', $school->domain_whitelist) }}</textarea>
                                <p class="text-[9px] text-slate-400 mt-3 ml-1 italic font-bold tracking-tight leading-relaxed">* Masukkan domain yang boleh dibuka saat ujian (Pisahkan dengan koma)</p>
                            </div>

                            <div class="sm:col-span-1">
                                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Aksen Warna Tema</label>
                                <div class="flex gap-4 items-center">
                                    <div class="relative w-16 h-16 shrink-0 group">
                                        <input type="color" name="theme_color" value="{{ old('theme_color', $school->theme_color ?? '#3C50E0') }}"
                                            class="w-full h-full bg-white border-2 border-slate-200 rounded-2xl cursor-pointer p-1 transition-all group-hover:scale-105 group-hover:border-indigo-400 shadow-sm">
                                    </div>
                                    <div class="flex-1">
                                        <input type="text" readonly value="{{ $school->theme_color ?? '#3C50E0' }}"
                                            class="w-full bg-slate-100 border-2 border-slate-100 py-4 px-6 rounded-2xl font-mono font-black text-xs text-slate-500 cursor-not-allowed uppercase tracking-widest">
                                    </div>
                                </div>
                                <p class="text-[9px] text-slate-400 mt-3 ml-1 italic font-bold tracking-tight">* Digunakan sebagai aksen warna utama di Dashboard Mobile</p>
                            </div>
                        </div>
                    </div>

                    <!-- section: SuperAdmin Settings -->
                    @if(Auth::user()->role === 'superadmin')
                    <div class="space-y-10 pt-10 border-t-4 border-slate-900/10">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-5">
                                <div class="w-12 h-12 bg-slate-900 text-white rounded-2xl flex items-center justify-center shadow-lg transform rotate-12">
                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                                </div>
                                <div>
                                    <h3 class="text-lg font-black text-slate-900 uppercase tracking-widest leading-none italic">S.ADMIN CONSOLE</h3>
                                    <p class="text-[10px] text-rose-500 font-bold uppercase tracking-tight mt-2 flex items-center gap-2">
                                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"/></svg>
                                        HANYA DAPAT DIUBAH OLEH PUSAT
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-8 bg-slate-900 p-8 rounded-3xl shadow-2xl relative overflow-hidden">
                            <!-- Background Decor -->
                            <div class="absolute top-0 right-0 w-32 h-32 bg-indigo-500 opacity-10 blur-[50px]"></div>
                            
                            <div class="relative z-10">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Tipe Langganan</label>
                                <select name="subscription_type" id="subscription_type" class="w-full bg-slate-800 border-2 border-slate-700 py-4 px-6 rounded-2xl font-black text-white text-sm outline-none focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all shadow-xl">
                                    <option value="trial" {{ $school->subscription_type === 'trial' ? 'selected' : '' }}>TRIAL (3 Hari)</option>
                                    <option value="6_months" {{ $school->subscription_type === '6_months' ? 'selected' : '' }}>6 BULAN</option>
                                    <option value="1_year" {{ $school->subscription_type === '1_year' ? 'selected' : '' }}>1 TAHUN</option>
                                    <option value="year" {{ $school->subscription_type === 'year' ? 'selected' : '' }}>ANNUAL (Custom)</option>
                                    <option value="lifetime" {{ $school->subscription_type === 'lifetime' ? 'selected' : '' }}>EXCLUSIVE (3 Tahun)</option>
                                </select>
                            </div>

                            <div class="relative z-10" id="duration_box">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3 ml-1">Masa Aktif (Bulan)</label>
                                <input type="number" name="subscription_months" value="0" min="0"
                                    class="w-full bg-slate-800 border-2 border-slate-700 py-4 px-6 rounded-2xl font-black text-indigo-400 text-sm outline-none focus:ring-4 focus:ring-indigo-500/20 focus:border-indigo-500 transition-all shadow-xl">
                            </div>

                            <div class="sm:col-span-2 space-y-4">
                                <label class="block text-[10px] font-black text-slate-500 uppercase tracking-[0.2em] ml-1">Status Keaktifan Instansi</label>
                                <div class="grid grid-cols-2 gap-4">
                                    <label class="relative flex items-center justify-center p-5 bg-slate-800 border-2 border-slate-700 rounded-2xl cursor-pointer hover:border-emerald-500/50 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-500/10 group">
                                        <input type="radio" name="is_active" value="1" {{ $school->is_active ? 'checked' : '' }} class="hidden">
                                        <span class="font-black text-slate-400 group-has-[:checked]:text-emerald-400 uppercase tracking-widest text-[11px]"> AKTIF </span>
                                    </label>
                                    <label class="relative flex items-center justify-center p-5 bg-slate-800 border-2 border-slate-700 rounded-2xl cursor-pointer hover:border-rose-500/50 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-500/10 group">
                                        <input type="radio" name="is_active" value="0" {{ !$school->is_active ? 'checked' : '' }} class="hidden">
                                        <span class="font-black text-slate-400 group-has-[:checked]:text-rose-400 uppercase tracking-widest text-[11px]"> DIBLOKIR </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    <!-- Sticky Bottom Action Bar -->
                    <div class="pt-8 border-t border-slate-100 flex flex-col sm:flex-row items-center justify-between gap-8">
                        <div class="text-center sm:text-left">
                            <h4 class="text-[11px] font-black text-slate-900 uppercase tracking-widest">Siap untuk menyimpan?</h4>
                            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tight mt-1">Perubahan akan langsung diterapkan ke semua aplikasi mobile siswa.</p>
                        </div>
                        <button type="submit" class="w-full sm:w-auto px-10 py-5 bg-slate-900 hover:bg-black text-white rounded-[1.2rem] font-black text-[11px] uppercase tracking-[0.3em] transition-all transform hover:scale-[1.05] hover:shadow-2xl hover:shadow-slate-300 active:scale-[0.98] flex items-center justify-center gap-4">
                            Simpan Perubahan
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<style>
    /* Premium Hover Animations */
    input:focus, textarea:focus, select:focus {
        background-color: white !important;
        box-shadow: 0 10px 25px -5px rgba(99, 102, 241, 0.1) !important;
    }
    
    label {
        transition: color 0.3s ease;
    }
    
    .group:focus-within label {
        color: #6366f1 !important;
    }
</style>

<script>
    function previewLogo(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const img = document.getElementById('preview-img');
            const placeholder = document.getElementById('preview-placeholder');
            const box = document.getElementById('preview-box');

            reader.onload = function(e) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
                box.classList.remove('border-slate-200');
                box.classList.add('border-indigo-500', 'bg-white');
                box.style.borderStyle = 'solid';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    function previewBg(input) {
        if (input.files && input.files[0]) {
            const reader = new FileReader();
            const img = document.getElementById('bg-preview-img');
            const placeholder = document.getElementById('bg-preview-placeholder');
            const box = document.getElementById('bg-preview-box');

            reader.onload = function(e) {
                img.src = e.target.result;
                img.classList.remove('hidden');
                if (placeholder) placeholder.classList.add('hidden');
                box.classList.remove('border-slate-200');
                box.classList.add('border-indigo-500', 'bg-white');
                box.style.borderStyle = 'solid';
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    document.getElementById('subscription_type')?.addEventListener('change', function() {
        const durationBox = document.getElementById('duration_box');
        if (this.value === 'lifetime') {
            durationBox.style.opacity = '0.3';
            durationBox.style.pointerEvents = 'none';
        } else {
            durationBox.style.opacity = '1';
            durationBox.style.pointerEvents = 'auto';
        }
    });

    // Save Guard
    let isFormDirty = false;
    const schoolForm = document.querySelector('form');
    if (schoolForm) {
        schoolForm.addEventListener('input', () => isFormDirty = true);
        schoolForm.addEventListener('submit', () => isFormDirty = false);
    }
    window.addEventListener('beforeunload', (e) => {
        if (isFormDirty) {
            e.preventDefault();
            e.returnValue = '';
        }
    });
</script>
@endsection
