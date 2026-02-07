<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png?v=3') }}">
    <title>Atur Ulang Sandi - Schola Exambro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .bg-mesh {
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 0% 0%, rgba(59, 130, 246, 0.05) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(147, 51, 234, 0.05) 0px, transparent 50%);
        }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .input-pill {
            background: rgba(241, 245, 249, 0.5);
            border: 1.5px solid transparent;
            border-radius: 100px;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .input-pill:focus-within {
            background: white;
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .btn-blue {
            background: #1d4ed8;
            box-shadow: 0 4px 12px rgba(29, 78, 216, 0.2);
            transition: all 0.3s ease;
        }
        .btn-blue:hover {
            background: #1e40af;
            box-shadow: 0 6px 20px rgba(29, 78, 216, 0.3);
            transform: translateY(-1px);
        }
    </style>
</head>
<body class="bg-mesh min-h-screen flex items-center justify-center p-4">
    <div class="w-full max-w-md">
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 mb-6">
                <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo" class="w-10 h-10">
                <div class="text-left border-l border-slate-200 pl-3">
                    <h2 class="text-base font-black text-slate-800 uppercase tracking-tighter leading-none">Schola <span class="text-blue-600 italic">Exambro</span></h2>
                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Secure Examination System</p>
                </div>
            </a>
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Atur Ulang Kata Sandi</h1>
            <p class="text-xs text-slate-500 font-medium mt-2 leading-relaxed">
                Silakan buat kata sandi baru yang kuat untuk akun Anda.
            </p>
        </div>

        <div class="glass-card rounded-[32px] p-8 shadow-2xl shadow-slate-200/50">
            <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
                @csrf

                <!-- Password Reset Token -->
                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email Address -->
                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Email</label>
                    <div class="input-pill flex items-center p-1 group">
                        <div class="w-9 h-9 flex items-center justify-center bg-white rounded-full shadow-sm mr-3">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email', $request->email) }}" required readonly
                            class="bg-transparent w-full outline-none text-slate-500 font-bold text-sm pr-5 cursor-not-allowed" />
                    </div>
                </div>

                <!-- Password -->
                <div class="space-y-1.5">
                    <label for="password" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Kata Sandi Baru</label>
                    <div class="input-pill flex items-center p-1 group">
                        <div class="w-9 h-9 flex items-center justify-center bg-white rounded-full shadow-sm mr-3">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                        </div>
                        <input type="password" name="password" id="password" required autofocus
                            placeholder="••••••••"
                            class="bg-transparent w-full outline-none text-slate-700 font-bold text-sm placeholder:text-slate-300 pr-5" />
                    </div>
                    @error('password')
                        <p class="text-[10px] text-red-500 font-bold ml-1 uppercase tracking-wider mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="space-y-1.5">
                    <label for="password_confirmation" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Konfirmasi Kata Sandi</label>
                    <div class="input-pill flex items-center p-1 group">
                        <div class="w-9 h-9 flex items-center justify-center bg-white rounded-full shadow-sm mr-3">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <input type="password" name="password_confirmation" id="password_confirmation" required
                            placeholder="••••••••"
                            class="bg-transparent w-full outline-none text-slate-700 font-bold text-sm placeholder:text-slate-300 pr-5" />
                    </div>
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-blue py-4 rounded-full text-white font-black text-xs uppercase tracking-[0.2em] transition-all">
                        Simpan Kata Sandi Baru
                    </button>
                </div>
            </form>
        </div>

        <p class="text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-12">
            Copyright © 2026 <span class="text-blue-500">Schola Exambro</span>
        </p>
    </div>
</body>
</html>
