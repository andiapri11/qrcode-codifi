@extends('layouts.admin')

@section('content')
@php
    $user = Auth::user();
    $isSuperAdmin = $user->role === 'superadmin';
    
    // Greeting Logic
    $hour = date('H');
    $greeting = 'Selamat Datang';
    if ($hour < 12) $greeting = 'Selamat Pagi';
    elseif ($hour < 15) $greeting = 'Selamat Siang';
    elseif ($hour < 18) $greeting = 'Selamat Sore';
    else $greeting = 'Selamat Malam';
@endphp

<!-- Header: Welcome Banner -->
<div class="relative mb-10 overflow-hidden bg-slate-900 rounded-[3rem] p-8 md:p-12 shadow-2xl shadow-slate-200 dark:shadow-none border border-white/10">
    <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-8">
        <div class="flex items-center gap-6">
            <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-indigo-600 rounded-3xl flex items-center justify-center text-3xl shadow-xl overflow-hidden border-4 border-white/20">
                @php
                    $headerLogo = (!$isSuperAdmin && $user->school) ? $user->school->logo_url : null;
                @endphp
                @if($headerLogo)
                    <img src="{{ $headerLogo }}" class="w-full h-full object-cover">
                @else
                    <span class="animate-pulse">🛡️</span>
                @endif
            </div>
            <div>
                <h2 class="text-3xl font-black text-white leading-tight tracking-tighter uppercase">{{ $greeting }}, {{ explode(' ', $user->name)[0] }}!</h2>
                <div class="flex items-center gap-3 mt-2">
                    <span class="px-3 py-1 bg-white/10 backdrop-blur-md rounded-full text-[9px] font-black text-blue-300 border border-white/10 uppercase tracking-widest">
                        {{ $isSuperAdmin ? 'Full Access Node' : 'Mitra Instance' }}
                    </span>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest pl-2 border-l border-white/20">
                        {{ $isSuperAdmin ? 'Administrator Pusat' : ($user->school ? $user->school->name : 'Administrator') }}
                    </p>
                </div>
            </div>
        </div>

        @if(!$isSuperAdmin && $user->school)
        <div class="flex items-center gap-4 bg-white/5 backdrop-blur-xl px-8 py-5 rounded-[2rem] border border-white/10 shadow-inner">
            <div class="text-right">
                <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest block mb-1">Status Lisensi</span>
                <span class="text-xs font-black text-white uppercase tracking-tight">
                    {{ ($user->school && $user->school->subscription_expires_at) ? $user->school->subscription_expires_at->format('d M Y') : 'Life Time' }}
                </span>
            </div>
            <div class="h-10 w-[1px] bg-white/10 mx-2"></div>
            <div class="flex flex-col items-center">
                @if($user->school && $user->school->isSubscriptionActive())
                    <div class="h-3 w-3 bg-emerald-500 rounded-full shadow-[0_0_15px_#10b981] mb-1"></div>
                    <span class="text-[8px] font-black text-emerald-400 uppercase tracking-widest">Aktif</span>
                @else
                    <div class="h-3 w-3 bg-rose-500 rounded-full shadow-[0_0_15px_#f43f5e] mb-1"></div>
                    <span class="text-[8px] font-black text-rose-400 uppercase tracking-widest">Expired</span>
                @endif
            </div>
        </div>
        @endif
    </div>
    
    <!-- Background Decor -->
    <div class="absolute top-0 right-0 -mr-20 -mt-20 w-80 h-80 bg-blue-600/20 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 -ml-20 -mb-20 w-80 h-80 bg-indigo-600/10 rounded-full blur-3xl"></div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
    <!-- Stat 1 -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] hover:shadow-xl hover:shadow-blue-500/5 group">
        <div class="w-14 h-14 bg-blue-50 dark:bg-blue-900/20 text-blue-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">
            {{ $isSuperAdmin ? '🏫' : '📦' }}
        </div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">
                {{ $isSuperAdmin ? $stats['total_schools'] : ($user->school->subscription_type === 'trial' ? 'FREE' : 'PRO') }}
            </div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">{{ $isSuperAdmin ? 'Total Instansi' : 'Paket Layanan' }}</div>
        </div>
    </div>

    <!-- Stat 2 -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] hover:shadow-xl hover:shadow-emerald-500/5 group">
        <div class="w-14 h-14 bg-emerald-50 dark:bg-emerald-900/20 text-emerald-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">⚡</div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $stats['active_links'] }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">Ujian Aktif</div>
        </div>
    </div>

    <!-- Stat 3 -->
    @if($isSuperAdmin)
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] hover:shadow-xl hover:shadow-amber-500/5 group">
        <div class="w-14 h-14 bg-amber-50 dark:bg-amber-900/20 text-amber-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">💰</div>
        <div>
            <div class="text-xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">
                <span class="text-xs">Rp</span> {{ number_format($stats['total_revenue'], 0, ',', '.') }}
            </div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">Penerimaan Global</div>
        </div>
    </div>
    @else
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] hover:shadow-xl hover:shadow-purple-500/5 group">
        <div class="w-14 h-14 bg-purple-50 dark:bg-purple-900/20 text-purple-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">📊</div>
        <div>
            <div class="text-2xl font-black text-slate-900 dark:text-white leading-none tracking-tighter">{{ $stats['total_links'] }}</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">Total Link QR</div>
        </div>
    </div>
    @endif

    <!-- Stat 4 -->
    <div class="bg-white dark:bg-slate-900 p-6 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm flex items-center gap-5 transition-all hover:translate-y-[-4px] hover:shadow-xl hover:shadow-indigo-500/5 group">
        <div class="w-14 h-14 bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 rounded-2xl flex items-center justify-center text-2xl group-hover:scale-110 transition-transform">🛡️</div>
        <div>
            <div class="text-xl font-black text-slate-900 dark:text-white leading-none tracking-tighter uppercase italic">Secure</div>
            <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase tracking-widest mt-2">API Firewall</div>
        </div>
    </div>
