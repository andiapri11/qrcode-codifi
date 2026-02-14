@extends('layouts.admin')

@section('content')
<!-- Stripe-Inspired Minimalist Checkout -->
<style>
    /* Focus Mode: Keep sidebar, hide top header only */
    nav.sticky, header.bg-white { display: none !important; }
    main { padding-top: 1.5rem !important; }
</style>

<div class="flex items-center justify-center py-4 md:py-8 animate-in fade-in duration-1000">
    <div class="w-full max-w-[1100px] bg-white rounded-3xl shadow-[0_48px_100px_-24px_rgba(0,0,0,0.06)] border border-slate-100 overflow-hidden flex flex-col md:flex-row min-h-[750px]">
        
        <!-- Left Column: Order Summary -->
        <div class="w-full md:w-[420px] bg-slate-50/40 border-r border-slate-100 p-8 md:p-14 flex flex-col">
            <div class="mb-auto">
                <a href="{{ route('subscription.index') }}" class="inline-flex items-center text-[11px] font-black text-slate-400 hover:text-slate-900 transition-all mb-16 group tracking-widest">
                    <svg class="w-4 h-4 mr-2 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                    KEMBALI
                </a>

                <div class="space-y-2 mb-12">
                    <div class="flex items-center gap-2 mb-2">
                        <span class="w-2 h-2 rounded-full bg-indigo-600"></span>
                        <span class="text-[10px] font-black text-indigo-600 tracking-[0.3em] uppercase">Checkout</span>
                    </div>
                    <h2 class="text-4xl font-medium text-slate-900 tracking-tighter leading-[1.1]">Konfirmasi<br>Pembayaran</h2>
                </div>

                <div class="space-y-8">
                    <div class="flex justify-between items-start">
                        <div class="space-y-1.5">
                            <p class="text-[14px] font-bold text-slate-800 uppercase tracking-tight">{{ $plan['name'] }}</p>
                            <p class="text-[12px] text-slate-500 font-medium">Subscription Plan ({{ $plan['duration'] }})</p>
                        </div>
                        <span class="text-[14px] font-black text-slate-900">IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>

                    <div class="h-px bg-slate-200/50 w-full"></div>

                    <div class="space-y-4">
                        <div class="flex justify-between items-center text-[12px] text-slate-500 font-medium tracking-tight">
                            <span>Subtotal</span>
                            <span>IDR {{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center text-[12px] text-slate-500 font-medium tracking-tight">
                            <span>Biaya Transaksi</span>
                            <span class="text-emerald-500 text-[10px] font-black uppercase tracking-widest bg-emerald-50 px-2 py-0.5 rounded-md">Free</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-16 pt-12 border-t border-slate-200/50">
                <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.3em] block mb-3">Total Payable</span>
                <div class="text-5xl font-light text-slate-950 tracking-tighter flex items-baseline gap-1">
                    <span class="text-xl font-medium text-slate-400">IDR</span>{{ number_format($transaction->amount, 0, ',', '.') }}
                </div>
                
                <div class="mt-10 flex items-center justify-between p-4 bg-white rounded-2xl border border-slate-100 shadow-sm">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 rounded-full bg-rose-500 animate-pulse"></div>
                        <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest tabular-nums" id="countdown">00:00:00</span>
                    </div>
                    <svg class="w-4 h-4 text-slate-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                </div>
            </div>
        </div>

        <!-- Right Column: Focus Payment -->
        <div class="flex-1 flex flex-col relative bg-white">
            <!-- Floating Security Indicator -->
            <div class="absolute top-10 right-10 flex items-center gap-2 group cursor-help z-20">
                <span class="text-[10px] font-black text-slate-300 uppercase tracking-widest">AES-256 Encrypted</span>
                <svg class="w-4 h-4 text-slate-200 group-hover:text-emerald-500 transition-colors" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" clip-rule="evenodd" /></svg>
            </div>

            <!-- Loader -->
            <div id="paymentLoader" class="absolute inset-0 z-30 bg-white flex flex-col items-center justify-center transition-all duration-700">
                <div class="w-8 h-8 border-[3px] border-slate-50 border-t-indigo-600 rounded-full animate-spin"></div>
            </div>

            <!-- Iframe Section: Deep Negative Margin to Hide Internal Header -->
            <div class="flex-1 overflow-hidden">
                <iframe 
                    src="{{ $transaction->snap_token }}" 
                    id="paymentIframe"
                    style="width: 100%; border: none; height: 1100px; margin-top: -105px;"
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
