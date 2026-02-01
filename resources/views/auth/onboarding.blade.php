<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil | Schola CBT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Satoshi:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Satoshi', sans-serif; }
        .bg-gradient { background: radial-gradient(circle at top left, #F8FAFC, #E2E8F0); }
        .shadow-premium { box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.08); }
        .text-primary { color: #3C50E0; }
        .bg-primary { background-color: #3C50E0; }
        .input-focus:focus { border-color: #3C50E0; box-shadow: 0 0 0 4px rgba(60, 80, 224, 0.1); }
    </style>
</head>
<body class="bg-gradient text-slate-900">
    <div class="flex items-center justify-center min-h-screen p-4">
        
        <div class="w-full max-w-[480px] rounded-[2.5rem] bg-white shadow-premium overflow-hidden border border-white">
            <!-- Progress Bar -->
            <div class="h-1.5 w-full bg-slate-100 italic">
                <div class="h-full bg-primary w-2/3"></div>
            </div>

            <!-- Header Section -->
            <div class="pt-10 pb-6 text-center px-10">
                <div class="w-16 h-16 bg-indigo-50 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-6">🏢</div>
                <h1 class="text-2xl font-black text-slate-800 uppercase tracking-tight">Lengkapi Profil</h1>
                <p class="text-xs text-slate-400 font-medium mt-2 leading-relaxed">
                    Sedikit lagi! Masukkan nama instansi dan buat password baru untuk keamanan akun Anda.
                </p>
            </div>

            <!-- Form Section -->
            <div class="px-10 pb-10">
                <form method="POST" action="{{ route('auth.onboarding.store') }}">
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 rounded-2xl border border-red-100 text-red-600 text-[11px] font-bold flex items-center gap-3">
                            <span>⚠️</span>
                            <ul class="list-disc list-inside">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="space-y-4">
                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Nama Instansi / Sekolah</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🏛️</span>
                                <input type="text" name="school_name" value="{{ old('school_name') }}" required autofocus
                                    placeholder="Contoh: SMA Negeri 1 Jakarta"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>

                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Buat Password Baru</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔒</span>
                                <input type="password" name="password" required
                                    placeholder="Minimal 8 karakter"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>

                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Konfirmasi Password</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔑</span>
                                <input type="password" name="password_confirmation" required
                                    placeholder="Ulangi password"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="w-full group relative cursor-pointer rounded-2xl bg-primary py-4 mt-8 font-black text-white transition-all shadow-xl shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 active:translate-y-0 uppercase tracking-[0.2em] text-xs">
                        <span class="relative z-10">Simpan & Masuk Dashboard</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
                    </button>
                    
                    <p class="mt-6 text-center text-[9px] text-slate-400 font-medium uppercase tracking-widest">
                        Data ini digunakan untuk identitas sertifikat dan laporan ujian Anda.
                    </p>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
