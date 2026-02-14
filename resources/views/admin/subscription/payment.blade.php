@extends('layouts.admin')

@section('content')
<!-- Stripe-Inspired Minimalist Checkout -->
<div class="min-h-[85vh] flex items-center justify-center py-6 md:py-12 animate-in fade-in duration-1000">
    <div class="w-full max-w-[1100px] bg-white rounded-2xl shadow-[0_40px_100px_-20px_rgba(0,0,0,0.08)] border border-slate-100 overflow-hidden flex flex-col md:flex-row min-h-[700px]">
        
        <!-- Left Column: Order Summary (Neutral/Elegant) -->
        <div class="w-full md:w-[400px] bg-slate-50/50 border-r border-slate-100 p-8 md:p-12 flex flex-col">
            <div class="mb-auto">
                <a href="{{ route('subscription.index') }}" class="inline-flex items-center text-[11px] font-bold text-slate-400 hover:text-slate-900 transition-colors mb-12 group">
                    <svg class="w-3.5 h-3.5 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M15 19l-7-7 7-7" /></svg>
                    KEMBALI KE PAKET
                </a>

                <div class="space-y-1 mb-10">
                    <span class="text-[10px] font-black text-indigo-600 tracking-[0.2em] uppercase">Konfirmasi Tagihan</span>
                    <h2 class="text-3xl font-medium text-slate-900 tracking-tight leading-tight">Selesaikan Pembayaran Anda.</h2>
                </div>

                <div class="space-y-6">
                    <div class="flex justify-between items-start group">
                        <div class="space-y-1">
                            <p class="text-[13px] font-semibold text-slate-700 uppercase tracking-tight">{{ $plan['name'] }}</p>
                            <p class="text-[11px] text-slate-400 font-medium">Aktivasi Link Barcode ({{ $plan['duration'] }})</p>
                        </div>
                        <span class="text-sm font-bold text-slate-900">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="h-px bg-slate-200/60 w-full"></div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-[12px] text-slate-500 font-medium">
                            <span>Subtotal</span>
                            <span>IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[12px] text-slate-500 font-medium">
                            <span>Pajak (PPN)</span>
                            <span class="text-emerald-500 text-[10px] font-bold uppercase tracking-widest">Included</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 pt-12 border-t border-slate-200/60">
                <div class="flex items-baseline gap-2 mb-2">
                    <span class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">Total Bayar</span>
                </div>
                <div class="text-4xl font-light text-slate-950 tracking-tighter">
                    <span class="text-xl font-medium text-slate-400 mr-1">IDR</span>{{ number_format($transaction->amount, 0, ',', '.') }}
                </div>
                
                <div class="mt-8 flex items-center gap-3 p-3 bg-white rounded-xl border border-rose-100/50 shadow-sm">
                    <div class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></div>
                    <span class="text-[10px] font-bold text-rose-500 uppercase tracking-widest tabular-nums" id="countdown">Sisa Waktu: 00:00:00</span>
                </div>
            </div>
        </div>

        <!-- Right Column: Xendit Payment Form (Pure Focus) -->
        <div class="flex-1 flex flex-col relative bg-white">
            <!-- Security Badge (Floating/Minimal) -->
            <div class="absolute top-6 right-8 flex items-center gap-2 px-3 py-1.5 bg-slate-50 rounded-full border border-slate-100 z-20">
                <svg class="w-3 h-3 text-slate-400" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
                <span class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">Secure Payment Gateway</span>
            </div>

            <!-- Preloader: Clean & Minimal -->
            <div id="paymentLoader" class="absolute inset-0 z-30 bg-white flex flex-col items-center justify-center transition-opacity duration-700">
                <div class="w-10 h-10 border-2 border-slate-100 border-t-slate-900 rounded-full animate-spin"></div>
                <p class="mt-4 text-[10px] font-bold text-slate-400 uppercase tracking-[0.2em] animate-pulse">Processing Order...</p>
            </div>

            <!-- Iframe Container: No browser frames, pure content -->
            <div class="flex-1 overflow-hidden">
                <iframe 
                    src="{{ $transaction->snap_token }}" 
                    id="paymentIframe"
                    style="width: 100%; border: none; height: 1100px; margin-top: -65px;"
                    class="opacity-0 transition-opacity duration-1000"
                    onload="handleIframeLoad()"
                ></iframe>
            </div>

            <!-- Subtle Trust Signatures -->
            <div class="p-8 border-t border-slate-50 bg-slate-50/20 flex flex-wrap justify-center items-center gap-x-8 gap-y-4 grayscale opacity-20 hover:opacity-100 transition-opacity duration-500">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/d/d6/Visa_2021.svg/1200px-Visa_2021.svg.png" class="h-2.5">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/2/2a/Mastercard-logo.svg/1280px-Mastercard-logo.svg.png" class="h-4">
                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/1/12/JCB_logo.svg/1280px-JCB_logo.svg.png" class="h-4">
                <img src="https://static.okrs.id/assets/images/payment/qris.png" class="h-5">
            </div>
        </div>
    </div>
</div>

<script>
    function handleIframeLoad() {
        const loader = document.getElementById('paymentLoader');
        const iframe = document.getElementById('paymentIframe');
        
        setTimeout(() => {
            loader.classList.add('opacity-0', 'pointer-events-none');
            iframe.classList.remove('opacity-0');
            iframe.classList.add('opacity-100');
        }, 100);
        
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 800);
    }

    function startCountdown() {
        const expiry = new Date("{{ $transaction->created_at->addHours(24)->toIso8601String() }}").getTime();
        const display = document.getElementById('countdown');
        
        const update = () => {
            const now = new Date().getTime();
            const diff = expiry - now;

            if (diff <= 0) {
                display.innerText = "TAGIHAN EXPIRED";
                return;
            }

            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff / (1000 * 60)) % 60);
            const s = Math.floor((diff / 1000) % 60);

            display.innerText = "SISA WAKTU: " + 
                String(h).padStart(2, '0') + ":" + 
                String(m).padStart(2, '0') + ":" + 
                String(s).padStart(2, '0');
            
            requestAnimationFrame(update);
        };
        update();
    }
    startCountdown();
</script>
@endsection
