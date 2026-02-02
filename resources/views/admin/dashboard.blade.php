@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Top Row: Functional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Subscribed Schools -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-blue-200 transition-colors">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <div class="p-1.5 bg-blue-50 text-blue-600 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Mitra Aktif</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 text-xs">▲</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['subscribed_schools'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Mitra</span>
                </div>
            </div>
            <div id="radial-1" class="w-16 h-16"></div>
        </div>

        <!-- Total Link / Asset -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-indigo-200 transition-colors">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <div class="p-1.5 bg-indigo-50 text-indigo-600 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h2m12 0h2M4 6h18M4 18h2m0-12v12m8-12v12m8-12v12M4 6h18M4 18h18" /></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Asset Link QR</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_links'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Aset</span>
                </div>
            </div>
            <div id="radial-2" class="w-16 h-16"></div>
        </div>

        <!-- Revenue Total -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-amber-200 transition-colors">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <div class="p-1.5 bg-amber-50 text-amber-600 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3m0-12V3m0 18v-3" /></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Total Revanue</p>
                </div>
                <div class="flex items-center">
                    <span class="text-[11px] font-black text-slate-400 mr-1">Rp</span>
                    <span class="text-xl font-black text-slate-800 tracking-tighter">{{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div id="radial-3" class="w-16 h-16"></div>
        </div>

        <!-- Total Users (Partner Admins) -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-emerald-200 transition-colors">
            <div class="flex flex-col">
                <div class="flex items-center gap-2 mb-2">
                    <div class="p-1.5 bg-emerald-50 text-emerald-600 rounded-lg">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" /></svg>
                    </div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">User Admin</p>
                </div>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 text-xs">+</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_users'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Akun</span>
                </div>
            </div>
            <div id="radial-4" class="w-16 h-16"></div>
        </div>
    </div>

    <!-- Middle Row: Operational Analytics -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Traffic Analysis (Scan vs Billing) -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Monitoring Aktivitas Sistem</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1 tracking-widest">Aktivitas Scan QR vs Transaksi Masuk</p>
                </div>
            </div>
            <div id="mixed-chart" class="w-full h-[350px]"></div>
        </div>

        <!-- System Utilization / Target -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-8 shadow-sm border border-slate-100 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Utilisasi Resource</h4>
                <button class="text-slate-400 hover:text-slate-600">⚙️</button>
            </div>
            
            <div class="relative flex-1 flex flex-col items-center justify-center py-6">
                <div id="main-radial" class="w-full"></div>
                <div class="mt-4 w-full px-4 space-y-4">
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">CPU Load</span>
                            <span class="text-blue-600 font-black text-xs">{{ $stats['server_cpu'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-blue-600 h-full rounded-full transition-all duration-1000" style="width: {{ $stats['server_cpu'] }}%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="flex items-center justify-between mb-2">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">RAM Usage</span>
                            <span class="text-emerald-600 font-black text-xs">{{ $stats['server_ram'] }}%</span>
                        </div>
                        <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                            <div class="bg-emerald-600 h-full rounded-full transition-all duration-1000" style="width: {{ $stats['server_ram'] }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Financial & Usage Summary -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 text-sm">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Omzet</p>
                <span class="font-black text-slate-800 tracking-tight">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
            </div>
            <span class="text-emerald-500 font-bold text-[10px]">+14%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Total Scan Berhasil</p>
                <span class="font-black text-slate-800 tracking-tight">{{ number_format($stats['total_scans'], 0, ',', '.') }} Scan</span>
            </div>
            <span class="text-blue-500 font-bold text-[10px]">▲ 8%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Biaya Ops (Est)</p>
                <span class="font-black text-slate-800 tracking-tight">Rp {{ number_format($stats['total_revenue'] * 0.05, 0, ',', '.') }}</span>
            </div>
            <span class="text-rose-500 font-bold text-[10px]">▼ 5%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Surplus Sistem</p>
                <span class="font-black text-emerald-600 tracking-tight">Rp {{ number_format($stats['total_revenue'] * 0.95, 0, ',', '.') }}</span>
            </div>
            <span class="text-amber-500 font-bold text-[10px]">+82%</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const primaryColor = '#3b82f6';
        const secondaryColor = '#10b981';
        const accentColor = '#f59e0b';
        const dangerColor = '#f43f5e';

        // Radial Indicators Utility
        function createRadial(id, percent, color) {
            new ApexCharts(document.querySelector(id), {
                series: [percent],
                chart: { type: 'radialBar', height: 100, sparkline: { enabled: true } },
                plotOptions: { radialBar: { dataLabels: { show: false }, hollow: { size: '60%' }, track: { background: '#f8fafc' } } },
                colors: [color]
            }).render();
        }

        createRadial("#radial-1", 65, primaryColor);
        createRadial("#radial-2", 45, '#6366f1');
        createRadial("#radial-3", 78, accentColor);
        createRadial("#radial-4", 92, secondaryColor);

        // Mixed Activity Chart (Scan Activity vs Revenue Trend)
        new ApexCharts(document.querySelector("#mixed-chart"), {
            series: [{
                name: 'Pembuatan Link QR',
                type: 'column',
                data: @json($chartData['exams'])
            }, {
                name: 'Pendapatan Berhasil',
                type: 'line',
                data: @json($chartData['revenue'])
            }],
            chart: { height: 350, type: 'line', stacked: false, toolbar: { show: false }, fontFamily: 'Outfit, sans-serif' },
            stroke: { width: [0, 3], curve: 'smooth' },
            colors: [primaryColor, secondaryColor],
            plotOptions: { bar: { columnWidth: '45%', borderRadius: 8 } },
            fill: { opacity: [0.15, 1], type: ['solid', 'gradient'], gradient: { shade: 'light', type: "vertical", shadeIntensity: 0.5, opacityFrom: 1, opacityTo: 0.8 } },
            labels: @json($chartData['labels']),
            markers: { size: 4, colors: ['#fff'], strokeColors: secondaryColor, strokeWidth: 2 },
            xaxis: { axisBorder: { show: false }, axisTicks: { show: false }, labels: { style: { colors: '#94a3b8', fontSize: '10px', fontWeight: 600 } } },
            yaxis: [{
                title: { text: "Total Scan", style: { color: primaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                labels: { style: { colors: '#94a3b8' } }
            }, {
                opposite: true,
                title: { text: "Revenue (IDR)", style: { color: secondaryColor, fontWeight: 800, fontSize: '9px', uppercase: true } },
                labels: { 
                    formatter: function(val) { return 'Rp ' + (val/1000) + 'k' },
                    style: { colors: '#94a3b8' } 
                }
            }],
            grid: { borderColor: '#f1f5f9', strokeDashArray: 4 },
            legend: { position: 'top', horizontalAlign: 'right', fontSize: '11px', fontWeight: 700, labels: { colors: '#64748b' } }
        }).render();

        // Main Radial Progress (Average System Load)
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
    });
</script>
@endsection
