<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png?v=3') }}">

    <title>Schola Exambro | Premium Exam Browser Management</title>

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
    <nav class="fixed top-0 w-full z-50 glass">
        <div class="max-w-7xl mx-auto px-6 h-16 flex items-center justify-between">
            <div class="flex items-center gap-0.5">
                <div class="w-10 h-10 flex items-center justify-center">
                    <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-[20px] font-black flex items-center leading-none tracking-[-0.07em]">
                    <span class="text-slate-900 uppercase">SCHOLA</span>
                    <span class="text-emerald-600 uppercase ml-0.5">EXAM</span>
                    <span class="text-slate-900 uppercase">BRO</span>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-brand-500 transition-colors">Fitur</a>
                <a href="#solutions" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-brand-500 transition-colors">Solusi</a>
                <a href="#pricing" class="text-[11px] font-black uppercase tracking-widest text-slate-500 hover:text-brand-500 transition-colors">Harga</a>
            </div>

            <div class="flex items-center gap-4">
                @if (Route::has('login'))
                    @auth
                        <a href="{{ url('/dashboard') }}" class="px-6 py-2.5 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-black transition-all">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-500 hover:text-brand-500 transition-colors">Masuk</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="px-6 py-2.5 bg-brand-500 text-white text-[10px] font-black uppercase tracking-widest rounded-xl hover:bg-brand-600 shadow-lg shadow-brand-500/20 transition-all">Daftar Sekarang</a>
                        @endif
                    @endauth
                @endif
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="relative pt-32 pb-16 overflow-hidden">
        <div class="absolute inset-0 hero-pattern z-0"></div>
        <div class="absolute top-40 right-0 w-96 h-96 bg-brand-500/10 rounded-full blur-[120px] -mr-48"></div>
        <div class="absolute bottom-20 left-0 w-96 h-96 bg-emerald-500/10 rounded-full blur-[120px] -ml-48"></div>

        <div class="max-w-7xl mx-auto px-6 relative z-10">
            <div class="flex flex-col lg:flex-row items-center gap-16">
                <div class="flex-1 text-center lg:text-left">
                    <div class="inline-flex items-center gap-3 px-4 py-2 bg-brand-50 border border-brand-100 rounded-full mb-6">
                        <span class="w-2 h-2 bg-brand-500 rounded-full animate-pulse"></span>
                        <span class="text-[10px] font-black text-brand-600 uppercase tracking-widest">Platform Exambro #1 di Indonesia</span>
                    </div>
                    <h1 class="text-5xl lg:text-7xl font-black text-slate-900 leading-[1] mb-2 uppercase tracking-tighter">
                        Amankan Ujian Digital <br> Dengan <span class="text-emerald-500">Eksklusivitas</span>
                    </h1>
                    <p class="text-lg text-slate-500 font-medium mb-5 max-w-2xl leading-relaxed">
                        Schola Exambro memberikan perlindungan maksimal untuk ujian online sekolah Anda. Kustomisasi penuh branding instansi, anti-curang tingkat tinggi, dan kemudahan manajemen QR Code.
                    </p>
                    <div class="flex flex-col sm:flex-row items-center justify-center lg:justify-start gap-4 mb-4">
                        <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-slate-900 border border-slate-900 text-white rounded-2xl font-black text-[11px] uppercase tracking-[0.2em] transition-all hover:bg-black hover:scale-105 active:scale-95 shadow-2xl">
                            Mulai Sekarang
                        </a>
                        <a href="https://play.google.com/store/apps/details?id=com.codifi.schola" target="_blank" class="w-full sm:w-auto h-[60px] transition-all hover:scale-105 active:scale-95 -ml-4">
                            <img src="https://play.google.com/intl/en_us/badges/static/images/badges/en_badge_web_generic.png" alt="Get it on Google Play" class="h-full object-contain">
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
                    <div class="relative z-10 animate-float">
                        <div class="bg-white rounded-[2.5rem] shadow-2xl border border-slate-200 overflow-hidden relative">
                            <div class="h-8 bg-slate-900 flex items-center px-6 gap-2">
                                <div class="w-2 h-2 rounded-full bg-rose-500"></div>
                                <div class="w-2 h-2 rounded-full bg-amber-500"></div>
                                <div class="w-2 h-2 rounded-full bg-emerald-500"></div>
                            </div>
                            <div class="p-8">
                                <div class="flex items-center justify-between mb-8">
                                    <div class="w-24 h-4 bg-slate-100 rounded-full"></div>
                                    <div class="w-10 h-10 bg-brand-50 text-brand-500 rounded-xl flex items-center justify-center">
                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a6 6 0 00-6 6v3.586l-.707.707A1 1 0 004 14h12a1 1 0 00.707-1.707L16 11.586V8a6 6 0 00-6-6zM10 18a3 3 0 01-3-3h6a3 3 0 01-3 3z"/></svg>
                                    </div>
                                </div>
                                <div class="space-y-4">
                                    <div class="h-20 bg-slate-50 rounded-2xl border border-dashed border-slate-200 flex items-center justify-center">
                                        <div class="flex flex-col items-center gap-2 text-slate-400">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/></svg>
                                            <span class="text-[8px] font-black uppercase tracking-widest">Logo Sekolah Anda</span>
                                        </div>
                                    </div>
                                    <div class="grid grid-cols-2 gap-4">
                                        <div class="h-12 bg-indigo-50 rounded-xl border border-indigo-100 p-3">
                                            <div class="w-12 h-2 bg-indigo-200 rounded-full"></div>
                                        </div>
                                        <div class="h-12 bg-emerald-50 rounded-xl border border-emerald-100 p-3">
                                            <div class="w-12 h-2 bg-emerald-200 rounded-full"></div>
                                        </div>
                                    </div>
                                    <div class="h-24 bg-slate-900 rounded-2xl p-4 flex flex-col justify-end">
                                        <div class="w-20 h-2 bg-white/20 rounded-full mb-2"></div>
                                        <div class="w-32 h-3 bg-white/40 rounded-full"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="features" class="py-32 bg-white">
        <div class="max-w-7xl mx-auto px-6">
            <div class="text-center mb-24">
                <h2 class="text-[10px] font-black text-brand-500 uppercase tracking-[0.4em] mb-4">Fitur Unggulan</h2>
                <h3 class="text-4xl lg:text-5xl font-black text-slate-900 uppercase tracking-tight">Lebih Dari Sekadar <br> Browser Ujian</h3>
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

    <!-- Call to Action -->
    <section class="py-24 bg-slate-900 relative overflow-hidden">
        <div class="absolute inset-0 bg-brand-500/5 z-0"></div>
        <div class="max-w-5xl mx-auto px-6 text-center relative z-10">
            <h2 class="text-3xl lg:text-5xl font-black text-white uppercase tracking-tight mb-10 leading-tight">
                Tingkatkan Derajat Ujian Digital <br> Di Instansi Anda Sekarang
            </h2>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-6">
                <a href="{{ route('register') }}" class="w-full sm:w-auto px-10 py-5 bg-brand-500 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:bg-brand-600 hover:scale-105 transition-all shadow-xl shadow-brand-500/20">
                    Coba Gratis 3 Hari
                </a>
                <a href="https://wa.me/your-number" target="_blank" class="w-full sm:w-auto px-10 py-5 bg-white/10 backdrop-blur-md border border-white/10 text-white rounded-2xl font-black text-xs uppercase tracking-[0.3em] hover:bg-white/20 transition-all flex items-center justify-center gap-3">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z" /></svg>
                    Diskusi Projek
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="py-16 bg-white border-t border-slate-100">
        <div class="max-w-7xl mx-auto px-6">
            <div class="flex flex-col md:flex-row justify-between items-center gap-10">
                <div class="flex items-center gap-0.5">
                    <div class="w-8 h-8 flex items-center justify-center">
                        <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo Icon" class="w-full h-full object-contain">
                    </div>
                    <div class="text-[17px] font-black flex items-center leading-none uppercase tracking-[-0.07em]">
                        <span class="text-slate-900">SCHOLA</span>
                        <span class="text-emerald-600 ml-0.5">EXAM</span>
                        <span class="text-slate-900">BRO</span>
                    </div>
                </div>
                
                <div class="flex items-center gap-8">
                    <a href="{{ route('terms') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-500 transition-colors">Syarat & Ketentuan</a>
                    <a href="{{ route('privacy') }}" class="text-[10px] font-black uppercase tracking-widest text-slate-400 hover:text-brand-500 transition-colors">Kebijakan Privasi</a>
                </div>

                <div class="text-[10px] font-black uppercase tracking-widest text-slate-400">
                    &copy; 2025 CODIFI.ID. All Rights Reserved.
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
