@extends('layouts.admin')

@section('content')
<div class="max-w-[1200px] mx-auto animate-in fade-in slide-in-from-bottom-6 duration-700">
    
    <!-- Ultra-Clean Header -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-8 mb-10">
        <div class="space-y-1">
            <nav class="flex items-center gap-2 mb-3">
                <a href="{{ route('subscription.index') }}" class="group flex items-center gap-2 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] hover:text-indigo-600 transition-all">
                    <svg class="w-3.5 h-3.5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M15 19l-7-7 7-7" /></svg>
                    Kembali ke Paket
                </a>
            </nav>
            <h2 class="text-3xl font-black text-slate-900 tracking-tight leading-none">
                Checkout <span class="text-indigo-600">Pembayaran</span>
            </h2>
            <p class="text-[11px] text-slate-400 font-bold uppercase tracking-[0.2em] flex items-center gap-2">
                Trx Ref: <span class="bg-slate-100 text-slate-600 px-2 py-0.5 rounded-md font-black">{{ $transaction->reference }}</span>
            </p>
        </div>

        <div class="flex items-center gap-4 bg-white p-2 pr-6 rounded-[2rem] border border-slate-200/60 shadow-xl shadow-slate-100/50">
             <div class="w-14 h-14 bg-rose-50 text-rose-500 rounded-[1.5rem] flex items-center justify-center relative overflow-hidden group">
                <div class="absolute inset-0 bg-rose-500/10 scale-0 group-hover:scale-100 transition-transform duration-500 rounded-full"></div>
                <svg class="w-6 h-6 relative z-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
            </div>
            <div>
                <span class="text-[8px] font-black text-slate-400 uppercase tracking-widest block mb-0.5">Berakhir Dalam</span>
                <span id="countdown" class="text-lg font-black text-slate-900 tracking-tighter tabular-nums leading-none">00:00:00</span>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-12 gap-10 items-start">
        <!-- Sidebar Detail: Refined UI -->
        <div class="col-span-12 lg:col-span-4 space-y-8">
            
            <div class="bg-white rounded-[2.5rem] border border-slate-200/80 shadow-sm relative overflow-hidden">
                <div class="p-8 pb-4">
                    <div class="flex items-center gap-2 mb-8">
                        <span class="w-1 h-5 bg-indigo-600 rounded-full"></span>
                        <h3 class="text-[11px] font-black text-slate-900 uppercase tracking-[0.2em]">Summary Pesanan</h3>
                    </div>
                    
                    <div class="space-y-6">
                        <div class="flex items-center justify-between p-5 bg-indigo-50/30 rounded-[1.5rem] border border-indigo-100/30">
                            <div>
                                <div class="text-[9px] font-black text-indigo-400 uppercase tracking-widest mb-1">Paket Pilihan</div>
                                <div class="text-sm font-black text-slate-800 uppercase tracking-tight">{{ $plan['name'] }}</div>
                            </div>
                            <div class="text-2xl animate-bounce duration-[3000ms]">🚀</div>
                        </div>

                        <div class="px-2 space-y-4">
                            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest transition-colors hover:text-slate-600">
                                <span>Durasi Akses</span>
                                <span class="text-slate-800 font-black">{{ $plan['duration'] }}</span>
                            </div>
                            <div class="flex justify-between items-center text-[10px] font-bold text-slate-400 uppercase tracking-widest transition-colors hover:text-slate-600">
                                <span>Layanan Support</span>
                                <span class="text-emerald-500 font-black">PRIORITY</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="p-8 pt-6 bg-slate-50/50 border-t border-slate-100/80">
                    <div class="flex justify-between items-end">
                        <div class="space-y-1">
                            <span class="text-[10px] font-black text-slate-400 uppercase tracking-widest">Total Bayar</span>
                            <div class="text-[8px] font-bold text-emerald-600 bg-emerald-50 px-2 py-0.5 rounded-full uppercase tracking-tighter inline-block italic">No Admin Fees</div>
                        </div>
                        <div class="text-3xl font-black text-slate-900 tracking-tighter leading-none">
                            <span class="text-xs font-bold text-slate-400 mr-1 uppercase">IDR</span>{{ number_format($transaction->amount, 0, ',', '.') }}
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pro Tips / Alert -->
            <div class="bg-indigo-900 rounded-[2.5rem] p-8 text-white relative overflow-hidden shadow-2xl shadow-indigo-200">
                <div class="absolute -right-4 -top-4 w-24 h-24 bg-white/10 rounded-full blur-2xl"></div>
                <div class="relative z-10">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-8 h-8 rounded-xl bg-white/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                        </div>
                        <h4 class="text-[10px] font-black uppercase tracking-[0.2em]">Instruksi Otomatis</h4>
                    </div>
                    <p class="text-[11px] text-indigo-100 font-medium leading-relaxed mb-6">
                        Silakan pilih metode pembayaran di sebelah kanan. Nomor Virtual Account atau QRIS akan muncul setelah Anda memilih metode.
                    </p>
                    <div class="flex items-center gap-2">
                        <span class="w-2 h-2 rounded-full bg-emerald-400 animate-pulse"></span>
                        <span class="text-[9px] font-black uppercase tracking-widest text-indigo-200">Validasi Real-time</span>
                    </div>
                </div>
            </div>

            <p class="text-center text-[9px] text-slate-400 font-bold uppercase tracking-widest leading-loose px-4">
                Powered by PT. CIPTA INOVASI DIGITAL<br> 
                Sumatera Selatan, Indonesia
            </p>
        </div>

        <!-- Main Content: Embedded Payment -->
        <div class="col-span-12 lg:col-span-8">
            <div class="bg-white rounded-[3rem] border border-slate-200 shadow-2xl shadow-slate-200/50 overflow-hidden relative min-h-[750px] group transition-all duration-500 hover:shadow-indigo-100">
                
                <!-- Skeleton Loader -->
                <div id="paymentLoader" class="absolute inset-0 z-20 bg-white flex flex-col items-center justify-center p-12 transition-all duration-500">
                    <div class="relative">
                        <div class="w-20 h-20 border-[6px] border-slate-50 border-t-indigo-600 rounded-full animate-spin"></div>
                        <div class="absolute inset-0 flex items-center justify-center">
                            <img src="{{ asset('assets/images/logo.png') }}" class="w-8 h-8 grayscale opacity-20">
                        </div>
                    </div>
                    <h3 class="mt-8 text-[11px] font-black text-slate-900 uppercase tracking-[0.3em] animate-pulse">Establishing Connection...</h3>
                    <p class="mt-2 text-[10px] text-slate-400 font-medium italic">Secure Tunnel to Payment Gateway</p>
                </div>

                <!-- Seamless Header for Widget -->
                <div class="px-8 py-5 border-b border-slate-100/80 bg-slate-50/50 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <div class="flex items-center -space-x-2">
                            <span class="w-2.5 h-2.5 rounded-full bg-rose-400 shadow-sm border border-white"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-amber-400 shadow-sm border border-white"></span>
                            <span class="w-2.5 h-2.5 rounded-full bg-emerald-400 shadow-sm border border-white"></span>
                        </div>
                        <span class="h-4 w-px bg-slate-200 mx-2"></span>
                        <div class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] flex items-center gap-2">
                             Secure Payment Portal 
                            <svg class="w-3 h-3 text-indigo-500" fill="currentColor" viewBox="0 0 20 20"><path d="M5 9V7a5 5 0 0110 0v2a2 2 0 012 2v5a2 2 0 01-2 2H5a2 2 0 01-2-2v-5a2 2 0 012-2zm8-2v2H7V7a3 3 0 016 0z" /></svg>
                        </div>
                    </div>
                    <div class="flex items-center gap-4">
                        <img src="https://www.xendit.co/wp-content/uploads/2017/08/xendit-logo.png" class="h-3 opacity-20 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-500">
                    </div>
                </div>

                <!-- Iframe Wrapper with Negative Margin to Hide Internal Header -->
                <div class="relative w-full overflow-hidden bg-white" style="height: 800px;">
                    <iframe 
                        src="{{ $transaction->snap_token }}" 
                        id="paymentIframe"
                        style="width: 100%; border: none; height: 1100px; margin-top: -65px;"
                        onload="handleIframeLoad()"
                        class="transition-opacity duration-1000 opacity-0"
                    ></iframe>
                </div>
            </div>

            <!-- Footer Meta -->
            <div class="mt-12 flex flex-col items-center">
                <div class="flex items-center gap-8 opacity-25 grayscale hover:grayscale-0 hover:opacity-100 transition-all duration-700 mb-6">
                    <img src="https://static.okrs.id/assets/images/payment/visa.png" class="h-4">
                    <img src="https://static.okrs.id/assets/images/payment/mastercard.png" class="h-4">
                    <img src="https://static.okrs.id/assets/images/payment/jcb.png" class="h-4">
                    <img src="https://static.okrs.id/assets/images/payment/qris.png" class="h-6">
                    <img src="https://static.okrs.id/assets/images/payment/bca.png" class="h-3">
                </div>
                <p class="text-[9px] font-black text-slate-300 uppercase tracking-[0.4em]">Integrated Secure Infrastructure</p>
            </div>
        </div>
    </div>
</div>

<style>
    /* Styling to make custom scrollbars for the whole layout if needed */
    .no-scrollbar::-webkit-scrollbar { display: none; }
    .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>

<script>
    function handleIframeLoad() {
        const loader = document.getElementById('paymentLoader');
        const iframe = document.getElementById('paymentIframe');
        
        loader.classList.add('opacity-0', 'pointer-events-none');
        iframe.classList.remove('opacity-0');
        iframe.classList.add('opacity-100');
        
        setTimeout(() => {
            loader.classList.add('hidden');
        }, 500);
    }

    // High-Precision Countdown
    function startCountdown() {
        const expiry = new Date("{{ $transaction->created_at->addHours(24)->toIso8601String() }}").getTime();
        const display = document.getElementById('countdown');
        
        const update = () => {
            const now = new Date().getTime();
            const diff = expiry - now;

            if (diff <= 0) {
                display.innerText = "EXPIRED";
                display.classList.add('text-rose-600');
                return;
            }

            const h = Math.floor(diff / (1000 * 60 * 60));
            const m = Math.floor((diff / (1000 * 60)) % 60);
            const s = Math.floor((diff / 1000) % 60);

            display.innerText = 
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
