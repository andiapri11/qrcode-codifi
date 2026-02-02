@extends('layouts.admin')

@section('content')
@php
    $isSuperAdmin = Auth::user()->role === 'superadmin';
@endphp

<div class="space-y-6 animate-in fade-in duration-700">
    <!-- Compact Header -->
    <div class="bg-white rounded-[2rem] shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-8 py-5 flex justify-between items-center">
            <div class="flex items-center gap-4">
                <div class="w-10 h-10 bg-blue-50 rounded-xl flex items-center justify-center text-blue-500 shadow-inner shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" /></svg>
                </div>
                <div>
                    <h2 class="text-base font-black text-slate-900 tracking-tight uppercase">
                        {{ $isSuperAdmin ? 'Manajemen Billing Global' : 'Langganan & Billing' }}
                    </h2>
                    <p class="text-[8px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">
                        {{ $isSuperAdmin ? 'Pantau pendapatan sistem' : 'Kelola paket layanan instansi' }}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">
        @if(!$isSuperAdmin)
        <!-- School Side: Status & Pricing -->
        <div class="col-span-full lg:col-span-4 space-y-6">
            <!-- Status Card -->
            <div class="bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6">
                <div class="flex items-center gap-2 mb-5">
                    <span class="w-1.5 h-4 bg-blue-500 rounded-full"></span>
                    <h2 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Status Akun</h2>
                </div>
                
                <div class="grid grid-cols-1 gap-3">
                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <div>
                            <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Tipe Paket</div>
                            <div class="text-xs font-black text-indigo-600 dark:text-blue-400 uppercase mt-0.5">
                                @if($school->subscription_type === 'trial')
                                    TRIAL ACCESS
                                @elseif($school->subscription_type === 'lifetime')
                                    ∞ LIFETIME
                                @else
                                    PREMIUM ANNUAL
                                @endif
                            </div>
                        </div>
                        <div class="h-10 w-10 bg-white dark:bg-slate-700 rounded-xl flex items-center justify-center text-xl shadow-sm">
                            {{ $school->subscription_type == 'lifetime' ? '👑' : '⭐' }}
                        </div>
                    </div>

                    <div class="flex items-center justify-between p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <div>
                            <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Berlaku Hingga</div>
                            <div class="text-xs font-black text-slate-700 dark:text-slate-300 mt-0.5 uppercase tracking-tight">
                                {{ $school->subscription_type == 'lifetime' ? 'SELAMANYA' : ($school->subscription_expires_at ? $school->subscription_expires_at->format('d M Y') : 'EXPIRED') }}
                            </div>
                        </div>
                        <div class="h-10 w-10 bg-white dark:bg-slate-700 rounded-xl flex items-center justify-center text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" /></svg>
                        </div>
                    </div>

                    <div class="p-4 bg-slate-50 dark:bg-slate-800/30 rounded-2xl border border-slate-100 dark:border-slate-800">
                        <div class="flex items-center justify-between mb-2">
                            <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Kuota Link Barcode</div>
                            <div class="text-[10px] font-black text-slate-900 dark:text-white">
                                @php
                                    $currentLinks = $school->examLinks()->count();
                                    $maxLinks = $school->subscription_type === 'lifetime' ? '∞' : ($school->subscription_type === 'trial' ? 1 : $school->max_links);
                                @endphp
                                {{ $currentLinks }} / {{ $maxLinks }}
                            </div>
                        </div>
                        <div class="w-full bg-slate-200 dark:bg-slate-700 h-1.5 rounded-full overflow-hidden">
                            @php
                                $denominator = $school->subscription_type === 'lifetime' ? 1 : ($school->subscription_type === 'trial' ? 1 : max(1, $school->max_links));
                                $usage = $school->subscription_type === 'lifetime' ? 0 : ($currentLinks / $denominator) * 100;
                            @endphp
                            <div class="bg-indigo-600 h-full rounded-full transition-all duration-1000" style="width: {{ min(100, $usage) }}%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- School Side: Plans -->
        <div class="col-span-full lg:col-span-8 bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 p-6">
            <div class="flex items-center gap-2 mb-6">
                <span class="w-1.5 h-4 bg-amber-500 rounded-full"></span>
                <h2 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Pilih Paket Perpanjangan</h2>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($plans as $plan)
                <div class="relative border {{ $plan['id'] == 'lifetime' ? 'border-blue-600 bg-blue-50/10' : 'border-slate-100 dark:border-slate-800 bg-slate-50/30 dark:bg-slate-800/20' }} rounded-[1.5rem] p-5 flex flex-col group hover:scale-[1.02] transition-all">
                    @if($plan['id'] == 'lifetime')
                        <div class="absolute -top-2.5 left-1/2 -translate-x-1/2 bg-blue-600 text-white text-[7px] font-black px-3 py-1 rounded-full uppercase tracking-[0.2em] shadow-lg shadow-blue-100">Best Value</div>
                    @endif
                    
                    <div class="mb-4">
                        <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest">{{ $plan['name'] }}</div>
                        <div class="text-xl font-black text-slate-900 dark:text-white mt-1 tracking-tight">Rp{{ number_format($plan['price'], 0, ',', '.') }}</div>
                        <div class="text-[7px] font-bold text-blue-600 dark:text-blue-400 mt-0.5 uppercase tracking-widest">{{ $plan['duration'] }}</div>
                    </div>
                    
                    <ul class="text-[8px] space-y-3 mb-6 flex-grow font-bold uppercase tracking-wide text-slate-500 dark:text-slate-400 opacity-80">
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            {{ $plan['links'] }} Barcode Secure
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Custom Branding
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="w-3 h-3 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"/></svg>
                            Priority Support
                        </li>
                    </ul>

                    <button onclick="checkout('{{ $plan['id'] }}')" 
                        class="w-full py-3 rounded-xl {{ $plan['id'] == 'lifetime' ? 'bg-blue-600 text-white shadow-lg shadow-blue-200' : 'bg-slate-900 text-white shadow-lg shadow-slate-200' }} font-black text-[9px] uppercase tracking-[0.2em] transition-all active:scale-95 hover:brightness-110">
                        Pilih Paket
                    </button>
                </div>
                @endforeach
            </div>
        </div>
        @else
        <!-- Superadmin Side: Global Stats -->
        <div class="col-span-full grid grid-cols-1 md:grid-cols-3 gap-6 mb-2">
            <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col justify-center">
                <div class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Total Volume Transaksi</div>
                <div class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">Rp{{ number_format($transactions->where('status', 'success')->sum('amount'), 0, ',', '.') }}</div>
                <div class="mt-3 flex items-center gap-2">
                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                    <span class="text-[8px] font-black text-emerald-600 uppercase tracking-widest">Revenue Terverifikasi</span>
                </div>
            </div>
            <div class="bg-white dark:bg-slate-900 p-6 rounded-[2rem] border border-slate-200 dark:border-slate-800 shadow-sm flex flex-col justify-center">
                <div class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Transaksi Berhasil</div>
                <div class="text-2xl font-black text-slate-900 dark:text-white tracking-tighter leading-none">{{ $transactions->where('status', 'success')->count() }} <span class="text-xs text-slate-400">/ {{ $transactions->count() }}</span></div>
                <div class="text-[8px] font-black text-slate-400 uppercase mt-3 tracking-widest leading-none">Data Pengguna Aktif</div>
            </div>
            <div class="bg-indigo-600 p-6 rounded-[2rem] shadow-xl shadow-indigo-100 dark:shadow-none flex flex-col justify-center text-white">
                <div class="text-[8px] font-black text-indigo-100 uppercase tracking-[0.2em] mb-2">Mitra Teraktif</div>
                @php
                    $topPartner = $transactions->groupBy('school_id')->sortByDesc(function($trxs) { return $trxs->sum('amount'); })->first();
                @endphp
                <div class="text-base font-black tracking-tight uppercase leading-none">{{ $topPartner ? $topPartner->first()->school->name : 'N/A' }}</div>
                <p class="text-[8px] font-bold text-indigo-200 mt-3 uppercase tracking-widest leading-none truncate">Kontributor Utama</p>
            </div>
        </div>
        @endif

        <!-- History Table (Full Width) -->
        <div class="col-span-full bg-white dark:bg-slate-900 shadow-sm rounded-[2rem] border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="px-8 py-5 border-b border-slate-100 dark:border-slate-800 flex items-center gap-2">
                <span class="w-1.5 h-4 bg-slate-900 dark:bg-white rounded-full"></span>
                <h2 class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Riwayat Transaksi</h2>
            </div>
            <div class="overflow-x-auto no-scrollbar">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-100 dark:border-slate-800">
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">No. Referensi</th>
                            @if($isSuperAdmin)
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">Nama Instansi</th>
                            @endif
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">Paket</th>
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">Nominal</th>
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Status</th>
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em]">Tanggal</th>
                            <th class="px-8 py-4 text-[9px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                        @forelse($transactions as $trx)
                        <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/10 transition-colors">
                            <td class="px-8 py-4 text-[10px] font-black text-slate-700 dark:text-slate-300 tracking-tight uppercase">{{ $trx->reference }}</td>
                            @if($isSuperAdmin)
                            <td class="px-8 py-4">
                                <span class="text-[10px] font-black text-indigo-600 dark:text-blue-400 uppercase tracking-tight">{{ $trx->school->name }}</span>
                            </td>
                            @endif
                            <td class="px-8 py-4 uppercase text-[9px] font-bold text-slate-500">{{ str_replace('_', ' ', $trx->type) }}</td>
                            <td class="px-8 py-4 font-black text-slate-900 dark:text-white text-[10px]">Rp{{ number_format($trx->amount, 0, ',', '.') }}</td>
                            <td class="px-8 py-4 text-center">
                                @if($trx->status == 'success')
                                    <span class="px-3 py-1 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 dark:text-emerald-500 rounded-lg text-[8px] font-black uppercase tracking-widest border border-emerald-100 dark:border-emerald-900/30">LUNAS</span>
                                @elseif($trx->status == 'pending')
                                    <span class="px-3 py-1 bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 rounded-lg text-[8px] font-black uppercase tracking-widest border border-amber-100 dark:border-amber-900/30">PENDING</span>
                                @else
                                    <span class="px-3 py-1 bg-rose-50 dark:bg-rose-900/20 text-rose-600 dark:text-rose-500 rounded-lg text-[8px] font-black uppercase tracking-widest border border-rose-100 dark:border-rose-900/30">GAGAL</span>
                                @endif
                            </td>
                            <td class="px-8 py-4 text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{ $trx->created_at->format('d/m/y, H:i') }}</td>
                            <td class="px-8 py-4 text-right">
                                @if(!$isSuperAdmin && $trx->status == 'pending' && $trx->snap_token)
                                    <button onclick="window.snap.pay('{{ $trx->snap_token }}')" class="bg-indigo-600 text-white px-3 py-1.5 rounded-lg font-black text-[8px] uppercase tracking-widest hover:bg-indigo-700 transition-all shadow-lg shadow-indigo-100">Bayar</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="{{ $isSuperAdmin ? 7 : 6 }}" class="px-8 py-12 text-center text-slate-400 dark:text-slate-600 italic font-bold uppercase text-[9px] tracking-widest">Belum ada riwayat transaksi yang tercatat.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
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
