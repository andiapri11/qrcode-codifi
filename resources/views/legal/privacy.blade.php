<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kebijakan Privasi | Schola Exambro</title>
    <link rel="shortcut icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <script>
        tailwind.config = { darkMode: 'class' }
    </script>
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glass-header {
            background: rgba(255, 255, 255, 0.82);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.3);
        }
        .dark .glass-header {
            background: rgba(15, 23, 42, 0.82);
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
        }
        .prose h2 { 
            font-size: 1.5rem;
            font-weight: 700;
            margin-top: 2.5rem;
            margin-bottom: 1rem;
            color: #1e293b;
            letter-spacing: -0.025em;
        }
        .dark .prose h2 { color: #60a5fa; }
        .prose p { 
            margin-bottom: 1.5rem;
            line-height: 1.75;
            color: #475569;
        }
        .dark .prose p { color: #94a3b8; }
        .prose ul { 
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.5rem;
            color: #475569;
        }
        .dark .prose ul { color: #94a3b8; }
        .prose li { margin-bottom: 0.5rem; line-height: 1.6; }
        .prose strong { color: #0f172a; font-weight: 700; }
        .dark .prose strong { color: #f8fafc; }
    </style>
</head>
<body class="bg-white dark:bg-slate-950 text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-300">

    <header class="sticky top-0 z-50 glass-header px-6 py-4">
        <div class="max-w-4xl mx-auto flex items-center justify-between">
            <a href="/" class="flex items-center gap-2">
                <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8">
                <span class="font-black text-lg tracking-tighter">Schola <span class="text-blue-600 italic">Exambro</span></span>
            </a>
            <button onclick="toggleDarkMode()" class="p-2 bg-slate-100 dark:bg-slate-800 rounded-full">
                <svg id="moonIcon" class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                <svg id="sunIcon" class="w-5 h-5 hidden dark:block text-yellow-400" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
            </button>
        </div>
    </header>

    <main class="max-w-4xl mx-auto px-6 py-16 prose">
        <h1 class="text-4xl md:text-5xl font-black mb-10 tracking-tight">Kebijakan <span class="text-blue-600">Privasi</span></h1>
        
        <p class="text-slate-400 text-sm italic mb-10">Terakhir diperbarui: 9 Februari 2026</p>

        <section>
            <p>Selamat datang di <strong>Schola Exambro</strong>. Kami sangat menghargai privasi Anda dan berkomitmen untuk melindungi data pribadi Anda, baik sebagai administrator instansi maupun pengguna aplikasi mobile (siswa). Kebijakan Privasi ini menjelaskan bagaimana kami mengumpulkan, menggunakan, dan melindungi informasi Anda sesuai dengan standar perlindungan data global dan kebijakan Google Play Store.</p>

            <h2>1. Informasi yang Kami Kumpulkan</h2>
            <p>Kami mengumpulkan informasi dalam dua kategori utama:</p>
            <ul>
                <li><strong>Informasi Admin Instansi:</strong> Saat Anda mendaftarkan sekolah/instansi, kami mengumpulkan nama admin, alamat email, nomor telepon, dan nama instansi pendidikan.</li>
                <li><strong>Informasi Aplikasi Mobile (Siswa):</strong> Aplikasi kami <strong>tidak mewajibkan</strong> siswa untuk mendaftarkan akun pribadi. Kami hanya memproses data teknis seperti model perangkat, versi sistem operasi, dan ID unik perangkat untuk keperluan validasi keamanan ujian.</li>
            </ul>
            
            <h2>2. Penggunaan Izin Perangkat (Permissions)</h2>
            <p>Untuk menjalankan fungsinya sebagai aplikasi ujian yang aman, Schola Exambro memerlukan beberapa izin teknis:</p>
            <ul>
                <li><strong>Kamera:</strong> Digunakan semata-mata untuk fitur pemindaian QR Code guna menghubungkan aplikasi ke server ujian Anda. Kami tidak mengambil foto, merekam video, atau menyimpan data visual apa pun ke server kami.</li>
                <li><strong>Akses Jaringan:</strong> Diperlukan untuk mengakses platform ujian online dan memverifikasi token ujian.</li>
                <li><strong>Package Usage Stats (Lockdown Feature):</strong> Digunakan untuk mendeteksi aplikasi terlarang yang berjalan di latar belakang guna menjaga integritas ujian (Anti-Curang).</li>
            </ul>

            <h2>3. Perlindungan terhadap Siswa & Anak-anak</h2>
            <p>Schola Exambro mematuhi standar perlindungan data anak (Families Policy). Kami tidak secara sengaja mengumpulkan informasi identitas pribadi (PII) dari siswa di bawah umur. Segala pengelolaan data peserta ujian dilakukan secara tertutup di portal admin instansi pendidikan masing-masing.</p>

            <h2>4. Keamanan & Penyimpanan Data</h2>
            <p>Kami mengimplementasikan enkripsi SSL/TLS selama transmisi data dan protokol keamanan server yang ketat. Data Anda disimpan di server cloud yang aman dan hanya dapat diakses oleh pihak yang berwenang.</p>

            <h2>5. Kebijakan "Tidak Menjual Data"</h2>
            <p>Kami menjamin bahwa <strong>Schola Exambro tidak akan pernah menjual, menyewakan, atau membagikan data pribadi Anda</strong> kepada pihak ketiga untuk kepentingan iklan atau pemasaran komersial.</p>

            <h2>6. Penghapusan Data</h2>
            <p>Anda memiliki hak untuk meminta penghapusan data Anda dari sistem kami. Jika Anda ingin menghapus akun admin atau data instansi Anda, silakan hubungi tim dukungan kami melalui email di bawah ini.</p>

            <h2>7. Hubungi Kami</h2>
            <p>Jika Anda memiliki pertanyaan mengenai Kebijakan Privasi ini, silakan hubungi kami melalui:</p>
            <p><strong>Email:</strong> help@codifi.id<br>
            <strong>Website:</strong> https://qrcode.codifi.id</p>
        </section>

        <div class="mt-20 pt-10 border-t border-slate-100 dark:border-slate-900 flex flex-col md:flex-row justify-between items-center gap-4">
            <a href="/" class="text-blue-600 font-bold flex items-center gap-2 order-2 md:order-1">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" /></svg>
                Kembali ke Beranda
            </a>
            <p class="text-xs text-slate-400 uppercase tracking-widest font-bold order-1 md:order-2">Copyright © 2026 CODIFI.ID - Schola Exambro</p>
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
