@extends('layouts.admin')

@section('content')
<div class="max-w-4xl mx-auto px-4">
    <div class="bg-gradient-to-b from-white to-slate-50/20 rounded-[2.5rem] shadow-sm border border-slate-200 overflow-hidden">
        <!-- Compact Header -->
        <div class="px-8 py-8 border-b border-slate-100 flex justify-between items-center bg-white">
            <div class="flex items-center gap-5">
                <div class="w-12 h-12 bg-indigo-50 rounded-2xl flex items-center justify-center text-indigo-500 shadow-inner shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                </div>
                <div>
                    <h2 class="text-lg font-black text-slate-900 tracking-tight uppercase">Profil Instansi</h2>
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
                <div class="col-span-12 lg:col-span-4">
                    <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Logo Instansi</label>
                    @php
                        $isTrial = $school->subscription_type === 'trial';
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
                                    <p class="text-[8px] text-slate-300 mt-0.5 uppercase tracking-tight">PNG, JPG (MAX 2MB)</p>
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

                <!-- Right Side: Contact Information -->
                <div class="col-span-12 lg:col-span-8">
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <div class="sm:col-span-2">
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

            <!-- SuperAdmin Settings (Only visible to Superadmin) -->
            @if(Auth::user()->role === 'superadmin')
            <div class="mt-12 pt-10 border-t border-slate-100">
                <div class="flex items-center gap-3 mb-6">
                    <span class="w-7 h-7 bg-slate-900 text-white rounded-lg flex items-center justify-center text-[10px] font-black">⚙️</span>
                    <h3 class="text-xs font-black text-slate-900 uppercase tracking-tight">Administratif</h3>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2.5 ml-1">Tipe Langganan</label>
                        <select name="subscription_type" id="subscription_type" class="w-full bg-slate-50 border border-slate-200 py-3 px-5 rounded-xl font-bold text-slate-700 text-xs outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="trial" {{ $school->subscription_type === 'trial' ? 'selected' : '' }}>TRIAL (3 Hari)</option>
                            <option value="year" {{ $school->subscription_type === 'year' ? 'selected' : '' }}>1 TAHUN</option>
                            <option value="lifetime" {{ $school->subscription_type === 'lifetime' ? 'selected' : '' }}>LIFE TIME</option>
                        </select>
                    </div>

                    <div id="duration_box" style="{{ $school->subscription_type === 'lifetime' ? 'opacity: 0.3; pointer-events: none;' : '' }}">
                        <label class="block text-[9px] font-black text-indigo-600 uppercase tracking-[0.2em] mb-2.5 ml-1">Perpanjang (Bulan)</label>
                        <input type="number" name="subscription_months" value="0" min="0"
                            class="w-full bg-white border-2 border-indigo-100 py-3 px-5 rounded-xl font-black text-indigo-600 text-xs outline-none focus:ring-4 focus:ring-indigo-500/20">
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
