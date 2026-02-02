@extends('layouts.admin')

@section('content')
<div class="mb-8 flex flex-col md:flex-row md:items-center justify-between gap-4">
    <div>
        <h2 class="text-2xl font-black text-slate-900 dark:text-white tracking-tight uppercase">Manajemen Admin Sistem</h2>
        <p class="text-slate-400 dark:text-slate-500 text-xs font-bold mt-1 uppercase tracking-wider">Kelola akses administrator pusat dan admin instansi mitra.</p>
    </div>
    <button onclick="openUserModal()" class="bg-blue-600 text-white px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-[0.2em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all flex items-center gap-3">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M12 4v16m8-8H4" /></svg>
        Tambah Administrator
    </button>
</div>

@if(session('success'))
<div class="mb-6 p-5 bg-emerald-50 dark:bg-emerald-900/20 border border-emerald-100 dark:border-emerald-900/30 rounded-3xl text-emerald-600 dark:text-emerald-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-3">
    <span class="w-6 h-6 bg-emerald-100 dark:bg-emerald-800 rounded-full flex items-center justify-center text-[10px]">✓</span>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-5 bg-rose-50 dark:bg-rose-900/20 border border-rose-100 dark:border-rose-900/30 rounded-3xl text-rose-600 dark:text-rose-500 text-[10px] font-black uppercase tracking-widest flex items-center gap-3">
    <span class="w-6 h-6 bg-rose-100 dark:bg-rose-800 rounded-full flex items-center justify-center text-[10px]">⚠️</span>
    {{ session('error') }}
</div>
@endif

