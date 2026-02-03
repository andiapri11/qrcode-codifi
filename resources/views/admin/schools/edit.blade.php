@extends('layouts.admin')

@section('content')
<div class="max-w-7xl mx-auto px-4">
    <div class="bg-gradient-to-b from-white to-slate-50/20 rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
        <!-- Compact Header -->
        <div class="px-8 py-8 border-b border-slate-100 flex justify-between items-center bg-white">
            <div class="flex items-center gap-5">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 shadow-inner shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <div>
                    <div class="flex items-center gap-3">
                        <h2 class="text-lg font-black text-slate-900 tracking-tight uppercase">Profil Instansi</h2>
                        @if($school->subscription_type === 'lifetime')
                            <span class="px-3 py-1 bg-amber-100 border border-amber-200 text-amber-600 text-[8px] font-black rounded-full uppercase tracking-widest shadow-sm shadow-amber-50 animate-pulse">
                                ⚡ Priority Tier
                            </span>
                        @endif
                    </div>
                    <p class="text-[9px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Identitas dan kontak sekolah</p>
                </div>
            </div>
            <div class="hidden sm:flex px-4 py-1.5 bg-slate-50 rounded-full border border-slate-100 text-[9px] font-black text-slate-400 uppercase tracking-widest">
                Step 1
            </div>
        </div>

        <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data" class="p-8 lg:p-10">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-12 gap-8">
                <!-- Left Side: Logo Section -->
                <div class="col-span-12 lg:col-span-4 space-y-8">
                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Logo Instansi</label>
                        @php
                            $isTrial = $school->subscription_type === 'trial';
                            $isLifetime = $school->subscription_type === 'lifetime';
                        @endphp

                        <div class="relative group">
                            <div id="preview-box" class="aspect-square bg-slate-50/50 rounded-[2rem] border-2 border-dashed {{ $school->logo ? 'border-indigo-100' : 'border-slate-200' }} flex flex-col items-center justify-center transition-all overflow-hidden relative shadow-inner {{ $isTrial ? 'opacity-70 bg-slate-100 cursor-not-allowed' : 'hover:bg-white hover:border-indigo-300' }}">
                                @if($school->logo)
                                    <img id="preview-img" src="{{ Storage::disk('public')->url($school->logo) }}" class="w-full h-full object-cover">
                                @else
                                    <div id="preview-placeholder" class="text-center p-4">
                                        <div class="w-12 h-12 bg-white rounded-xl flex items-center justify-center text-slate-300 mx-auto mb-3 border border-slate-100 shadow-sm">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                        </div>
                                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Upload logo</p>
                                        <p class="text-[8px] text-slate-300 mt-0.5 uppercase tracking-tight">Gunakan format PNG Tanpa Background</p>
                                    </div>
                                    <img id="preview-img" class="hidden w-full h-full object-cover">
                                @endif

                                @if(!$isTrial)
                                <input type="file" name="logo" id="logo-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-10" onchange="previewLogo(this)">
                                @endif
                            </div>

                            @if($isTrial)
                            <div class="absolute inset-x-0 bottom-4 flex justify-center z-20">
                                <span class="bg-slate-900 text-white text-[8px] font-black px-5 py-3 rounded-2xl uppercase tracking-[0.2em] shadow-2xl flex flex-col items-center gap-3 text-center leading-relaxed border border-white/10 backdrop-blur-sm">
                                    <svg class="w-5 h-5 text-amber-400 drop-shadow-[0_0_8px_rgba(251,191,36,0.5)]" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" />
                                    </svg>
                                    <span>UPGRADE PAKET UNTUK<br>KUSTOMISASI LOGO BRANDING</span>
                                </span>
                            </div>
                            @endif
                        </div>
                    </div>

                    <!-- Custom Background Section -->
                    <div>
                        <div class="flex items-center justify-between mb-4">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Custom Background App</label>
                            @if($isLifetime)
                                <span class="bg-indigo-100 text-indigo-600 px-2 py-0.5 rounded text-[7px] font-black uppercase tracking-widest">Lifetime Only</span>
                            @endif
                        </div>
                        
                        <div class="flex justify-center">
                            <div class="relative group w-[180px]">
                                <!-- Phone Frame Decorator -->
                                <div class="absolute -inset-2 border-[6px] border-slate-900 rounded-[2.5rem] shadow-2xl z-0 pointer-events-none"></div>
                                <div class="absolute top-0 left-1/2 -translate-x-1/2 w-20 h-5 bg-slate-900 rounded-b-2xl z-20 pointer-events-none"></div>
                                
                                <div id="bg-preview-box" class="aspect-[9/16] bg-slate-100 rounded-[2rem] border-2 border-dashed {{ $school->custom_background ? 'border-transparent' : 'border-slate-300' }} flex flex-col items-center justify-center transition-all overflow-hidden relative shadow-inner z-10 {{ !$isLifetime && strtolower(Auth::user()->role) !== 'superadmin' ? 'opacity-70 bg-slate-200 cursor-not-allowed' : 'hover:bg-slate-50 hover:border-indigo-300' }}">
                                    @if($school->custom_background)
                                        <img id="bg-preview-img" src="{{ Storage::disk('public')->url($school->custom_background) }}" class="w-full h-full object-cover animate-in fade-in zoom-in duration-500">
                                    @else
                                        <div id="bg-preview-placeholder" class="text-center p-4">
                                            <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-slate-300 mx-auto mb-2 border border-slate-100 shadow-sm">
                                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                                            </div>
                                            <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest leading-tight">Klik untuk<br>Pilih Foto</p>
                                        </div>
                                        <img id="bg-preview-img" class="hidden w-full h-full object-cover">
                                    @endif

                                    @if($isLifetime || strtolower(Auth::user()->role) === 'superadmin')
                                    <input type="file" name="custom_background" id="bg-input" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer z-30" onchange="previewBg(this)">
                                    @endif

                                    <!-- Subtle Mobile Overlay Preview -->
                                    <div class="absolute inset-x-0 bottom-0 h-24 bg-gradient-to-t from-white/80 to-transparent z-20 flex flex-col items-center justify-end pb-4 font-black text-[6px] text-slate-400 uppercase tracking-widest opacity-50">
                                        Schola Client v5.1
                                    </div>
                                </div>

                                @if(!$isLifetime && strtolower(Auth::user()->role) !== 'superadmin')
                                <div class="absolute inset-0 flex items-center justify-center bg-slate-900/60 backdrop-blur-[4px] rounded-[2rem] z-40">
                                    <span class="bg-white text-slate-900 text-[8px] font-black px-4 py-2 rounded-lg uppercase tracking-widest shadow-xl flex items-center gap-2">
                                        <svg class="w-3 h-3 text-amber-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" /></svg>
                                        LIFETIME
                                    </span>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="mt-8 bg-amber-50 rounded-xl p-4 border border-amber-100">
                            <h6 class="text-[9px] font-black text-amber-700 uppercase tracking-widest flex items-center gap-2 mb-2">
                                <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7-4a1 1 0 11-2 0 1 1 0 012 0zM9 9a1 1 0 000 2v3a1 1 0 001 1h1a1 1 0 100-2v-3a1 1 0 00-1-1H9z" clip-rule="evenodd" /></svg>
                                Smart Convert Aktif
                            </h6>
                            <p class="text-[8px] text-amber-600/80 leading-relaxed font-bold uppercase tracking-tight">
                                Anda bisa upload foto ukuran apapun. Sistem akan otomatis memotong (crop) dan menyesuaikan ke rasio layar handphone secara presisi.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Right Side: Contact Information -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-1">
                            @php
                                $canEditCode = strtolower(Auth::user()->role) === 'superadmin' || $school->subscription_type === 'lifetime';
                                $codeLength = $school->subscription_type === 'lifetime' ? 10 : 5;
                            @endphp
                            
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Kode Instansi (Hingga {{ $codeLength }} Char)</label>
                            @if($canEditCode)
                                <input type="text" name="school_code" value="{{ old('school_code', $school->school_code) }}" maxlength="{{ $codeLength }}" placeholder="Contoh: SMKN1" style="text-transform: uppercase;"
                                    class="w-full bg-slate-50 border border-slate-200 py-3.5 px-6 rounded-xl font-black text-slate-700 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                                <p class="text-[8px] text-slate-400 mt-2 ml-1 italic tracking-tight">* Kode unik untuk diinput siswa di aplikasi.</p>
                            @else
                                <div class="w-full bg-slate-100/50 border border-slate-200 py-3.5 px-6 rounded-xl font-black text-slate-500 text-sm cursor-not-allowed flex items-center gap-2">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    {{ $school->school_code ?? 'BELUM DISET' }}
                                    <span class="ml-auto text-[8px] opacity-70">FIXED</span>
                                </div>
                                <p class="text-[8px] text-rose-400 mt-2 ml-1 italic font-bold uppercase tracking-widest">Upgrade ke Lifetime untuk ganti kode</p>
                            @endif
                        </div>

                        <div class="sm:col-span-1">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Nama Instansi</label>
                            <input type="text" name="name" required value="{{ old('name', $school->name) }}" placeholder="Contoh: SMA Negeri 1 Jakarta"
                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                        </div>

                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email', $school->email) }}" placeholder="info@sekolah.sch.id"
                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                        </div>

                        <div>
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone', $school->phone) }}" placeholder="(021) 1234567"
                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                        </div>

                        <div class="sm:col-span-2">
                            <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Alamat Lengkap</label>
                            <textarea name="address" rows="2" placeholder="Jl. Jenderal Sudirman No..."
                                class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner resize-none">{{ old('address', $school->address) }}</textarea>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-10 border-t border-slate-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center shadow-inner">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Sesi & Keamanan App</h3>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tight mt-1">Konfigurasi password mandiri instansi</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Password Keluar Ujian</label>
                        <input type="text" name="exit_password" value="{{ old('exit_password', $school->exit_password) }}" placeholder="Default: admin123"
                            class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                        <p class="text-[8px] text-slate-400 mt-2 ml-1 italic tracking-tight">* Diminta saat siswa ingin keluar dari mode Webview.</p>
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Password Buka Pelanggaran</label>
                        <input type="text" name="violation_password" value="{{ old('violation_password', $school->violation_password) }}" placeholder="Default: admin123"
                            class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner">
                        <p class="text-[8px] text-slate-400 mt-2 ml-1 italic tracking-tight">* Diminta saat siswa terdeteksi melakukan pelanggaran (Unpin).</p>
                    </div>
                </div>
            </div>

            <!-- Branding & Web Access -->
            <div class="mt-12 pt-10 border-t border-slate-100">
                <div class="flex items-center gap-4 mb-8">
                    <div class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center shadow-inner">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                    </div>
                    <div>
                        <h3 class="text-xs font-black text-slate-900 uppercase tracking-widest">Branding & Akses Web</h3>
                        <p class="text-[9px] text-slate-400 font-bold uppercase tracking-tight mt-1">Identitas warna dan pembatasan akses website</p>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="md:col-span-1">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Whitelist Domain (Pisahkan koma)</label>
                        <textarea name="domain_whitelist" rows="2" placeholder="Contoh: docs.google.com, forms.gle, sekolah.sch.id"
                            class="w-full bg-slate-50 border border-slate-100 py-3.5 px-6 rounded-xl font-bold text-slate-900 text-sm outline-none focus:ring-4 focus:ring-indigo-500/10 focus:border-indigo-500 transition shadow-inner resize-none">{{ old('domain_whitelist', $school->domain_whitelist) }}</textarea>
                        <p class="text-[8px] text-slate-400 mt-2 ml-1 italic tracking-tight">* Alamat website selain ujian yang boleh diakses siswa.</p>
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Warna Tema Aplikasi</label>
                        <div class="flex gap-4 items-center">
                            <input type="color" name="theme_color" value="{{ old('theme_color', $school->theme_color ?? '#3C50E0') }}"
                                class="w-16 h-12 bg-slate-50 border border-slate-100 rounded-xl cursor-pointer p-1">
                            <div class="flex-1">
                                <input type="text" readonly value="{{ $school->theme_color ?? '#3C50E0' }}"
                                    class="w-full bg-slate-100 border border-slate-100 py-3.5 px-6 rounded-xl font-mono text-xs text-slate-500 cursor-not-allowed">
                            </div>
                        </div>
                        <p class="text-[8px] text-slate-400 mt-2 ml-1 italic tracking-tight">* Warna utama dashboard di aplikasi mobile siswa.</p>
                    </div>
                </div>
            </div>

            <!-- SuperAdmin Settings (Only visible to Superadmin) -->
            @if(Auth::user()->role === 'superadmin')
            <div class="mt-12 pt-10 border-t border-slate-100">
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-7 h-7 bg-slate-900 text-white rounded-lg flex items-center justify-center text-[10px] font-black">⚙️</span>
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-tight">Administratif</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div class="flex flex-col">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Tipe Langganan</label>
                        <select name="subscription_type" id="subscription_type" class="w-full bg-slate-50 border border-slate-200 py-3 px-5 rounded-xl font-bold text-slate-700 text-xs outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="trial" {{ $school->subscription_type === 'trial' ? 'selected' : '' }}>TRIAL (3 Hari)</option>
                            <option value="6_months" {{ $school->subscription_type === '6_months' ? 'selected' : '' }}>6 BULAN</option>
                            <option value="1_year" {{ $school->subscription_type === '1_year' ? 'selected' : '' }}>1 TAHUN</option>
                            <option value="year" {{ $school->subscription_type === 'year' ? 'selected' : '' }}>ANNUAL (Custom)</option>
                            <option value="lifetime" {{ $school->subscription_type === 'lifetime' ? 'selected' : '' }}>LIFE TIME</option>
                        </select>
                        @if($school->subscription_expires_at)
                            <p class="text-[8px] font-bold text-indigo-500 uppercase mt-2 ml-1 tracking-widest italic">Exp: {{ $school->subscription_expires_at->format('d M Y') }}</p>
                        @endif
                    </div>

                    <div id="duration_box" style="{{ $school->subscription_type === 'lifetime' ? 'opacity: 0.3; pointer-events: none;' : '' }}">
                        <label class="block text-[9px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-2.5 ml-1">Tambah Masa Aktif (Bulan)</label>
                        <input type="number" name="subscription_months" value="0" min="0"
                            class="w-full bg-white border-2 border-indigo-100 py-3 px-5 rounded-xl font-black text-indigo-600 text-xs outline-none focus:ring-4 focus:ring-indigo-500/20">
                    </div>

                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Link Quota (Max)</label>
                        <input type="number" name="max_links" value="{{ old('max_links', $school->max_links) }}" min="1"
                            class="w-full bg-slate-50 border border-slate-200 py-3 px-5 rounded-xl font-bold text-slate-700 text-xs outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        <p class="text-[8px] font-bold text-slate-400 uppercase mt-2 ml-1 tracking-widest">Saat ini: {{ $school->examLinks()->count() }} link terpakai</p>
                    </div>

                    <div class="md:col-span-2 pt-2">
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4 ml-1">Status Akses</label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                            <label class="relative flex items-center p-4 bg-white border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-emerald-500/30 transition-all has-[:checked]:border-emerald-500 has-[:checked]:bg-emerald-50/20 group">
                                <input type="radio" name="is_active" value="1" {{ $school->is_active ? 'checked' : '' }} class="hidden">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-200 flex items-center justify-center group-has-[:checked]:border-emerald-500 group-has-[:checked]:bg-emerald-500 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100"></div>
                                </div>
                                <span class="ml-3 font-black text-slate-700 uppercase tracking-tighter text-[10px]">AKTIF</span>
                            </label>
                            
                            <label class="relative flex items-center p-4 bg-white border-2 border-slate-100 rounded-2xl cursor-pointer hover:border-rose-500/30 transition-all has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/20 group">
                                <input type="radio" name="is_active" value="0" {{ !$school->is_active ? 'checked' : '' }} class="hidden">
                                <div class="w-5 h-5 rounded-full border-2 border-slate-200 flex items-center justify-center group-has-[:checked]:border-rose-500 group-has-[:checked]:bg-rose-500 transition-all">
                                    <div class="w-1.5 h-1.5 bg-white rounded-full opacity-0 group-has-[:checked]:opacity-100"></div>
                                </div>
                                <span class="ml-3 font-black text-slate-700 uppercase tracking-tighter text-[10px]">BEKUKAN</span>
                            </label>
                        </div>
                    </div>
                </div>
            </div>
            @endif

            <div class="mt-12 flex justify-end">
                <button type="submit" class="w-full sm:w-auto min-w-[240px] bg-slate-900 text-white py-4 px-8 rounded-xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-black hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-slate-200/50">
                    Simpan Profil
                </button>
            </div>
        </form>
    </div>
</div>

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
</script>
@endsection
