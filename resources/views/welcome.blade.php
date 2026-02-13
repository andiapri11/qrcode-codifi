<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
    <link rel="shortcut icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
    <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('assets/images/logo.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/logo.png') }}">
    <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">

    <title>Schola Exambro - Aplikasi Ujian Digital Anti-Curang Paling Aman</title>
    <meta name="description" content="Download aplikasi Exambro resmi dari Schola Exambro. Platform management ujian digital (CBT) & lockdown browser paling aman dengan fitur Whitelabel Sekolah dan QR Code Instant.">
    <meta name="keywords" content="Schola Exambro, Aplikasi CBT, Lockdown Browser, Ujian Sekolah Online, Anti-Curang, Codifi, Exam Browser Desktop">
    <meta name="author" content="Codifi Team">
    <meta name="robots" content="index, follow">
    
    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url('/') }}">
    <meta property="og:title" content="Schola Exambro - Aplikasi Ujian Digital Anti-Curang">
    <meta property="og:description" content="Tingkatkan integritas ujian sekolah dengan Schola Exambro. Branding logo sekolah sendiri dan fitur penguncian sistem level tinggi.">
    <meta property="og:image" content="{{ asset('assets/images/logo.png') }}">

    <!-- Schema.org for Google -->
    <script type="application/ld+json">
    {
      "@context": "https://schema.org",
      "@type": "WebSite",
      "name": "Schola Exambro",
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
        "name": "Codifi ID",
        "logo": {
          "@type": "ImageObject",
          "url": "{{ asset('assets/images/logo.png') }}"
        }
      },
      "description": "Aplikasi management ujian digital (CBT) paling aman dengan fitur Whitelabel Instansi."
    }
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
                    <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo" class="w-full h-full object-contain">
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
                <a href="https://wa.me/6285768441485" target="_blank" class="px-5 py-2.5 rounded-xl text-[10px] font-black text-slate-500 hover:text-slate-900 hover:bg-slate-100 uppercase tracking-[0.2em] transition-all">Hubungi Sales</a>
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
                <a href="https://wa.me/6285768441485" target="_blank" class="block px-6 py-4 text-[10px] font-black text-slate-500 uppercase tracking-widest hover:text-brand-500 border-b border-slate-50">Hubungi Sales</a>
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
                            <img src="{{ asset('assets/images/materi1.jpg') }}" alt="Download Aplikasi Exambro - Tampilan Schola Exambro" class="w-full h-auto">
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

    <!-- Alur Implementasi Section -->
    <section id="how-it-works" class="py-24 lg:py-40 bg-[#0a1128] relative overflow-hidden">
        <!-- Subtle Tech background -->
        <div class="absolute inset-0 opacity-[0.03] pointer-events-none hero-pattern scale-150"></div>
        <div class="absolute top-[-10%] left-[-10%] w-[600px] h-[600px] bg-blue-500/10 rounded-full blur-[150px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[600px] h-[600px] bg-emerald-500/10 rounded-full blur-[150px]"></div>

        <div class="max-w-6xl mx-auto px-6 relative z-10">
            <div class="text-center mb-24">
                <h2 class="text-4xl lg:text-6xl font-black text-white mb-4 uppercase tracking-tighter font-outfit">Alur Implementasi</h2>
                <div class="flex items-center justify-center gap-4">
                    <div class="h-px w-12 bg-blue-500/50"></div>
                    <h3 class="text-xl lg:text-2xl font-light text-blue-400 uppercase tracking-[0.4em] font-outfit">Schola Exambro</h3>
                    <div class="h-px w-12 bg-blue-500/50"></div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">
                <!-- Step 1: Konfigurasi -->
                <div class="relative pt-8 group">
                    <div class="bg-white rounded-[40px] p-10 h-full shadow-[0_20px_50px_-15px_rgba(0,0,0,0.3)] hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.4)] transition-all duration-500 flex flex-col relative">
                        <!-- Step Badge - Fixed Positioning -->
                        <div class="absolute top-0 left-10 -translate-y-1/2 bg-[#1e293b] text-white px-6 py-2.5 rounded-2xl text-xl font-black font-outfit shadow-xl z-20">01</div>
                        
                        <div class="flex justify-between items-center mb-8 pt-4">
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight font-outfit">Konfigurasi</h4>
                            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-500 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V5h14v14zM17 12h-2v2h2v-2zm-4 0h-2v2h2v-2zm-4 0H7v2h2v-2zm8-4h-2v2h2V8zm-4 0h-2v2h2V8zm-4 0H7v2h2V8z"/></svg>
                            </div>
                        </div>

                        <p class="text-[15px] font-bold text-slate-500 leading-relaxed font-sans opacity-90">
                            Admin menyiapkan ujian melalui dashboard, mulai dari soal, durasi, hingga peserta. Semua teratur dan siap digunakan sesuai jadwal.
                        </p>
                    </div>
                </div>

                <!-- Step 2: Distribusi QR -->
                <div class="relative pt-8 group">
                    <div class="bg-white rounded-[40px] p-10 h-full shadow-[0_20px_50px_-15px_rgba(0,0,0,0.3)] hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.4)] transition-all duration-500 flex flex-col relative">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-10 -translate-y-1/2 bg-[#1e293b] text-white px-6 py-2.5 rounded-2xl text-xl font-black font-outfit shadow-xl z-20">02</div>

                        <div class="flex justify-between items-center mb-8 pt-4">
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight font-outfit">Distribusi QR</h4>
                            <div class="w-12 h-12 bg-blue-50 rounded-2xl flex items-center justify-center text-blue-500 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 11h8V3H3v8zm2-6h4v4H5V5zM3 21h8v-8H3v8zm2-6h4v4H5v-4zM13 3v8h8V3h-8zm6 6h-4V5h4v4zM13 13h2v2h-2v-2zm2 2h2v2h-2v-2zm-2 2h2v2h-2v-2zm2 2h2v2h-2v-2zm2-2h2v2h-2v-2zm0-4h2v2h-2v-2zm2 2h2v2h-2v-2z"/></svg>
                            </div>
                        </div>

                        <p class="text-[15px] font-bold text-slate-500 leading-relaxed font-sans opacity-90">
                            Instansi membagikan kode atau QR login kepada peserta. Proses cepat dan langsung terhubung ke sistem ujian.
                        </p>
                    </div>
                </div>

                <!-- Step 3: Aplikasi Client -->
                <div class="relative pt-8 group">
                    <div class="bg-white rounded-[40px] p-10 h-full shadow-[0_20px_50px_-15px_rgba(0,0,0,0.3)] hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.4)] transition-all duration-500 flex flex-col relative">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-10 -translate-y-1/2 bg-[#1e293b] text-white px-6 py-2.5 rounded-2xl text-xl font-black font-outfit shadow-xl z-20">03</div>

                        <div class="flex justify-between items-center mb-8 pt-4">
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight font-outfit">Aplikasi Client</h4>
                            <div class="w-12 h-12 bg-purple-50 rounded-2xl flex items-center justify-center text-purple-500 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M17 1.01L7 1c-1.1 0-2 .9-2 2v18c0 1.1.9 2 2 2h10c1.1 0 2-.9 2-2V3c0-1.1-.9-1.99-2-1.99zM17 19H7V5h10v14z"/></svg>
                            </div>
                        </div>

                        <p class="text-[15px] font-bold text-slate-500 leading-relaxed font-sans opacity-90">
                            Peserta memasukkan kode dan otomatis masuk ke halaman ujian. Sistem berjalan dalam mode fullscreen secure.
                        </p>
                    </div>
                </div>

                <!-- Step 4: Monitoring -->
                <div class="relative pt-8 group">
                    <div class="bg-white rounded-[40px] p-10 h-full shadow-[0_20px_50px_-15px_rgba(0,0,0,0.3)] hover:shadow-[0_30px_60px_-15px_rgba(0,0,0,0.4)] transition-all duration-500 flex flex-col relative">
                        <!-- Step Badge -->
                        <div class="absolute top-0 left-10 -translate-y-1/2 bg-[#1e293b] text-white px-6 py-2.5 rounded-2xl text-xl font-black font-outfit shadow-xl z-20">04</div>

                        <div class="flex justify-between items-center mb-8 pt-4">
                            <h4 class="text-xl font-black text-slate-900 uppercase tracking-tight font-outfit">Monitoring</h4>
                            <div class="w-12 h-12 bg-amber-50 rounded-2xl flex items-center justify-center text-amber-50 group-hover:scale-110 transition-transform duration-500">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 13h8V3H3v10zm2-8h4v4H5V5zm8 16h8V11h-8v10zm2-8h4v4h-4v-4zM13 3v6h8V3h-8zm6 4h-4V5h4v2zM3 21h8v-6H3v6zm2-4h4v2H5v-2z"/></svg>
                            </div>
                        </div>

                        <p class="text-[15px] font-bold text-slate-500 leading-relaxed font-sans opacity-90">
                            Pengawas memantau ujian secara real-time. Jika peserta keluar aplikasi, sistem memberi peringatan otomatis.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
    <!-- Pricing Section -->
    <section id="pricing" class="py-12 lg:py-24 bg-white relative">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-16 px-4">
                <span class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-4 block">Pilihan Paket</span>
                <h2 class="text-3xl md:text-5xl font-black text-slate-900 mb-6 uppercase tracking-tight">Investasi Keamanan Ujian</h2>
                <p class="text-slate-500 font-medium max-w-2xl mx-auto text-sm sm:text-base">Pilih paket yang paling sesuai dengan kebutuhan instansi Anda. Nikmati fitur premium tanpa kompromi.</p>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Basic Semester -->
                <div class="bg-slate-50 rounded-[2.5rem] p-10 border border-slate-100 hover:border-brand-500/30 transition-all group">
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">6 Bulan</div>
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-2 italic">Basic Semester</h3>
                    <div class="mb-6">
                        <div class="text-[10px] font-bold text-slate-400 line-through opacity-50 mb-1">Rp 400.000</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400">Rp</span>
                            <span class="text-4xl font-black text-slate-900 tracking-tighter">200rb</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10 opacity-70">
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            10 Barcode Secure
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Branding
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Admin Dashboard
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Standard Support
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-white border border-slate-200 text-slate-900 text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">Pilih Paket</a>
                </div>

                <!-- Basic Annual -->
                <div class="bg-slate-900 rounded-[2.5rem] p-10 border border-slate-800 relative shadow-2xl scale-105 z-10">
                    <div class="absolute -top-4 left-1/2 -translate-x-1/2 px-4 py-1.5 bg-emerald-500 text-white rounded-full text-[8px] font-black uppercase tracking-[0.2em]">Paling Populer</div>
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">12 Bulan</div>
                    <h3 class="text-2xl font-black text-white uppercase tracking-tight mb-2 italic">Basic Annual</h3>
                    <div class="mb-6">
                        <div class="text-[10px] font-bold text-slate-500 line-through opacity-50 mb-1">Rp 700.000</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400 text-white/50">Rp</span>
                            <span class="text-4xl font-black text-white tracking-tighter">350rb</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10">
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-300">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            20 Barcode Secure
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-300">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Fitur Whitelist Domain
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-300">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Update Prioritas
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-300">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Hemat 50% (Flash Sale)
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-brand-500 text-white text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-brand-600 transition-all shadow-lg shadow-brand-500/20">Daftar Sekarang</a>
                </div>

                <!-- Exclusive Pro -->
                <div class="bg-slate-50 rounded-[2.5rem] p-10 border border-slate-100 hover:border-brand-500/30 transition-all group">
                    <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">3 Tahun (36 Bln)</div>
                    <h3 class="text-2xl font-black text-slate-900 uppercase tracking-tight mb-2 italic">Exclusive Pro</h3>
                    <div class="mb-6">
                        <div class="text-[10px] font-bold text-slate-400 line-through opacity-50 mb-1">Rp 1.500.000</div>
                        <div class="flex items-baseline gap-1">
                            <span class="text-lg font-bold text-slate-400">Rp</span>
                            <span class="text-4xl font-black text-slate-900 tracking-tighter">700rb</span>
                        </div>
                    </div>
                    <ul class="space-y-4 mb-10 opacity-70">
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            100 Barcode Secure
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Full Whitelabel
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Background App
                        </li>
                        <li class="flex items-center gap-3 text-xs font-bold text-slate-600">
                            <svg class="w-5 h-5 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Dukungan 3 Tahun Penuh
                        </li>
                    </ul>
                    <a href="{{ route('register') }}" class="block w-full py-4 bg-white border border-slate-200 text-slate-900 text-center rounded-2xl text-[10px] font-black uppercase tracking-[0.2em] hover:bg-slate-900 hover:text-white transition-all">Pilih Paket</a>
                </div>
            </div>
        </div>
    </section>



    <!-- Footer -->
    <footer class="py-8 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-8">
                <div class="flex items-center gap-1">
                    <div class="w-7 h-7 flex items-center justify-center">
                        <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="text-[15px] font-black flex items-center leading-none uppercase tracking-[-0.07em]">
                        <span class="text-slate-900">SCHOLA</span>
                        <span class="text-emerald-600 ml-0.5">EXAM</span>
                        <span class="text-slate-900">BRO</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-6">
                    <a href="{{ route('terms') }}" class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400 hover:text-emerald-600 transition-colors">Syarat & Ketentuan</a>
                    <a href="{{ route('privacy') }}" class="text-[9px] font-extrabold uppercase tracking-widest text-slate-400 hover:text-emerald-600 transition-colors">Kebijakan Privasi</a>
                </div>

                <div class="text-[9px] font-bold uppercase tracking-widest text-slate-400">
                    &copy; 2026 <span class="text-slate-500">CODIFI.ID</span>. All Rights Reserved.
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
    </script>
</body>
</html>
