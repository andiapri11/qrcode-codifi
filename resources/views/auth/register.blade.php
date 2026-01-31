<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi Instansi | Schola CBT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 antialiased min-h-screen flex items-center justify-center p-6">
    
    <div class="max-w-4xl w-full bg-white rounded-[3rem] shadow-2xl shadow-slate-200 overflow-hidden flex flex-col md:flex-row border border-slate-100">
        <!-- Left Side: Promo/Info -->
        <div class="md:w-5/12 bg-indigo-600 p-12 text-white flex flex-col justify-between relative overflow-hidden">
            <div class="relative z-10">
                <div class="flex items-center gap-3 mb-10">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-12 h-12 brightness-0 invert">
                    <span class="text-2xl font-black tracking-tighter uppercase">Schola <span class="text-indigo-200 underline">CBT</span></span>
                </div>
                
                <h1 class="text-4xl font-extrabold leading-tight mb-6">Mulai Ujian Aman Hari Ini.</h1>
                <p class="text-indigo-100 text-sm font-medium leading-loose mb-10">Daftarkan instansi Anda dan nikmati fitur CBT premium dengan sistem pengamanan Barcode terenkripsi secara gratis.</p>
                
                <div class="space-y-4">
                    <div class="flex items-center gap-4 bg-white/10 p-4 rounded-2xl border border-white/5 backdrop-blur-sm">
                        <span class="text-xl">🛡️</span>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-indigo-200">Security Suite</p>
                            <p class="text-[11px] font-bold">Secure Browser Integration</p>
                        </div>
                    </div>
                    <div class="flex items-center gap-4 bg-white/10 p-4 rounded-2xl border border-white/5 backdrop-blur-sm">
                        <span class="text-xl">🎁</span>
                        <div>
                            <p class="text-xs font-black uppercase tracking-widest text-indigo-200">New User Offer</p>
                            <p class="text-[11px] font-bold">Free 2-Day Trial Premium</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 relative z-10">
                <p class="text-[10px] font-black text-indigo-300 uppercase tracking-widest">Powered by Schola Tech Ecosystem</p>
            </div>

            <!-- Decoration -->
            <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-white/5 rounded-full"></div>
            <div class="absolute -left-10 top-20 w-32 h-32 bg-indigo-500/30 rounded-full blur-3xl"></div>
        </div>

        <!-- Right Side: Form -->
        <div class="flex-1 p-12 md:p-16">
            <div class="mb-10">
                <h2 class="text-2xl font-black text-slate-900 uppercase tracking-tight">Registrasi Baru</h2>
                <p class="text-xs text-slate-400 font-bold uppercase tracking-widest mt-1">Lengkapi data untuk membuat akun admin instansi.</p>
            </div>

            <form method="POST" action="{{ route('register') }}" class="space-y-5">
                @csrf

                <!-- Grid for split fields -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Personal Name -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Lengkap Admin</label>
                        <input type="text" name="name" :value="old('name')" required autofocus placeholder="Contoh: Budi Santoso" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Alamat Email</label>
                        <input type="email" name="email" :value="old('email')" required placeholder="admin@instansi.com" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- School / Institution Name -->
                <div>
                    <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Nama Instansi / Sekolah</label>
                    <input type="text" name="school_name" :value="old('school_name')" required placeholder="Contoh: SMA Negeri 01 Jakarta" class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    <x-input-error :messages="$errors->get('school_name')" class="mt-2" />
                </div>



                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                    <!-- Password -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Kata Sandi</label>
                        <input type="password" name="password" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <label class="block text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2 ml-1">Konfirmasi Sandi</label>
                        <input type="password" name="password_confirmation" required class="w-full bg-slate-50 border border-slate-200 rounded-2xl py-4 px-6 text-xs font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-600 transition shadow-inner">
                    </div>
                </div>

                <div class="flex flex-col gap-4 mt-8">
                    <button type="submit" class="w-full bg-indigo-600 text-white rounded-2xl py-5 font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-[0.98]">
                        Daftar & Mulai Trial Gratis
                    </button>
                    
                    <div class="text-center">
                        <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 uppercase tracking-widest hover:text-indigo-600 transition-colors">
                            Sudah punya akun? <span class="text-indigo-600 underline">Masuk Sekarang</span>
                        </a>
                    </div>
                </div>
            </form>
        </div>
    </div>

</body>
</html>
