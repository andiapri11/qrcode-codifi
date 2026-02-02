@extends('layouts.admin')

@section('content')
<div class="min-h-[70vh] flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 animate-in fade-in zoom-in duration-500">
    <div class="max-w-md w-full space-y-8 bg-white dark:bg-slate-900 p-10 rounded-[3rem] shadow-2xl border border-slate-100 dark:border-slate-800 text-center relative overflow-hidden">
        <!-- Background Decoration -->
        <div class="absolute -top-24 -right-24 w-48 h-48 bg-emerald-500/10 rounded-full blur-3xl"></div>
        <div class="absolute -bottom-24 -left-24 w-48 h-48 bg-blue-500/10 rounded-full blur-3xl"></div>

        <div class="relative">
            <!-- Success Icon -->
            <div class="mx-auto flex items-center justify-center h-24 w-24 rounded-full bg-emerald-50 dark:bg-emerald-900/20 mb-8 shadow-inner">
                <svg class="h-12 w-12 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                </svg>
            </div>

            <h2 class="text-3xl font-black text-slate-900 dark:text-white tracking-tighter uppercase mb-2">Pembayaran Berhasil!</h2>
            <p class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-10">Transaksi Anda telah kami terima dan diverifikasi</p>

            <div class="space-y-4 mb-10">
                <div class="p-6 bg-slate-50 dark:bg-slate-800/50 rounded-3xl border border-slate-100 dark:border-slate-800/50 text-left">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Status Langganan</p>
                    <p class="text-xs font-black text-slate-900 dark:text-white uppercase tracking-tight">Akun Instansi Anda kini telah Aktif sebagai member PREMIUM.</p>
                </div>
                
                <p class="text-[9px] font-bold text-slate-400 italic">Data limit dan masa berlaku paket telah diperbarui secara otomatis di dashboard Agan.</p>
            </div>

            <div class="flex flex-col gap-4">
                <a href="{{ route('subscription.index') }}" class="w-full py-4 bg-slate-900 text-white dark:bg-white dark:text-slate-900 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:scale-[1.02] active:scale-[0.98] transition-all shadow-xl shadow-slate-200 dark:shadow-none">
                    Ke Riwayat Billing
                </a>
                <a href="{{ route('dashboard') }}" class="w-full py-4 bg-white dark:bg-slate-800 text-slate-400 dark:text-slate-500 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] border border-slate-100 dark:border-slate-800 hover:bg-slate-50 dark:hover:bg-slate-700 transition-all">
                    Kembali ke Dashboard
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Auto redirect if needed, or just stay here -->
<script>
    // Optional: confetti or something fun
</script>
@endsection
