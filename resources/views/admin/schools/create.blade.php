@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Pendaftaran Sekolah Baru</h2>
                <p class="text-slate-500 text-xs font-medium mt-1">Lengkapi data untuk membuat akses sekolah baru.</p>
            </div>
            <a href="{{ route('schools.index') }}" class="text-slate-400 hover:text-slate-900 font-bold text-sm">Kembali</a>
        </div>

        <form action="{{ route('schools.store') }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Logo Upload Section -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Logo Sekolah (Opsional)</label>
                    <div class="flex items-center gap-4">
                        <div id="preview-box" class="w-16 h-16 bg-slate-100 rounded-2xl border-2 border-dashed border-slate-300 flex items-center justify-center text-slate-400 overflow-hidden">
                            <span id="preview-placeholder">🏫</span>
                            <img id="preview-img" class="hidden w-full h-full object-cover">
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" id="logo-input" accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-all">
                            <p class="text-[9px] text-slate-400 mt-1 uppercase tracking-wider">Format: JPG, PNG, JPEG. Max: 2MB. Logo akan tampil di tengah QR.</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Nama Sekolah</label>
                    <input type="text" name="name" required value="{{ old('name') }}"
                        placeholder="Misal: SMK Codifi Indonesia"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Domain Whitelist</label>
                    <input type="text" name="domain_whitelist" required value="{{ old('domain_whitelist') }}"
                        placeholder="Misal: scholacbt.id"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900">
                    <p class="text-[10px] text-slate-400 mt-2 font-medium uppercase tracking-wider">DOMAIN UTAMA YANG DIIZINKAN (Tanpa http/https)</p>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Tipe Langganan</label>
                    <select name="subscription_type" id="subscription_type" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-bold text-slate-700">
                        <option value="year">1 TAHUN / DURASI</option>
                        <option value="lifetime">LIFE TIME (FOREVER)</option>
                    </select>
                </div>

                <div class="md:col-span-1" id="duration_box">
                    <label class="block text-sm font-bold text-slate-700 mb-2">Durasi (Bulan)</label>
                    <input type="number" name="subscription_months" value="12" min="1"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-bold">
                </div>
            </div>

            <div class="pt-4">
                <label class="block text-sm font-bold text-slate-700 mb-4 uppercase tracking-widest text-[10px]">Status Akses Awal</label>
                <div class="flex space-x-4">
                    <label class="flex items-center p-4 bg-slate-50 border border-slate-200 cursor-pointer hover:border-indigo-500 transition flex-1 rounded-2xl border-2 border-transparent has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/30">
                        <input type="radio" name="is_active" value="1" checked class="hidden">
                        <span class="ml-3 font-bold text-slate-700 uppercase tracking-tighter text-xs">AKTIFKAN SEKARANG</span>
                    </label>
                    <label class="flex items-center p-4 bg-slate-50 border border-slate-200 cursor-pointer hover:border-slate-400 transition flex-1 rounded-2xl border-2 border-transparent has-[:checked]:border-slate-500">
                        <input type="radio" name="is_active" value="0" class="hidden">
                        <span class="ml-3 font-bold text-slate-700 uppercase tracking-tighter text-xs">TANGGUHKAN</span>
                    </label>
                </div>
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white p-5 rounded-2xl font-black text-lg hover:bg-indigo-700 transition shadow-xl shadow-indigo-100 mt-4 uppercase tracking-widest group">
                Konfirmasi Pendaftaran <span class="group-hover:translate-x-1 transition-transform inline-block">🚀</span>
            </button>
        </form>
    </div>
</div>

<script>
    document.getElementById('subscription_type').addEventListener('change', function() {
        const durationBox = document.getElementById('duration_box');
        if (this.value === 'lifetime') {
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
</script>
@endsection
