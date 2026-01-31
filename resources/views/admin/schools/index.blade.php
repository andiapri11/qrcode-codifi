@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight">Manajemen Instansi Mitra</h2>
        <p class="text-slate-500 text-sm mt-1 font-medium">Kelola data instansi, pengaturan whitelist, dan masa aktif langganan.</p>
    </div>
    @if(Auth::user()->role === 'superadmin')
    <a href="{{ route('schools.create') }}" class="inline-flex items-center gap-2 bg-indigo-600 px-5 py-2.5 rounded-xl font-bold text-white shadow-lg shadow-indigo-100 hover:bg-indigo-700 transition-all text-sm">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M12 4v16m8-8H4" /></svg>
        Tambah Instansi
    </a>
    @endif
</div>

<div class="bg-white rounded-[1.5rem] border border-slate-200 shadow-sm overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-200">
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Informasi Instansi</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Langganan</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Status</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Total Link</th>
                    <th class="px-6 py-4 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Manajemen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($schools as $school)
                <tr class="hover:bg-slate-50/50 transition-colors group">
                    <td class="px-6 py-5">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-indigo-50 rounded-xl flex items-center justify-center text-indigo-600 font-black text-sm">
                                {{ substr($school->name, 0, 1) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-slate-900 font-bold text-sm">{{ $school->name }}</span>
                                <span class="text-slate-400 text-[10px] font-medium tracking-wider uppercase">Terintegrasi Ke Sistem Schola</span>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-5 text-center">
                        @if($school->subscription_type === 'lifetime')
                            <span class="bg-amber-50 text-amber-600 text-[10px] font-black px-3 py-1 rounded-lg border border-amber-100 uppercase tracking-widest">LIFE TIME</span>
                        @else
                            <div class="flex flex-col items-center">
                                <span class="bg-slate-100 text-slate-600 text-[10px] font-black px-3 py-1 rounded-lg border border-slate-200 uppercase tracking-widest mb-1">TAHUNAN</span>
                                @if($school->subscription_expires_at)
                                    @if($school->subscription_expires_at->isPast())
                                        <span class="text-[9px] text-rose-500 font-bold uppercase tracking-tighter">Expired: {{ $school->subscription_expires_at->format('d/m/Y') }}</span>
                                    @else
                                        <span class="text-[9px] text-slate-400 font-bold uppercase tracking-tighter">Sampai: {{ $school->subscription_expires_at->format('d/m/Y') }}</span>
                                    @endif
                                @endif
                            </div>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-center">
                        @php
                            $isSubActive = $school->isSubscriptionActive();
                            $finalStatus = $school->is_active && $isSubActive;
                        @endphp

                        @if($finalStatus)
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-emerald-50 px-3 py-1 text-[10px] font-extrabold text-emerald-600 border border-emerald-100 uppercase tracking-tighter">
                                <span class="w-1 h-1 bg-emerald-600 rounded-full"></span>
                                AKTIF
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1.5 rounded-full bg-rose-50 px-3 py-1 text-[10px] font-extrabold text-rose-600 border border-rose-100 uppercase tracking-tighter">
                                <span class="w-1 h-1 bg-rose-600 rounded-full"></span>
                                SUSPENDED
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-5 text-center">
                        <span class="text-slate-700 font-bold text-sm">{{ $school->exam_links_count }}</span>
                    </td>
                    <td class="px-6 py-5">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('schools.edit', $school->id) }}" class="p-2 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all" title="Edit Data">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </a>
                            @if(Auth::user()->role === 'superadmin')
                            <form action="{{ route('schools.destroy', $school->id) }}" method="POST" onsubmit="return confirm('Hapus sekolah ini? Semua data terkait akan hilang.')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all" title="Hapus Sekolah">
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
    <div class="p-20 text-center">
        <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center mx-auto mb-4 border border-dashed border-slate-200 text-3xl">
            📭
        </div>
        <h3 class="text-slate-900 font-bold">Belum ada sekolah terdaftar</h3>
        <p class="text-slate-400 text-sm mt-1">Silakan tambah sekolah baru untuk memulai integrasi.</p>
    </div>
    @endif
</div>
@endsection
