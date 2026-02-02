<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lengkapi Profil | Schola CBT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            background: #03001C;
        }
        .bg-login {
            background-image: url("{{ asset('assets/images/login-bg.png') }}");
            background-size: cover;
            background-position: center;
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.03);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        .input-glass {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: white;
            transition: all 0.3s ease;
        }
        .input-glass:focus {
            background: rgba(255, 255, 255, 0.08);
            border-color: #3C50E0;
            box-shadow: 0 0 20px rgba(60, 80, 224, 0.2);
        }
        .btn-gradient {
            background: linear-gradient(135deg, #3C50E0 0%, #00ADB5 100%);
            box-shadow: 0 10px 25px -5px rgba(60, 80, 224, 0.4);
        }
    </style>
</head>
<body class="bg-login text-white overflow-hidden">
    <!-- Overlay -->
    <div class="absolute inset-0 bg-slate-950/60"></div>

    <div class="relative flex items-center justify-center min-h-screen p-4 z-10">
        
        <div class="w-full max-w-[480px] rounded-[2.5rem] glass-card shadow-2xl overflow-hidden p-1">
            <div class="bg-slate-900/40 rounded-[2.2rem]">
                <!-- Progress Indicator -->
                <div class="h-1.5 w-full bg-white/5 overflow-hidden">
                    <div class="h-full bg-gradient-to-r from-blue-500 to-cyan-400 w-2/3 shadow-[0_0_10px_rgba(60,80,224,0.5)]"></div>
                </div>

                <!-- Header Section -->
                <div class="pt-10 pb-6 text-center px-10">
                    <div class="w-16 h-16 bg-blue-500/10 rounded-2xl flex items-center justify-center text-2xl mx-auto mb-6 border border-white/5">🏢</div>
                    <h1 class="text-2xl font-black text-white uppercase tracking-tight">Setup Profil Instansi</h1>
                    <p class="text-xs text-slate-400 font-bold mt-3 leading-relaxed opacity-70">
                        Langkah terakhir! Atur identitas sekolah dan buat password keamanan Anda.
                    </p>
                </div>

                <!-- Form Section -->
                <div class="px-10 pb-12">
                    <form method="POST" action="{{ route('auth.onboarding.store') }}">
                        @csrf
                        
                        @if ($errors->any())
                            <div class="mb-6 p-4 bg-red-500/10 rounded-2xl border border-red-500/20 text-red-400 text-[10px] font-bold">
                                <ul class="list-disc list-inside space-y-1">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="space-y-5">
                            <div class="group">
                                <label class="mb-2 ml-1 block font-bold text-slate-500 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-blue-400">Nama Sekolah</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                                    </span>
                                    <input type="text" name="school_name" value="{{ old('school_name') }}" required autofocus
                                        placeholder="Contoh: SMA Negeri 1 Jakarta"
                                        class="w-full rounded-2xl input-glass py-4 pl-14 pr-6 font-semibold outline-none text-sm placeholder:text-slate-600" />
                                </div>
                            </div>

                            <div class="group">
                                <label class="mb-2 ml-1 block font-bold text-slate-500 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-blue-400">Buat Password Admin</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                                    </span>
                                    <input type="password" name="password" required
                                        placeholder="Minimal 8 karakter"
                                        class="w-full rounded-2xl input-glass py-4 pl-14 pr-6 font-semibold outline-none text-sm placeholder:text-slate-600" />
                                </div>
                            </div>

                            <div class="group">
                                <label class="mb-2 ml-1 block font-bold text-slate-500 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-blue-400">Konfirmasi Password</label>
                                <div class="relative">
                                    <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-500">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                                    </span>
                                    <input type="password" name="password_confirmation" required
                                        placeholder="Ulangi password"
                                        class="w-full rounded-2xl input-glass py-4 pl-14 pr-6 font-semibold outline-none text-sm placeholder:text-slate-600" />
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="w-full btn-gradient py-5 mt-10 rounded-2xl font-black text-white uppercase tracking-[0.3em] text-[10px] hover:scale-[1.01] active:scale-[0.99] transition-all">
                            Selesaikan & Masuk Dashboard
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
