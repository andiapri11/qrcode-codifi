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

                                @if($trx->status == 'success')
                                    <a href="{{ route('subscription.transactions.invoice', $trx->id) }}?download=1" target="_blank" class="inline-flex items-center gap-2 px-3 py-1.5 bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-600 dark:text-slate-400 rounded-lg transition-all border border-slate-200 dark:border-slate-700 group">
                                        <svg class="w-3.5 h-3.5 group-hover:scale-110 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" /></svg>
                                        <span class="text-[8px] font-black uppercase tracking-widest">Invoice</span>
                                    </a>
                                @endif

                                @if($isSuperAdmin)
                                    <form action="{{ route('subscription.transactions.destroy', $trx->id) }}" method="POST" onsubmit="return confirm('Hapus riwayat transaksi ini?')" class="inline ml-2">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-rose-500 hover:text-rose-700 transition-colors p-2" title="Hapus Riwayat">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                        </button>
                                    </form>
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
<!-- Review Modal -->
<div id="reviewModal" class="hidden fixed inset-0 z-[100] flex items-center justify-center p-6 bg-slate-900/40 backdrop-blur-md animate-in fade-in duration-300">
    <div class="bg-white dark:bg-slate-900 w-full max-w-[420px] rounded-[2.5rem] shadow-2xl border border-white dark:border-slate-800 overflow-hidden transform transition-all duration-300 scale-95 opacity-0" id="reviewModalContent">
        <div class="p-8 md:p-10">
            <div class="flex items-center gap-4 mb-8">
                <div class="w-12 h-12 bg-blue-50 dark:bg-blue-900/20 rounded-2xl flex items-center justify-center text-blue-600 dark:text-blue-400 shadow-inner">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4" /></svg>
                </div>
                <div>
                    <h3 class="text-lg font-black text-slate-900 dark:text-white tracking-tight uppercase">Konfirmasi Order</h3>
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mt-0.5">Review paket yang Anda pilih</p>
                </div>
            </div>

            <div class="space-y-4 mb-10">
                <div class="p-5 bg-slate-50 dark:bg-slate-800/50 rounded-2xl border border-slate-100 dark:border-slate-800/50">
                    <div class="flex justify-between items-center mb-4 pb-4 border-b border-slate-200/50 dark:border-slate-700/50">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Detail Paket</span>
                        <span id="reviewPlanName" class="text-[10px] font-black text-indigo-600 dark:text-blue-400 uppercase"></span>
                    </div>
                    <div class="space-y-3">
                        <div class="flex justify-between items-center">
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Durasi</span>
                            <span id="reviewDuration" class="text-[9px] font-black text-slate-700 dark:text-slate-300 uppercase"></span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest">Link Barcode</span>
                            <span id="reviewLinks" class="text-[9px] font-black text-slate-700 dark:text-slate-300 uppercase italic"></span>
                        </div>
                    </div>
                </div>

                <div class="flex justify-between items-center px-4">
                    <span class="text-[10px] font-black text-slate-800 dark:text-white uppercase tracking-widest">Total Bayar</span>
                    <span id="reviewPrice" class="text-xl font-black text-slate-900 dark:text-white tracking-tighter"></span>
                </div>
            </div>

            <div class="grid grid-cols-2 gap-4">
                <button onclick="closeReviewModal()" class="py-4 rounded-2xl bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-black text-[9px] uppercase tracking-[0.3em] hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
                    Batal
                </button>
                <button id="confirmPayBtn" class="py-4 rounded-2xl bg-blue-600 text-white font-black text-[9px] uppercase tracking-[0.3em] hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-blue-200 dark:shadow-none">
                    Bayar
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Midtrans Snap Script -->
<script type="text/javascript" src="{{ config('services.midtrans.is_production') ? 'https://app.midtrans.com/snap/snap.js' : 'https://app.sandbox.midtrans.com/snap/snap.js' }}" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    const plansData = @json($plans);
    let currentSelectedPlanId = null;

    function checkout(planId) {
        currentSelectedPlanId = planId;
        const plan = plansData.find(p => p.id === planId);
        
        if (!plan) return;

        // Populate Modal
        document.getElementById('reviewPlanName').innerText = plan.name;
        document.getElementById('reviewDuration').innerText = plan.duration;
        document.getElementById('reviewLinks').innerText = plan.links + (plan.id == 'lifetime' ? '' : ' LINK');
        document.getElementById('reviewPrice').innerText = 'Rp' + new Intl.NumberFormat('id-ID').format(plan.price);
        
        // Show Modal
        const modal = document.getElementById('reviewModal');
        const content = document.getElementById('reviewModalContent');
        
        modal.classList.remove('hidden');
        setTimeout(() => {
            content.classList.remove('scale-95', 'opacity-0');
            content.classList.add('scale-100', 'opacity-100');
        }, 10);

        // Update Button Click
        document.getElementById('confirmPayBtn').onclick = processPayment;
    }

    function closeReviewModal() {
        const modal = document.getElementById('reviewModal');
        const content = document.getElementById('reviewModalContent');
        
        content.classList.add('scale-95', 'opacity-0');
        content.classList.remove('scale-100', 'opacity-100');
        
        setTimeout(() => {
            modal.classList.add('hidden');
        }, 300);
    }

    function processPayment() {
        const btn = document.getElementById('confirmPayBtn');
        const originalText = btn.innerText;
        btn.disabled = true;
        btn.innerText = 'WAIT...';

        fetch("{{ route('subscription.checkout') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ plan: currentSelectedPlanId })
        })
        .then(response => response.json())
        .then(data => {
            closeReviewModal();
            if (data.token) {
                window.snap.pay(data.token, {
                    onSuccess: function(result) { window.location.href = "{{ route('subscription.success') }}"; },
                    onPending: function(result) { location.reload(); },
                    onError: function(result) { 
                        showAlert('Error', 'Pembayaran gagal! Silakan coba kembali.', 'error');
                    },
                    onClose: function() { }
                });
            } else {
                showAlert('Error', data.error || 'Terjadi gangguan pada sistem pembayaran.', 'error');
            }
        })
        .catch(error => {
            closeReviewModal();
            console.error('Error:', error);
            showAlert('Error', 'Koneksi terputus. Gagal memproses permintaan.', 'error');
        })
        .finally(() => {
            btn.disabled = false;
            btn.innerText = originalText;
        });
    }
</script>
@endif
@endsection
