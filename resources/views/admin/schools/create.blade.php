@extends('layouts.admin')

@section('content')
<div class="max-w-5xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Pendaftaran Instansi Baru</h2>
        <p class="text-slate-500 text-xs font-bold uppercase tracking-widest mt-1">Lengkapi data instansi dan akun administrator pendamping.</p>
    </div>

    @if($errors->any())
    <div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl text-rose-600 text-xs font-bold">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Left Side: Institution Data -->
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-8 bg-indigo-50 text-indigo-600 rounded-lg flex items-center justify-center text-sm">🏢</span>
                    <h3 class="font-black text-slate-900 text-xs uppercase tracking-widest">Informasi Utama Instansi</h3>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Logo Instansi</label>
                    <div class="flex items-center gap-4 bg-slate-50 p-4 rounded-2xl border border-slate-100 shadow-inner">
                        <div id="preview-box" class="w-14 h-14 bg-white rounded-xl border-2 border-dashed border-slate-200 flex items-center justify-center text-xl overflow-hidden">
                            <span id="preview-placeholder">🏫</span>
                            <img id="preview-img" class="hidden w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" id="logo-input" accept="image/*" class="text-[10px] text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[9px] file:font-black file:bg-indigo-600 file:text-white hover:file:bg-indigo-700 transition-all cursor-pointer">
                        </div>
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Instansi / Sekolah</label>
                    <input type="text" name="name" value="{{ old('name') }}" required placeholder="Contoh: SMK Codifi Indonesia" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Domain Whitelist (Tanpa HTTP)</label>
                    <input type="text" name="domain_whitelist" value="{{ old('domain_whitelist') }}" required placeholder="forms.gle, docs.google.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                </div>

                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Paket</label>
                        <select name="subscription_type" id="subscription_type" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-black text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner appearance-none cursor-pointer">
                            <option value="trial">TRIAL (7 HARI)</option>
                            <option value="year">DURASI BULAN</option>
                            <option value="lifetime">LIFE TIME</option>
                        </select>
                    </div>
                    <div id="duration_box" class="opacity-30 pointer-events-none">
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Durasi (Bln)</label>
                        <input type="number" name="subscription_months" id="subscription_months" value="12" min="1" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Status Awal</label>
                    <div class="flex gap-4">
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="is_active" value="1" checked class="hidden peer">
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-[9px] font-black text-slate-400 text-center peer-checked:bg-indigo-600 peer-checked:text-white peer-checked:border-indigo-600 transition-all uppercase tracking-widest">Aktif</div>
                        </label>
                        <label class="flex-1 cursor-pointer">
                            <input type="radio" name="is_active" value="0" class="hidden peer">
                            <div class="p-4 bg-slate-50 border border-slate-100 rounded-2xl text-[9px] font-black text-slate-400 text-center peer-checked:bg-rose-600 peer-checked:text-white peer-checked:border-rose-600 transition-all uppercase tracking-widest">Ditunda</div>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Right Side: Admin Account Data -->
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-8 space-y-6">
                <div class="flex items-center gap-3 mb-2">
                    <span class="w-8 h-8 bg-emerald-50 text-emerald-600 rounded-lg flex items-center justify-center text-sm">👤</span>
                    <h3 class="font-black text-slate-900 text-xs uppercase tracking-widest">Akun Administrator Instansi</h3>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Administrator</label>
                    <input type="text" name="admin_name" value="{{ old('admin_name') }}" required placeholder="Nama Lengkap PJ / Admin" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                        <input type="email" name="admin_email" value="{{ old('admin_email') }}" required placeholder="email@instansi.sch.id" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    </div>
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nomor WhatsApp</label>
                        <input type="text" name="admin_phone" value="{{ old('admin_phone') }}" required placeholder="08xxxxxxxxxx" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    </div>
                </div>

                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Password Akses</label>
                    <input type="password" name="admin_password" required placeholder="Minimal 8 karakter" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    <p class="text-[9px] text-slate-400 mt-2 font-bold uppercase tracking-wider ml-1">Berikan password ini kepada admin instansi terkait.</p>
                </div>

                <div class="pt-4">
                    <div class="p-6 bg-amber-50 rounded-3xl border border-amber-100">
                        <div class="flex gap-4">
                            <span class="text-xl">💡</span>
                            <div>
                                <h4 class="text-[10px] font-black text-amber-900 uppercase tracking-widest mb-1">Informasi Penting</h4>
                                <p class="text-[10px] text-amber-800/70 font-bold leading-relaxed">Pastikan data email valid karena akan digunakan untuk proses login dan pemulihan akun oleh admin instansi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8 flex items-center justify-between gap-4">
            <a href="{{ route('schools.index') }}" class="bg-white text-slate-400 px-8 py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] border border-slate-200 hover:text-slate-900 transition-all">Batal & Kembali</a>
            <button type="submit" class="flex-1 bg-indigo-600 text-white rounded-2xl py-5 font-black text-[12px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-[0.98] flex items-center justify-center gap-3">
                <span>SIMPAN PERUBAHAN INSTANSI</span>
                <span class="text-xl">🚀</span>
            </button>
        </div>
    </form>
</div>

<script>
    document.getElementById('subscription_type').addEventListener('change', function() {
        const durationBox = document.getElementById('duration_box');
        const monthsInput = document.getElementById('subscription_months');
        
        if (this.value === 'lifetime' || this.value === 'trial') {
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
            box.classList.remove('border-dashed');
            box.classList.add('border-indigo-100');
        }
        
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });

    // Initial check
    window.addEventListener('load', () => {
        const subType = document.getElementById('subscription_type').value;
        if(subType === 'trial' || subType === 'lifetime') {
            document.getElementById('duration_box').style.opacity = '0.3';
            document.getElementById('duration_box').style.pointerEvents = 'none';
        }
    });
</script>
@endsection
