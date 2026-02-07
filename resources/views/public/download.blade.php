<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png?v=3') }}">
    <title>Download Schola Exambro - Aplikasi Ujian Aman</title>
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
<body class="bg-[#f8fafc] text-slate-900 min-h-screen flex flex-col pt-24 lg:pt-32">
    <!-- Background Decor -->
    <div class="fixed inset-0 -z-10 overflow-hidden">
        <div class="absolute -top-[10%] -left-[10%] w-[40%] h-[40%] bg-blue-500/5 rounded-full blur-[120px]"></div>
        <div class="absolute top-[20%] -right-[5%] w-[30%] h-[30%] bg-indigo-500/5 rounded-full blur-[100px]"></div>
    </div>

    <!-- Navigation (Copied from welcome for consistency) -->
    <nav class="fixed top-0 w-full z-50 bg-white/80 backdrop-blur-md border-b border-slate-100 h-16 lg:h-24 flex items-center">
        <div class="max-w-7xl mx-auto px-6 w-full flex items-center justify-between">
            <a href="/" class="flex items-center gap-1.5 group">
                <div class="w-10 h-10 lg:w-12 lg:h-12 flex items-center justify-center group-hover:scale-110 transition-transform">
                    <img src="{{ asset('assets/images/logo.png?v=3') }}" alt="Logo" class="w-full h-full object-contain">
                </div>
                <div class="text-[18px] lg:text-[22px] font-black flex items-center leading-none tracking-[-0.07em]">
                    <span class="text-slate-900 uppercase">SCHOLA</span>
                    <span class="text-emerald-600 uppercase ml-0.5">EXAM</span>
                    <span class="text-slate-900 uppercase">BRO</span>
                </div>
            </a>
            <a href="/" class="px-6 py-3 bg-slate-900 text-white text-[10px] font-black uppercase tracking-widest rounded-2xl hover:bg-black transition-all">Kembali ke Home</a>
        </div>
    </nav>

    <!-- Content -->
    <div class="flex-grow flex items-center justify-center p-6 pb-24">
        <div class="max-w-4xl w-full">
            <div class="text-center mb-12">
                <div class="inline-flex items-center gap-3 px-4 py-2 bg-blue-50 border border-blue-100 rounded-full mb-6">
                    <span class="w-2 h-2 bg-blue-500 rounded-full animate-pulse"></span>
                    <span class="text-[10px] font-black text-blue-600 uppercase tracking-widest tracking-[0.2em]">Official Download Link</span>
                </div>
                <h1 class="text-3xl md:text-5xl font-extrabold tracking-tight mb-4 uppercase tracking-tighter">Pusat Unduhan <br class="sm:hidden"> <span class="text-emerald-500 italic">Schola Exambro</span></h1>
                <p class="text-slate-500 font-medium max-w-lg mx-auto text-sm leading-relaxed uppercase tracking-wide opacity-70">Satu aplikasi untuk seluruh jenjang pendidikan. Amankan integritas ujian sekolah Anda dengan teknologi lockdown browser terkini.</p>
            </div>

            <div class="grid md:grid-cols-2 gap-8">
                <!-- Windows Card -->
                <div class="glass-card rounded-[2.5rem] p-8 shadow-xl shadow-blue-500/5 flex flex-col hover:scale-[1.02] transition-transform duration-500 group">
                    <div class="w-14 h-14 bg-slate-900 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-slate-900/20 group-hover:bg-blue-600 transition-colors">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M0 3.449L9.75 2.1V11.59H0V3.449zm0 8.891h9.75v9.491L0 20.461v-8.121zm10.549-10.435L24 0v11.431h-13.451V1.905zm13.451 10.435L24 24l-13.451-1.939v-9.626H24z"/></svg>
                    </div>
                    <h2 class="text-xl font-black mb-2 uppercase tracking-tight tracking-[-0.02em]">Desktop Windows</h2>
                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wide leading-relaxed mb-8 flex-grow opacity-60">Optimasi untuk Windows 10 & 11. Fitur pengunci sistem total (Lockdown), blokir multitasking, dan proteksi pencatatan layar otomatis.</p>
                    
                    <div class="space-y-3">
                        <a href="{{ $settings['download_link_windows'] ?? '#' }}" 
                           class="block w-full bg-slate-900 text-center text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-black transition-all shadow-xl shadow-slate-900/20 {{ !isset($settings['download_link_windows']) ? 'opacity-50 cursor-not-allowed' : '' }}">
                           {{ isset($settings['download_link_windows']) ? 'Unduh Untuk Windows' : 'Belum Tersedia' }}
                        </a>
                        <div class="flex justify-between items-center px-1">
                             <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">v{{ $settings['app_version'] ?? '1.0.0' }}</span>
                             <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Secure Client</span>
                        </div>
                    </div>
                </div>

                <!-- Android Card -->
                <div class="glass-card rounded-[2.5rem] p-8 shadow-xl shadow-indigo-500/5 flex flex-col hover:scale-[1.02] transition-transform duration-500 group">
                    <div class="w-14 h-14 bg-emerald-500 rounded-2xl flex items-center justify-center text-white mb-6 shadow-lg shadow-emerald-500/20 group-hover:bg-slate-900 transition-colors">
                        <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 24 24"><path d="M17.523 15.3414C17.0456 15.3414 16.6585 14.9543 16.6585 14.4769C16.6585 13.9995 17.0456 13.6124 17.523 13.6124C18.0004 13.6124 18.3875 13.9995 18.3875 14.4769C18.3875 14.9543 18.0004 15.3414 17.523 15.3414ZM6.47699 15.3414C5.99958 15.3414 5.61251 14.9543 5.61251 14.4769C5.61251 13.9995 5.99958 13.6124 6.47699 13.6124C6.95439 13.6124 7.34146 13.9995 7.34146 14.4769C7.34146 14.9543 6.95439 15.3414 6.47699 15.3414ZM17.8631 6.01429L19.6826 2.86282C19.7828 2.68916 19.7233 2.46746 19.5497 2.36712C19.376 2.26685 19.1543 2.32634 19.054 2.49993L17.2104 5.6946C15.6841 5.00048 13.9213 4.6094 12.0001 4.6094C10.0788 4.6094 8.31603 5.00048 6.78972 5.6946L4.94611 2.49993C4.84584 2.32634 4.62414 2.26685 4.45048 2.36712C4.27681 2.46746 4.21733 2.68916 4.3176 2.86282L6.13706 6.01429C2.6953 7.85409 0.341461 11.4287 0.341461 15.5841H23.6585C23.6585 11.4287 21.3047 7.85409 17.8631 6.01429Z"/></svg>
                    </div>
                    <h2 class="text-xl font-black mb-2 uppercase tracking-tight tracking-[-0.02em]">Mobile Android</h2>
                    <p class="text-slate-500 text-[11px] font-bold uppercase tracking-wide leading-relaxed mb-8 flex-grow opacity-60">Lockdown browser untuk smartphone. Fitur scan otomatis, deteksi floating apps, dan penguncian tombol home/recent apps yang tangguh.</p>
                    
                    <div class="space-y-3">
                        <a href="{{ $settings['download_link_android'] ?? '#' }}" 
                           class="block w-full bg-slate-900 text-center text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] hover:bg-black transition-all shadow-xl shadow-slate-900/20 {{ !isset($settings['download_link_android']) ? 'opacity-50 cursor-not-allowed' : '' }}">
                           {{ isset($settings['download_link_android']) ? 'Unduh Untuk Android' : 'Belum Tersedia' }}
                        </a>
                        <div class="flex justify-between items-center px-1">
                             <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">v{{ $settings['app_version'] ?? '1.1.2' }}</span>
                             <span class="text-[9px] font-black text-emerald-500 uppercase tracking-widest">Safety Check OK</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer (Copied from welcome for consistency) -->
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
</body>
</html>
