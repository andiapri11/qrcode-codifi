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
<body class="bg-white text-slate-900 antialiased overflow-hidden">
    <!-- Subtle Background Decoration -->
    <div class="fixed inset-0 pointer-events-none">
        <div class="absolute top-[-10%] right-[-10%] w-[40%] h-[40%] bg-blue-50/50 rounded-full blur-[100px]"></div>
        <div class="absolute bottom-[-10%] left-[-10%] w-[40%] h-[40%] bg-slate-50 rounded-full blur-[100px]"></div>
    </div>

    <div class="h-screen w-full flex items-center justify-center p-6 relative z-10">
        <div class="max-w-3xl w-full flex flex-col items-center justify-center">
            <!-- Illustration - Scaled Down -->
            <div class="mb-2 transform hover:scale-[1.02] transition-transform duration-700">
                <img src="{{ asset('assets/images/404-illustration.png') }}" alt="404 Tersesat" class="w-full max-w-[280px] md:max-w-[320px] h-auto drop-shadow-[0_15px_35px_rgba(0,0,0,0.08)]">
            </div>

            <!-- 404 Text -->
            <h1 class="text-6xl md:text-8xl font-black text-gradient tracking-tighter leading-none mb-2">404</h1>

            <!-- Content Area -->
            <div class="space-y-4 text-center">
                <div class="space-y-1">
                    <h2 class="text-lg md:text-xl font-black text-slate-800 tracking-tight uppercase leading-tight">
                        Sepertinya Anda Sedang Tersesat...
                    </h2>
                    <p class="text-slate-400 font-bold text-[10px] md:text-xs leading-relaxed max-w-sm mx-auto uppercase tracking-[0.1em] opacity-80">
                        Tenang, jangan panik. Halaman yang Anda cari mungkin sedang bersembunyi atau sudah pindah ke alamat baru. Mari kami bantu Anda menemukan jalan pulang.
                    </p>
                </div>

                <!-- Action Button -->
                <div class="pt-2 flex justify-center">
                    <a href="{{ url('/') }}" class="inline-flex items-center gap-3 bg-white border border-slate-200 px-8 py-3.5 rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:bg-slate-50 transition-all shadow-sm active:scale-95 group">
                        <svg class="w-4 h-4 text-slate-300 group-hover:text-indigo-500 transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6" />
                        </svg>
                        Kembali ke Beranda
                    </a>
                </div>
            </div>

            <!-- Footer - Fixed at bottom of the main container -->
            <div class="mt-12 text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">
                &copy; {{ date('Y') }} Codifi. Hak Cipta Dilindungi.
            </div>
        </div>
    </div>
</body>
</html>