<div class="bg-white dark:bg-slate-900 rounded-[2.5rem] border border-slate-100 dark:border-slate-800 shadow-sm overflow-hidden">
    <div class="overflow-x-auto no-scrollbar">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-slate-50/50 dark:bg-slate-800/30 border-b border-slate-50 dark:border-slate-800">
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Profil Admin</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Tingkat Akses</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em]">Penempatan</th>
                    <th class="px-8 py-5 text-[10px] font-black uppercase text-slate-400 tracking-[0.2em] text-right">Manajemen</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-50 dark:divide-slate-800">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/30 dark:hover:bg-slate-800/10 transition-colors group">
                    <td class="px-8 py-6">
                        <div class="flex items-center gap-4">
                            <div class="w-10 h-10 bg-slate-100 dark:bg-slate-800 rounded-full flex items-center justify-center font-black text-slate-500 text-xs uppercase">
                                {{ substr($user->name, 0, 1) }}
                            </div>
                            <div>
                                <div class="text-sm font-black text-slate-900 dark:text-white uppercase tracking-tight">{{ $user->name }}</div>
                                <div class="text-[10px] font-bold text-slate-400 dark:text-slate-500 mt-0.5">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-8 py-6">
                        @if($user->role === 'superadmin')
                            <span class="inline-flex items-center gap-2 rounded-full bg-blue-50 dark:bg-blue-900/20 px-3 py-1 text-[9px] font-black text-blue-600 dark:text-blue-500 border border-blue-100 dark:border-blue-900/30 uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-blue-600 shadow-[0_0_8px_#3b82f6]"></span>
                                SUPERADMIN
                            </span>
                        @else
                            <span class="inline-flex items-center gap-2 rounded-full bg-slate-50 dark:bg-slate-800 px-3 py-1 text-[9px] font-black text-slate-600 dark:text-slate-400 border border-slate-100 dark:border-slate-700 uppercase tracking-widest">
                                <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                MITRA ADMIN
                            </span>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        @if($user->school)
                            <div class="text-xs font-black text-slate-700 dark:text-slate-300 uppercase tracking-tight">{{ $user->school->name }}</div>
                            <div class="text-[9px] font-bold text-slate-400 uppercase mt-0.5">INSTANSI AKTIF</div>
                        @else
                            <div class="text-xs font-black text-blue-600 dark:text-blue-500 uppercase tracking-tight italic">PUSAT SISTEM</div>
                        @endif
                    </td>
                    <td class="px-8 py-6">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" 
                                onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->school_id }}')" 
                                class="p-2.5 text-slate-400 hover:text-blue-600 hover:bg-blue-50 dark:hover:bg-blue-900/20 rounded-xl transition-all border border-transparent hover:border-current">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>

                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('⚠️ Hapus akses administrator ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 dark:hover:bg-rose-900/20 rounded-xl transition-all border border-transparent hover:border-current">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
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
</div>

<!-- CREATE USER MODAL -->
<div id="userModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" onclick="closeUserModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300 border border-white/20">
        <button onclick="closeUserModal()" class="absolute -top-4 -right-4 w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center font-black shadow-lg hover:rotate-90 transition-all">✕</button>
        
        <div class="mb-10">
            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Tambah Administrator</h3>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] mt-2">Daftarkan akun administrator baru untuk sistem.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-6">
            @csrf
            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Role Akses</label>
                <select name="role" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm" onchange="toggleSchoolField(this.value, 'create')">
                    <option value="superadmin">Administrator Pusat (Full Access)</option>
                    <option value="school_admin">Administrator Mitra (School Limited)</option>
                </select>
            </div>

            <div id="school_field_create" class="hidden">
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Instansi Mitra</label>
                <select name="school_id" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="md:col-span-2">
                    <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                    <input type="text" name="name" required placeholder="NAMA SESUAI IDENTITAS" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm placeholder:opacity-30">
                </div>
                <div>
                    <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Email Aktif</label>
                    <input type="email" name="email" required placeholder="ADM@SCHOLA.ID" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm placeholder:opacity-30">
                </div>
                <div>
                    <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Kata Sandi</label>
                    <input type="password" name="password" required placeholder="MIN 8 KARAKTER" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm placeholder:opacity-30">
                </div>
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all active:scale-95 mt-4">
                Daftarkan Sekarang
            </button>
        </form>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div id="editUserModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-950/60 backdrop-blur-md" onclick="closeEditModal()"></div>
    <div class="relative bg-white dark:bg-slate-900 rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300 border border-white/20">
        <button onclick="closeEditModal()" class="absolute -top-4 -right-4 w-12 h-12 bg-slate-900 text-white rounded-full flex items-center justify-center font-black shadow-lg hover:rotate-90 transition-all">✕</button>
        
        <div class="mb-10">
            <h3 class="text-xl font-black text-slate-900 dark:text-white uppercase tracking-tight">Edit Administrator</h3>
            <p class="text-[10px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.1em] mt-2">Perbarui informasi kredensial administrator.</p>
        </div>

        <form id="editUserForm" method="POST" class="space-y-6">
            @csrf
            @method('PUT')
            
            <div>
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Role Akses</label>
                <select name="role" id="edit_role" required class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm" onchange="toggleSchoolField(this.value, 'edit')">
                    <option value="superadmin">Administrator Pusat</option>
                    <option value="school_admin">Administrator Mitra</option>
                </select>
            </div>

            <div id="school_field_edit" class="hidden">
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Ganti Instansi Mitra</label>
                <select name="school_id" id="edit_school_id" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm">
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
                <label class="mb-2 block font-black text-slate-400 dark:text-slate-500 text-[9px] uppercase tracking-[0.2em] ml-1">Password (Isi jika ganti)</label>
                <input type="password" name="password" placeholder="MINIMAL 8 KARAKTER" class="w-full rounded-2xl border border-slate-100 dark:border-slate-800 bg-slate-50 dark:bg-slate-800/50 py-4 px-6 font-black text-slate-900 dark:text-white outline-none focus:ring-4 focus:ring-blue-500/10 transition text-xs shadow-sm placeholder:opacity-30">
            </div>

            <button type="submit" class="w-full bg-blue-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-blue-100 dark:shadow-none hover:bg-blue-700 transition-all active:scale-95 mt-4">
                Update Data Admin
            </button>
        </form>
    </div>
</div>

<script>
    function openUserModal() { document.getElementById('userModal').classList.remove('hidden'); }
    function closeUserModal() { document.getElementById('userModal').classList.add('hidden'); }
    
    function toggleSchoolField(role, action) {
        const field = document.getElementById('school_field_' + action);
        if (role === 'school_admin') {
            field.classList.remove('hidden');
        } else {
            field.classList.add('hidden');
        }
    }

    function openEditModal(id, name, email, role, schoolId) {
        const modal = document.getElementById('editUserModal');
        const form = document.getElementById('editUserForm');
        
        form.action = `/users/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role').value = role;
        
        if (schoolId && schoolId !== 'null' && schoolId !== '') {
            document.getElementById('edit_school_id').value = schoolId;
            document.getElementById('school_field_edit').classList.remove('hidden');
        } else {
            document.getElementById('school_field_edit').classList.add('hidden');
        }
        
        modal.classList.remove('hidden');
    }

    function closeEditModal() { document.getElementById('editUserModal').classList.add('hidden'); }
</script>
@endsection
