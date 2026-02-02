@extends('layouts.admin')

@section('content')
@php
    $user = Auth::user();
    $isSuperAdmin = $user->role === 'superadmin';
@endphp

<!-- Header Section: Welcome & Context -->
<div class="mb-8 flex flex-col lg:flex-row lg:items-center justify-between gap-6 bg-white dark:bg-slate-900 p-6 md:p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm transition-all">
    <div class="flex items-center gap-5">
        <div class="w-16 h-16 bg-blue-600 rounded-[1.2rem] flex items-center justify-center text-white text-2xl shadow-xl shadow-blue-200 dark:shadow-none overflow-hidden border-2 border-white dark:border-slate-700">
            @php
                $headerLogo = (!$isSuperAdmin && $user->school) ? $user->school->logo_url : null;
            @endphp
            
            @if($headerLogo)
                <img src="{{ $headerLogo }}" class="w-full h-full object-cover">
            @else
                <span class="font-black">👋</span>
            @endif
        </div>
        <div>
            <h2 class="text-2xl font-black text-slate-900 dark:text-white leading-tight tracking-tight uppercase">Halo, {{ explode(' ', $user->name)[0] }}!</h2>
            <p class="text-xs font-bold text-slate-400 dark:text-slate-500 mt-1 uppercase tracking-[0.2em]">
                {{ $isSuperAdmin ? 'System Administrator' : ($user->school ? $user->school->name : 'Administrator') }}
            </p>
        </div>
    </div>

    @if(!$isSuperAdmin && $user->school)
    <div class="flex items-center gap-6 bg-slate-50 dark:bg-slate-800/50 px-6 py-4 rounded-3xl border border-slate-100 dark:border-slate-800 transition-all">
        <div class="text-center lg:text-left">
            <span class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest block mb-1">Masa Berlangganan</span>
            <span class="text-sm font-black text-blue-600 dark:text-blue-400 uppercase tracking-tighter">
                {{ ($user->school && $user->school->subscription_expires_at) ? $user->school->subscription_expires_at->format('d M Y') : 'Life Time' }}
            </span>
        </div>
        <div class="h-10 w-[1px] bg-slate-200 dark:bg-slate-700"></div>
        <div class="flex items-center gap-2">
            @if($user->school && $user->school->isSubscriptionActive())
                <span class="flex h-2.5 w-2.5 relative">
                    <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-emerald-400 opacity-75"></span>
                    <span class="relative inline-flex rounded-full h-2.5 w-2.5 bg-emerald-500"></span>
                </span>
                <span class="text-[10px] font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-wider">Aktif</span>
            @else
                <span class="h-2.5 w-2.5 rounded-full bg-rose-500"></span>
                <span class="text-[10px] font-black text-rose-600 dark:text-rose-500 uppercase tracking-wider">Expired</span>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Key Performance Stats -->
    @if($isSuperAdmin)
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-blue-200 dark:hover:border-blue-900 transition-all">
        <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🏫</div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $stats['total_schools'] }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Total Instansi</div>
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-blue-200 dark:hover:border-blue-900 transition-all">
        <div class="w-12 h-12 {{ ($user->school && $user->school->subscription_type === 'trial') ? 'bg-rose-50 dark:bg-rose-900/20 text-rose-600' : 'bg-amber-50 dark:bg-amber-900/20 text-amber-600' }} rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">
            {{ ($user->school && $user->school->subscription_type === 'trial') ? '🎁' : '💎' }}
        </div>
        <div>
            <div class="text-lg font-black text-slate-900 dark:text-white leading-none tracking-tighter uppercase">{{ $user->school->subscription_type === 'trial' ? 'Uji Coba' : 'Pro Plan' }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Status Lisensi</div>
        </div>
    </div>
    @endif

    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-emerald-200 dark:hover:border-emerald-900 transition-all">
        <div class="w-12 h-12 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">⚡</div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $stats['active_links'] }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Ujian Aktif</div>
        </div>
    </div>

    @if($isSuperAdmin)
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-amber-200 dark:hover:border-amber-900 transition-all">
        <div class="w-12 h-12 bg-amber-50 dark:bg-amber-900/20 text-amber-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">💰</div>
        <div>
            <div class="text-xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Total Pendapatan</div>
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-purple-200 dark:hover:border-purple-900 transition-all">
        <div class="w-12 h-12 bg-purple-50 dark:bg-purple-900/20 text-purple-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">📊</div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $stats['total_links'] }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Total Link QR</div>
        </div>
    </div>
    @endif

    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 group hover:border-slate-300 dark:hover:border-slate-700 transition-all">
        <div class="w-12 h-12 bg-slate-50 dark:bg-slate-800 text-slate-600 rounded-2xl flex items-center justify-center text-xl group-hover:scale-110 transition-transform">🛡️</div>
        <div>
            <div class="text-lg font-black text-slate-900 dark:text-white leading-none tracking-tighter uppercase">Secure</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-1.5">Handshake API</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Left: Content Tables -->
    <div class="lg:col-span-8 space-y-8">
        <!-- Latest Schools Table -->
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/20">
                <h4 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">{{ $isSuperAdmin ? 'Pendaftaran Instansi Terbaru' : 'Tinjauan Keamanan QR' }}</h4>
                <a href="{{ $isSuperAdmin ? route('schools.index') : route('links.index') }}" class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest hover:underline">Lihat Semua</a>
            </div>
            <div class="p-6 md:p-8 space-y-4">
                @foreach($latestSchools as $school)
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-5 bg-slate-50/50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800 group hover:border-blue-200 dark:hover:border-blue-900 transition-colors">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-sm shadow-lg overflow-hidden border-2 border-white dark:border-slate-700">
                            @if($school->logo_url)
                                <img src="{{ $school->logo_url }}" class="w-full h-full object-cover">
                            @else
                                {{ $school->initials }}
                            @endif
                        </div>
                        <div>
                            <div class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $school->name }}</div>
                            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-1">ID: <span class="text-blue-600 dark:text-blue-400">SECURE-{{ str_pad($school->id, 4, '0', STR_PAD_LEFT) }}</span></div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 lg:gap-10">
                        <div class="text-center">
                            <span class="text-[10px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-widest block mb-1.5">Whitelist Domain</span>
                            <code class="text-[11px] font-black text-blue-600 dark:text-blue-400 bg-white dark:bg-slate-800 px-4 py-1.5 rounded-xl border border-slate-200 dark:border-slate-700 tracking-tight">{{ $school->domain_whitelist ?? 'N/A' }}</code>
                        </div>
                        <div class="text-center">
                            <span class="text-[10px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-widest block mb-1.5">Status Filter</span>
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 dark:bg-emerald-900/20 px-4 py-1.5 text-[10px] font-black text-emerald-600 dark:text-emerald-500 border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600 shadow-[0_0_8px_#10b981]"></span>
                                Aktif
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        @if($isSuperAdmin && $latestTransactions->isNotEmpty())
        <!-- Latest Transactions Table -->
        <div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
            <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-slate-50/50 dark:bg-slate-800/20">
                <h4 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">Transaksi Terbaru</h4>
                <a href="{{ route('subscription.index') }}" class="text-[10px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest hover:underline">Semua Transaksi</a>
            </div>
            <div class="p-6 md:p-8 space-y-4">
                @foreach($latestTransactions as $trx)
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-5 bg-slate-50/50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800 group hover:border-emerald-200 dark:hover:border-emerald-900 transition-colors">
                    <div class="flex items-center gap-5">
                        <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/20 text-emerald-600 rounded-2xl flex items-center justify-center text-xl shadow-sm border border-emerald-100 dark:border-emerald-900/30">
                            💰
                        </div>
                        <div>
                            <div class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $trx->school->name }}</div>
                            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-1">Ref: {{ $trx->reference }}</div>
                        </div>
                    </div>
                    
                    <div class="flex flex-wrap items-center gap-6 lg:gap-10">
                        <div class="text-center">
                            <span class="text-[10px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-widest block mb-1.5">Nominal</span>
                            <span class="text-sm font-black text-slate-900 dark:text-white">Rp {{ number_format($trx->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="text-center">
                            <span class="text-[10px] font-black text-slate-400 dark:text-slate-600 uppercase tracking-widest block mb-1.5">Waktu Bayar</span>
                            <span class="text-[10px] font-bold text-slate-500">{{ $trx->paid_at->format('d M, H:i') }}</span>
                        </div>
                        <div class="text-center">
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 dark:bg-emerald-900/20 px-4 py-1.5 text-[10px] font-black text-emerald-600 dark:text-emerald-500 border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-widest">
                                BERHASIL
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Right: Sidebar & Quick Actions -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Quick Action Card -->
        <div class="bg-blue-600 rounded-[2.5rem] p-8 shadow-2xl shadow-blue-200 dark:shadow-none relative overflow-hidden flex flex-col items-center text-center">
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-md rounded-2.5xl flex items-center justify-center text-white text-2xl mx-auto mb-6 border border-white/30">✨</div>
                <h4 class="text-2xl font-black text-white mb-3 uppercase tracking-tighter leading-tight">Buat Link <br>QR Ujian</h4>
                <p class="text-xs text-blue-100/70 font-bold mb-8 leading-relaxed uppercase tracking-wider">Automasi keamanan ujian <br>digital instansi Anda sekarang.</p>
                <a href="{{ route('links.index') }}" class="inline-flex items-center gap-3 bg-white px-8 py-5 rounded-2xl text-blue-600 font-extrabold text-[10px] uppercase tracking-[0.2em] shadow-xl hover:scale-105 transition-transform active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
                    Data Barcode
                </a>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-10 -bottom-10 w-40 h-40 bg-white/10 rounded-full blur-2xl"></div>
            <div class="absolute -left-10 -top-10 w-32 h-32 bg-blue-400/20 rounded-full blur-2xl"></div>
        </div>

        <!-- System Health -->
        <div class="bg-slate-900 dark:bg-slate-950 rounded-[2rem] p-8 border border-slate-800">
            <h5 class="text-[10px] font-black text-slate-500 uppercase tracking-[0.3em] mb-6">Status Keamanan Sistem</h5>
            <div class="space-y-6">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></div>
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Main Engine</span>
                    </div>
                    <span class="text-[9px] font-black text-emerald-500 uppercase">Operational</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 rounded-full bg-emerald-500 shadow-[0_0_10px_#10b981]"></div>
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Handshake API</span>
                    </div>
                    <span class="text-[9px] font-black text-emerald-500 uppercase">Operational</span>
                </div>
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-4">
                        <div class="w-2 h-2 rounded-full bg-blue-500 animate-pulse shadow-[0_0_10px_#3b82f6]"></div>
                        <span class="text-xs font-black text-slate-300 uppercase tracking-widest">Secure Database</span>
                    </div>
                    <span class="text-[9px] font-black text-blue-500 uppercase">Synced</span>
                </div>
            </div>
            
            <div class="mt-8 pt-6 border-t border-slate-800 flex items-center gap-4">
                <div class="flex -space-x-2">
                    <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-blue-600 flex items-center justify-center text-[10px] font-black text-white uppercase italic">S</div>
                    <div class="w-8 h-8 rounded-full border-2 border-slate-900 bg-slate-700 flex items-center justify-center text-[8px] font-black text-white uppercase tracking-tighter">CBT</div>
                </div>
                <div class="text-[10px] font-black text-slate-500 uppercase tracking-widest leading-none">Global Network Infrastructure</div>
            </div>
        </div>
    </div>
</div>
@endsection
