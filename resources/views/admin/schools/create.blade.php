@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto">
    <!-- Header with Back Button -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('schools.index') }}" class="w-10 h-10 flex items-center justify-center bg-white dark:bg-slate-800 rounded-full shadow-sm border border-slate-200 dark:border-slate-700 text-slate-500 hover:text-blue-600 hover:border-blue-200 transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" /></svg>
        </a>
        <div>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight">Tambah Instansi Baru</h2>
            <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Setup profil sekolah dan akun administrator.</p>
        </div>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 rounded-xl bg-red-50 dark:bg-red-900/20 border border-red-100 dark:border-red-900/30 flex items-start gap-3">
        <svg class="w-5 h-5 text-red-500 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
        <div class="flex-1">
            <h4 class="text-sm font-bold text-red-800 dark:text-red-400">Terdapat kesalahan input</h4>
            <ul class="mt-1 list-disc list-inside text-xs text-red-600 dark:text-red-500 font-medium">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    </div>
    @endif

    <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
        @csrf
        
        <!-- Section 1: Profil Instansi -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 rounded-xl flex items-center justify-center text-blue-600 dark:text-blue-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider">Profil Instansi</h3>
                        <p class="text-xs text-slate-500 font-medium">Informasi identitas dan kontak sekolah</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500">Step 1</span>
            </div>
            
            <div class="p-8 grid grid-cols-1 lg:grid-cols-12 gap-8">
                <!-- Logo Upload (Left Col) -->
                <div class="lg:col-span-4">
                    <label class="block text-xs font-bold text-slate-500 mb-3 uppercase tracking-wider">Logo Sekolah</label>
                    <div class="relative group">
                        <div id="preview-box" class="w-full aspect-square rounded-2xl border-2 border-dashed border-slate-300 dark:border-slate-700 bg-slate-50 dark:bg-slate-800 flex flex-col items-center justify-center text-slate-400 transition-all hover:border-blue-400 hover:bg-blue-50 dark:hover:bg-slate-700 cursor-pointer text-center p-4">
                            <img id="preview-img" class="hidden w-32 h-32 object-contain mb-2">
                            <div id="preview-placeholder" class="flex flex-col items-center">
                                <svg class="w-12 h-12 mb-3 text-slate-300" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                                <span class="text-xs font-bold">Upload Logo</span>
                                <span class="text-[10px] mt-1">PNG, JPG (Max 2MB)</span>
                            </div>
                        </div>
                        <input type="file" name="logo" id="logo-input" accept="image/*" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer">
                    </div>
                </div>

                <!-- Fields (Right Col) -->
                <div class="lg:col-span-8 space-y-5">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Nama Instansi</label>
                        <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: SMA Negeri 1 Jakarta" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all placeholder:text-slate-400">
                    </div>

                    <div class="grid grid-cols-2 gap-5">
                        <div>
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Email Resmi</label>
                            <input type="email" name="email" value="{{ old('email') }}" placeholder="info@sekolah.sch.id" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Nomor Telepon</label>
                            <input type="text" name="phone" value="{{ old('phone') }}" placeholder="(021) 1234567" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Alamat Lengkap</label>
                        <textarea name="address" rows="2" placeholder="Jl. Jenderal Sudirman No..." class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all resize-none">{{ old('address') }}</textarea>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Section: Sesi & Keamanan -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-indigo-100 dark:bg-indigo-900/30 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider">Sesi & Keamanan App</h3>
                        <p class="text-xs text-slate-500 font-medium">Password pengawas untuk kontrol akses aplikasi</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Password Keluar Ujian</label>
                    <input type="text" name="exit_password" value="admin123" placeholder="Contoh: 123456"
                        class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-inner">
                    <p class="text-[9px] text-slate-400 mt-2 italic font-medium">* Digunakan siswa untuk keluar sesi ujian.</p>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Password Buka Pelanggaran</label>
                    <input type="text" name="violation_password" value="admin123" placeholder="Contoh: 654321"
                        class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-inner">
                    <p class="text-[9px] text-slate-400 mt-2 italic font-medium">* Digunakan saat unpin aplikasi terdeteksi.</p>
                </div>
            </div>
        </div>

        <!-- Section: Branding & Akses Web -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider">Branding & Akses Web</h3>
                        <p class="text-xs text-slate-500 font-medium">Pengaturan whitelist website dan warna tema aplikasi</p>
                    </div>
                </div>
            </div>
            
            <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Whitelist Domain (Pisahkan Koma)</label>
                    <textarea name="domain_whitelist" rows="2" placeholder="Contoh: docs.google.com, forms.gle"
                        class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50 focus:border-blue-500 transition-all shadow-inner resize-none"></textarea>
                    <p class="text-[9px] text-slate-400 mt-2 italic font-medium">* Daftar website sekolah/ujian yang boleh diakses.</p>
                </div>

                <div>
                    <label class="block text-[10px] font-bold text-slate-500 uppercase tracking-wider mb-2">Warna Tema Aplikasi</label>
                    <div class="flex gap-4">
                        <input type="color" name="theme_color" value="#3C50E0" class="w-16 h-12 bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl cursor-pointer p-1">
                        <input type="text" readonly value="#3C50E0" class="flex-1 bg-slate-100 dark:bg-slate-800/50 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-xs font-mono text-slate-400 cursor-not-allowed">
                    </div>
                    <p class="text-[9px] text-slate-400 mt-2 italic font-medium">* Warna dominan pada aplikasi mobile siswa.</p>
                </div>
            </div>
        </div>

        <!-- Section 2: Layanan & Akses -->
        <div class="bg-white dark:bg-slate-900 rounded-[2rem] shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-6 border-b border-slate-100 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/30">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/30 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                    </div>
                    <div>
                        <h3 class="font-black text-slate-800 dark:text-slate-100 text-sm uppercase tracking-wider">Layanan & Akses Admin</h3>
                        <p class="text-xs text-slate-500 font-medium">Pengaturan paket dan akun superuser sekolah</p>
                    </div>
                </div>
                <span class="px-3 py-1 rounded-full bg-slate-100 dark:bg-slate-800 text-xs font-bold text-slate-500">Step 2</span>
            </div>

            <div class="p-8 space-y-8">
                <!-- Paket Subscription -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div>
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Jenis Paket</label>
                        <div class="relative">
                            <select name="subscription_type" id="subscription_type" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-black text-slate-800 dark:text-white appearance-none focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                                <option value="trial" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">TRIAL (3 Hari)</option>
                                <option value="6_months" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">PREMIUM 6 BULAN</option>
                                <option value="1_year" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">PREMIUM 1 TAHUN</option>
                                <option value="year" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">ANNUAL (Custom)</option>
                                <option value="lifetime" class="bg-white dark:bg-slate-800 text-slate-700 dark:text-slate-200">LIFETIME (Permanen)</option>
                            </select>
                            <div class="absolute right-4 top-1/2 -translate-y-1/2 pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                            </div>
                        </div>
                    </div>
                    <div id="duration_box" class="opacity-30 pointer-events-none transition-all">
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Durasi (Bulan)</label>
                        <input type="number" name="subscription_months" id="subscription_months" value="12" min="1" class="w-full bg-slate-50 dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl px-4 py-3.5 text-sm font-bold text-slate-800 dark:text-white focus:outline-none focus:ring-2 focus:ring-blue-500/50">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-slate-600 dark:text-slate-400 mb-2 uppercase tracking-wide">Status Akun</label>
                        <div class="flex bg-slate-100 dark:bg-slate-800/50 p-1 rounded-xl">
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="is_active" value="1" checked class="peer sr-only">
                                <span class="block text-center py-2.5 text-xs font-black rounded-lg text-slate-500 peer-checked:bg-white dark:peer-checked:bg-slate-700 peer-checked:text-emerald-600 peer-checked:shadow-sm transition-all uppercase tracking-wide">Aktif</span>
                            </label>
                            <label class="flex-1 relative cursor-pointer group">
                                <input type="radio" name="is_active" value="0" class="peer sr-only">
                                <span class="block text-center py-2.5 text-xs font-black rounded-lg text-slate-500 peer-checked:bg-white dark:peer-checked:bg-slate-700 peer-checked:text-rose-600 peer-checked:shadow-sm transition-all uppercase tracking-wide">Non-Aktif</span>
                            </label>
                        </div>
                    </div>
                </div>

                <hr class="border-slate-100 dark:border-slate-800">

                <!-- Admin User -->
                <div class="bg-indigo-50/50 dark:bg-indigo-900/10 rounded-2xl p-6 border border-indigo-100 dark:border-indigo-900/20">
                    <h4 class="text-xs font-black text-indigo-900 dark:text-indigo-400 uppercase tracking-widest mb-6 flex items-center gap-2">
                        <span class="w-6 h-6 bg-indigo-200 dark:bg-indigo-800 rounded-full flex items-center justify-center text-[10px]">🔑</span>
                        Akun Administrator
                    </h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-800/60 dark:text-indigo-300/60 uppercase tracking-wider mb-1.5">Nama Lengkap Admin</label>
                            <input type="text" name="admin_name" value="{{ old('admin_name') }}" required class="w-full bg-white dark:bg-slate-900 border border-indigo-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 dark:text-white placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-800/60 dark:text-indigo-300/60 uppercase tracking-wider mb-1.5">WhatsApp Admin</label>
                            <input type="text" name="admin_phone" value="{{ old('admin_phone') }}" required class="w-full bg-white dark:bg-slate-900 border border-indigo-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 dark:text-white placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-800/60 dark:text-indigo-300/60 uppercase tracking-wider mb-1.5">Email Login</label>
                            <input type="email" name="admin_email" value="{{ old('admin_email') }}" required class="w-full bg-white dark:bg-slate-900 border border-indigo-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 dark:text-white placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                        </div>
                        <div>
                            <label class="block text-[10px] font-bold text-indigo-800/60 dark:text-indigo-300/60 uppercase tracking-wider mb-1.5">Password</label>
                            <input type="password" name="admin_password" required class="w-full bg-white dark:bg-slate-900 border border-indigo-100 dark:border-slate-700 rounded-xl px-4 py-3 text-sm font-bold text-slate-800 dark:text-white placeholder:text-slate-300 focus:outline-none focus:ring-2 focus:ring-indigo-500/30">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Action Bar -->
        <div class="flex items-center justify-end gap-4 pt-4">
            <a href="{{ route('schools.index') }}" class="px-6 py-4 rounded-xl text-xs font-bold text-slate-500 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors uppercase tracking-widest">Batal</a>
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white rounded-xl px-8 py-4 text-xs font-black uppercase tracking-[0.2em] shadow-lg shadow-blue-500/20 transition-all transform active:scale-95 flex items-center gap-2">
                Simpan Data
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" /></svg>
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('subscription_type').addEventListener('change', function() {
        const durationBox = document.getElementById('duration_box');
        if (this.value === 'lifetime' || this.value === 'trial' || this.value === '6_months' || this.value === '1_year') {
            durationBox.style.opacity = '0.3';
            durationBox.style.pointerEvents = 'none';
        } else {
            durationBox.style.opacity = '1';
            durationBox.style.pointerEvents = 'auto';
        }
    });

    document.getElementById('logo-input').addEventListener('change', function(e) {
        const reader = new FileReader();
        const placeholder = document.getElementById('preview-placeholder');
        const img = document.getElementById('preview-img');
        const box = document.getElementById('preview-box');

        reader.onload = function(e) {
            img.src = e.target.result;
            img.classList.remove('hidden');
            placeholder.classList.add('hidden');
            box.classList.add('border-blue-500', 'bg-white');
            box.classList.remove('border-dashed');
        }
        
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    window.addEventListener('load', () => {
        const subType = document.getElementById('subscription_type').value;
        if(subType === 'trial' || subType === 'lifetime' || subType === '6_months' || subType === '1_year') {
            document.getElementById('duration_box').style.opacity = '0.3';
            document.getElementById('duration_box').style.pointerEvents = 'none';
        }
    });
</script>
@endsection
