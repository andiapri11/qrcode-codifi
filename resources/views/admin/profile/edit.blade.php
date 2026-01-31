@extends('layouts.admin')

@section('content')
<div class="max-w-2xl mx-auto">
    <div class="mb-8">
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight uppercase">Pengaturan Profil</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Perbarui informasi akun dan kata sandi Anda</p>
    </div>

    @if(session('success'))
    <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-600 text-xs font-bold flex items-center gap-3">
        <span>✅</span>
        {{ session('success') }}
    </div>
    @endif

    <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden p-10">
        <form action="{{ route('profile.update') }}" method="POST" class="space-y-6">
            @csrf
            @method('PUT')

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Nama Lengkap</label>
                <input type="text" name="name" value="{{ old('name', $user->name) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <div>
                <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3 ml-1">Alamat Email</label>
                <input type="email" name="email" value="{{ old('email', $user->email) }}" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="pt-6 border-t border-slate-100">
                <h3 class="text-[10px] font-black text-slate-900 uppercase tracking-widest mb-6">Ubah Kata Sandi (Kosongkan jika tidak ingin diubah)</h3>
                
                <div class="space-y-5">
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi Baru</label>
                        <input type="password" name="password" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Konfirmasi Kata Sandi</label>
                        <input type="password" name="password_confirmation" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    </div>
                </div>
            </div>

            <div class="pt-8">
                <button type="submit" class="w-full bg-indigo-600 text-white rounded-2xl py-5 font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-[0.98]">
                    Simpan Perubahan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
