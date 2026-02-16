<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan | Schola Exambro</title>
    <link rel="shortcut icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0, 0, 0, 0.05);
        }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 min-h-screen antialiased">

    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-header h-20 flex items-center">
        <div class="max-w-4xl mx-auto w-full px-6 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-lg tracking-tighter uppercase">Schola <span class="text-emerald-600">Exambro</span></span>
            </a>
            <a href="/" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 pt-32 pb-24 text-center">
        <div class="mb-16">
            <h1 class="text-4xl md:text-6xl font-black text-slate-900 mb-6 tracking-tight uppercase">Pusat <span class="text-emerald-600">Bantuan</span></h1>
            <p class="text-slate-500 font-medium max-w-xl mx-auto text-base md:text-lg italic leading-relaxed">
                Kami siap membantu Anda mengelola ujian digital yang aman dan profesional.
            </p>
        </div>

        <div class="grid md:grid-cols-2 gap-8 text-left">
            <!-- FAQ Card 1 -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-500">
                <div class="w-14 h-14 bg-emerald-50 text-emerald-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-4 uppercase tracking-tight italic leading-tight">Cara Mulai Langganan?</h3>
                <p class="text-slate-500 text-sm md:text-base font-medium leading-relaxed">
                    Daftarkan akun admin instansi Anda, pilih paket masa aktif yang sesuai, lalu lakukan pembayaran via QRIS atau Transfer Bank. Fitur premium akan langsung aktif secara otomatis.
                </p>
            </div>

            <!-- FAQ Card 2 -->
            <div class="bg-white p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-500">
                <div class="w-14 h-14 bg-indigo-50 text-indigo-600 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                </div>
                <h3 class="text-xl font-black text-slate-900 mb-4 uppercase tracking-tight italic leading-tight">Keamanan Data Ujian?</h3>
                <p class="text-slate-500 text-sm md:text-base font-medium leading-relaxed">
                    Semua soal dan data peserta disimpan di server cloud terlindungi oleh <strong>PT. CIPTA INOVASI DIGITAL</strong>. Kami menggunakan enkripsi SSL untuk menjamin kerahasiaan data instansi Anda.
                </p>
            </div>
        </div>

        <section class="mt-24 pt-16 border-t border-slate-200">
            <h2 class="text-2xl font-black text-slate-900 mb-8 uppercase tracking-tighter">Masih Butuh Bantuan Teknis?</h2>
            <div class="flex flex-col sm:flex-row justify-center gap-4">
                <a href="https://wa.me/628218144726" target="_blank" class="px-10 py-5 bg-slate-900 text-white rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-black transition-all shadow-xl shadow-slate-900/20">
                    Kirim WhatsApp
                </a>
                <a href="mailto:support@codifi.id" class="px-10 py-5 bg-white border border-slate-200 text-slate-900 rounded-[2rem] font-black text-[11px] uppercase tracking-[0.2em] hover:bg-slate-50 transition-all shadow-sm">
                    Kirim Email
                </a>
            </div>
        </section>

        <footer class="mt-32 pt-12 border-t border-slate-100">
            <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest">
                &copy; 2026 PT. CIPTA INOVASI DIGITAL. Seluruh hak cipta dilindungi undang-undang.
            </p>
        </footer>
    </main>
</body>
</html>
