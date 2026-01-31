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
            <div class="pt-12 pb-8 text-center px-10">
                <div class="relative inline-block mb-6">
                    <div class="absolute -inset-1 bg-gradient-to-r from-primary to-cyan-400 rounded-2xl blur opacity-20"></div>
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="relative w-16 h-16 mx-auto drop-shadow-sm">
                </div>
                <h1 class="text-3xl font-black tracking-[0.25em] text-slate-800 uppercase leading-none">Schola <span class="text-primary italic">CBT</span></h1>
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-[0.3em] mt-4 opacity-70">Admin Control Panel</p>
            </div>

            <!-- Form Section -->
            <div class="px-10 pb-12">
                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <!-- Error Message (Polished) -->
                    @if ($errors->any())
                        <div class="mb-6 p-4 bg-red-50 rounded-2xl border border-red-100 text-red-600 text-[11px] font-bold flex items-center gap-3 animate-pulse">
                            <span>⚠️</span>
                            <span>{{ $errors->first() }}</span>
                        </div>
                    @endif

                    <div class="space-y-5">
                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Email Address</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">📧</span>
                                <input type="email" name="email" value="{{ old('email') }}" required autofocus
                                    placeholder="admin@schola.id"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>

                        <div class="group">
                            <label class="mb-2 ml-1 block font-black text-slate-400 text-[10px] uppercase tracking-widest transition-colors group-focus-within:text-primary">Secret Password</label>
                            <div class="relative">
                                <span class="absolute left-5 top-1/2 -translate-y-1/2 text-slate-400 text-sm">🔒</span>
                                <input type="password" name="password" required
                                    placeholder="••••••••"
                                    class="w-full rounded-2xl border border-slate-100 bg-slate-50 py-4 pl-12 pr-6 font-bold text-slate-700 outline-none transition-all input-focus text-sm" />
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 mb-8 flex items-center justify-between px-1">
                        <label for="remember" class="flex cursor-pointer select-none items-center font-bold text-[11px] text-slate-400 uppercase tracking-tighter hover:text-slate-600 transition-colors">
                            <input type="checkbox" name="remember" id="remember" class="mr-2 h-4 w-4 rounded-lg border-slate-200 text-primary focus:ring-primary" />
                            Keep me logged in
                        </label>
                        <a href="#" class="text-[11px] font-black text-primary uppercase tracking-tighter hover:opacity-70 transition-opacity">Forgot?</a>
                    </div>

                    <button type="submit" class="w-full group relative cursor-pointer rounded-2xl bg-primary py-4 font-black text-white transition-all shadow-xl shadow-indigo-100 hover:shadow-indigo-200 hover:-translate-y-0.5 active:translate-y-0 uppercase tracking-[0.2em] text-xs">
                        <span class="relative z-10">Access Dashboard</span>
                        <div class="absolute inset-0 bg-white/10 opacity-0 group-hover:opacity-100 transition-opacity rounded-2xl"></div>
                    </button>

                    <div class="mt-8 text-center">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-loose">
                            Belum memiliki akun instansi?
                        </p>
                        <a href="{{ route('register') }}" class="inline-block mt-2 text-[11px] font-black text-primary uppercase tracking-[0.1em] border-b-2 border-primary/20 hover:border-primary transition-all pb-0.5">
                            Daftar & Mulai Trial Sekarang
                        </a>
                    </div>
                </form>

                <div class="text-center mt-10">
                    <p class="text-[9px] text-slate-300 font-black uppercase tracking-[0.3em]">
                        Developed with Excellence by <span class="text-slate-400">codifi.id</span>
                    </p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
