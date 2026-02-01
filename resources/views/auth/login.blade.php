<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Schola CBT</title>
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
<body class="bg-gradient text-slate-900 overflow-hidden">
    <div class="flex items-center justify-center h-screen p-4">
        
        <div class="w-full max-w-[440px] rounded-[2rem] bg-white shadow-premium overflow-hidden border border-white">
            <!-- Header Section (Clean & Integrated) -->
            <div class="pt-8 pb-4 text-center px-10">
                <div class="relative inline-block mb-4">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-cyan-400 rounded-2xl blur opacity-20"></div>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="relative w-14 h-14 mx-auto drop-shadow-sm">
                </div>
                <h1 class="text-2xl font-black tracking-[0.25em] text-slate-800 uppercase leading-none">Schola <span class="text-primary italic">CBT</span></h1>
                <p class="text-[9px] text-slate-400 font-black uppercase tracking-[0.3em] mt-3 opacity-70">Admin Control Panel</p>
            </div>

            <!-- Form Section -->
            <div class="px-10 pb-8">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Error Message (Polished) -->
                    @if ($errors->any())
                        <div class="mb-4 p-3 bg-red-50 rounded-2xl border border-red-100 text-red-600 text-[10px] font-bold flex items-center gap-3 animate-pulse">
                            <span>⚠️</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="space-y-3">
                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Email Address</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">📧</span>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="admin@schola.id"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-3.5 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>

                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Secret Password</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔒</span>
                                <input type="password" name="password" required
                                    placeholder="••••••••"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-3.5 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 mb-6 flex items-center justify-between px-1">
                        <label for="remember" class="flex cursor-pointer select-none items-center font-bold text-[11px] text-slate-400 uppercase tracking-tighter hover:text-slate-600 transition-colors">
                            <input type="checkbox" name="remember" id="remember" class="mr-2 h-4 w-4 rounded-lg border-slate-200 text-primary focus:ring-primary" />
                            Keep me logged in
                        </label>
                        <a href="#" class="text-[11px] font-black text-primary uppercase tracking-tighter hover:opacity-70 transition-opacity">Forgot?</a>
                    </div>

                    <button type="submit" class="w-full group relative cursor-pointer rounded-2xl bg-primary py-3.5 font-black text-white transition-all shadow-xl shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 active:translate-y-0 uppercase tracking-[0.2em] text-xs">
                        <span class="relative z-10">Access Dashboard</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
                    </button>

                    <!-- Google Authentication Option -->
                    <div class="relative my-6">
                        <div class="absolute inset-0 flex items-center">
                            <span class="w-full border-t border-slate-100"></span>
                        </div>
                        <div class="relative flex justify-center text-[10px] uppercase font-black text-slate-300 tracking-widest leading-none">
                            <span class="bg-white px-4">Instant Access</span>
                        </div>
                    </div>

                    <a href="{{ route('google.login') }}" class="w-full group flex items-center justify-center gap-3 rounded-2xl border-2 border-slate-100 bg-white py-3.5 px-6 transition-all hover:bg-slate-50 hover:border-slate-200 active:scale-[0.98] shadow-sm">
                        <svg class="h-5 w-5" viewBox="0 0 24 24">
                            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                        </svg>
                        <span class="text-xs font-black text-slate-700 uppercase tracking-widest">Sign in with Google</span>
                    </a>

                    <div class="mt-6 text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-loose">
                            Belum memiliki akun instansi?
                        </p>
                        <a href="{{ route('register') }}" class="inline-block mt-1 text-[11px] font-black text-primary uppercase tracking-[0.1em] border-b-2 border-primary/20 hover:border-primary transition-all pb-0.5">
                            Daftar & Mulai Trial Sekarang
                        </a>
                    </div>
                </form>

                <div class="text-center mt-6">
                    <p class="text-[9px] text-slate-200 font-black uppercase tracking-[0.3em]">
                        Developed with Excellence by <span class="text-slate-300">codifi.id</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
