@extends('layouts.admin')

@section('content')
@php
    $user = Auth::user();
    $isSuperAdmin = $user->role === 'superadmin';
@endphp

<!-- Compact Header: Welcome + Subscription -->
<div class="mb-6 flex flex-col lg:flex-row lg:items-center justify-between gap-4 bg-white p-6 rounded-3xl border border-slate-200 shadow-sm">
    <div class="flex items-center gap-4">
        <div class="w-12 h-12 bg-indigo-600 rounded-2xl flex items-center justify-center text-white text-xl shadow-lg shadow-indigo-200 overflow-hidden border border-white/20">
            @php
                $headerLogo = (!$isSuperAdmin && $user->school) ? $user->school->logo_url : null;
            @endphp
            
            @if($headerLogo)
                <img src="{{ $headerLogo }}" class="w-full h-full object-cover">
            @else
                👋
            @endif
        </div>
        <div>
            <h2 class="text-xl font-bold text-slate-900 leading-none">Hello, {{ explode(' ', $user->name)[0] }}!</h2>
            <p class="text-xs font-medium text-slate-400 mt-1 uppercase tracking-wider">
                {{ $isSuperAdmin ? 'SISTEM ADMINISTRATOR' : ($user->school ? $user->school->name : 'ADMINISTRATOR') }}
            </p>
        </div>
    </div>

    @if(!$isSuperAdmin && $user->school)
    <div class="flex items-center gap-6 bg-slate-50 px-5 py-3 rounded-2xl border border-slate-100">
        <div>
            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">BERLANGGANAN SAMPAI</span>
            <span class="text-sm font-black text-indigo-600 uppercase">
                {{ ($user->school && $user->school->subscription_expires_at) ? $user->school->subscription_expires_at->format('d M Y') : 'Life Time' }}
            </span>
        </div>
        <div class="h-8 w-[1px] bg-slate-200"></div>
        <div class="flex items-center gap-2">
            @if($user->school && $user->school->isSubscriptionActive())
                <span class="h-2 w-2 rounded-full bg-emerald-500 animate-pulse"></span>
                <span class="text-[10px] font-black text-emerald-600 uppercase">Active</span>
            @else
                <span class="h-2 w-2 rounded-full bg-rose-500"></span>
                <span class="text-[10px] font-black text-rose-600 uppercase">Expired / N/A</span>
            @endif
        </div>
    </div>
    @endif
</div>

