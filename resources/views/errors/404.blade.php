<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Halaman Tidak Ditemukan | Codifi</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">

    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
        }
        .text-gradient {
            background: linear-gradient(135deg, #94a3b8 0%, #475569 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>
<body class="bg-slate-50/50 min-h-screen flex items-center justify-center p-6 text-slate-900">
    <div class="max-w-2xl w-full text-center">
        <!-- Illustration -->
        <div class="mb-8 flex justify-center">
            <img src="{{ asset('assets/images/404-illustration.png') }}" alt="404 Tersesat" class="w-full max-w-[400px] h-auto drop-shadow-2xl">
        </div>

        <!-- 404 Text -->
        <h1 class="text-8xl md:text-9xl font-black text-gradient tracking-tighter mb-4">404</h1>

        <!-- Content -->
        <div class="space-y-4 px-4">
            <h2 class="text-2xl md:text-3xl font-black text-slate-800 tracking-tight uppercase">
                Sepertinya Anda Sedang Tersesat...
            </h2>
            <p class="text-slate-400 font-medium text-sm md:text-base leading-relaxed max-w-lg mx-auto uppercase tracking-wide">
                Tenang, jangan panik. Halaman yang Anda cari mungkin sedang bersembunyi atau sudah pindah ke alamat baru. Mari kami bantu Anda menemukan jalan pulang.
            </p>
        </div>

        <!-- Action -->
        <div class="mt-10">
            <a href="{{ url('/') }}" class="inline-flex items-center gap-3 bg-white border border-slate-200 px-8 py-4 rounded-2xl text-[11px] font-black uppercase tracking-[0.2em] text-slate-600 hover:bg-slate-50 hover:border-slate-300 transition-all shadow-xl shadow-slate-200/50 group">
                <svg class="w-4 h-4 text-slate-400 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                </svg>
                Kembali ke Beranda
            </a>
        </div>

        <!-- Footer -->
        <div class="mt-16 text-[10px] font-bold text-slate-300 uppercase tracking-[0.3em]">
            &copy; {{ date('Y') }} Codifi. Hak Cipta Dilindungi.
        </div>
    </div>
</body>
</html>
