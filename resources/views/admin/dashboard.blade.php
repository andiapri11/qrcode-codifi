@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@php
    $user = Auth::user();
    $isSuperAdmin = $user->role === 'superadmin';
@endphp

<div class="space-y-5 animate-in fade-in duration-700">
    
    @if($isSuperAdmin)
    <!-- ========================================================= -->
    <!-- SUPERADMIN VIEW -->
    <!-- ========================================================= -->
    <!-- Top Row: Functional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Mitra Berlangganan -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Mitra Berlangganan</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $stats['subscribed_schools'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Mitra</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 dark:bg-slate-700 rounded-xl flex items-center justify-center text-slate-400 dark:text-slate-500 border border-slate-100 dark:border-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
        </div>

        <!-- Total Omset -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Omset</p>
                <div class="flex items-center gap-1">
                    <span class="text-[11px] font-black text-slate-400">Rp</span>
                    <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 dark:bg-slate-700 rounded-xl flex items-center justify-center text-slate-400 dark:text-slate-500 border border-slate-100 dark:border-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3m0-12V3m0 18v-3" /></svg>
            </div>
        </div>

        <!-- Total Scan -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Global Scan QR</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $stats['total_scans'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Times</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 dark:bg-slate-700 rounded-xl flex items-center justify-center text-slate-400 dark:text-slate-500 border border-slate-100 dark:border-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h2m12 0h2M4 6h18M4 18h2m0-12v12m8-12v12m8-12v12M4 6h18M4 18h18" /></svg>
            </div>
        </div>

        <!-- Total User Mitra -->
        <div class="bg-white dark:bg-slate-800 rounded-2xl p-6 shadow-sm border border-slate-100 dark:border-slate-700 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Akun Mitra</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $stats['total_users'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Akun</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 dark:bg-slate-700 rounded-xl flex items-center justify-center text-slate-400 dark:text-slate-500 border border-slate-100 dark:border-slate-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
        </div>
    </div>
    @else
    
    <!-- ========================================================= -->
    <!-- USER (SCHOOL ADMIN) VIEW -->
    <!-- ========================================================= -->

    @php
        $isPremium = $user->school && $user->school->subscription_type !== 'trial';
    @endphp
    <!-- Header / Banner Area -->
    <div class="{{ $isPremium ? 'bg-gradient-to-br from-[#1e1b4b] via-[#312e81] to-[#4338ca]' : 'bg-gradient-to-br from-[#3b59f8] to-[#4338ca]' }} rounded-[2rem] p-5 md:p-6 text-white shadow-2xl shadow-blue-900/10 relative overflow-hidden">
        <!-- Background Decorative Shapes -->
        <div class="absolute top-0 right-0 w-full h-full pointer-events-none opacity-[0.07]">
            <svg class="w-full h-full" viewBox="0 0 100 100" preserveAspectRatio="none">
                <path d="M50 0 L100 50 L50 100 L0 50 Z" fill="white"/>
            </svg>
        </div>
        
        <div class="relative z-10 flex flex-col lg:flex-row lg:items-center justify-between gap-10">
            <div class="flex-1">
                <div class="inline-flex items-center px-4 py-1 rounded-full bg-white/20 backdrop-blur-md border border-white/20 mb-3 shadow-sm">
                    <span class="text-[8px] font-extrabold uppercase tracking-[0.15em] text-white">Dashboard Instansi</span>
                </div>
                
                <h2 class="text-2xl md:text-3xl font-black tracking-tight mb-1 flex items-center gap-3">
                    Halo, {{ strtolower(explode(' ', $user->name)[0]) }} 👋
                    @if($user->school && $user->school->subscription_type !== 'trial')
                        <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-emerald-400/20 backdrop-blur-sm border border-emerald-400/30 rounded-full text-[10px] font-black uppercase tracking-widest text-emerald-300 shadow-lg shadow-emerald-500/10">
                            <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z" /></svg>
                            PRO
                        </span>
                    @endif
                </h2>
                <p class="text-blue-100 font-bold text-xs opacity-90 mb-4">{{ strtolower($user->school->name ?? 'belum ada instansi') }}</p>
                
                <div class="flex flex-wrap gap-2">
                    <!-- Status -->
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-[10px] rounded-lg px-3 py-1.5 border border-white/10">
                        <span class="text-[8px] font-black uppercase tracking-widest text-blue-50">Status:</span>
                        <div class="flex items-center gap-1">
                            @php
                                $isActive = $user->school && $user->school->isSubscriptionActive();
                            @endphp
                            <span class="w-1.5 h-1.5 rounded-full {{ $isActive ? 'bg-[#34d399]' : 'bg-rose-500' }}"></span>
                            <span class="text-[8px] font-black uppercase tracking-widest {{ $isActive ? 'text-[#34d399]' : 'text-rose-500' }}">
                                {{ $isActive ? 'Aktif' : 'Non-Aktif' }}
                            </span>
                        </div>
                    </div>
                    
                    <!-- Paket -->
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-[10px] rounded-lg px-3 py-1.5 border border-white/10">
                        <span class="text-[8px] font-black uppercase tracking-widest text-blue-50">Paket:</span>
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">
                            @if($user->school)
                                {{ $user->school->subscription_type === 'trial' ? 'Masa Trial' : ($user->school->subscription_type === 'lifetime' ? 'Lifetime' : 'Premium') }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
 
                    <!-- Exp -->
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-[10px] rounded-lg px-3 py-1.5 border border-white/10">
                        <span class="text-[8px] font-black uppercase tracking-widest text-blue-50">Exp:</span>
                        <span class="text-[8px] font-black uppercase tracking-widest text-white">
                            @if($user->school)
                                {{ $user->school->subscription_type === 'lifetime' ? '∞' : ($user->school->subscription_expires_at ? $user->school->subscription_expires_at->format('d M y') : '-') }}
                            @else
                                -
                            @endif
                        </span>
                    </div>
                </div>
            </div>
            
            <!-- Right-side Buttons -->
            <div class="flex-shrink-0 flex flex-col gap-3 w-full lg:w-[280px]">
                @php
                    $subType = $user->school->subscription_type ?? 'trial';
                    $isTrial = $subType === 'trial';
                @endphp

                <!-- Subscription Action Button -->
                @if($isTrial)
                <!-- Upgrade Button (Trial) -->
                <a href="{{ route('subscription.index') }}" class="group relative bg-gradient-to-r from-[#ffb129] to-[#ff7d1f] rounded-2xl p-3.5 flex items-center gap-3.5 shadow-xl shadow-orange-600/30 border border-white/20 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-colors shrink-0">
                         <svg class="w-5 h-5 text-white fill-current" viewBox="0 0 24 24"><path d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-[8px] text-white/90 font-black uppercase tracking-widest mb-0.5 leading-none">Masa Trial</span>
                        <span class="block text-sm font-black uppercase tracking-tight leading-none">Upgrade Paket</span>
                    </div>
                </a>
                @else
                <!-- Manage Button (Premium/Lifetime) -->
                <a href="{{ route('subscription.index') }}" class="group relative bg-gradient-to-r from-[#6366f1] to-[#4f46e5] rounded-2xl p-3.5 flex items-center gap-3.5 shadow-xl shadow-indigo-600/20 border border-white/10 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300">
                    <div class="w-10 h-10 bg-white/20 rounded-xl flex items-center justify-center backdrop-blur-sm group-hover:bg-white/30 transition-colors shrink-0">
                         <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                    </div>
                    <div class="text-left">
                        <span class="block text-[8px] text-white/90 font-black uppercase tracking-widest mb-0.5 leading-none">{{ $subType === 'lifetime' ? 'Lifetime Access' : ($isActive ? 'Paket Aktif' : 'Paket Expired') }}</span>
                        <span class="block text-sm font-black uppercase tracking-tight leading-none">{{ !$isActive ? 'Perbarui Paket' : 'Atur Layanan' }}</span>
                    </div>
                    <!-- Indicator Dot -->
                    <div class="absolute top-3 right-3">
                        <span class="flex h-2 w-2">
                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full {{ $isActive ? 'bg-emerald-400' : 'bg-rose-400' }} opacity-75"></span>
                            <span class="relative inline-flex rounded-full h-2 w-2 {{ $isActive ? 'bg-emerald-500' : 'bg-rose-500' }}"></span>
                        </span>
                    </div>
                </a>
                @endif

               <!-- Shortcut Button -->
               @php
                   $canCreate = $user->school && $user->school->canCreateMoreLinks();
               @endphp

                @if(!$canCreate)
               <div class="group relative bg-slate-100 rounded-2xl p-3.5 flex items-center gap-3.5 border border-slate-200 opacity-80 cursor-not-allowed">
                   <div class="w-10 h-10 bg-slate-200 rounded-xl flex items-center justify-center text-slate-400 shrink-0">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" /></svg>
                   </div>
                   <div class="text-left">
                       <span class="block text-[8px] text-slate-400 font-black uppercase tracking-widest mb-0.5 leading-none">{{ !$isActive ? 'Masa Habis' : 'Limit Tercapai' }}</span>
                       <span class="block text-sm font-black uppercase tracking-tight leading-none text-slate-400">Barcode Terkunci</span>
                   </div>
               </div>
               @else
               <a href="{{ route('links.create') }}" class="group relative bg-white rounded-2xl p-3.5 flex items-center gap-3.5 shadow-xl shadow-black/5 hover:scale-[1.02] active:scale-[0.98] transition-all duration-300 border border-slate-100">
                   <div class="w-10 h-10 bg-[#eff6ff] rounded-xl flex items-center justify-center group-hover:bg-[#dbeafe] transition-colors shrink-0">
                        <svg class="w-5 h-5 text-[#3b82f6]" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                   </div>
                   <div class="text-left">
                       <span class="block text-[8px] text-slate-400 font-black uppercase tracking-widest mb-0.5 leading-none">Shortcut</span>
                       <span class="block text-sm font-black uppercase tracking-tight leading-none text-slate-800">Buat Barcode Baru</span>
                   </div>
               </a>
               @endif
            </div>
        </div>
    </div>
    
    <!-- Stats Row User -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Links -->
        <div class="bg-white dark:bg-slate-800 rounded-[1.5rem] p-5 shadow-sm border border-slate-100 dark:border-slate-700 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-indigo-50 dark:bg-indigo-900/20 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-11 h-11 bg-indigo-100 dark:bg-indigo-900/40 rounded-xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white leading-none">{{ $stats['total_links'] }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Barcode Aktif</p>
                </div>
            </div>
        </div>

        <!-- Total Scans -->
        <div class="bg-white dark:bg-slate-800 rounded-[1.5rem] p-5 shadow-sm border border-slate-100 dark:border-slate-700 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-24 h-24 bg-emerald-50 dark:bg-emerald-900/20 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10 flex items-center gap-4">
                <div class="w-11 h-11 bg-emerald-100 dark:bg-emerald-900/40 rounded-xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <div>
                    <h3 class="text-2xl font-black text-slate-900 dark:text-white leading-none">{{ number_format($stats['total_scans']) }}</h3>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Total Scan</p>
                </div>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="bg-indigo-900 rounded-[1.5rem] p-5 shadow-lg relative overflow-hidden text-white flex flex-col justify-between h-full">
            <div class="relative z-10">
                 <h4 class="font-bold text-sm mb-1 uppercase tracking-tight">Pusat Bantuan</h4>
                 <p class="text-[10px] text-indigo-200 leading-snug mb-3">Butuh bantuan atau perpanjangan paket?</p>
                 <a href="#" class="inline-block bg-white text-indigo-900 text-[9px] font-black uppercase tracking-widest px-4 py-2 rounded-lg hover:bg-indigo-50 transition-colors">Hubungi Support</a>
            </div>
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none translate-x-4 translate-y-4">
                <svg class="w-20 h-20" fill="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
        </div>
    </div>
    @endif

    <!-- Middle Row: Analytics (Common for both but simplified visuals for user) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Traffic Analysis -->
        @if($isSuperAdmin)
        <div class="lg:col-span-8 bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-tight">Statistik Aktivitas</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1 tracking-widest">Tren Pembuatan & Scan QR (12 Hari Terakhir)</p>
                </div>
            </div>
            <div id="mixed-chart" class="w-full h-[350px]"></div>
        </div>
        @endif

        @if($isSuperAdmin)
        <!-- System Utilization (Superadmin Only) -->
        <div class="lg:col-span-4 bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-tight">Utilisasi Resource</h4>
                <button class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-300">⚙️</button>
            </div>
            
            <div class="relative flex-1 flex flex-col items-center justify-center py-6">
                <div id="main-radial" class="w-full"></div>
                <div class="mt-4 w-full px-4 space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">CPU Load</span>
                            <span class="text-blue-600 font-black text-xs">{{ $stats['server_cpu'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full rounded-full transition-all duration-1000" style="width: {{ $stats['server_cpu'] }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">RAM Usage</span>
                            <span class="text-emerald-600 font-black text-xs">{{ $stats['server_ram'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 dark:bg-slate-700 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded-full transition-all duration-1000" style="width: {{ $stats['server_ram'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
    <!-- Guide / Steps Section -->
    @if(!$isSuperAdmin)
    <div class="lg:col-span-12 mt-4 mb-4">
        <div class="flex flex-col sm:flex-row sm:items-end justify-between gap-4 mb-6 px-1">
            <div>
                <span class="text-[9px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-[0.2em] mb-1.5 block">Quick Start Guide</span>
                <h4 class="text-xl md:text-2xl font-black text-slate-900 dark:text-white tracking-tight leading-none">Petunjuk Penggunaan</h4>
                <p class="text-[9px] font-semibold text-slate-400 dark:text-slate-500 mt-1.5 uppercase tracking-widest leading-none">Kelola ujian digital dalam 4 langkah mudah</p>
            </div>
            <a href="#" class="inline-flex items-center gap-2 text-[9px] font-black text-slate-600 dark:text-slate-400 hover:text-blue-600 dark:hover:text-blue-400 bg-white dark:bg-slate-800 border border-slate-100 dark:border-slate-700 px-4 py-2.5 rounded-xl transition-all shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                UNDUH PANDUAN (PDF)
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
            <!-- Step 1 -->
            <div class="group relative bg-white dark:bg-slate-800 p-6 rounded-[2rem] border border-slate-50 dark:border-slate-700/50 shadow-sm hover:shadow-lg transition-all duration-500">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 dark:text-blue-400 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-blue-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[8px] font-black bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 px-2 py-0.5 rounded-full uppercase tracking-tighter">Mulai</span>
                </div>
                <h5 class="text-sm font-black text-slate-900 dark:text-white mb-2 tracking-tight">Konfigurasi Tautan</h5>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 leading-relaxed font-bold opacity-80">Daftarkan URL ujian di menu <b>"Data Barcode"</b> untuk generate QR.</p>
            </div>
            
            <!-- Step 2 -->
            <div class="group relative bg-white dark:bg-slate-800 p-6 rounded-[2rem] border border-slate-50 dark:border-slate-700/50 shadow-sm hover:shadow-lg transition-all duration-500">
                <div class="w-12 h-12 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-indigo-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[8px] font-black bg-indigo-100 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 px-2 py-0.5 rounded-full uppercase tracking-tighter">Distribusi</span>
                </div>
                <h5 class="text-sm font-black text-slate-900 dark:text-white mb-2 tracking-tight">Distribusi QR</h5>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 leading-relaxed font-bold opacity-80">Cetak atau tampilkan QR Code kepada seluruh siswa peserta ujian.</p>
            </div>

            <!-- Step 3 -->
            <div class="group relative bg-white dark:bg-slate-800 p-6 rounded-[2rem] border border-slate-50 dark:border-slate-700/50 shadow-sm hover:shadow-lg transition-all duration-500">
                <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-400 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-emerald-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z" /></svg>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[8px] font-black bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 px-2 py-0.5 rounded-full uppercase tracking-tighter">Aktivasi</span>
                </div>
                <h5 class="text-sm font-black text-slate-900 dark:text-white mb-2 tracking-tight">Aplikasi Client</h5>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 leading-relaxed font-bold opacity-80 mb-4">Gunakan <b>Schola ExamBrowser</b> untuk scan & mengerjakan ujian.</p>
                <a href="#" class="inline-flex items-center justify-between w-full bg-slate-900 dark:bg-slate-700 text-white px-4 py-2 rounded-xl group/btn hover:bg-black transition-colors">
                    <span class="text-[9px] font-black uppercase tracking-widest">Get App</span>
                    <svg class="w-3.5 h-3.5 group-hover/btn:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/></svg>
                </a>
            </div>

            <!-- Step 4 -->
            <div class="group relative bg-white dark:bg-slate-800 p-6 rounded-[2rem] border border-slate-50 dark:border-slate-700/50 shadow-sm hover:shadow-lg transition-all duration-500">
                <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-400 rounded-2xl flex items-center justify-center mb-5 group-hover:bg-amber-600 group-hover:text-white transition-all duration-500 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" /></svg>
                </div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="text-[8px] font-black bg-amber-100 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 px-2 py-0.5 rounded-full uppercase tracking-tighter">Pantau</span>
                </div>
                <h5 class="text-sm font-black text-slate-900 dark:text-white mb-2 tracking-tight">Monitoring Realtime</h5>
                <p class="text-[10px] text-slate-500 dark:text-slate-400 leading-relaxed font-bold opacity-80">Pantau kehadiran dan progres siswa selama ujian berlangsung.</p>
            </div>
        </div>
    </div>
    @endif

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryColor = '#3b82f6';
        const secondaryColor = '#10b981';
        
        @if($isSuperAdmin)
        // Mixed Activity Chart
        // For User, we might focus more on Activity (Scans/Exams) and less on "Revenue" if it's 0
        new ApexCharts(document.querySelector("#mixed-chart"), {
            series: [{
                name: 'Pembuatan Link QR',
                type: 'column',
                data: @json($chartData['exams'])
            }, 
            {
                name: 'Pendapatan (IDR)',
                type: 'line',
                data: @json($chartData['revenue'])
            }
            ],
            chart: { height: 350, type: 'line', stacked: false, toolbar: { show: false }, fontFamily: 'Outfit, sans-serif' },
            stroke: { width: [0, 3], curve: 'smooth' },
            colors: [primaryColor, secondaryColor],
            plotOptions: { bar: { columnWidth: '45%', borderRadius: 8 } },
            fill: { opacity: [0.85, 1], type: ['solid', 'gradient'] },
            labels: @json($chartData['labels']),
            markers: { size: 4, colors: ['#fff'], strokeColors: secondaryColor, strokeWidth: 2 },
            xaxis: { axisBorder: { show: false }, axisTicks: { show: false }, labels: { style: { colors: '#94a3b8', fontSize: '10px', fontWeight: 600 } } },
            yaxis: [
                {
                    title: { text: "Aktivitas", style: { color: primaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                    labels: { style: { colors: '#94a3b8' } }
                }, 
                {
                    opposite: true,
                    title: { text: "Revenue", style: { color: secondaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                    labels: { formatter: function(val) { return 'Rp ' + (val/1000) + 'k' }, style: { colors: '#94a3b8' } }
                }
            ],
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            legend: { position: 'top', horizontalAlign: 'right', fontSize: '11px', fontWeight: 700, labels: { colors: '#64748b' } }
        }).render();
        @endif

        @if($isSuperAdmin)
        // Main Radial Progress
        new ApexCharts(document.querySelector("#main-radial"), {
            series: [{{ round(($stats['server_cpu'] + $stats['server_ram']) / 2) }}],
            chart: { height: 300, type: 'radialBar' },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    hollow: { size: '70%', },
                    track: { background: '#f1f5f9', strokeWidth: '97%' },
                    dataLabels: {
                        name: { show: true, fontSize: '11px', fontWeight: 900, color: '#94a3b8', offsetY: -10, text: 'AVG LOAD' },
                        value: { show: true, fontSize: '36px', fontWeight: 900, color: '#1e293b', offsetY: 15, formatter: (v) => v + '%' }
                    }
                }
            },
            colors: ['#3b82f6'],
            fill: { type: 'gradient', gradient: { shade: 'dark', type: 'horizontal', gradientToColors: ['#60a5fa'], stops: [0, 100] } }
        }).render();
        @endif
    });
</script>
@endsection
