@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

@php
    $user = Auth::user();
    $isSuperAdmin = $user->role === 'superadmin';
@endphp

<div class="space-y-8 animate-in fade-in duration-700">
    
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

    <!-- Header / Banner Area -->
    <div class="bg-gradient-to-r from-blue-600 to-indigo-700 rounded-[2.5rem] p-8 md:p-10 text-white shadow-xl shadow-blue-900/10 relative overflow-hidden">
        <!-- Decoration -->
        <div class="absolute top-0 right-0 p-4 opacity-10 pointer-events-none">
            <svg class="w-64 h-64" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2L2 7l10 5 10-5-10-5zm0 9l2.5-1.25L12 8.5l-2.5 1.25L12 11zm0 2.5l-5-2.5-5 2.5L12 22l10-8.5-5-2.5-5 2.5z"/></svg>
        </div>
        
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <span class="inline-block py-1 px-3 rounded-full bg-white/20 backdrop-blur-md text-[10px] font-black uppercase tracking-widest mb-3 border border-white/20">Dashboard Instansi</span>
                <h2 class="text-3xl md:text-4xl font-black tracking-tight mb-2">Halo, {{ Str::limit($user->name, 20) }} 👋</h2>
                <p class="text-blue-100 font-medium text-sm md:text-base opacity-90">{{ $user->school->name ?? 'Belum ada instansi' }}</p>
                
                <div class="mt-6 flex flex-wrap gap-4">
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 border border-white/10">
                        <span class="text-xs font-bold text-blue-100 uppercase tracking-wider">Status:</span>
                        @if($user->school && $user->school->is_active)
                            <span class="text-xs font-black text-emerald-300 uppercase tracking-widest flex items-center gap-1">
                                <span class="w-2 h-2 rounded-full bg-emerald-300 animate-pulse"></span> Aktif
                            </span>
                        @else
                            <span class="text-xs font-black text-red-300 uppercase tracking-widest">Suspend</span>
                        @endif
                    </div>
                    
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 border border-white/10">
                        <span class="text-xs font-bold text-blue-100 uppercase tracking-wider">Paket:</span>
                        <span class="text-xs font-black text-white uppercase tracking-widest">
                            {{ $user->school->subscription_type === 'year' ? 'Tahunan' : ($user->school->subscription_type === 'lifetime' ? 'Lifetime' : 'Trial 3 Hari') }}
                        </span>
                    </div>

                    @if($user->school->subscription_type !== 'lifetime')
                    <div class="flex items-center gap-2 bg-white/10 backdrop-blur-sm rounded-xl px-4 py-2 border border-white/10">
                        <span class="text-xs font-bold text-blue-100 uppercase tracking-wider">Exp:</span>
                        <span class="text-xs font-black text-white">
                            {{ $user->school->subscription_expires_at ? $user->school->subscription_expires_at->format('d M Y') : 'N/A' }}
                        </span>
                    </div>
                    @endif
                </div>
            </div>
            
            <div class="flex-shrink-0 flex flex-col gap-3">
               @if($user->school->subscription_type === 'trial')
               <a href="{{ route('subscription.index') }}" class="group bg-gradient-to-r from-amber-400 to-orange-500 text-white hover:brightness-110 transition-all rounded-2xl px-6 py-4 flex items-center gap-3 shadow-lg shadow-orange-500/30">
                   <div class="bg-white/20 rounded-xl p-2 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                   </div>
                   <div class="text-left">
                       <span class="block text-[10px] text-white/80 font-bold uppercase tracking-wider">Masa Trial</span>
                       <span class="block text-sm font-black uppercase tracking-tight">Upgrade Paket</span>
                   </div>
               </a>
               @endif

               <a href="{{ route('links.create') }}" class="group bg-white text-blue-600 hover:bg-blue-50 transition-all rounded-2xl px-6 py-4 flex items-center gap-3 shadow-lg shadow-black/5">
                   <div class="bg-blue-100 rounded-xl p-2 group-hover:bg-blue-200 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" /></svg>
                   </div>
                   <div class="text-left">
                       <span class="block text-[10px] text-slate-400 font-bold uppercase tracking-wider">Shortcut</span>
                       <span class="block text-sm font-black uppercase tracking-tight">Buat Barcode Baru</span>
                   </div>
               </a>
            </div>
        </div>
    </div>
    
    <!-- Stats Row User -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <!-- Total Links -->
        <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-sm border border-slate-100 dark:border-slate-700 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-indigo-50 dark:bg-indigo-900/20 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-indigo-100 dark:bg-indigo-900/40 rounded-2xl flex items-center justify-center text-indigo-600 dark:text-indigo-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.828 10.172a4 4 0 00-5.656 0l-4 4a4 4 0 105.656 5.656l1.102-1.101m-.758-4.899a4 4 0 005.656 0l4-4a4 4 0 00-5.656-5.656l-1.1 1.1" /></svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-1">{{ $stats['total_links'] }}</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Barcode Ujian Aktif</p>
                @if($user->school->subscription_type === 'trial')
                    <p class="mt-4 text-[10px] text-rose-500 font-bold bg-rose-50 dark:bg-rose-900/20 rounded-lg py-1 px-2 inline-block">Limit: 1 Barcode (Trial)</p>
                @endif
            </div>
        </div>

        <!-- Total Scans -->
        <div class="bg-white dark:bg-slate-800 rounded-[2rem] p-8 shadow-sm border border-slate-100 dark:border-slate-700 relative overflow-hidden group">
            <div class="absolute -right-6 -bottom-6 w-32 h-32 bg-emerald-50 dark:bg-emerald-900/20 rounded-full group-hover:scale-110 transition-transform duration-500"></div>
            <div class="relative z-10">
                <div class="w-12 h-12 bg-emerald-100 dark:bg-emerald-900/40 rounded-2xl flex items-center justify-center text-emerald-600 dark:text-emerald-400 mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" /><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" /></svg>
                </div>
                <h3 class="text-3xl font-black text-slate-900 dark:text-white mb-1">{{ number_format($stats['total_scans']) }}</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">Total Aktivitas Scan</p>
            </div>
        </div>
        
        <!-- Info Card -->
        <div class="bg-indigo-900 rounded-[2rem] p-8 shadow-lg relative overflow-hidden text-white flex flex-col justify-between">
            <div class="relative z-10">
                 <h4 class="font-bold text-lg mb-2">Pusat Bantuan</h4>
                 <p class="text-xs text-indigo-200 leading-relaxed mb-4">Butuh bantuan atau perpanjangan paket? Hubungi admin pusat kami.</p>
                 <a href="#" class="inline-block bg-white text-indigo-900 text-[10px] font-black uppercase tracking-widest px-4 py-3 rounded-xl hover:bg-indigo-50 transition-colors">Hubungi Support</a>
            </div>
            <div class="absolute right-0 bottom-0 opacity-10 pointer-events-none">
                <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 24 24"><path d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/></svg>
            </div>
        </div>
    </div>
    @endif

    <!-- Middle Row: Analytics (Common for both but simplified visuals for user) -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Traffic Analysis -->
        <div class="{{ $isSuperAdmin ? 'lg:col-span-8' : 'lg:col-span-12' }} bg-white dark:bg-slate-800 rounded-2xl p-8 shadow-sm border border-slate-100 dark:border-slate-700">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-sm font-black text-slate-800 dark:text-white uppercase tracking-tight">Statistik Aktivitas</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1 tracking-widest">Tren Pembuatan & Scan QR (12 Hari Terakhir)</p>
                </div>
            </div>
            <div id="mixed-chart" class="w-full h-[350px]"></div>
        </div>

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
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryColor = '#3b82f6';
        const secondaryColor = '#10b981';
        
        // Mixed Activity Chart
        // For User, we might focus more on Activity (Scans/Exams) and less on "Revenue" if it's 0
        new ApexCharts(document.querySelector("#mixed-chart"), {
            series: [{
                name: 'Pembuatan Link QR',
                type: 'column',
                data: @json($chartData['exams'])
            }, 
            @if($isSuperAdmin)
            {
                name: 'Pendapatan (IDR)',
                type: 'line',
                data: @json($chartData['revenue'])
            }
            @endif
            ],
            chart: { height: 350, type: 'line', stacked: false, toolbar: { show: false }, fontFamily: 'Outfit, sans-serif' },
            stroke: { width: [0, 3], curve: 'smooth' },
            colors: @if($isSuperAdmin) [primaryColor, secondaryColor] @else [primaryColor] @endif,
            plotOptions: { bar: { columnWidth: '45%', borderRadius: 8 } },
            fill: { opacity: [0.85, 1], type: ['solid', 'gradient'] },
            labels: @json($chartData['labels']),
            markers: { size: 4, colors: ['#fff'], strokeColors: secondaryColor, strokeWidth: 2 },
            xaxis: { axisBorder: { show: false }, axisTicks: { show: false }, labels: { style: { colors: '#94a3b8', fontSize: '10px', fontWeight: 600 } } },
            yaxis: [
                {
                    title: { text: "Aktivitas", style: { color: primaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                    labels: { style: { colors: '#94a3b8' } }
                }
                @if($isSuperAdmin)
                , {
                    opposite: true,
                    title: { text: "Revenue", style: { color: secondaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                    labels: { formatter: function(val) { return 'Rp ' + (val/1000) + 'k' }, style: { colors: '#94a3b8' } }
                }
                @endif
            ],
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            legend: { position: 'top', horizontalAlign: 'right', fontSize: '11px', fontWeight: 700, labels: { colors: '#64748b' } }
        }).render();

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
