<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Admin' }} | Schola CBT</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .sidebar-item-active { background-color: #EEF2FF; color: #4F46E5; }
        .sidebar-item-hover:hover { background-color: #F8FAFC; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900">
    <!-- Page Wrapper -->
    <div class="flex h-screen overflow-hidden">

        <!-- Sidebar (Light Premium Style) -->
        <aside id="sidebar" class="absolute left-0 top-0 z-50 flex h-screen w-72 border-r border-slate-200 bg-white duration-300 ease-linear lg:static lg:translate-x-0 -translate-x-full">
            <div class="flex flex-col h-full w-full">
                <!-- Sidebar Header -->
                <div class="flex items-center justify-between px-6 py-8">
                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-10 h-10">
                        <span class="text-slate-900 text-xl font-extrabold tracking-tight uppercase">Schola <span class="text-indigo-600">CBT</span></span>
                    </a>
                </div>

                <!-- Sidebar Content -->
                <div class="flex-1 overflow-y-auto no-scrollbar px-4 py-4">
                    <nav class="space-y-1">
                        <!-- Dashboard -->
                        <a href="{{ route('dashboard') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all {{ request()->is('dashboard') ? 'sidebar-item-active' : 'text-slate-600 sidebar-item-hover' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->is('dashboard') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z" />
                                </svg>
                                <span class="font-semibold text-sm">Dashboard</span>
                            </div>
                            <svg class="w-4 h-4 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" /></svg>
                        </a>

                        <!-- AI / Schools -->
                        @if(Auth::user()->role === 'superadmin')
                        <a href="{{ route('schools.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all text-slate-600 sidebar-item-hover {{ request()->is('schools*') ? 'sidebar-item-active' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->is('schools*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                                </svg>
                                <span class="font-semibold text-sm">Data Instansi</span>
                            </div>
                            <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tighter">New</span>
                        </a>
                        @endif



                        <div class="pt-6 pb-2 px-4">
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">Support Tools</span>
                        </div>

                        <!-- Secure QR -->
                        <a href="{{ route('links.index') }}" class="flex items-center justify-between px-4 py-3 rounded-xl transition-all text-slate-600 sidebar-item-hover {{ request()->is('links*') ? 'sidebar-item-active' : '' }}">
                            <div class="flex items-center gap-3">
                                <svg class="w-5 h-5 {{ request()->is('links*') ? 'text-indigo-600' : 'text-slate-400' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                                <span class="font-semibold text-sm">Data Barcode Ujian</span>
                            </div>
                            <span class="bg-emerald-50 text-emerald-600 text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tighter">New</span>
                        </a>

                        <!-- Chat / Log -->
                        <a href="#" class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 sidebar-item-hover">
                            <svg class="w-5 h-5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z" />
                            </svg>
                            <span class="font-semibold text-sm">System Chat</span>
                        </a>
                    </nav>
                </div>

            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header class="bg-white border-b border-slate-200 px-8 py-4 flex items-center justify-between">
                <button id="mobileToggle" class="lg:hidden p-2 bg-slate-50 border border-slate-200 rounded-lg text-slate-500">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    </svg>
                </button>
                <div class="flex items-center gap-4">
                    <div class="hidden md:flex items-center bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 w-96 group focus-within:border-indigo-300 focus-within:bg-white transition-all">
                        <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        <input type="text" placeholder="Cari data instansi atau link..." class="bg-transparent border-none outline-none ml-2 text-sm w-full font-medium">
                    </div>
                </div>
                <div class="flex items-center gap-6">
                    <!-- User Profile & Logout in Header -->
                    <div class="flex items-center gap-4 border-l border-slate-200 pl-6 h-10">
                        <div class="flex flex-col text-right hidden sm:flex">
                            <span class="text-slate-900 text-sm font-bold leading-none mb-1">{{ Auth::user()->name }}</span>
                            <span class="text-slate-400 text-[10px] font-bold uppercase tracking-widest">{{ Auth::user()->role }}</span>
                        </div>
                        
                        @php
                            $user = Auth::user();
                            $profileLogo = ($user->role === 'school_admin' && $user->school) ? $user->school->logo_url : null;
                        @endphp

                        <div id="header-profile-box" class="h-10 w-10 bg-indigo-600 rounded-full flex items-center justify-center text-white font-bold shadow-indigo-100 shadow-md overflow-hidden border border-slate-100">
                            @if($profileLogo)
                                <img id="header-profile-img" src="{{ $profileLogo }}" class="w-full h-full object-cover">
                            @else
                                <span id="header-profile-initials">{{ ($user->role === 'school_admin' && $user->school) ? $user->school->initials : substr($user->name, 0, 1) }}</span>
                            @endif
                        </div>
                        
                        <form action="{{ route('logout') }}" method="POST" class="ml-2">
                            @csrf
                            <button type="submit" class="p-2.5 bg-slate-100 text-slate-600 rounded-xl hover:bg-red-50 hover:text-red-600 transition-all shadow-sm border border-slate-200 group" title="Sign Out">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                                </svg>
                            </button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content Scroll -->
            <main class="flex-1 overflow-y-auto no-scrollbar p-8">
                <div class="max-w-screen-2xl mx-auto">
                    @yield('content')
                </div>
            </main>
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

        // Event listener for profile photo updates
        window.addEventListener('profile-photo-updated', (event) => {
            const headerImg = document.getElementById('header-profile-img');
            const headerInitials = document.getElementById('header-profile-initials');
            const profileBox = document.getElementById('header-profile-box');

            if (event.detail.url) {
                if (headerImg) {
                    headerImg.src = event.detail.url + '?t=' + new Date().getTime();
                } else {
                    const img = document.createElement('img');
                    img.id = 'header-profile-img';
                    img.src = event.detail.url + '?t=' + new Date().getTime();
                    img.className = 'w-full h-full object-cover';
                    if (headerInitials) headerInitials.remove();
                    profileBox.appendChild(img);
                }
            }
        });
    </script>
</body>
</html>