<!-- Compact Stats Row -->
<div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
    @if($isSuperAdmin)
    <div class="bg-white p-5 rounded-3xl border border-slate-200 flex items-center gap-4">
        <div class="w-10 h-10 bg-indigo-50 text-indigo-600 rounded-xl flex items-center justify-center text-lg">🏫</div>
        <div>
            <div class="text-lg font-black text-slate-900 leading-none">{{ $stats['total_schools'] }}</div>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Instansi</div>
        </div>
    </div>
    @else
    <div class="bg-white p-5 rounded-3xl border border-slate-200 flex items-center gap-4">
        <div class="w-10 h-10 {{ ($user->school && $user->school->subscription_type === 'trial') ? 'bg-rose-50 text-rose-600' : 'bg-amber-50 text-amber-600' }} rounded-xl flex items-center justify-center text-lg">
            {{ ($user->school && $user->school->subscription_type === 'trial') ? '🎁' : '👑' }}
        </div>
        <div>
            <div class="text-lg font-black text-slate-900 leading-none uppercase">
                {{ ($user->school && $user->school->subscription_type === 'trial') ? 'Trial Mode' : 'Premium' }}
            </div>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Status Akun</div>
        </div>
    </div>
    @endif

    <div class="bg-white p-5 rounded-3xl border border-slate-200 flex items-center gap-4">
        <div class="w-10 h-10 bg-emerald-50 text-emerald-600 rounded-xl flex items-center justify-center text-lg">⚡</div>
        <div>
            <div class="text-lg font-black text-slate-900 leading-none">{{ $stats['active_links'] }}</div>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Ujian Aktif</div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 flex items-center gap-4">
        <div class="w-10 h-10 bg-slate-50 text-slate-600 rounded-xl flex items-center justify-center text-lg">📊</div>
        <div>
            <div class="text-lg font-black text-slate-900 leading-none">{{ $stats['total_links'] }}</div>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Total Scan QR</div>
        </div>
    </div>

    <div class="bg-white p-5 rounded-3xl border border-slate-200 flex items-center gap-4">
        <div class="w-10 h-10 bg-blue-50 text-blue-600 rounded-xl flex items-center justify-center text-lg">🛡️</div>
        <div>
            <div class="text-lg font-black text-slate-900 leading-none">SECURE</div>
            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest mt-1">Handshake API</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-6 items-start">
    <!-- Left: Integration Status (More compact) -->
    <div class="lg:col-span-8">
        <div class="bg-white rounded-3xl border border-slate-200 overflow-hidden shadow-sm">
            <div class="px-6 py-4 border-b border-slate-50 bg-slate-50/30">
                <h4 class="text-sm font-black text-slate-900 uppercase tracking-widest">Detail Integrasi Instansi</h4>
            </div>
            <div class="p-6">
                @foreach($latestSchools as $school)
                <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 p-4 bg-slate-50/50 rounded-2xl border border-slate-100">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-indigo-600 rounded-xl flex items-center justify-center text-white font-black text-xs shadow-md overflow-hidden border border-white/20">
                            @if($school->logo_url)
                                <img src="{{ $school->logo_url }}" class="w-full h-full object-cover">
                            @else
                                {{ $school->initials }}
                            @endif
                        </div>
                        <div>
                            <div class="text-sm font-bold text-slate-900">{{ $school->name }}</div>
                            <div class="text-[10px] font-medium text-slate-400">ID: SECURE-ID-{{ $school->id }}</div>
                        </div>
                    </div>
                    
                    <div class="flex items-center gap-8">
                        <div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1 text-center">Whitelist Domain</span>
                            <code class="text-[11px] font-bold text-indigo-600 bg-white px-3 py-1 rounded-lg border border-slate-200">{{ $school->domain_whitelist }}</code>
                        </div>
                        <div>
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest block mb-1 text-center">Status Akses</span>
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-100 px-3 py-1 text-[9px] font-black text-emerald-600 border border-emerald-200 uppercase">
                                <span class="h-1 w-1 rounded-full bg-emerald-600"></span>
                                AKTIF
                            </span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <!-- Right: Quick Action Banner (Sleeker) -->
    <div class="lg:col-span-4">
        <div class="bg-indigo-600 rounded-[2rem] p-8 shadow-xl shadow-indigo-100 relative overflow-hidden flex flex-col items-center text-center">
            <div class="relative z-10">
                <div class="w-12 h-12 bg-white/20 rounded-2xl flex items-center justify-center text-white text-xl mx-auto mb-4">✨</div>
                <h4 class="text-xl font-black text-white mb-2 leading-tight uppercase tracking-tight">Generate QR Ujian</h4>
                <p class="text-[11px] text-indigo-100/80 font-medium mb-6">Buat link akses Google Form / CBT yang aman untuk siswa Anda sekarang.</p>
                <a href="{{ route('links.index') }}" class="inline-flex items-center gap-2 bg-white px-6 py-4 rounded-2xl text-indigo-600 font-bold text-xs uppercase tracking-widest shadow-lg hover:scale-105 transition-transform">
                    <span>➕</span> Buat QR Baru
                </a>
            </div>
            <!-- Decorative circle -->
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-white/10 rounded-full"></div>
        </div>

        <div class="mt-4 bg-slate-900 rounded-3xl p-6 text-center lg:text-left">
            <h5 class="text-[9px] font-black text-slate-500 uppercase tracking-[0.2em] mb-3">Sistem Status</h5>
            <div class="flex items-center justify-center lg:justify-start gap-4">
                <div class="flex -space-x-2">
                    <div class="w-6 h-6 rounded-full border-2 border-slate-900 bg-emerald-500"></div>
                    <div class="w-6 h-6 rounded-full border-2 border-slate-900 bg-indigo-500 text-[8px] flex items-center justify-center text-white font-black">API</div>
                </div>
                <div class="text-[10px] font-bold text-slate-400 uppercase">Semua Sistem Normal</div>
            </div>
        </div>
    </div>
</div>
@endsection
