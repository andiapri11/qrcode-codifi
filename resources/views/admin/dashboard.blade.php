@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Top Row: Functional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Total Omzet -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between h-32 relative group overflow-hidden">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Total Omzet</p>
            </div>
            <div class="flex items-baseline gap-1.5">
                <span class="text-sm font-black text-slate-800">Rp</span>
                <span class="text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
            </div>
            <div class="absolute -bottom-1 -right-1 opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3m0-12V3m0 18v-3" /></svg>
            </div>
        </div>

        <!-- Total Scan Berhasil -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between h-32 relative group overflow-hidden">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Total Scan Berhasil</p>
            </div>
            <div class="flex items-baseline gap-1.5">
                <span class="text-3xl font-black text-slate-800 tracking-tighter">{{ number_format($stats['total_scans'], 0, ',', '.') }}</span>
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Scan</span>
            </div>
            <div class="absolute -bottom-1 -right-1 opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h2m12 0h2M4 6h18M4 18h2m0-12v12m8-12v12m8-12v12M4 6h18M4 18h18" /></svg>
            </div>
        </div>

        <!-- Biaya Ops -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between h-32 relative group overflow-hidden">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Biaya Ops (Est)</p>
            </div>
            <div class="flex items-baseline gap-1.5 text-rose-500">
                <span class="text-sm font-black text-rose-400">Rp</span>
                <span class="text-3xl font-black tracking-tighter">{{ number_format($stats['operational_cost'], 0, ',', '.') }}</span>
            </div>
            <div class="absolute -bottom-1 -right-1 opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm1 15h-2v-2h2v2zm0-4h-2V7h2v6z" /></svg>
            </div>
        </div>

        <!-- Surplus Sistem -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex flex-col justify-between h-32 relative group overflow-hidden">
            <div class="flex items-center justify-between">
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-none">Surplus Sistem</p>
            </div>
            <div class="flex items-baseline gap-1.5 text-emerald-600">
                <span class="text-sm font-black text-emerald-400">Rp</span>
                <span class="text-3xl font-black tracking-tighter">{{ number_format($stats['surplus'], 0, ',', '.') }}</span>
            </div>
            <div class="absolute -bottom-1 -right-1 opacity-[0.03] group-hover:opacity-[0.06] transition-opacity">
                <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 24 24"><path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41L9 16.17z" /></svg>
            </div>
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
