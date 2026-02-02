<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Syarat & Ketentuan | Schola CBT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass-header {
            background: rgba(15, 23, 42, 0.82);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .prose h2 { @apply text-2xl font-bold mt-10 mb-4 text-slate-800 dark:text-blue-400; }
        .prose p { @apply text-slate-600 dark:text-slate-400 leading-relaxed mb-6; }
    </style>
</head>
<body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-300">

    <header class="sticky top-0 z-50 glass-header px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="{{ route('login') }}" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-lg tracking-tighter">Schola <span class="text-blue-600 italic">CBT</span></span>
            </a>
            <button onclick="toggleDarkMode()" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-full">
                <svg id="moonIcon" class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="sunIcon" class="w-5 h-5 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-16 prose">
        <h1 class="text-4xl md:text-5xl font-black mb-10 tracking-tight">Syarat & <span class="text-blue-600">Ketentuan</span></h1>
        
        <p class="text-slate-400 text-sm italic mb-10">Terakhir diperbarui: 2 Februari 2026</p>

        <section>
            <h2>1. Penerimaan Ketentuan</h2>
            <p>Dengan mengakses dan menggunakan layanan Schola CBT, Anda setuju untuk terikat oleh syarat dan ketentuan ini. Jika Anda tidak setuju, harap jangan melanjutkan penggunaan layanan kami.</p>
            
            <h2>2. Pendaftaran Akun</h2>
            <p>Pengguna wajib memberikan informasi yang akurat dan lengkap saat pendaftaran. Keamanan kata sandi adalah tanggung jawab penuh masing-masing instansi pengguna.</p>

            <h2>3. Penggunaan Layanan</h2>
            <p>Schola CBT dilarang digunakan untuk kegiatan ilegal, penipuan, atau tindakan yang dapat merusak integritas sistem ujian digital.</p>

            <h2>4. Pembatalan & Pengembalian Dana</h2>
            <p>Kebijakan langganan bersifat final. Instansi yang ingin berhenti dapat membatalkan langganan sebelum periode berikutnya dimulai.</p>
        </section>

        <div class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-900 flex justify-between items-center">
            <a href="{{ route('login') }}" class="text-blue-600 font-bold flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Kembali
            </a>
            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold">Copyright © 2026 ScholaCBT</p>
        </div>
    </main>

    <script>
        if (localStorage.getItem('dark-mode') === 'true') document.documentElement.classList.add('dark');
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark-mode', isDark);
        }
    </script>
</body>
</html>
