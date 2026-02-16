<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="language" content="id">
    <meta name="geo.region" content="ID-SS">
    <meta name="geo.placename" content="Sumatera Selatan">
    <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/logo.png?v=5') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/logo.png?v=5') }}">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/logo.png?v=5') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png?v=5') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico?v=3') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon.ico?v=3') }}" type="image/x-icon">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <title>Schola Exambro - Aplikasi Ujian Digital & Lockdown Browser Aman</title>
    <meta name="description" content="Download Schola Exambro, platform management ujian digital (CBT) & lockdown browser paling aman. Dilengkapi fitur Whitelabel Sekolah, Anti-Curang, dan QR Code Instant.">
    <meta name="keywords" content="Schola Exambro, Aplikasi CBT, Lockdown Browser, Ujian Sekolah Online, Anti-Curang, Codifi, Exam Browser Desktop, Exam Browser Android">
    <meta name="author" content="Codifi Team">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Schola Exambro - Solusi Ujian Digital Aman & Profesional">
    <meta property="og:description" content="Tingkatkan integritas ujian sekolah dengan Schola Exambro. Fitur penguncian tingkat tinggi dan branding logo sekolah sendiri.">
    <meta property="og:image" content="{{ asset('assets/images/materi1.webp') }}">
    <meta property="og:site_name" content="Schola Exambro">

    <!-- Twitter Cards -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Schola Exambro - Aplikasi Exam Browser #1 di Indonesia">
    <meta name="twitter:description" content="Aplikasi management ujian digital (CBT) paling aman dengan fitur Whitelabel Instansi.">
    <meta name="twitter:image" content="{{ asset('assets/images/materi1.webp') }}">

    <meta name="theme-color" content="#3C50E0">

    <!-- Schema.org for Google -->
    <script type="application/ld+json">
    [
      {
        "@context": "https://schema.org",
        "@type": "WebSite",
        "name": "Schola Exambro",
        "alternateName": "Schola Exam Browser",
        "url": "{{ url('/') }}",
        "potentialAction": {
          "@type": "SearchAction",
          "target": "{{ url('/') }}/search?q={search_term_string}",
          "query-input": "required name=search_term_string"
        }
      },
      {
        "@context": "https://schema.org",
        "@type": "SoftwareApplication",
        "name": "Schola Exambro",
        "operatingSystem": "Windows, Android",
        "applicationCategory": "EducationApplication",
        "publisher": {
          "@type": "Organization",
          "name": "PT. CIPTA INOVASI DIGITAL",
          "url": "https://codifi.id",
          "logo": {
            "@type": "ImageObject",
            "url": "{{ asset('assets/images/logo.png') }}"
          }
        },
        "description": "Aplikasi management ujian digital (CBT) paling aman dengan fitur Whitelabel Instansi.",
        "offers": {
          "@type": "Offer",
          "price": "200000",
          "priceCurrency": "IDR"
        }
      },
      {
        "@context": "https://schema.org",
        "@type": "FAQPage",
        "mainEntity": [{
          "@type": "Question",
          "name": "Apakah aplikasi ini benar-benar aman dari kecurangan?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Sangat aman. Schola Exambro menggunakan teknologi lock-screen yang sangat ketat. Aplikasi akan otomatis mendeteksi jika siswa mencoba membuka aplikasi lain, melakukan screenshot, atau mencoba menggunakan fitur split-screen di ponsel mereka."
          }
        }, {
          "@type": "Question",
          "name": "Metode pembayaran apa saja yang didukung?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Kami mendukung berbagai metode pembayaran otomatis melalui Xendit, termasuk QRIS (Dana, OVO, GoPay, ShopeePay), Transfer Bank (Virtual Account), dan gerai retail seperti Alfamart."
          }
        }, {
          "@type": "Question",
          "name": "Berapa lama proses aktivasi akun setelah membayar?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Proses aktivasi berlangsung secara otomatis dan instan segera setelah pembayaran Anda terverifikasi oleh sistem."
          }
        }, {
          "@type": "Question",
          "name": "Apakah sekolah harus memiliki server sendiri?",
          "acceptedAnswer": {
            "@type": "Answer",
            "text": "Tidak perlu. Schola Exambro berbasis Cloud. Pihak sekolah hanya perlu memiliki koneksi internet dan dashboard admin untuk mengelola link ujian."
          }
        }]
      }
    ]
    </script>

    <link rel="canonical" href="{{ url()->current() }}">

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Plus+Jakarta+Sans:ital,wght@0,200..800;1,200..800&display=swap" rel="stylesheet">

    <!-- Styles -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                        outfit: ['Outfit', 'sans-serif'],
                    },
                    colors: {
                        brand: {
                            50: '#f0f4ff',
                            100: '#e1e9ff',
                            200: '#c8d7ff',
                            300: '#a1bcff',
                            400: '#7095ff',
                            500: '#3C50E0', // Primary Indigo
                            600: '#2b39cc',
                            700: '#222ca3',
                            800: '#1e2685',
                            900: '#1d236b',
                            950: '#111440',
                        },
                    },
                    animation: {
                        'float': 'float 6s ease-in-out infinite',
                        'pulse-slow': 'pulse 4s cubic-bezier(0.4, 0, 0.6, 1) infinite',
                    },
                    keyframes: {
                        float: {
                            '0%, 100%': { transform: 'translateY(0)' },
                            '50%': { transform: 'translateY(-20px)' },
                        }
                    }
                }
            }
        }
    </script>

    <style>
        .glass {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }
        .dark .glass {
            background: rgba(15, 23, 42, 0.7);
            border: 1px solid rgba(255, 255, 255, 0.05);
        }
        .gradient-text {
            background: linear-gradient(135deg, #3C50E0 0%, #10b981 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .hero-pattern {
            background-image: radial-gradient(#3C50E0 0.5px, transparent 0.5px);
            background-size: 24px 24px;
            opacity: 0.1;
        }
    </style>
</head>
<body class="font-sans antialiased text-slate-900 bg-slate-50 overflow-x-hidden">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full z-50 glass border-b border-white/50 transition-all duration-300">
        <div class="max-w-screen-2xl mx-auto px-6 lg:px-10 h-16 lg:h-24 flex items-center justify-between">
            <div class="flex items-center gap-1.5 group cursor-pointer" onclick="window.scrollTo({top: 0, behavior: 'smooth'})">
                <div class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <img src="{{ asset('assets/images/logo.png?v=4') }}" alt="Logo Schola Exambro - Aplikasi Ujian Digital" class="w-full h-full object-contain">
                </div>
                <div class="text-[18px] lg:text-[22px] font-black flex items-center leading-none tracking-[-0.07em]">
                    <span class="text-slate-900 uppercase">SCHOLA</span>
                    <span class="text-emerald-600 uppercase ml-0.5">EXAM</span>
                    <span class="text-slate-900 uppercase">BRO</span>
                </div>
            </div>

            <!-- Main Nav (Hidden on Mobile) -->
            <div class="hidden lg:flex items-center gap-1">
                <a href="#features" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-slate-500 hover:text-slate-900 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Fitur Utama</a>
                <a href="#how-it-works" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-slate-500 hover:text-slate-900 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Cara Kerja</a>
                <a href="#pricing" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-slate-500 hover:text-slate-900 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Harga Layanan</a>
                <a href="{{ route('public.download') }}" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-indigo-600 hover:text-indigo-700 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Download Gratis</a>
                <a href="https://wa.me/628218144726" target="_blank" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-slate-500 hover:text-slate-900 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Hubungi Sales</a>
            </div>

            <div class="flex items-center gap-3 sm:gap-5">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="hidden sm:inline-flex px-8 py-3.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-black hover:shadow-xl hover:shadow-slate-200 transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-[0.2em] text-slate-500 hover:text-brand-500 transition-colors pr-2">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="hidden sm:inline-flex px-8 py-3.5 bg-brand-500 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-brand-600 shadow-xl shadow-brand-500/20 transition-all">Daftar Akun</a>
                        @endif
                    @endauth
                @endif

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="lg:hidden w-11 h-11 flex items-center justify-center text-slate-900 bg-slate-100 rounded-2xl">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path id="menu-icon" stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 6h16M4 12h16m-7 6h7" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Overlay -->
        <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-slate-100 p-6 animate-in slide-in-from-top duration-300">
            <div class="flex flex-col gap-5">
                <a href="#features" onclick="toggleMobileMenu()" class="text-xs font-black text-slate-600 uppercase tracking-[0.2em]">✨ Fitur Utama</a>
                <a href="#how-it-works" onclick="toggleMobileMenu()" class="block px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-brand-500 border-b border-slate-50">Cara Kerja</a>
                <a href="#pricing" onclick="toggleMobileMenu()" class="block px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-brand-500 border-b border-slate-50">Harga</a>
                <a href="{{ route('public.download') }}" onclick="toggleMobileMenu()" class="block px-6 py-4 text-[10px] font-black text-indigo-600 uppercase tracking-widest hover:text-indigo-700 border-b border-slate-50">Download Gratis</a>
                <a href="https://wa.me/628218144726" target="_blank" class="block px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-brand-500 border-b border-slate-50">Hubungi Sales</a>
                <hr class="border-slate-100">
                @guest
                    <a href="{{ route('register') }}" class="w-full py-4 bg-brand-500 text-white text-center rounded-2xl text-[11px] font-black uppercase tracking-[0.3em]">Daftar Akun Baru</a>
                @else
                    <a href="{{ url('/dashboard') }}" class="w-full py-4 bg-slate-900 text-white text-center rounded-2xl text-[11px] font-black uppercase tracking-[0.3em]">Buka Dashboard</a>
                @endguest
            </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-24 lg:pt-32 pb-12 lg:pb-24 overflow-hidden">
        <div class="absolute inset-0 hero-pattern z-0"></div>
        <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-brand-500/10 rounded-full blur-[100px] -mr-48"></div>
        <div class="absolute bottom-0 left-0 w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[100px] -ml-48"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-brand-50 border border-brand-100 rounded-full mb-6">
                        <span class="w-2 h-2 bg-brand-500 rounded-full animate-pulse"></span>
                        <span class="text-[9px] sm:text-[10px] font-black text-brand-600 uppercase tracking-widest">Platform Exambro #1 di Indonesia</span>
                    </div>
                    <h1 class="text-3xl sm:text-4xl lg:text-[48px] font-black text-slate-900 leading-[1.1] mb-6 uppercase tracking-tighter">
                        Aplikasi <span class="text-emerald-500">Exam Browser</span> <br class="hidden sm:block"> 
                        Ujian Digital Lebih <br> 
                        <span class="text-slate-900 italic">Aman</span> & Profesional
                    </h1>
                    <p class="text-base sm:text-lg lg:text-lg text-slate-500 font-medium mb-10 max-w-2xl leading-relaxed mx-auto lg:mx-0">
                        Solusi Aplikasi Exam Browser terbaik dengan keamanan tingkat tinggi, Anti-Curang, dan fitur Branding Instansi untuk pengalaman ujian yang lebih profesional dan terpercaya.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-2">
                        <a href="{{ route('public.download') }}" class="w-full sm:w-auto px-12 py-5 bg-slate-900 border border-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] transition-all hover:bg-black hover:scale-105 active:scale-95 shadow-xl shadow-slate-900/20">
                            Download Gratis
                        </a>
                    </div>
                    <div class="mt-12 flex items-center justify-center lg:justify-start gap-8 opacity-60">
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-slate-900">500+</span>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Instansi</span>
                        </div>
                        <div class="w-px h-8 bg-slate-200"></div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-slate-900">50rb+</span>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Siswa Aktif</span>
                        </div>
                        <div class="w-px h-8 bg-slate-200"></div>
                        <div class="flex flex-col">
                            <span class="text-2xl font-black text-slate-900">99.9%</span>
                            <span class="text-[9px] font-black uppercase tracking-widest text-slate-400">Uptime</span>
                        </div>
                    </div>
                </div>

                <div class="flex-1 relative">
                    <!-- Premium UI Mockup Illustration -->
                    <div class="relative z-10">
                        <div class="rounded-[2.5rem] shadow-2xl overflow-hidden border border-slate-200">
                            <img src="{{ asset('assets/images/materi1.webp') }}" alt="Tampilan Dashboard Aplikasi Schola Exambro untuk Windows dan Android" class="w-full h-auto">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-12 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-12">
                <h2 class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-4">Fitur Unggulan</h2>
                <h3 class="text-3xl lg:text-5xl font-black text-slate-900 uppercase tracking-tighter">Sistem Ujian Digital Paling Aman & Eksklusif</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                <!-- Feature 1 -->
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-brand-500/30 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                    <div class="w-14 h-14 bg-white text-indigo-500 rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01" /></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-4 italic">Branding Eksklusif</h4>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed mb-6">
                        Bukan cuma aplikasi ujian biasa. Tampilkan identitas sekolah Anda mulai dari logo, warna tema, hingga latar belakang aplikasi yang prestisius.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Logo
                        </li>
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Background
                        </li>
                    </ul>
                </div>

                <!-- Feature 2 -->
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-brand-500/30 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                    <div class="w-14 h-14 bg-white text-emerald-500 rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-4 italic">Keamanan Berlapis</h4>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed mb-6">
                        Mencegah siswa membuka aplikasi lain, mematikan notifikasi, hingga fitur blokir domain luar (Whitelist) yang bisa diatur per sekolah.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Password Lock
                        </li>
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Domain Whitelisting
                        </li>
                    </ul>
                </div>

                <!-- Feature 3 -->
                <div class="group p-10 bg-slate-50 rounded-[2.5rem] border border-slate-100 hover:border-brand-500/30 hover:shadow-xl hover:shadow-brand-500/5 transition-all">
                    <div class="w-14 h-14 bg-white text-amber-500 rounded-2xl flex items-center justify-center mb-8 shadow-sm group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1l-3.322 3.322a2 2 0 01-1.414.586H5a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-7a2 2 0 00-2-2h-2.343a2 2 0 01-1.414-.586L12 4z" /></svg>
                    </div>
                    <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight mb-4 italic">Instant QR Generator</h4>
                    <p class="text-slate-500 font-medium text-sm leading-relaxed mb-6">
                        Buat link ujian Google Forms, Quizizz, atau moodle menjadi QR Code cantik secara instan. Cetak sekali, gunakan selamanya.
                    </p>
                    <ul class="space-y-3">
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Bulk QR Generation
                        </li>
                        <li class="flex items-center gap-2 text-[10px] font-black uppercase text-slate-400">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Real-time Edit Link
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- Alur Implementasi Section (Senior Dev Refined - Compact) -->
    <section id="how-it-works" class="py-16 lg:py-24 bg-[#0a1128] relative overflow-hidden">
        <!-- Background Tech pattern overlay -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none hero-pattern scale-150"></div>
        <div class="absolute top-0 left-0 w-full h-full">
            <div class="absolute top-1/2 -left-1/4 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] -translate-y-1/2"></div>
            <div class="absolute top-1/2 -right-1/4 w-[400px] h-[400px] bg-emerald-600/10 rounded-full blur-[100px] -translate-y-1/2"></div>
        </div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center mb-14">
                <h2 class="text-3xl lg:text-5xl font-black text-white mb-2 uppercase tracking-tighter font-outfit">Alur Implementasi</h2>
                <h3 class="text-lg lg:text-xl font-light text-slate-400 uppercase tracking-[0.3em] font-outfit opacity-70">Schola Exambro</h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 lg:gap-8">
                <!-- Step 1: Konfigurasi -->
                <div class="relative pt-6 group">
                    <div class="bg-white rounded-[32px] p-8 h-full shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] flex flex-col relative overflow-visible transition-all duration-500 hover:-translate-y-1.5">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-8 -translate-y-1/2 bg-[#1e293b] text-white px-5 py-2 rounded-xl text-base font-black font-outfit shadow-lg z-20">01</div>
                        
                        <div class="flex items-center justify-between gap-3 mb-6 pt-2">
                            <h4 class="text-[18px] font-black text-slate-800 uppercase tracking-tight font-outfit leading-tight">Konfigurasi</h4>
                            <div class="w-11 h-10 shrink-0 bg-emerald-100/80 rounded-xl flex items-center justify-center text-emerald-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                        </div>

                        <p class="text-[14px] font-bold text-slate-500 leading-relaxed font-sans opacity-95">
                            Admin menyiapkan ujian melalui dashboard, mulai dari soal, durasi, hingga peserta. Semua teratur dan siap digunakan sesuai jadwal.
                        </p>
                    </div>
                </div>

                <!-- Step 2: Distribusi QR -->
                <div class="relative pt-6 group">
                    <div class="bg-white rounded-[32px] p-8 h-full shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] flex flex-col relative overflow-visible transition-all duration-500 hover:-translate-y-1.5">
                         <!-- Step Badge -->
                        <div class="absolute top-0 left-8 -translate-y-1/2 bg-[#1e293b] text-white px-5 py-2 rounded-xl text-base font-black font-outfit shadow-lg z-20">02</div>

                        <div class="flex items-center justify-between gap-3 mb-6 pt-2">
                            <h4 class="text-[18px] font-black text-slate-800 uppercase tracking-tight font-outfit leading-tight">Distribusi QR</h4>
                            <div class="w-11 h-10 shrink-0 bg-blue-100/80 rounded-xl flex items-center justify-center text-blue-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z"/></svg>
                            </div>
                        </div>

                        <p class="text-[14px] font-bold text-slate-500 leading-relaxed font-sans opacity-95">
                            Instansi membagikan kode atau QR login kepada peserta. Proses cepat dan langsung terhubung ke sistem ujian.
                        </p>
                    </div>
                </div>

                <!-- Step 3: Aplikasi Client -->
                <div class="relative pt-6 group">
                    <div class="bg-white rounded-[32px] p-8 h-full shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] flex flex-col relative overflow-visible transition-all duration-500 hover:-translate-y-1.5">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-8 -translate-y-1/2 bg-[#1e293b] text-white px-5 py-2 rounded-xl text-base font-black font-outfit shadow-lg z-20">03</div>

                        <div class="flex items-center justify-between gap-3 mb-6 pt-2">
                            <h4 class="text-[18px] font-black text-slate-800 uppercase tracking-tight font-outfit leading-tight">Aplikasi Client</h4>
                            <div class="w-11 h-10 shrink-0 bg-purple-100/80 rounded-xl flex items-center justify-center text-purple-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"/></svg>
                            </div>
                        </div>

                        <p class="text-[14px] font-bold text-slate-500 leading-relaxed font-sans opacity-95">
                            Peserta memasukkan kode dan otomatis masuk ke halaman ujian. Sistem berjalan dalam mode fullscreen secure.
                        </p>
                    </div>
                </div>

                <!-- Step 4: Monitoring -->
                <div class="relative pt-6 group">
                    <div class="bg-white rounded-[32px] p-8 h-full shadow-[0_30px_60px_-15px_rgba(0,0,0,0.5)] flex flex-col relative overflow-visible transition-all duration-500 hover:-translate-y-1.5">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-8 -translate-y-1/2 bg-[#1e293b] text-white px-5 py-2 rounded-xl text-base font-black font-outfit shadow-lg z-20">04</div>

                        <div class="flex items-center justify-between gap-3 mb-6 pt-2">
                            <h4 class="text-[18px] font-black text-slate-800 uppercase tracking-tight font-outfit leading-tight">Monitoring</h4>
                            <div class="w-11 h-10 shrink-0 bg-yellow-100/80 rounded-xl flex items-center justify-center text-yellow-600">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/></svg>
                            </div>
                        </div>

                        <p class="text-[14px] font-bold text-slate-500 leading-relaxed font-sans opacity-95">
                            Pengawas memantau ujian secara real-time. Jika peserta keluar aplikasi, sistem memberi peringatan otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Pricing Section -->
    <section id="pricing" class="py-24 bg-slate-50 relative overflow-hidden">
        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="text-center mb-16">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-4 uppercase tracking-tight font-outfit">Investasi Pendidikan</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto text-sm sm:text-base">Pilih paket lisensi yang sesuai dengan kebutuhan jumlah ujian instansi Anda.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Plan 1 -->
                <div class="bg-white p-6 sm:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                    <div class="mb-8">
                        <h3 class="text-[10px] font-black text-emerald-600 uppercase tracking-[0.3em] mb-4">Masa Aktif 6 Bulan</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400">Rp</span>
                            <span class="text-4xl font-black text-slate-900 tracking-tighter">200.000</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10 opacity-70 flex-grow">
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            10 Link Barcode Secure
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Nama Sekolah
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Dukungan Teknis Standar
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-slate-900 text-white text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-black transition-all">Mulai Sekarang</a>
                </div>

                <!-- Plan 2 -->
                <div class="bg-slate-900 p-6 sm:p-10 rounded-[2.5rem] shadow-2xl shadow-blue-200 relative transform md:-translate-y-4 flex flex-col border border-blue-500/20 mt-8 md:mt-0">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 bg-blue-500 text-white text-[8px] font-black px-4 py-1.5 rounded-full uppercase tracking-widest shadow-xl">Best Value</div>
                    <div class="mb-8">
                        <h3 class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] mb-4 text-center">Masa Aktif 1 Tahun</h3>
                        <div class="flex items-baseline justify-center gap-1">
                            <span class="text-lg font-bold text-slate-500">Rp</span>
                            <span class="text-5xl font-black text-white tracking-tighter">350.000</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10 opacity-90 flex-grow text-center">
                        <li class="flex items-center justify-center gap-3 text-xs font-bold text-slate-300">
                            20 Link Barcode Secure
                        </li>
                        <li class="flex items-center justify-center gap-3 text-xs font-bold text-slate-300">
                            Statistik Hasil Ujian
                        </li>
                        <li class="flex items-center justify-center gap-3 text-xs font-bold text-slate-300">
                            Dukungan Update Prioritas
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-white text-slate-900 text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-100 transition-all shadow-xl">Aktivasi Paket</a>
                </div>

                <!-- Plan 3 -->
                <div class="bg-white p-6 sm:p-10 rounded-[2.5rem] border border-slate-200 shadow-sm hover:shadow-xl transition-all duration-500 flex flex-col">
                    <div class="mb-8">
                        <h3 class="text-[10px] font-black text-indigo-600 uppercase tracking-[0.3em] mb-4">Masa Aktif 3 Tahun</h3>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400">Rp</span>
                            <span class="text-4xl font-black text-slate-900 tracking-tighter">700.000</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10 opacity-70 flex-grow">
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            100 Barcode Secure
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Full Whitelabel (Branding Sekolah)
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Akses Dashboard Premium
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-white border border-slate-200 text-slate-900 text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>    <!-- FAQ Section -->
    <section id="faq" class="py-24 bg-white relative">
        <div class="max-w-4xl mx-auto px-6">
            <div class="text-center mb-16 px-4">
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 uppercase tracking-tight">Tanya Jawab Umum</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto text-sm sm:text-base">Temukan jawaban atas pertanyaan yang paling sering diajukan mengenai layanan kami.</p>
            </div>

            <div class="grid grid-cols-1 gap-4">
                <!-- FAQ Item 1 -->
                <div class="faq-item group border border-slate-100 rounded-[2.5rem] p-6 sm:p-8 hover:border-emerald-500/20 hover:bg-slate-50 transition-all duration-300 cursor-pointer" onclick="toggleFaq(1)">
                    <h3 class="text-lg font-black text-slate-900 flex items-center justify-between">
                        Apakah aplikasi ini benar-benar aman dari kecurangan?
                        <span id="faq-icon-1" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-emerald-500 group-hover:text-white transition-all text-sm">+</span>
                    </h3>
                    <div id="faq-answer-1" class="max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-[14px] font-medium text-slate-500 leading-relaxed font-sans opacity-90 pt-6">
                            Sangat aman. Schola Exambro menggunakan teknologi lock-screen yang sangat ketat. Aplikasi akan otomatis mendeteksi jika siswa mencoba membuka aplikasi lain, melakukan screenshot, atau mencoba menggunakan fitur split-screen di ponsel mereka.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 2 -->
                <div class="faq-item group border border-slate-100 rounded-[2.5rem] p-6 sm:p-8 hover:border-emerald-500/20 hover:bg-slate-50 transition-all duration-300 cursor-pointer" onclick="toggleFaq(2)">
                    <h3 class="text-lg font-black text-slate-900 flex items-center justify-between">
                        Metode pembayaran apa saja yang didukung?
                        <span id="faq-icon-2" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-emerald-500 group-hover:text-white transition-all text-sm">+</span>
                    </h3>
                    <div id="faq-answer-2" class="max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-[14px] font-medium text-slate-500 leading-relaxed font-sans opacity-90 pt-6">
                            Berkat integrasi Xendit, kami mendukung berbagai metode pembayaran otomatis mulai dari <strong>QRIS (Dana, OVO, GoPay, ShopeePay)</strong>, Transfer Bank (Virtual Account), hingga gerai retail seperti Alfamart. Semua pembayaran terkonfirmasi secara instan.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 3 -->
                <div class="faq-item group border border-slate-100 rounded-[2.5rem] p-6 sm:p-8 hover:border-emerald-500/20 hover:bg-slate-50 transition-all duration-300 cursor-pointer" onclick="toggleFaq(3)">
                    <h3 class="text-lg font-black text-slate-900 flex items-center justify-between">
                        Berapa lama proses aktivasi akun setelah membayar?
                        <span id="faq-icon-3" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-emerald-500 group-hover:text-white transition-all text-sm">+</span>
                    </h3>
                    <div id="faq-answer-3" class="max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-[14px] font-medium text-slate-500 leading-relaxed font-sans opacity-90 pt-6">
                            Proses aktivasi berlangsung secara **otomatis dan instan**. Segera setelah pembayaran Anda terverifikasi oleh sistem Xendit, status langganan di dashboard Anda akan langsung berubah menjadi aktif dan kuota barcode bertambah.
                        </p>
                    </div>
                </div>

                <!-- FAQ Item 4 -->
                <div class="faq-item group border border-slate-100 rounded-[2.5rem] p-6 sm:p-8 hover:border-emerald-500/20 hover:bg-slate-50 transition-all duration-300 cursor-pointer" onclick="toggleFaq(4)">
                    <h3 class="text-lg font-black text-slate-900 flex items-center justify-between">
                        Apakah sekolah harus memiliki server sendiri?
                        <span id="faq-icon-4" class="w-8 h-8 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 group-hover:bg-emerald-500 group-hover:text-white transition-all text-sm">+</span>
                    </h3>
                    <div id="faq-answer-4" class="max-h-0 overflow-hidden transition-all duration-300">
                        <p class="text-[14px] font-medium text-slate-500 leading-relaxed font-sans opacity-90 pt-6">
                            Tidak perlu. Schola Exambro berbasis Cloud. Pihak sekolah hanya perlu memiliki koneksi internet dan dashboard admin untuk mengelola link ujian. Segala infrastruktur server dan keamanan sistem sudah kami tangani sepenuhnya.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-16">
                <div class="col-span-1 md:col-span-2 space-y-6">
                    <div class="flex items-center gap-1">
                        <div class="w-8 h-8 flex items-center justify-center">
                            <img src="{{ asset('assets/images/logo.png?v=4') }}" alt="Logo Icon" class="w-full h-full object-contain">
                        </div>
                        <div class="text-[18px] font-black flex items-center leading-none uppercase tracking-[-0.07em]">
                            <span class="text-slate-900">SCHOLA</span>
                            <span class="text-emerald-600 ml-0.5">EXAM</span>
                            <span class="text-slate-900">BRO</span>
                        </div>
                    </div>
                    <p class="text-sm text-slate-500 font-medium leading-relaxed max-w-sm">
                        Solusi manajemen ujian digital terenkripsi untuk integritas pendidikan Indonesia yang lebih baik. Dikembangkan oleh tim ahli untuk keamanan instansi Anda.
                    </p>
                    <div class="pt-4 space-y-3">
                        <div class="flex items-center gap-3 text-slate-500 group">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover:bg-emerald-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest">support@codifi.id</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-500 group">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover:bg-emerald-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"/></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-widest">+62 821-8144-726</span>
                        </div>
                        <div class="flex items-center gap-3 text-slate-500 group">
                            <div class="w-8 h-8 rounded-lg bg-slate-50 flex items-center justify-center group-hover:bg-emerald-50 transition-colors">
                                <svg class="w-4 h-4 text-slate-400 group-hover:text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                            </div>
                            <span class="text-xs font-bold uppercase tracking-tight leading-tight">Sumatera Selatan, Indonesia</span>
                        </div>
                    </div>
                </div>
                
                <div class="col-span-1">
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-6">Legalitas</h4>
                    <ul class="space-y-4">
                        <li><a href="{{ route('terms') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-tight">Syarat & Ketentuan</a></li>
                        <li><a href="{{ route('privacy') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-tight">Kebijakan Privasi</a></li>
                        <li><a href="{{ route('refund') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-tight">Refund & Pembatalan</a></li>
                    </ul>
                </div>

                <div class="col-span-1">
                    <h4 class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-6">Navigasi</h4>
                    <ul class="space-y-4">
                        <li><a href="#how-it-works" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-tight">Alur Kerja</a></li>
                        <li><a href="{{ route('public.download') }}" class="text-xs font-bold text-slate-400 hover:text-emerald-600 transition-colors uppercase tracking-tight">Download App</a></li>
                    </ul>
                </div>
            </div>

            <div class="pt-8 border-t border-slate-100 flex flex-col md:flex-row justify-between items-center gap-4">
                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-400">
                    &copy; 2026 <span class="text-slate-900 font-black">PT. CIPTA INOVASI DIGITAL</span>. All Rights Reserved.
                </div>
                <div class="flex items-center gap-4">
                    <div class="text-[9px] font-black text-slate-300 uppercase tracking-widest px-3 py-1 border border-slate-100 rounded-lg">Official Partner of CODIFI.ID</div>
                </div>
            </div>
        </div>
    </footer>
    <script>
        function toggleMobileMenu() {
            const menu = document.getElementById('mobile-menu');
            const icon = document.getElementById('menu-icon');
            const isHidden = menu.classList.contains('hidden');
            
            if (isHidden) {
                menu.classList.remove('hidden');
                icon.setAttribute('d', 'M6 18L18 6M6 6l12 12');
            } else {
                menu.classList.add('hidden');
                icon.setAttribute('d', 'M4 6h16M4 12h16m-7 6h7');
            }
        }

        function toggleFaq(id) {
            const answer = document.getElementById(`faq-answer-${id}`);
            const icon = document.getElementById(`faq-icon-${id}`);
            const allAnswers = document.querySelectorAll('[id^="faq-answer-"]');
            const allIcons = document.querySelectorAll('[id^="faq-icon-"]');

            // Close other answers
            allAnswers.forEach((item, index) => {
                if (item.id !== `faq-answer-${id}`) {
                    item.style.maxHeight = null;
                    allIcons[index].textContent = '+';
                    allIcons[index].classList.remove('bg-emerald-500', 'text-white');
                    allIcons[index].classList.add('bg-slate-100', 'text-slate-400');
                }
            });

            // Toggle current answer
            if (answer.style.maxHeight) {
                answer.style.maxHeight = null;
                icon.textContent = '+';
                icon.classList.remove('bg-emerald-500', 'text-white');
                icon.classList.add('bg-slate-100', 'text-slate-400');
            } else {
                answer.style.maxHeight = answer.scrollHeight + "px";
                icon.textContent = '-';
                icon.classList.add('bg-emerald-500', 'text-white');
                icon.classList.remove('bg-slate-100', 'text-slate-400');
            }
        }
    </script>
</body>
</html>
