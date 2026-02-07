<!DOCTYPE html>
<html lang="id" class="light">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png?v=3') }}">
    <title>Lupa Sandi - Schola Exambro</title>
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
            <h1 class="text-2xl font-bold text-slate-900 tracking-tight">Lupa Kata Sandi?</h1>
            <p class="text-xs text-slate-500 font-medium mt-2 leading-relaxed">
                Jangan khawatir! Masukkan alamat email Anda dan kami akan mengirimkan tautan untuk mengatur ulang kata sandi Anda.
            </p>
        </div>

        <div class="glass-card rounded-[32px] p-8 shadow-2xl shadow-slate-200/50">
            @if (session('status'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl">
                    <p class="text-[11px] font-bold text-emerald-600 uppercase tracking-wider text-center">
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            <form method="POST" action="{{ route('password.email') }}" class="space-y-4">
                @csrf

                <div class="space-y-1.5">
                    <label for="email" class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] ml-1">Alamat Email</label>
                    <div class="input-pill flex items-center p-1 group">
                        <div class="w-9 h-9 flex items-center justify-center bg-white rounded-full shadow-sm mr-3">
                            <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207" />
                            </svg>
                        </div>
                        <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                            placeholder="nama@sekolah.sch.id"
                            class="bg-transparent w-full outline-none text-slate-700 font-bold text-sm placeholder:text-slate-300 pr-5" />
                    </div>
                    @error('email')
                        <p class="text-[10px] text-red-500 font-bold ml-1 uppercase tracking-wider mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="pt-4">
                    <button type="submit" class="w-full btn-blue py-4 rounded-full text-white font-black text-xs uppercase tracking-[0.2em] transition-all">
                        Kirim Tautan Atur Ulang
                    </button>
                </div>
            </form>

            <div class="text-center mt-8">
                <a href="{{ route('login') }}" class="text-[10px] font-black text-slate-400 hover:text-blue-600 uppercase tracking-[0.2em] transition-colors flex items-center justify-center gap-2">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Kembali ke Login
                </a>
            </div>
        </div>

        <p class="text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-12">
            Copyright © 2026 <span class="text-blue-500">Schola Exambro</span>
        </p>
    </div>
</body>
</html>
