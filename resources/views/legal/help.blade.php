<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pusat Bantuan | Schola Exambro</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa',
                            500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>
    <style>
        body { font-family: 'Outfit', sans-serif; }
        .glass-card {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass-card {
            background: rgba(30, 41, 59, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-300">

    <!-- Navigation -->
    <nav class="sticky top-0 z-50 glass-card px-6 py-4 flex items-center justify-between">
        <a href="{{ route('login') }}" class="flex items-center gap-3">
            <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8">
            <span class="font-black text-lg tracking-tighter">Schola <span class="text-blue-600 italic">CBT</span></span>
        </a>
        <div class="flex items-center gap-4">
            <button onclick="toggleDarkMode()" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-full">
                <svg id="moonIcon" class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="sunIcon" class="w-5 h-5 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
            <a href="{{ route('login') }}" class="text-sm font-bold text-blue-600">Kembali ke Masuk</a>
        </div>
    </nav>

    <main class="max-w-4xl mx-auto px-6 py-12 md:py-20">
        <header class="text-center mb-16">
            <h1 class="text-4xl md:text-5xl font-black tracking-tight mb-4">Pusat <span class="text-blue-600">Bantuan</span></h1>
            <p class="text-slate-500 dark:text-slate-400 text-lg">Bagaimana kami bisa membantu Anda hari ini?</p>
        </header>

        <section class="grid md:grid-cols-2 gap-8">
            <!-- FAQ 1 -->
            <div class="glass-card p-8 rounded-3xl">
                <div class="w-12 h-12 bg-blue-100 dark:bg-blue-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12l-1.5-3h-9L6 21zm6-6h.01M12 9a3 3 0 100-6 3 3 0 000 6z" /></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Cara Mendaftar Instansi?</h3>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Klik tombol "Daftar Sekarang" di halaman login, isi profil instansi, dan akun admin Anda akan segera aktif untuk masa percobaan.</p>
            </div>

            <!-- FAQ 2 -->
            <div class="glass-card p-8 rounded-3xl">
                <div class="w-12 h-12 bg-purple-100 dark:bg-purple-900/30 rounded-2xl flex items-center justify-center mb-6">
                    <svg class="w-6 h-6 text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                </div>
                <h3 class="text-xl font-bold mb-3">Apakah Data Saya Aman?</h3>
                <p class="text-slate-500 dark:text-slate-400 leading-relaxed">Schola Exambro menggunakan enkripsi tingkat militer dan backup harian untuk memastikan semua data ujian dan siswa tetap aman.</p>
            </div>
        </section>

        <section class="mt-20 text-center">
            <h2 class="text-2xl font-bold mb-6">Masih Butuh Bantuan?</h2>
            <div class="flex flex-wrap justify-center gap-4">
                <a href="https://wa.me/yournumber" class="px-8 py-4 bg-blue-600 text-white rounded-full font-bold hover:scale-105 transition-transform flex items-center gap-2">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.45L0 24l6.335-1.662c1.42.774 3.022 1.182 4.653 1.182h.004c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z" /></svg>
                    Chat Support
                </a>
                <a href="mailto:support@codifi.id" class="px-8 py-4 bg-slate-200 dark:bg-slate-800 rounded-full font-bold hover:bg-slate-300 transition-colors">
                    Kirim Email
                </a>
            </div>
        </section>
    </main>

    <footer class="py-10 text-center border-t border-slate-200 dark:border-slate-800">
        <p class="text-[10px] text-slate-400 font-medium uppercase tracking-tight">Copyright © 2026 <span class="text-blue-500 font-bold">ScholaCBT</span> by Codifi.id</p>
    </footer>

    <script>
        if (localStorage.getItem('dark-mode') === 'true') document.documentElement.classList.add('dark');
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark-mode', isDark);
        }
    </script>
</body>
</html>