</div>

<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 items-start">
    <!-- Left: Tables -->
    <div class="lg:col-span-8 space-y-8">
        <!-- Main Activity Card -->
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
            <div class="px-10 py-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between bg-white dark:bg-slate-900">
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $isSuperAdmin ? 'Pendaftaran Instansi Baru' : 'Data QR Ujian Terakhir' }}</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Status Sinkronisasi Real-Time Node Pusat</p>
                </div>
                <a href="{{ $isSuperAdmin ? route('schools.index') : route('links.index') }}" class="px-6 py-2 bg-slate-50 dark:bg-slate-800 hover:bg-blue-600 hover:text-white transition-all rounded-full text-[9px] font-black text-slate-500 dark:text-slate-400 uppercase tracking-widest">
                    Lihat Semua
                </a>
            </div>
            
            <div class="p-8">
                @if($latestSchools->isEmpty())
                    <div class="text-center py-12">
                        <div class="text-4xl mb-4">📭</div>
                        <p class="text-xs font-black text-slate-300 uppercase tracking-widest">Belum ada aktivitas tercatat</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($latestSchools as $school)
                        <div class="group flex flex-col md:flex-row md:items-center justify-between gap-6 p-6 bg-slate-50/50 dark:bg-slate-800/30 rounded-[2rem] border border-slate-100 dark:border-slate-800 transition-all hover:bg-white dark:hover:bg-slate-800 hover:shadow-xl hover:shadow-slate-200/40 dark:hover:shadow-none hover:border-blue-200 dark:hover:border-blue-900">
                            <div class="flex items-center gap-5">
                                <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-indigo-700 rounded-2xl flex items-center justify-center text-white font-black text-sm shadow-lg overflow-hidden border-2 border-white dark:border-slate-700 transform group-hover:rotate-6 transition-transform">
                                    @if($school->logo_url)
                                        <img src="{{ $school->logo_url }}" class="w-full h-full object-cover">
                                    @else
                                        {{ $school->initials }}
                                    @endif
                                </div>
                                <div>
                                    <div class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $school->name }}</div>
                                    <div class="flex items-center gap-2 mt-1">
                                        <span class="text-[9px] font-black text-blue-600 dark:text-blue-400 uppercase tracking-widest">SID:{{ str_pad($school->id, 4, '0', STR_PAD_LEFT) }}</span>
                                        <span class="w-1 h-1 rounded-full bg-slate-300 dark:bg-slate-600"></span>
                                        <span class="text-[9px] font-bold text-slate-400 uppercase">{{ $school->domain_whitelist ?: 'Global Domain' }}</span>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="flex items-center gap-8">
                                <div class="hidden md:block text-right">
                                    <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] block mb-1">Total Link</span>
                                    <span class="text-sm font-black text-slate-900 dark:text-white">{{ $school->exam_links_count }} Barcode</span>
                                </div>
                                <div class="bg-white dark:bg-slate-900 px-5 py-2.5 rounded-full border border-slate-100 dark:border-slate-700 text-[10px] font-black text-emerald-600 dark:text-emerald-500 uppercase tracking-widest shadow-sm">
                                    Operational
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

        @if($isSuperAdmin && $latestTransactions->isNotEmpty())
        <!-- Real-Time Revenue Log -->
        <div class="bg-white dark:bg-slate-900 rounded-[3rem] border border-slate-100 dark:border-slate-800 overflow-hidden shadow-sm">
            <div class="px-10 py-8 border-b border-slate-50 dark:border-slate-800 flex items-center justify-between">
                <div>
                    <h4 class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">Ledger Transaksi Berhasil</h4>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">Aliran Kas Ekosistem Schola CBT</p>
                </div>
            </div>
            
            <div class="p-8 space-y-3">
                @foreach($latestTransactions as $trx)
                <div class="flex items-center justify-between p-4 px-6 bg-slate-50 dark:bg-slate-800/20 rounded-2xl hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors">
                    <div class="flex items-center gap-4">
                        <div class="w-10 h-10 bg-emerald-100 dark:bg-emerald-900/40 text-emerald-600 rounded-full flex items-center justify-center text-sm">💸</div>
                        <div>
                            <div class="text-[11px] font-black text-slate-800 dark:text-white uppercase tracking-tight">{{ $trx->school->name }}</div>
                            <div class="text-[9px] font-bold text-slate-400 uppercase mt-0.5">{{ $trx->paid_at->diffForHumans() }}</div>
                        </div>
                    </div>
                    <div class="text-right">
                        <div class="text-[11px] font-black text-emerald-600 dark:text-emerald-500 uppercase">+ Rp {{ number_format($trx->amount, 0, ',', '.') }}</div>
                        <div class="text-[8px] font-bold text-slate-400 uppercase tracking-widest mt-0.5">Payment Verified</div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>

    <!-- Right: Sidebar -->
    <div class="lg:col-span-4 space-y-8">
        <!-- Dashboard Assistant / Quick Tool -->
        <div class="bg-gradient-to-br from-indigo-700 to-blue-800 rounded-[3rem] p-10 shadow-2xl relative overflow-hidden text-center group">
            <div class="relative z-10">
                <div class="w-16 h-16 bg-white/20 backdrop-blur-xl rounded-3xl flex items-center justify-center text-white text-3xl mx-auto mb-8 border border-white/20 shadow-lg group-hover:rotate-12 transition-transform">✨</div>
                <h4 class="text-2xl font-black text-white mb-3 uppercase tracking-tighter leading-tight italic">Secure Gateway <br>Codifi Engine</h4>
                <p class="text-[10px] text-blue-100/60 font-black mb-10 leading-relaxed uppercase tracking-[0.2em] px-4">Automasi perlindungan ujian <br>digital instansi mitra.</p>
                
                <a href="{{ route('links.index') }}" class="flex items-center justify-center gap-3 bg-white px-8 py-5 rounded-[1.5rem] text-blue-800 font-black text-[10px] uppercase tracking-[0.2em] shadow-2xl hover:bg-blue-50 transition-all active:scale-95">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 10V3L4 14h7v7l9-11h-7z" /></svg>
                    Buka Management
                </a>
            </div>
            
            <!-- BG FX -->
            <div class="absolute -right-16 -top-16 w-56 h-56 bg-white/10 rounded-full blur-3xl group-hover:bg-white/20 transition-colors"></div>
            <div class="absolute -left-16 -bottom-16 w-48 h-48 bg-blue-400/20 rounded-full blur-3xl"></div>
        </div>

        <!-- System Node Monitor -->
        <div class="bg-slate-900 rounded-[3rem] p-10 border border-slate-800 shadow-2xl">
            <h5 class="text-[9px] font-black text-slate-500 uppercase tracking-[0.4em] mb-10 border-b border-white/5 pb-4">Security Node Status</h5>
            
            <div class="space-y-8">
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_15px_#10b981]"></div>
                        <span class="text-[11px] font-black text-slate-300 uppercase tracking-widest">Secure Handshake</span>
                    </div>
                    <span class="text-[8px] font-black text-emerald-500 uppercase bg-emerald-500/10 px-3 py-1 rounded-full">UP</span>
                </div>
                
                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-2.5 h-2.5 rounded-full bg-emerald-500 shadow-[0_0_15px_#10b981]"></div>
                        <span class="text-[11px] font-black text-slate-300 uppercase tracking-widest">ID Validation</span>
                    </div>
                    <span class="text-[8px] font-black text-emerald-500 uppercase bg-emerald-500/10 px-3 py-1 rounded-full">UP</span>
                </div>

                <div class="flex items-center justify-between">
                    <div class="flex items-center gap-5">
                        <div class="w-2.5 h-2.5 rounded-full bg-blue-500 animate-pulse shadow-[0_0_15px_#3b82f6]"></div>
                        <span class="text-[11px] font-black text-slate-300 uppercase tracking-widest">Database Sync</span>
                    </div>
                    <span class="text-[8px] font-black text-blue-500 uppercase bg-blue-500/10 px-3 py-1 rounded-full italic">LIVE</span>
                </div>
            </div>

            <div class="mt-12 flex items-center gap-4 bg-white/5 p-4 rounded-2xl border border-white/5">
                <div class="w-10 h-10 bg-slate-800 rounded-xl flex items-center justify-center font-black text-blue-500 text-xs">CBT</div>
                <div class="overflow-hidden">
                    <div class="text-[9px] font-black text-white uppercase truncate tracking-tighter">Global Infrastructure</div>
                    <div class="text-[8px] font-bold text-slate-500 uppercase mt-0.5">Codifi.id Secure Node</div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
