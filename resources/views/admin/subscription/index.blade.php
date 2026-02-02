@extends('layouts.admin')

@section('content')
@php
    $isSuperAdmin = Auth::user()->role === 'superadmin';
@endphp

<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">
            {{ $isSuperAdmin ? 'Manajemen Billing Global' : 'Langganan & Billing' }}
        </h2>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-1 uppercase tracking-wider">
            {{ $isSuperAdmin ? 'Pantau seluruh transaksi masuk dan status pendapatan sistem.' : 'Kelola paket layanan dan riwayat pembayaran instansi Anda.' }}
        </p>
    </div>
</div>

<div class="grid grid-cols-12 gap-8">
    @if(!$isSuperAdmin)
    <!-- School Side: Status & Pricing -->
    <div class="col-span-full lg:col-span-4 space-y-8">
        <!-- Status Card -->
        <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8">
            <h2 class="text-xs font-black text-slate-900 dark:text-white mb-6 uppercase tracking-[0.2em]">Status Akun</h2>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-5 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Tipe Paket</div>
                        <div class="text-sm font-black text-blue-600 dark:text-blue-400 uppercase mt-1">
                            {{ $school->subscription_type == 'lifetime' ? '∞ LIFETIME' : 'PREMIUM ANNUAL' }}
                        </div>
                    </div>
                    <div class="h-12 w-12 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-2xl shadow-sm">
                        {{ $school->subscription_type == 'lifetime' ? '👑' : '⭐' }}
                    </div>
                </div>

                <div class="flex items-center justify-between p-5 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <div>
                        <div class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Berlaku Hingga</div>
                        <div class="text-sm font-black text-slate-700 dark:text-slate-300 mt-1 uppercase tracking-tight">
                            {{ $school->subscription_type == 'lifetime' ? 'SELAMANYA' : ($school->subscription_expires_at ? $school->subscription_expires_at->format('d M Y') : 'EXPIRED') }}
                        </div>
                    </div>
                </div>

                <div class="p-5 bg-slate-50 dark:bg-slate-800/30 rounded-3xl border border-slate-100 dark:border-slate-800">
                    <div class="flex items-center justify-between mb-3">
                        <div class="text-[10px] font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">Kuota Link QR</div>
                        <div class="text-xs font-black text-slate-900 dark:text-white uppercase">
                            {{ $school->examLinks()->count() }} / {{ $school->subscription_type == 'lifetime' ? '∞' : $school->max_links }}
                        </div>
                    </div>
                    <div class="w-full bg-slate-200 dark:bg-slate-700 rounded-full h-2 overflow-hidden">
                        @php
                            $usage = $school->subscription_type == 'lifetime' ? 0 : ($school->examLinks()->count() / max(1, $school->max_links)) * 100;
                        @endphp
                        <div class="bg-blue-600 h-full rounded-full transition-all duration-1000" style="width: {{ min(100, $usage) }}%"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- School Side: Plans -->
    <div class="col-span-full lg:col-span-8 bg-white dark:bg-slate-900 shadow-sm rounded-[2.5rem] border border-slate-100 dark:border-slate-800 p-8">
        <h2 class="text-xs font-black text-slate-900 dark:text-white mb-8 uppercase tracking-[0.2em]">Pilih Paket Perpanjangan</h2>
        
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($plans as $plan)
            <div class="relative border-2 {{ $plan['id'] == 'lifetime' ? 'border-blue-600 bg-blue-50/10' : 'border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20' }} rounded-[2rem] p-6 flex flex-col group hover:scale-[1.02] transition-all">
                @if($plan['id'] == 'lifetime')
                    <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[9px] font-black px-4 py-1.5 rounded-full uppercase tracking-[0.2em] shadow-lg shadow-blue-200 dark:shadow-none">Best Value</div>
                @endif
                
                <div class="mb-6">
                    <div class="text-xs font-black text-slate-400 dark:text-slate-500 uppercase tracking-widest">{{ $plan['name'] }}</div>
                    <div class="text-2xl font-black text-slate-900 dark:text-white mt-1 uppercase tracking-tight">Rp {{ number_format($plan['price'], 0, ',', '.') }}</div>
                    <div class="text-[9px] font-bold text-blue-600 dark:text-blue-400 mt-1 uppercase tracking-widest">Durasi: {{ $plan['duration'] }}</div>
                </div>
                
                <ul class="text-[10px] space-y-4 mb-10 flex-grow font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400">
                    <li class="flex items-center gap-3">
                        <span class="w-5 h-5 bg-blue-50 dark:bg-blue-900/40 text-blue-600 flex items-center justify-center rounded-lg text-[8px]">✓</span> 
                        {{ $plan['links'] }} Link Ujian Secure
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-5 h-5 bg-blue-50 dark:bg-blue-900/40 text-blue-600 flex items-center justify-center rounded-lg text-[8px]">✓</span> 
                        Custom Branding
                    </li>
                    <li class="flex items-center gap-3">
                        <span class="w-5 h-5 bg-blue-50 dark:bg-blue-900/40 text-blue-600 flex items-center justify-center rounded-lg text-[8px]">✓</span> 
                        Priority Support
                    </li>
                </ul>

                <button onclick="checkout('{{ $plan['id'] }}')" class="w-full py-4 rounded-2xl {{ $plan['id'] == 'lifetime' ? 'bg-blue-600 text-white shadow-xl shadow-blue-100 dark:shadow-none' : 'bg-slate-900 text-white shadow-xl shadow-slate-200 dark:shadow-none' }} font-black text-[10px] uppercase tracking-[0.3em] transition-all active:scale-95 group-hover:bg-blue-700">
                    Pilih Paket
                </button>
            </div>
            @endforeach
        </div>
    </div>
    @else
    <!-- Superadmin Side: Global Stats -->
    <div class="col-span-full grid grid-cols-1 md:grid-cols-3 gap-8 mb-4">
        <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Total Volume Transaksi</div>
            <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">Rp {{ number_format($transactions->where('status', 'success')->sum('amount'), 0, ',', '.') }}</div>
            <div class="mt-4 flex items-center gap-2">
                <span class="h-2 w-2 rounded-full bg-emerald-500"></span>
                <span class="text-[10px] font-black text-emerald-600 uppercase tracking-widest">Revenue Terverifikasi</span>
            </div>
        </div>
        <div class="bg-white dark:bg-slate-900 p-8 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm">
            <div class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-3">Transaksi Berhasil</div>
            <div class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter">{{ $transactions->where('status', 'success')->count() }}</div>
            <div class="text-[10px] font-black text-slate-400 uppercase mt-4 tracking-widest">Dari Total {{ $transactions->count() }} Percobaan</div>
        </div>
        <div class="bg-blue-600 p-8 rounded-[2.5rem] border border-blue-500 shadow-xl shadow-blue-100 dark:shadow-none">
            <div class="text-[10px] font-black text-blue-100 uppercase tracking-[0.2em] mb-3">Mitra Teraktif</div>
            @php
                $topPartner = $transactions->groupBy('school_id')->sortByDesc(function($trxs) { return $trxs->sum('amount'); })->first();
            @endphp
            <div class="text-xl font-black text-white tracking-tight uppercase">{{ $topPartner ? $topPartner->first()->school->name : 'N/A' }}</div>
            <p class="text-[10px] font-bold text-blue-200 mt-2 uppercase tracking-widest">Kontributor Pendapatan Utama</p>
        </div>
    </div>
    @endif

    <!-- History Table (Full Width) -->
    <div class="col-span-full bg-white dark:bg-slate-900 shadow-sm rounded-[2.5rem] border border-slate-100 dark:border-slate-800 overflow-hidden">
        <div class="px-8 py-6 border-b border-slate-50 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20">
            <h2 class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-[0.2em]">Data Riwayat Transaksi</h2>
        </div>
        <div class="overflow-x-auto no-scrollbar">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-50 dark:border-slate-800">
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">No. Referensi</th>
                        @if($isSuperAdmin)
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Nama Instansi</th>
                        @endif
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Paket Layanan</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Nominal Akhir</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Status Bayar</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Tanggal</th>
                        <th class="px-8 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                    @forelse($transactions as $trx)
                    <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/10 transition-colors">
                        <td class="px-8 py-5 text-xs font-black text-slate-700 dark:text-slate-300 tracking-tight uppercase">{{ $trx->reference }}</td>
                        @if($isSuperAdmin)
                        <td class="px-8 py-5">
                            <span class="text-xs font-black text-blue-600 dark:text-blue-400 uppercase">{{ $trx->school->name }}</span>
                        </td>
                        @endif
                        <td class="px-8 py-5 uppercase text-[10px] font-bold text-slate-500">{{ str_replace('_', ' ', $trx->type) }}</td>
                        <td class="px-8 py-5 font-black text-slate-900 dark:text-white text-xs">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                        <td class="px-8 py-5 text-center">
                            @if($trx->status == 'success')
                                <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-emerald-100 dark:border-emerald-900/30">BERHASIL</span>
                            @elseif($trx->status == 'pending')
                                <span class="px-3 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-amber-100 dark:border-amber-900/30">PENDING</span>
                            @else
                                <span class="px-3 py-1 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-500 rounded-lg text-[9px] font-black uppercase tracking-widest border border-rose-100 dark:border-rose-900/30">GAGAL</span>
                            @endif
                        </td>
                        <td class="px-8 py-5 text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{ $trx->created_at->format('d/m/Y, H:i') }}</td>
                        <td class="px-8 py-5 text-right">
                            @if(!$isSuperAdmin && $trx->status == 'pending' && $trx->snap_token)
                                <button onclick="window.snap.pay('{{ $trx->snap_token }}')" class="text-blue-600 dark:text-blue-400 font-black text-[10px] uppercase tracking-widest hover:underline">Bayar Sekarang</button>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="{{ $isSuperAdmin ? 7 : 6 }}" class="px-8 py-16 text-center text-slate-400 dark:text-slate-600 italic font-bold uppercase text-[10px] tracking-widest">Belum ada riwayat transaksi yang tercatat.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@if(!$isSuperAdmin)
<!-- Midtrans Snap Script -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function checkout(planId) {
        if (!confirm('Lanjutkan proses pembayaran untuk paket ini?')) return;
        
        fetch("{{ route('subscription.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ plan: planId })
        })
        .then(response => response.json())
        .then(data => {
            if (data.token) {
                window.snap.pay(data.token, {
                    onSuccess: function(result) { location.reload(); },
                    onPending: function(result) { location.reload(); },
                    onError: function(result) { alert('Pembayaran gagal! Silakan coba kembali.'); },
                    onClose: function() { }
                });
            } else {
                alert(data.error || 'Terjadi gangguan pada sistem pembayaran.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Koneksi terputus. Gagal memproses permintaan.');
        });
    }
</script>
@endif
@endsection
