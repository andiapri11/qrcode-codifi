@extends('layouts.admin')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Manajemen Instansi Mitra</h2>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-1 uppercase tracking-wider">Kelola data instansi, pengaturan whitelist, dan masa aktif langganan.</p>
    </div>
    @if(Auth::user()->role === 'superadmin')
    <a href="{{ route('schools.create') }}" class="inline-flex items-center gap-2 bg-blue-600 px-6 py-3 rounded-2xl font-black text-white shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all text-[10px] uppercase tracking-[0.2em]">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Tambah Instansi
    </a>
    @endif
</div>

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/20 border-b border-slate-100 dark:border-slate-800">
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Informasi Instansi</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Langganan</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Akses Sistem</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Total Link</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @foreach($schools as $school)
                <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/10 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-12 h-12 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-sm shadow-md border-2 border-white dark:border-slate-700 overflow-hidden">
                                @if($school->logo_url)
                                    <img src="{{ $school->logo_url }}" class="w-full h-full object-cover">
                                @else
                                    {{ $school->initials }}
                                @endif
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-900 dark:text-white font-black text-sm uppercase tracking-tight">{{ $school->name }}</span>
                                <span class="text-slate-400 dark:text-slate-500 text-[9px] font-bold tracking-[0.1em] uppercase mt-0.5">ID: SCH-{{ str_pad($school->id, 4, '0', STR_PAD_LEFT) }}</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6 text-center">
                        @if($school->subscription_type === 'lifetime')
                            <span class="bg-amber-50 dark:bg-amber-900/20 text-amber-600 dark:text-amber-500 text-[10px] font-black px-4 py-1.5 rounded-xl border border-amber-100 dark:border-amber-900/30 uppercase tracking-widest text-[9px]">LIFE TIME</span>
                        @else
                            <div class="flex flex-col items-center">
                                <span class="bg-indigo-50 dark:bg-indigo-900/20 text-indigo-600 dark:text-indigo-400 text-[10px] font-black px-4 py-1.5 rounded-xl border border-indigo-100 dark:border-indigo-900/30 uppercase tracking-widest text-[9px] mb-1.5">{{ $school->subscription_type === 'year' ? 'Annual' : 'Trial' }}</span>
                                @if($school->subscription_expires_at)
                                    <span class="text-[9px] font-bold uppercase tracking-tighter {{ $school->subscription_expires_at->isPast() ? 'text-rose-500' : 'text-slate-400' }}">
                                        {{ $school->subscription_expires_at->format('d M Y') }}
                                    </span>
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-center">
                        @php
                            $isSubActive = $school->isSubscriptionActive();
                            $finalStatus = $school->is_active && $isSubActive;
                        @endphp

                        @if($finalStatus)
                            <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 dark:bg-emerald-900/20 px-4 py-1.5 text-[9px] font-black text-emerald-600 dark:text-emerald-500 border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-emerald-600 shadow-[0_0_8px_#10b981]"></span>
                                ACTIVE
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-rose-50 dark:bg-rose-900/20 px-4 py-1.5 text-[9px] font-black text-rose-600 dark:text-rose-500 border border-rose-100 dark:border-rose-900/30 uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-rose-600"></span>
                                SUSPENDED
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="text-slate-900 dark:text-white font-black text-base">{{ $school->exam_links_count }}</span>
                        <span class="text-[10px] font-bold text-slate-400 dark:text-slate-500 uppercase block tracking-wider">Links</span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-3">
                            <form action="{{ route('schools.toggle-status', $school->id) }}" method="POST">
                                @csrf
                                <button type="submit" class="p-2.5 {{ $school->is_active ? 'text-rose-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20' : 'text-emerald-400 hover:text-emerald-600 hover:bg-emerald-50 dark:hover:bg-emerald-900/20' }} rounded-xl transition-all border border-transparent hover:border-current" title="{{ $school->is_active ? 'Suspend' : 'Activate' }}">
                                    @if($school->is_active)
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728L5.636 5.636" /></svg>
                                    @else
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                                    @endif
                                </button>
                            </form>

                            <a href="{{ route('schools.edit', $school->id) }}" class="p-2.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all border border-transparent hover:border-current" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            
                            @if(Auth::user()->role === 'superadmin')
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" onsubmit="return confirm('⚠️ Hapus sekolah ini secara permanen? Seluruh data terkait (user, link, history) akan dimusnahkan.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all border border-transparent hover:border-current" title="Hapus Sekolah">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @if($schools->isEmpty())
    <div class="p-24 text-center">
        <div class="w-24 h-24 bg-slate-50 dark:bg-slate-800/50 rounded-full flex items-center justify-center mx-auto mb-6 border border-dashed border-slate-200 dark:border-slate-700 text-4xl">
            🏗️
        </div>
        <h3 class="text-slate-900 dark:text-white font-black uppercase text-lg tracking-tight">Belum ada mitra instansi</h3>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-2 uppercase tracking-widest">Mulai dengan menambahkan sekolah mitra pertama Anda.</p>
        <a href="{{ route('schools.create') }}" class="inline-flex items-center gap-2 bg-blue-600 px-8 py-4 rounded-2xl font-black text-white shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all text-[10px] uppercase tracking-[0.2em] mt-8">
            Tambah Sekarang
        </a>
    </div>
    @endif
</div>
@endsection
