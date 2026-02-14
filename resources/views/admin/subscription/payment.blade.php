@extends('layouts.admin')

@section('content')
<div class="max-w-6xl mx-auto animate-in fade-in slide-in-from-bottom-4 duration-700">
    <!-- Header: Stepper or Progress -->
    <div class="mb-8 flex flex-col md:flex-row justify-between items-center gap-6">
        <div class="flex items-center gap-4">
            <div class="w-12 h-12 bg-emerald-50 rounded-2xl flex items-center justify-center text-emerald-600 shadow-sm">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z" /></svg>
            </div>
            <div>
                <h2 class="text-xl font-black text-slate-900 tracking-tight uppercase">Selesaikan Pembayaran</h2>
                <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-0.5">Order ID: <span class="text-indigo-600">{{ $transaction->reference }}</span></p>
            </div>
        </div>
        
        <div class="flex items-center gap-2 bg-white px-5 py-3 rounded-2xl border border-slate-100 shadow-sm">
            <div class="flex flex-col items-end">
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest">Sisa Waktu Pembayaran</span>
                <span id="countdown" class="text-xs font-black text-rose-500 tracking-tighter">--:--:--</span>
            </div>
            <div class="w-8 h-8 rounded-full border-2 border-slate-100 flex items-center justify-center text-rose-500 animate-pulse">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-8 items-start">
        <!-- Sidebar: Summary -->
        <div class="col-span-12 lg:col-span-4 space-y-6">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm p-8">
                <div class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em] mb-6 flex items-center gap-2">
                    <span class="w-1.5 h-4 bg-indigo-600 rounded-full"></span>
                    Ringkasan Pesanan
                </div>
                
                <div class="space-y-6">
                    <div class="flex items-start justify-between gap-4 p-4 bg-slate-50 rounded-2xl border border-slate-100/50">
                        <div>
                            <div class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Paket Layanan</div>
                            <div class="text-sm font-black text-slate-800 uppercase mt-1">{{ $plan['name'] }}</div>
                            <div class="text-[8px] font-bold text-indigo-500 uppercase tracking-widest mt-0.5">Masa Aktif: {{ $plan['duration'] }}</div>
                        </div>
                        <div class="text-xl">🚀</div>
                    </div>

                    <div class="pt-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Harga Paket</span>
                            <span class="text-[11px] font-black text-slate-700">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center mb-6">
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Biaya Layanan</span>
                            <span class="text-[11px] font-black text-emerald-600 uppercase tracking-widest">GRATIS</span>
                        </div>
                        <div class="pt-5 border-t border-slate-100 flex justify-between items-end">
                            <div>
                                <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Total Tagihan</span>
                                <p class="text-[7px] text-slate-400 font-bold uppercase tracking-widest mt-1">PPN Termasuk</p>
                            </div>
                            <div class="text-2xl font-black text-slate-900 tracking-tighter">
                                <span class="text-xs font-bold text-slate-400 mr-1">Rp</span>{{ number_format($transaction->amount, 0, ',', '.') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-amber-50 rounded-[2rem] border border-amber-100 p-6 flex items-start gap-4">
                <div class="w-10 h-10 bg-white rounded-xl flex items-center justify-center text-amber-500 shadow-sm shrink-0">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
                <div>
                    <h4 class="text-[10px] font-black text-amber-900 uppercase tracking-widest mb-1">Penting</h4>
                    <p class="text-[10px] text-amber-800 font-medium leading-relaxed italic opacity-80">
                        Pastikan nominal transfer sesuai dengan total tagihan agar sistem dapat memverifikasi pembayaran Anda secara otomatis dalam hitungan detik.
                    </p>
                </div>
            </div>

            <a href="{{ route('subscription.index') }}" class="flex items-center justify-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-slate-900 transition-colors py-4">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                Kembali & Ganti Paket
            </a>
        </div>

        <!-- Main Content: Xendit Widget -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-xl overflow-hidden relative">
                <div class="absolute inset-x-0 top-0 h-1.5 bg-gradient-to-r from-blue-600 via-indigo-600 to-emerald-600"></div>
                
                <!-- Loading State placeholder -->
                <div id="paymentLoader" class="absolute inset-0 z-10 bg-white flex flex-col items-center justify-center">
                    <div class="w-12 h-12 border-4 border-slate-100 border-t-indigo-600 rounded-full animate-spin"></div>
                    <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mt-6">Menyiapkan Instruksi Pembayaran...</p>
                </div>

                <div class="p-4 md:p-6 bg-slate-50 border-b border-slate-100 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('assets/images/logo.png') }}" class="w-6 h-6 grayscale opacity-30">
                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em]">Secure Checkout by <span class="text-slate-900">Xendit</span></div>
                    </div>
                </div>

                <!-- The Iframe Wrapper with custom height for better UX -->
                <div class="relative w-full overflow-hidden" style="min-height: 650px;">
                    <iframe 
                        src="{{ $transaction->snap_token }}" 
                        id="paymentIframe"
                        style="width: 100%; border: none; height: 1000px; margin-top: -65px;"
                        onload="document.getElementById('paymentLoader').classList.add('hidden')"
                    ></iframe>
                </div>
            </div>
            
            <p class="text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-8 flex items-center justify-center gap-2">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" /></svg>
                Pembayaran Dienkripsi & Terjamin Aman oleh PT. Cipta Inovasi Digital
            </p>
        </div>
    </div>
</div>

<script>
    // Simple countdown logic
    function startCountdown() {
        // Assume 24 hours from created_at
        const expiry = new Date("{{ $transaction->created_at->addHours(24)->toIso8601String() }}").getTime();
        
        const timer = setInterval(() => {
            const now = new Date().getTime();
            const diff = expiry - now;

            if (diff <= 0) {
                clearInterval(timer);
                document.getElementById('countdown').innerText = "EXPIRED";
                return;
            }

            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff / (1000 * 60)) % 60);
            const s = Math.floor((diff / 1000) % 60);

            document.getElementById('countdown').innerText = 
                String(h).padStart(2, '0') + ":" + 
                String(m).padStart(2, '0') + ":" + 
                String(s).padStart(2, '0');
        }, 1000);
    }

    startCountdown();
</script>
@endsection
