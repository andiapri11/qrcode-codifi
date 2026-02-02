@extends('layouts.admin')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Manajemen Admin Mitra</h2>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-1 uppercase tracking-wider">Kelola akun administrator sekolah yang terintegrasi dengan sistem.</p>
    </div>
    <button onclick="openPartnerModal()" class="bg-blue-600 text-white px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all flex items-center gap-3">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Tambah Admin Mitra
    </button>
</div>

@if(session('success'))
<div class="mb-6 p-5 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-900/30 rounded-3xl text-emerald-600 dark:text-emerald-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-3">
    <span class="w-6 h-6 bg-emerald-100 dark:bg-emerald-800 rounded-full flex items-center justify-center text-[10px]">✓</span>
    {{ session('success') }}
</div>
@endif

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-50 dark:border-slate-800">
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Data Akun</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Instansi Terkait</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-center">Status Akses</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Tindakan</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/10 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-blue-100 dark:bg-blue-900/30 text-blue-600 rounded-full flex items-center justify-center font-black text-xs uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $user->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-0.5">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($user->school)
                            <div class="text-xs font-black text-blue-600 dark:text-blue-400 uppercase tracking-tight">{{ $user->school->name }}</div>
                            <div class="text-[9px] font-bold text-slate-400 uppercase mt-0.5 tracking-widest">MITRA AKTIF</div>
                        @else
                            <span class="text-rose-500 text-[9px] font-black uppercase">Belum Menautkan Instansi</span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-center">
                        <span class="inline-flex items-center gap-2 rounded-full bg-emerald-50 dark:bg-emerald-900/20 px-3 py-1 text-[9px] font-black text-emerald-600 dark:text-emerald-500 border border-emerald-100 dark:border-emerald-900/30 uppercase tracking-widest">
                            <span class="h-1.5 w-1.5 rounded-full bg-emerald-600"></span>
                            GRANTED
                        </span>
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" 
                                onclick="openEditPartnerModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->school_id }}')" 
                                class="p-2.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all border border-transparent hover:border-current">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>

                            <form action="{{ route('partners.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus akses admin mitra ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all border border-transparent hover:border-current">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<!-- CREATE PARTNER MODAL -->
<div id="partnerModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" onclick="closePartnerModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300 border border-white/20">
        <button onclick="closePartnerModal()" class="absolute -top-4 -right-4 w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center font-black shadow-lg hover:rotate-90 transition-all">✕</button>
        
        <div class="mb-10">
            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Tambah Admin Mitra</h3>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] mt-2">Daftarkan akun administrator untuk instansi sekolah.</p>
        </div>

        <form action="{{ route('partners.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Instansi Mitra</label>
                <select name="school_id" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Lengkap Admin</label>
                <input type="text" name="name" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Email Resmi</label>
                <input type="email" name="email" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Kata Sandi</label>
                <input type="password" name="password" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all active:scale-95 mt-4">
                Daftarkan Admin Mitra
            </button>
        </form>
    </div>
</div>

<!-- EDIT PARTNER MODAL -->
<div id="editPartnerModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" onclick="closeEditPartnerModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300 border border-white/20">
        <button onclick="closeEditPartnerModal()" class="absolute -top-4 -right-4 w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center font-black shadow-lg hover:rotate-90 transition-all">✕</button>
        
        <div class="mb-10">
            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Edit Admin Mitra</h3>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] mt-2">Perbarui data administrasi instansi.</p>
        </div>

        <form id="editPartnerForm" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Instansi Mitra</label>
                <select name="school_id" id="edit_school_id" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                <input type="text" name="name" id="edit_name" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Email</label>
                <input type="email" name="email" id="edit_email" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Ganti Password (Opsional)</label>
                <input type="password" name="password" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all active:scale-95 mt-4">
                Update Data Mitra
            </button>
        </form>
    </div>
</div>

<script>
    function openPartnerModal() { document.getElementById('partnerModal').classList.remove('hidden'); }
    function closePartnerModal() { document.getElementById('partnerModal').classList.add('hidden'); }
    
    function openEditPartnerModal(id, name, email, schoolId) {
        const modal = document.getElementById('editPartnerModal');
        const form = document.getElementById('editPartnerForm');
        
        form.action = `/partners/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_school_id').value = schoolId;
        
        modal.classList.remove('hidden');
    }

    function closeEditPartnerModal() { document.getElementById('editPartnerModal').classList.add('hidden'); }
</script>
@endsection
