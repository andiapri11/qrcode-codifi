<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
    <title>{{ $title ?? 'Admin' }} | Schola Exambro</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa',
                            500: '#3C50E0', 600: '#2b39cc', 700: '#222ca3', 800: '#1e2685', 900: '#1d236b',
                        }
                    }
                }
            }
        }
    </script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            transition: background-color 0.3s ease, color 0.3s ease;
        }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        
        /* Sidebar Active State Customization */
        .sidebar-item-active { 
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            color: white !important;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
        }
        .sidebar-item-active svg { color: white !important; }
        
        .dark .sidebar-item-active {
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
        }

        .glass-header {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(241, 245, 249, 1);
        }
        .dark .glass-header {
            background: rgba(15, 23, 42, 0.8);
            border-bottom: 1px solid rgba(30, 41, 59, 1);
        }
    </style>
</head>
<body class="bg-slate-50 dark:bg-[#080c14] text-slate-900 dark:text-slate-100 min-h-screen transition-colors duration-300">
    <!-- Page Wrapper -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar (Premium Minimalist) -->
        <aside id="sidebar" class="absolute left-0 top-0 z-50 flex h-screen w-72 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-[#0f172a] duration-300 ease-in-out lg:static lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full w-full">
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between px-8 py-10">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-2.5 group">
                        <div class="w-10 h-10 bg-brand-500 rounded-[12px] flex items-center justify-center text-white shadow-lg shadow-brand-500/20 group-hover:scale-105 transition-transform">
                            <svg class="w-6 h-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2L4 5V11C4 16.1 7.4 20.9 12 22C16.6 20.9 20 16.1 20 11V5L12 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <circle cx="12" cy="11" r="3" stroke="currentColor" stroke-width="2"/>
                                <path d="M12 14V17" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </div>
                        <div class="leading-none flex flex-col justify-center">
                            <h1 class="text-slate-900 dark:text-white text-lg font-black tracking-tighter uppercase whitespace-nowrap flex items-center">
                                <span>SCHOLA</span>
                                <span class="text-brand-500 ml-1">EXAMBRO</span>
                            </h1>
                            <span class="text-[8px] font-bold text-slate-400 dark:text-slate-500 tracking-[0.2em] uppercase mt-0.5">Admin Panel</span>
                        </div>
                    </a>
                </div>

                <!-- Sidebar Content -->
                <div class="flex-1 overflow-y-auto no-scrollbar px-6 py-4">
                    <nav class="space-y-2">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('dashboard') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Dashboard</span>
                        </a>

                        <!-- Instansi / Schools -->
                        <a href="{{ route('schools.index') }}" class="flex items-center justify-between px-4 py-3.5 rounded-2xl transition-all {{ request()->is('schools*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="font-bold text-sm tracking-tight">{{ Auth::user()->role === 'superadmin' ? 'Data Instansi' : 'Profil Instansi' }}</span>
                            </div>
                            @if(Auth::user()->role === 'superadmin')
                            <span class="bg-blue-600 text-white text-[8px] font-black px-2 py-0.5 rounded-full uppercase tracking-tighter">New</span>
                            @endif
                        </a>

                        <div class="pt-6 pb-2 px-4">
                            <span class="text-slate-400 dark:text-slate-600 text-[10px] font-black uppercase tracking-[0.2em]">CBT Tools</span>
                        </div>

                        <!-- Secure QR -->
                        <a href="{{ route('links.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('links*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Barcode Ujian</span>
                        </a>

                        <div class="pt-6 pb-2 px-4">
                            <span class="text-slate-400 dark:text-slate-600 text-[10px] font-black uppercase tracking-[0.2em]">Management</span>
                        </div>

                        <!-- My Profile -->
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('profile*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Profil Saya</span>
                        </a>

                        <!-- Subscription & Billing -->
                        <a href="{{ route('subscription.index') }}" class="flex items-gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('subscription*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Langganan & Billing</span>
                        </a>

                        @if(Auth::user()->role === 'superadmin')
                        <!-- Internal Admin Management -->
                        <a href="{{ route('users.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('users*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Manajemen Admin</span>
                        </a>

                        <!-- Partner Management -->
                        <a href="{{ route('partners.index') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('partners*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Manajemen Mitra</span>
                        </a>

                        <!-- System Settings -->
                        <a href="{{ route('admin.settings') }}" class="flex items-center gap-3 px-4 py-3.5 rounded-2xl transition-all {{ request()->is('settings*') ? 'sidebar-item-active' : 'text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800/50 hover:text-blue-600' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37a1.724 1.724 0 002.572-1.065z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span class="font-bold text-sm tracking-tight">Pengaturan Sistem</span>
                        </a>
                        @endif
                    </nav>
                </div>

                <!-- Sidebar Footer -->
                <div class="p-6 border-t border-slate-100 dark:border-slate-800">
                    <div class="flex items-center gap-4 bg-slate-50 dark:bg-slate-800/50 p-3 rounded-2xl">
                        <div class="h-10 w-10 bg-blue-600 rounded-full flex items-center justify-center text-white font-black text-xs uppercase">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <div class="overflow-hidden">
                            <p class="text-xs font-black text-slate-800 dark:text-white truncate uppercase">{{ Auth::user()->name }}</p>
                            <p class="text-[9px] font-bold text-slate-400 dark:text-slate-500 tracking-wider uppercase mt-0.5">{{ Auth::user()->role }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="glass-header px-8 py-5 flex items-center justify-between z-40">
                <div class="flex items-center gap-6">
                    <button id="mobileToggle" class="lg:hidden p-2 bg-white dark:bg-slate-800 border border-slate-200 dark:border-slate-700 rounded-xl text-slate-500">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                </div>
                
                <div class="flex items-center gap-4">
                    <!-- Dark Mode Toggle -->
                    <button onclick="toggleDarkMode()" class="p-2.5 bg-slate-100 dark:bg-slate-800 rounded-xl hover:bg-slate-200 dark:hover:bg-slate-700 transition-all text-slate-500">
                        <svg id="moonIcon" class="w-5 h-5 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                        <svg id="sunIcon" class="w-5 h-5 text-yellow-500 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                    </button>

                    <div class="h-8 w-[1px] bg-slate-200 dark:bg-slate-800 mx-1"></div>

                    <!-- User Actions -->
                    <div class="flex items-center gap-3">
                        <a href="{{ route('logout.get') }}" class="flex items-center gap-2 p-2.5 bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded-xl hover:bg-red-50 dark:hover:bg-red-900/20 hover:text-red-600 dark:hover:text-red-400 transition-all border border-slate-200 dark:border-slate-700 group" title="Keluar">
                            <svg class="w-5 h-5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                            </svg>
                            <span class="text-xs font-black tracking-tight uppercase hidden sm:inline">Keluar</span>
                        </a>
                    </div>
                </div>
            </header>

            <!-- Main Content Scroll -->
            <main class="flex-1 overflow-y-auto no-scrollbar flex flex-col p-6 md:p-8">
                <div class="max-w-screen-2xl mx-auto flex-1 w-full">
                    @yield('content')
                </div>

                <!-- Premium Integrated Footer -->
                <footer class="mt-auto pt-16 pb-8">
                    <div class="flex flex-col items-center justify-center space-y-4">
                        <div class="flex items-center gap-6 md:gap-8">
                            <a href="{{ route('help') }}" class="text-[9px] font-black text-slate-400 hover:text-indigo-600 dark:hover:text-blue-400 uppercase tracking-[0.2em] transition-all">Bantuan</a>
                            <span class="w-1 h-1 bg-slate-200 dark:bg-slate-800 rounded-full"></span>
                            <a href="{{ route('terms') }}" class="text-[9px] font-black text-slate-400 hover:text-indigo-600 dark:hover:text-blue-400 uppercase tracking-[0.2em] transition-all">Syarat</a>
                            <span class="w-1 h-1 bg-slate-200 dark:bg-slate-800 rounded-full"></span>
                            <a href="{{ route('privacy') }}" class="text-[9px] font-black text-slate-400 hover:text-indigo-600 dark:hover:text-blue-400 uppercase tracking-[0.2em] transition-all">Privasi</a>
                        </div>
                        
                        <div class="flex items-center gap-2.5 px-6 py-2 bg-white/40 dark:bg-slate-800/40 backdrop-blur-sm rounded-full border border-slate-100 dark:border-slate-800/50 shadow-sm">
                            <span class="text-[8px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest">© 2026</span>
                            <div class="w-1 h-1 bg-slate-200 dark:bg-slate-700 rounded-full"></div>
                            <span class="text-[9px] font-black text-slate-800 dark:text-white uppercase tracking-tighter">Schola <span class="text-indigo-600">CBT</span></span>
                            <span class="text-[8px] font-bold text-slate-300 dark:text-slate-600 uppercase tracking-widest">Enterprise</span>
                        </div>
                    </div>
                </footer>
            </main>
        </div>
    </div>

    <!-- Custom High-Fidelity Modal -->
    <div id="customModal" class="hidden fixed inset-0 z-[9999] flex items-center justify-center p-6 bg-slate-950/60 backdrop-blur-md animate-in fade-in duration-300">
        <div class="bg-[#1a1617] w-full max-w-[400px] rounded-[1.5rem] shadow-2xl border border-white/5 overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="modalContent">
            <div class="p-8 text-left">
                <h3 id="modalTitle" class="text-lg font-bold text-white tracking-tight mb-4"></h3>
                <p id="modalText" class="text-sm font-medium text-slate-300 leading-relaxed mb-8"></p>
                
                <div class="flex flex-row-reverse items-center gap-3">
                    <button id="modalPrimaryBtn" class="px-8 py-3 rounded-full bg-[#ffc1cf] text-[#6d2d3e] font-black text-xs uppercase tracking-widest hover:bg-[#ffb1c2] transition-all">
                        Tetap Keluar
                    </button>
                    <button id="modalSecondaryBtn" onclick="closeCustomModal()" class="px-8 py-3 rounded-full bg-[#4a232e] text-white font-black text-xs uppercase tracking-widest hover:bg-[#5a2d39] transition-all">
                        Batal
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const mobileToggle = document.getElementById('mobileToggle');

        mobileToggle.addEventListener('click', (e) => {
            e.stopPropagation();
            sidebar.classList.toggle('-translate-x-full');
        });

        document.addEventListener('click', (e) => {
            if (!sidebar.contains(e.target) && !mobileToggle.contains(e.target)) {
                sidebar.classList.add('-translate-x-full');
            }
        });

        // Dark Mode Logic (Default to Light Mode)
        if (localStorage.getItem('dark-mode') === 'true') {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
        }

        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark-mode', isDark);
        }

        // Custom Modal Logic
        function showAlert(title, text, type = 'info', onConfirm = null) {
            const modal = document.getElementById('customModal');
            const content = document.getElementById('modalContent');
            const titleEl = document.getElementById('modalTitle');
            const textEl = document.getElementById('modalText');
            const primaryBtn = document.getElementById('modalPrimaryBtn');
            const secondaryBtn = document.getElementById('modalSecondaryBtn');

            titleEl.innerText = title;
            textEl.innerText = text;

            if (onConfirm) {
                primaryBtn.style.display = 'block';
                secondaryBtn.style.display = 'block';
                primaryBtn.innerText = 'Leave';
                secondaryBtn.innerText = 'Cancel';
                primaryBtn.onclick = function() {
                    onConfirm();
                    closeCustomModal();
                };
            } else {
                primaryBtn.style.display = 'block';
                secondaryBtn.style.display = 'none';
                primaryBtn.innerText = 'OK';
                primaryBtn.onclick = closeCustomModal;
            }

            modal.classList.remove('hidden');
            setTimeout(() => {
                content.classList.remove('scale-95', 'opacity-0');
                content.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeCustomModal() {
            const modal = document.getElementById('customModal');
            const content = document.getElementById('modalContent');
            
            content.classList.add('scale-95', 'opacity-0');
            content.classList.remove('scale-100', 'opacity-100');
            
            setTimeout(() => {
                modal.classList.add('hidden');
            }, 300);
        }

        window.addEventListener('profile-photo-updated', (event) => {
            // Refreshes profile parts if needed
            location.reload(); 
        });

        // Language placeholder for future scalability
        function changeLanguage(lang) {
            localStorage.setItem('app-lang', lang);
            location.reload();
        }
    </script>
</body>
</html>
