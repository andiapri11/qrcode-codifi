@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Top Row: Functional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Mitra Berlangganan -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Mitra Berlangganan</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 tracking-tighter">{{ $stats['subscribed_schools'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Mitra</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" /></svg>
            </div>
        </div>

        <!-- Total Omset -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Omset</p>
                <div class="flex items-center gap-1">
                    <span class="text-[11px] font-black text-slate-400">Rp</span>
                    <span class="text-2xl font-black text-slate-900 tracking-tighter">{{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 1.343-3 3s1.343 3 3 3 3 1.343 3 3-1.343 3-3 3m0-12c1.657 0 3 1.343 3 3s-1.343 3-3 3-3-1.343-3-3 1.343-3 3-3m0-12V3m0 18v-3" /></svg>
            </div>
        </div>

        <!-- Total Scan -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Scan QR</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 tracking-tighter">{{ $stats['total_scans'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Times</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h2M4 8h2m12 0h2M4 6h18M4 18h2m0-12v12m8-12v12m8-12v12M4 6h18M4 18h18" /></svg>
            </div>
        </div>

        <!-- Total User Mitra -->
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-1">Total Akun Mitra</p>
                <div class="flex items-center gap-1">
                    <span class="text-2xl font-black text-slate-900 tracking-tighter">{{ $stats['total_users'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase">Akun</span>
                </div>
            </div>
            <div class="w-12 h-12 bg-slate-50 rounded-xl flex items-center justify-center text-slate-400 border border-slate-100">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
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
