@extends('layouts.admin')

@section('content')
<!-- ApexCharts CDN -->
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<div class="space-y-8 animate-in fade-in duration-700">
    <!-- Top Row: Functional Stats -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Subscribed Schools -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-blue-200 transition-colors">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Mitra Berlangganan</p>
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
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Link QR</p>
                <div class="flex items-center gap-2">
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_links'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Asset</span>
                </div>
            </div>
            <div id="radial-2" class="w-16 h-16"></div>
        </div>

        <!-- Revenue Total -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-amber-200 transition-colors">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total Pendapatan</p>
                <div class="flex items-center">
                    <span class="text-[11px] font-black text-slate-400 mr-1">Rp</span>
                    <span class="text-xl font-black text-slate-800 tracking-tighter">{{ number_format($stats['total_revenue'], 0, ',', '.') }}</span>
                </div>
            </div>
            <div id="radial-3" class="w-16 h-16"></div>
        </div>

        <!-- Total Users (Partner Admins) -->
        <div class="bg-white rounded-xl p-6 shadow-sm border border-slate-100 flex items-center justify-between group hover:border-emerald-200 transition-colors">
            <div>
                <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest mb-2">Total User Mitra</p>
                <div class="flex items-center gap-2">
                    <span class="text-emerald-500 text-xs">+</span>
                    <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $stats['total_users'] }}</span>
                    <span class="text-[10px] font-bold text-slate-400 uppercase ml-1">Users</span>
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
                <div class="flex gap-2">
                    <button class="bg-slate-50 text-slate-500 px-4 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-slate-100 transition-colors">Export</button>
                    <button class="bg-amber-400 text-white px-5 py-2 rounded-lg text-[9px] font-black uppercase tracking-widest hover:bg-amber-500 transition-colors">Global View</button>
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
                <div class="mt-4 w-full px-4">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-blue-600 font-black text-xs">75%</span>
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Server Load</span>
                    </div>
                    <div class="w-full bg-slate-100 h-1.5 rounded-full overflow-hidden">
                        <div class="bg-blue-600 h-full rounded-full" style="width: 75%"></div>
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
                name: 'Scan QR Activity',
                type: 'column',
                data: @json($chartData['exams'])
            }, {
                name: 'Payment Inflow',
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

        // System Resource Gauge
        new ApexCharts(document.querySelector("#main-radial"), {
            series: [75],
            chart: { height: 300, type: 'radialBar' },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    hollow: { size: '70%', },
                    track: { background: '#f1f5f9', strokeWidth: '97%' },
                    dataLabels: {
                        name: { show: true, fontSize: '11px', fontWeight: 900, color: '#94a3b8', offsetY: -10, text: 'USAGE' },
                        value: { show: true, fontSize: '36px', fontWeight: 900, color: '#1e293b', offsetY: 15, formatter: (v) => v + '%' }
                    }
                }
            },
            colors: [primaryColor],
            fill: { type: 'gradient', gradient: { shade: 'dark', type: 'horizontal', gradientToColors: ['#60a5fa'], stops: [0, 100] } }
        }).render();
    });
</script>
@endsection
