@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Top Row: Stats with Radial Indicators -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- New Schools -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Instansi Baru</p>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 text-xs">▲</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">234%</span>
                </div>
            </div>
            <div id="radial-1" class="w-16 h-16"></div>
        </div>

        <!-- System Traffic -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Beban Server</p>
                <div class="flex items-center gap-2">
                    <span class="text-rose-500 text-xs">▼</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">71%</span>
                </div>
            </div>
            <div id="radial-2" class="w-16 h-16"></div>
        </div>

        <!-- Est Value -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Revenue</p>
                <div class="flex items-center">
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">Rp {{ number_format($stats['total_revenue']/1000000, 2) }}M</span>
                </div>
            </div>
            <div id="radial-3" class="w-16 h-16"></div>
        </div>

        <!-- New Admin Hits -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Admin Mitra</p>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 text-xs">+</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_users'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">users</span>
                </div>
            </div>
            <div id="radial-4" class="w-16 h-16"></div>
        </div>
    </div>

    <!-- Middle Row: Main Charts -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <!-- Traffic Sources (Mixed Chart) -->
        <div class="lg:col-span-8 bg-white rounded-2xl p-8 shadow-sm border border-slate-100">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Eksplorasi Aktivitas Ujian</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase mt-1 tracking-widest">Data Sinkronisasi Mingguan</p>
                </div>
                <button class="bg-amber-400 text-white px-5 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-amber-500 transition-colors">Actions</button>
            </div>
            <div id="mixed-chart" class="w-full h-[350px]"></div>
        </div>

        <!-- Radial Progress (Income Target) -->
        <div class="lg:col-span-4 bg-white rounded-2xl p-8 shadow-sm border border-slate-100 flex flex-col justify-between">
            <div class="flex items-center justify-between mb-2">
                <h4 class="text-sm font-black text-slate-800 uppercase tracking-tight">Target Capaian</h4>
                <button class="text-slate-400 hover:text-slate-600">⚙️</button>
            </div>
            
            <div class="relative flex-1 flex flex-col items-center justify-center py-6">
                <div id="main-radial" class="w-full"></div>
                <div class="mt-4 w-full px-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-amber-500 font-black text-xs">32%</span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Target Bulanan</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-amber-400 h-full rounded-full" style="width: 32%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Row: Minor Metrics -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Income</p>
                <span class="text-lg font-black text-slate-800">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
            </div>
            <span class="text-emerald-500 font-bold text-[10px]">+14%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Expenses</p>
                <span class="text-lg font-black text-slate-800">Rp {{ number_format($stats['total_revenue'] * 0.1, 0, ',', '.') }}</span>
            </div>
            <span class="text-rose-500 font-bold text-[10px]">▲ 8%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Spendings</p>
                <span class="text-lg font-black text-slate-800">Rp 0</span>
            </div>
            <span class="text-emerald-500 font-bold text-[10px]">▼ 15%</span>
        </div>
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-1">Totals</p>
                <span class="text-lg font-black text-slate-800">Rp {{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
            </div>
            <span class="text-amber-500 font-bold text-[10px]">+76%</span>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Radial 1
        new ApexCharts(document.querySelector("#radial-1"), {
            series: [58],
            chart: { type: 'radialBar', height: 100, sparkline: { enabled: true } },
            plotOptions: { radialBar: { dataLabels: { show: false }, hollow: { size: '60%' }, track: { strokeWidth: '100%' } } },
            colors: ['#3b82f6']
        }).render();

        // Radial 2
        new ApexCharts(document.querySelector("#radial-2"), {
            series: [62],
            chart: { type: 'radialBar', height: 100, sparkline: { enabled: true } },
            plotOptions: { radialBar: { dataLabels: { show: false }, hollow: { size: '60%' } } },
            colors: ['#f43f5e']
        }).render();

        // Radial 3
        new ApexCharts(document.querySelector("#radial-3"), {
            series: [72],
            chart: { type: 'radialBar', height: 100, sparkline: { enabled: true } },
            plotOptions: { radialBar: { dataLabels: { show: false }, hollow: { size: '60%' } } },
            colors: ['#f59e0b']
        }).render();

        // Radial 4
        new ApexCharts(document.querySelector("#radial-4"), {
            series: [81],
            chart: { type: 'radialBar', height: 100, sparkline: { enabled: true } },
            plotOptions: { radialBar: { dataLabels: { show: false }, hollow: { size: '60%' } } },
            colors: ['#10b981']
        }).render();

        // Mixed Chart
        new ApexCharts(document.querySelector("#mixed-chart"), {
            series: [{
                name: 'Website Blog',
                type: 'column',
                data: @json($chartData['exams'])
            }, {
                name: 'Social Media',
                type: 'line',
                data: @json($chartData['revenue'])
            }],
            chart: { height: 350, type: 'line', stacked: false, toolbar: { show: false } },
            stroke: { width: [0, 2], curve: 'smooth' },
            colors: ['#3b82f6', '#10b981'],
            plotOptions: { bar: { columnWidth: '50%' } },
            fill: { opacity: [0.85, 1] },
            labels: @json($chartData['labels']),
            markers: { size: 5, colors: ['#fff'], strokeColors: '#10b981', strokeWidth: 2 },
            xaxis: { type: 'category', labels: { style: { colors: '#94a3b8', fontSize: '10px', fontWeight: 600 } } },
            yaxis: { labels: { style: { colors: '#94a3b8', fontSize: '10px' } } },
            legend: { position: 'bottom', horizontalAlign: 'center', fontSize: '10px', fontWeight: 700 }
        }).render();

        // Main Radial Progress
        new ApexCharts(document.querySelector("#main-radial"), {
            series: [75],
            chart: { height: 280, type: 'radialBar' },
            plotOptions: {
                radialBar: {
                    hollow: { size: '70%', },
                    track: { background: '#f1f5f9' },
                    dataLabels: {
                        name: { show: true, fontSize: '12px', fontWeight: 900, color: '#94a3b8', offsetY: -10, text: 'Percent' },
                        value: { show: true, fontSize: '32px', fontWeight: 900, color: '#1e293b', offsetY: 15 }
                    }
                }
            },
            colors: ['#10b981'],
            fill: { type: 'gradient', gradient: { shade: 'dark', type: 'horizontal', gradientToColors: ['#34d399'], stops: [0, 100] } }
        }).render();
    });
</script>
@endsection
