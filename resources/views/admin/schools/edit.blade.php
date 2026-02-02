@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <div class="p-8 border-b border-slate-100 flex justify-between items-center bg-slate-50/50">
            <div>
                <h2 class="text-2xl font-black text-slate-900">Edit Data Sekolah</h2>
                <p class="text-slate-500 text-xs font-medium mt-1">Perbarui informasi sekolah, logo, dan masa aktif langganan.</p>
            </div>
            <a href="{{ route('schools.index') }}" class="text-slate-400 hover:text-slate-900 font-bold text-sm">Kembali</a>
        </div>

        <form action="{{ route('schools.update', $school->id) }}" method="POST" enctype="multipart/form-data" class="p-8 space-y-6">
            @csrf
            @method('PUT')
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Logo Upload Section -->
                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">Logo Sekolah (Ditengah QR)</label>
                    <div class="flex items-center gap-5">
                        <div id="preview-box" class="w-20 h-20 bg-slate-50 rounded-2xl border-2 {{ $school->logo ? 'border-indigo-100' : 'border-dashed border-slate-200' }} flex items-center justify-center text-slate-400 overflow-hidden shadow-inner">
                            @if($school->logo)
                                <img id="preview-img" src="{{ Storage::disk('public')->url($school->logo) }}" class="w-full h-full object-cover">
                                <span id="preview-placeholder" class="hidden text-2xl">🏫</span>
                            @else
                                <img id="preview-img" class="hidden w-full h-full object-cover">
                                <span id="preview-placeholder" class="text-2xl">🏫</span>
                            @endif
                        </div>
                        <div class="flex-1">
                            <input type="file" name="logo" id="logo-input" accept="image/*"
                                class="block w-full text-xs text-slate-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-[10px] file:font-black file:bg-indigo-50 file:text-indigo-600 hover:file:bg-indigo-100 transition-all cursor-pointer">
                            <p class="text-[9px] text-slate-400 mt-2 uppercase tracking-widest font-bold">REKOMENDASI: Ukuran Persegi (1:1). Max: 2MB.</p>
                        </div>
                    </div>
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">Nama Instansi</label>
                    <input type="text" name="name" required value="{{ old('name', $school->name) }}"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900">
                </div>

                <div class="md:col-span-2">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">Alamat Lengkap</label>
                    <textarea name="address" rows="2" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900 resize-none">{{ old('address', $school->address) }}</textarea>
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">No. Telp Instansi</label>
                    <input type="text" name="phone" value="{{ old('phone', $school->phone) }}"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900">
                </div>

                <div class="md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">Email Instansi</label>
                    <input type="email" name="email" value="{{ old('email', $school->email) }}"
                        class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-medium text-slate-900">
                </div>

                @if(Auth::user()->role === 'superadmin')
                <div class="md:col-span-1">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta">Tipe Langganan</label>
                    <select name="subscription_type" id="subscription_type" class="w-full p-4 bg-slate-50 border border-slate-200 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-bold text-slate-700">
                        <option value="trial" {{ $school->subscription_type === 'trial' ? 'selected' : '' }}>TRIAL (3 Hari)</option>
                        <option value="year" {{ $school->subscription_type === 'year' ? 'selected' : '' }}>1 TAHUN / DURASI</option>
                        <option value="lifetime" {{ $school->subscription_type === 'lifetime' ? 'selected' : '' }}>LIFE TIME (FOREVER)</option>
                    </select>
                </div>

                <div class="md:col-span-1" id="duration_box" style="{{ $school->subscription_type === 'lifetime' ? 'opacity: 0.3; pointer-events: none;' : '' }}">
                    <label class="block text-sm font-bold text-slate-700 mb-2 font-jakarta text-indigo-600">Perpanjang (Bulan)</label>
                    <input type="number" name="subscription_months" value="0" min="0"
                        class="w-full p-4 bg-white border-2 border-indigo-100 rounded-2xl focus:ring-2 focus:ring-indigo-500 outline-none transition font-bold text-indigo-600">
                    <p class="text-[9px] text-slate-400 mt-2 font-black uppercase tracking-widest text-right">ED: {{ $school->subscription_expires_at ? $school->subscription_expires_at->format('d M Y') : 'INFINITY' }}</p>
                </div>

                <div class="md:col-span-2 pt-4">
                    <label class="block text-sm font-bold text-slate-700 mb-4 uppercase tracking-widest text-[10px]">Kontrol Status Akses</label>
                    <div class="flex space-x-4">
                        <label class="flex items-center p-4 bg-slate-50 border border-slate-200 cursor-pointer hover:border-indigo-500 transition flex-1 rounded-2xl border-2 border-transparent has-[:checked]:border-indigo-500 has-[:checked]:bg-indigo-50/30">
                            <input type="radio" name="is_active" value="1" {{ $school->is_active ? 'checked' : '' }} class="hidden">
                            <span class="ml-3 font-bold text-slate-700 uppercase tracking-tighter text-xs">BERIKAN AKSES PENUH</span>
                        </label>
                        <label class="flex items-center p-4 bg-slate-50 border border-slate-200 cursor-pointer hover:border-rose-500 transition flex-1 rounded-2xl border-2 border-transparent has-[:checked]:border-rose-500 has-[:checked]:bg-rose-50/30">
                            <input type="radio" name="is_active" value="0" {{ !$school->is_active ? 'checked' : '' }} class="hidden">
                            <span class="ml-3 font-bold text-slate-700 uppercase tracking-tighter text-xs text-rose-600">BEKUKAN AKSES</span>
                        </label>
                    </div>
                </div>
                @endif
            </div>

            <button type="submit" class="w-full bg-slate-900 text-white p-5 rounded-2xl font-black text-lg hover:bg-slate-800 transition shadow-xl shadow-slate-200 mt-4 uppercase tracking-widest group">
                Simpan Perubahan <span class="group-hover:scale-110 transition-transform inline-block ml-1">💾</span>
            </button>
        </form>
    </div>
</div>

<script>
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

    document.getElementById('logo-input').addEventListener('change', function(e) {
        const reader = new FileReader();
        const placeholder = document.getElementById('preview-placeholder');
        const img = document.getElementById('preview-img');
        const box = document.getElementById('preview-box');

        reader.onload = function(e) {
            img.src = e.target.result;
            img.classList.remove('hidden');
            if(placeholder) placeholder.classList.add('hidden');
            box.classList.remove('border-dashed');
            box.classList.add('border-indigo-100');
        }
        
        if (this.files[0]) {
            reader.readAsDataURL(this.files[0]);
        }
    });
</script>
@endsection
