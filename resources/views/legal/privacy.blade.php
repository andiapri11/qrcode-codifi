<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi | Schola Exambro</title>
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
<body class="bg-slate-50 text-slate-900 min-h-screen antialiased transition-colors duration-300">

    <!-- Simple Navigation -->
    <nav class="fixed top-0 w-full z-50 glass-header h-20 flex items-center">
        <div class="max-w-4xl mx-auto w-full px-6 flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-lg tracking-tighter uppercase">Schola <span class="text-emerald-600">Exambro</span></span>
            </a>
            <a href="/" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-slate-900 transition-colors">Kembali ke Beranda</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 pt-32 pb-24">
        <div class="bg-white rounded-[2.5rem] p-8 md:p-16 border border-slate-200 shadow-sm">
            <h1 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 tracking-tight uppercase">Kebijakan <span class="text-emerald-600">Privasi</span></h1>
            <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mb-12">Terakhir Diperbarui: 14 Februari 2026</p>

            <div class="space-y-12">
                <p class="text-slate-600 leading-relaxed font-medium text-sm md:text-base">
                    Selamat datang di <strong>Schola Exambro</strong>. Kami di <strong>PT. CIPTA INOVASI DIGITAL</strong> berkomitmen penuh untuk melindungi privasi data Anda. Kebijakan ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda dengan standar keamanan tinggi.
                </p>

                <section>
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight italic">1. Informasi yang Dikumpulkan</h2>
                    <ul class="space-y-4">
                        <li class="flex gap-4">
                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-xs font-sans">1</span>
                            <p class="text-slate-600 text-sm md:text-base"><strong>Informasi Admin:</strong> Nama, alamat email, dan nomor telepon yang Anda berikan saat pendaftaran instansi.</p>
                        </li>
                        <li class="flex gap-4">
                            <span class="w-6 h-6 rounded-full bg-emerald-50 text-emerald-600 flex items-center justify-center shrink-0 font-bold text-xs font-sans">2</span>
                            <p class="text-slate-600 text-sm md:text-base"><strong>Informasi Perangkat:</strong> Data teknis seperti model perangkat dan ID unik demi keamanan validasi sesi ujian.</p>
                        </li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight italic">2. Penggunaan Izin Perangkat</h2>
                    <p class="text-slate-600 leading-relaxed font-medium text-sm md:text-base mb-6">
                        Aplikasi Schola Exambro memerlukan izin khusus untuk menjalankan fungsi lockdown browser:
                    </p>
                    <ul class="space-y-4 pl-10 list-disc text-slate-600 text-sm md:text-base">
                        <li><strong>Kamera:</strong> Digunakan secara eksklusif untuk pemindaian QR Code Link Ujian.</li>
                        <li><strong>Lockdown Browser:</strong> Memerlukan hak akses sistem untuk mencegah penggunaan aplikasi lain selama ujian berlangsung.</li>
                    </ul>
                </section>

                <section>
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight italic">3. Keamanan Data</h2>
                    <p class="text-slate-600 leading-relaxed font-medium text-sm md:text-base">
                        Semua data Anda ditransmisikan melalui protokol aman SSL/TLS dan disimpan di server cloud terlindungi. Kami menjamin bahwa <strong>PT. CIPTA INOVASI DIGITAL tidak akan pernah menjual atau membagikan data Anda</strong> kepada pihak ketiga untuk kepentingan iklan.
                    </p>
                </section>

                <section>
                    <h2 class="text-xl font-black text-slate-900 mb-6 uppercase tracking-tight italic">4. Kontak & Dukungan</h2>
                    <div class="bg-slate-50 rounded-[2rem] p-8 border border-slate-100">
                        <p class="text-slate-900 font-black uppercase text-sm mb-4">PT. CIPTA INOVASI DIGITAL</p>
                        <div class="space-y-2">
                            <p class="text-slate-500 text-[13px] font-medium leading-relaxed italic">Email: support@codifi.id</p>
                            <p class="text-slate-500 text-[13px] font-medium leading-relaxed">WhatsApp: +62 857-6844-1485</p>
                            <p class="text-slate-500 text-[13px] font-medium leading-relaxed leading-tight text-xs mt-2 opacity-60">Sumatera Selatan, Indonesia</p>
                        </div>
                    </div>
                </section>
            </div>

            <div class="mt-20 pt-12 border-t border-slate-100">
                <p class="text-[10px] text-slate-400 font-black uppercase tracking-widest text-center">
                    &copy; 2026 PT. CIPTA INOVASI DIGITAL. Seluruh hak cipta dilindungi undang-undang.
                </p>
            </div>
        </div>
    </main>
</body>
</html>
