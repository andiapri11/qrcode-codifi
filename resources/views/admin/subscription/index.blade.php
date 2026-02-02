@extends('layouts.admin')

@section('content')
<div class="px-4 sm:px-6 lg:px-8 py-8 w-full max-w-9xl mx-auto">

    <!-- Page header -->
    <div class="sm:flex sm:justify-between sm:items-center mb-8">
        <div class="mb-4 sm:mb-0">
            <h1 class="text-2xl md:text-3xl text-slate-800 font-bold">Langganan & Billing ✨</h1>
            <p class="text-sm text-slate-500 mt-1">Kelola paket layanan dan riwayat pembayaran instansi Anda.</p>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-6">

        <!-- Status Card -->
        <div class="col-span-full xl:col-span-4 bg-white shadow-lg rounded-2xl border border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-800 mb-4">Status Akun</h2>
            
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                    <div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Tipe Paket</div>
                        <div class="text-sm font-black text-primary uppercase">
                            {{ $school->subscription_type == 'lifetime' ? '∞ LIFETIME' : 'PREMIUM PLAN' }}
                        </div>
                    </div>
                    <div class="h-10 w-10 bg-indigo-100 rounded-lg flex items-center justify-center text-xl">
                        {{ $school->subscription_type == 'lifetime' ? '👑' : '⭐' }}
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                    <div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Berlaku Hingga</div>
                        <div class="text-sm font-bold text-slate-700">
                            {{ $school->subscription_type == 'lifetime' ? 'Selamanya' : ($school->subscription_expires_at ? $school->subscription_expires_at->format('d M Y') : 'Expired') }}
                        </div>
                    </div>
                    <div class="text-sm font-medium text-slate-400 italic">
                        {{ $school->subscription_expires_at && $school->subscription_expires_at->isFuture() ? $school->subscription_expires_at->diffForHumans() : '' }}
                    </div>
                </div>

                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                    <div>
                        <div class="text-xs font-bold text-slate-400 uppercase tracking-widest">Kuota Link</div>
                        <div class="text-sm font-bold text-slate-700">
                            {{ $school->examLinks()->count() }} / {{ $school->subscription_type == 'lifetime' ? '∞' : $school->max_links }}
                        </div>
                    </div>
                    <div class="w-24 bg-slate-200 rounded-full h-1.5">
                        @php
                            $usage = $school->subscription_type == 'lifetime' ? 0 : ($school->examLinks()->count() / max(1, $school->max_links)) * 100;
                        @endphp
                        <div class="bg-primary h-1.5 rounded-full" style="width: {{ min(100, $usage) }}%"></div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Pricing Plans -->
        <div class="col-span-full xl:col-span-8 bg-white shadow-lg rounded-2xl border border-slate-200 p-6">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Pilih Paket Perpanjangan</h2>
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($plans as $plan)
                <div class="relative border-2 {{ $plan['id'] == 'lifetime' ? 'border-primary bg-indigo-50/30' : 'border-slate-100' }} rounded-2xl p-5 flex flex-col hover:border-primary/50 transition-colors">
                    @if($plan['id'] == 'lifetime')
                        <div class="absolute -top-3 left-1/2 -translate-x-1/2 bg-primary text-white text-[10px] font-black px-3 py-1 rounded-full uppercase tracking-widest">Paling Populer</div>
                    @endif
                    
                    <div class="mb-4">
                        <div class="text-sm font-bold text-slate-800">{{ $plan['name'] }}</div>
                        <div class="text-3xl font-black text-slate-800 mt-2">Rp {{ number_format($plan['price'], 0, ',', '.') }}</div>
                        <div class="text-xs font-bold text-slate-400 mt-1">/ {{ $plan['duration'] }}</div>
                    </div>
                    
                    <ul class="text-xs space-y-3 mb-8 flex-grow">
                        <li class="flex items-center gap-2 text-slate-600">
                            <span class="text-green-500">✓</span> {{ $plan['links'] }} Link Ujian
                        </li>
                        <li class="flex items-center gap-2 text-slate-600">
                            <span class="text-green-500">✓</span> Branding Sekolah (Logo)
                        </li>
                        <li class="flex items-center gap-2 text-slate-600">
                            <span class="text-green-500">✓</span> Keamanan Anti-Contek
                        </li>
                        <li class="flex items-center gap-2 text-slate-600">
                            <span class="text-green-500">✓</span> Support Prioritas
                        </li>
                    </ul>

                    <button onclick="checkout('{{ $plan['id'] }}')" class="w-full py-3 rounded-xl {{ $plan['id'] == 'lifetime' ? 'bg-primary text-white' : 'bg-slate-800 text-white' }} font-bold text-xs uppercase tracking-widest hover:opacity-90 transition-opacity">
                        Pilih Paket
                    </button>
                </div>
                @endforeach
            </div>
        </div>

        <!-- History Table -->
        <div class="col-span-full bg-white shadow-lg rounded-2xl border border-slate-200 overflow-hidden">
            <div class="p-6 border-b border-slate-100">
                <h2 class="text-lg font-bold text-slate-800">Riwayat Pembayaran</h2>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead class="bg-slate-50 text-slate-400 font-bold uppercase text-[10px] tracking-widest">
                        <tr>
                            <th class="px-6 py-4">Referensi</th>
                            <th class="px-6 py-4">Paket</th>
                            <th class="px-6 py-4">Jumlah</th>
                            <th class="px-6 py-4">Status</th>
                            <th class="px-6 py-4">Tanggal</th>
                            <th class="px-6 py-4">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 text-sm">
                        @forelse($transactions as $trx)
                        <tr>
                            <td class="px-6 py-4 font-bold text-slate-700">{{ $trx->reference }}</td>
                            <td class="px-6 py-4 uppercase text-xs">{{ str_replace('_', ' ', $trx->type) }}</td>
                            <td class="px-6 py-4 font-medium">Rp {{ number_format($trx->amount, 0, ',', '.') }}</td>
                            <td class="px-6 py-4">
                                @if($trx->status == 'success')
                                    <span class="px-2 py-1 bg-green-100 text-green-700 rounded-full text-[10px] font-black uppercase">BERHASIL</span>
                                @elseif($trx->status == 'pending')
                                    <span class="px-2 py-1 bg-amber-100 text-amber-700 rounded-full text-[10px] font-black uppercase">MENUNGGU</span>
                                @else
                                    <span class="px-2 py-1 bg-red-100 text-red-700 rounded-full text-[10px] font-black uppercase">GAGAL</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-slate-500">{{ $trx->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                @if($trx->status == 'pending' && $trx->snap_token)
                                    <button onclick="window.snap.pay('{{ $trx->snap_token }}')" class="text-primary font-bold text-xs hover:underline">Bayar Sekarang</button>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic">Belum ada riwayat transaksi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>

<!-- Midtrans Snap Script -->
<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('services.midtrans.client_key') }}"></script>
<script>
    function checkout(planId) {
        if (!confirm('Anda yakin ingin memilih paket ini?')) return;
        
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
                    onError: function(result) { alert('Pembayaran gagal!'); },
                    onClose: function() { alert('Anda menutup layar pembayaran.'); }
                });
            } else {
                alert(data.error || 'Terjadi kesalahan sistem.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Gagal memproses permintaan.');
        });
    }
</script>
@endsection
