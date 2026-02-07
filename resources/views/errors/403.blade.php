<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png?v=3') }}">
    <title>403 - Akses Dilarang | Schola Exambro</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
    </style>
</head>
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex items-center justify-center p-6">
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-rose-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[10%] -right-[5%] w-[30%] h-[30%] bg-amber-500/5 rounded-full blur-[100px]"></div>
    </div>

    <div class="max-w-md w-full text-center">
        <div class="glass-card rounded-[3rem] p-12 shadow-2xl border border-rose-100/50">
            <div class="w-24 h-24 bg-rose-50 rounded-[2rem] flex items-center justify-center mx-auto mb-8 shadow-inner">
                <svg class="w-12 h-12 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                </svg>
            </div>
            
            <h1 class="text-6xl font-black text-slate-900 mb-4 tracking-tighter italic">403</h1>
            <h2 class="text-xl font-extrabold text-slate-800 uppercase tracking-widest mb-4">Akses Dilarang</h2>
            <p class="text-slate-500 text-sm font-medium leading-relaxed mb-10 opacity-80">Maaf, Anda tidak memiliki izin untuk mengakses halaman atau folder ini. Area ini dilindungi oleh sistem keamanan Schola.</p>
            
            <a href="/" class="block w-full py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:bg-black transition-all shadow-xl shadow-slate-900/20 active:scale-95">
                Kembali ke Beranda
            </a>
        </div>
        
        <p class="mt-12 text-[10px] font-black text-slate-400 uppercase tracking-[0.3em]">
            &copy; 2026 CODIFI.ID - Secure Protection System
        </p>
    </div>
</body>
</html>
