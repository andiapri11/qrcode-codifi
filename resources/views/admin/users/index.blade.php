@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight uppercase">Manajemen Administrator</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Kelola hak akses dan akun administrator sistem</p>
    </div>
    <button onclick="openUserModal()" class="bg-indigo-600 text-white px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center gap-2">
        <span>➕</span> Tambah Administrator
    </button>
</div>

@if(session('success'))
<div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-2xl text-emerald-600 text-xs font-bold flex items-center gap-3">
    <span>✅</span>
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="mb-6 p-4 bg-rose-50 border border-rose-100 rounded-2xl text-rose-600 text-xs font-bold flex items-center gap-3">
    <span>⚠️</span>
    {{ session('error') }}
</div>
@endif

<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden text-sm uppercase">
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead>
                <tr class="bg-slate-50/50 border-b border-slate-100">
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest leading-loose">Informasi User</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Role</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Instansi</th>
                    <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @foreach($users as $user)
                <tr class="hover:bg-slate-50/30 transition-colors">
                    <td class="px-8 py-6 font-bold">
                        <div class="text-slate-900">{{ $user->name }}</div>
                        <div class="text-[10px] text-slate-400 font-bold tracking-wider mt-0.5">{{ $user->email }}</div>
                    </td>
                    <td class="px-8 py-6">
                        @if($user->role === 'superadmin')
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-indigo-100 px-3 py-1 text-[9px] font-black text-indigo-600 border border-indigo-200 uppercase">
                            Super Admin
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1.5 rounded-full bg-slate-100 px-3 py-1 text-[9px] font-black text-slate-600 border border-slate-200 uppercase">
                            Admin Instansi
                        </span>
                        @endif
                    </td>
                    <td class="px-8 py-6 text-slate-500 font-bold text-[10px]">
                        {{ $user->school->name ?? 'SISTEM PUSAT' }}
                    </td>
                    <td class="px-8 py-6 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <button type="button" 
                                onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}', '{{ $user->school_id }}')" 
                                class="p-2.5 text-slate-400 hover:text-indigo-600 hover:bg-indigo-50 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" /></svg>
                            </button>

                            @if(auth()->id() !== $user->id)
                            <form action="{{ route('users.destroy', $user) }}" method="POST" onsubmit="return confirm('Hapus administrator ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
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
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeUserModal()"></div>
    <div class="relative bg-white rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300">
        <button onclick="closeUserModal()" class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-transform">✕</button>
        
        <div class="mb-8">
            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Tambah Administrator Baru</h3>
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Daftarkan akun administrator baru untuk membantu manajemen.</p>
        </div>

        <form action="{{ route('users.store') }}" method="POST" class="space-y-5 uppercase">
            @csrf
            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                <input type="text" name="name" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Email</label>
                <input type="email" name="email" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Role & Akses</label>
                <select name="role" id="role_select" onchange="toggleSchoolField()" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
                    @if(auth()->user()->role === 'superadmin')
                    <option value="superadmin">SUPER ADMINISTRATOR (AKSES PENUH)</option>
                    @endif
                    <option value="school_admin">ADMINISTRATOR INSTANSI (AKSES TERBATAS)</option>
                </select>
            </div>

            <div id="school_field">
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Instansi</label>
                <select name="school_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
                    @foreach($schools as $school)
                    <option value="{{ $school->id }}" {{ auth()->user()->school_id == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Password</label>
                <input type="password" name="password" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 mt-4">
                Simpan Administrator
            </button>
        </form>
    </div>
</div>

<!-- EDIT USER MODAL -->
<div id="editUserModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeEditModal()"></div>
    <div class="relative bg-white rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300">
        <button onclick="closeEditModal()" class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-transform">✕</button>
        
        <div class="mb-8">
            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Edit Data Administrator</h3>
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Perbarui informasi akun administrator terpilih.</p>
        </div>

        <form id="editUserForm" method="POST" class="space-y-5 uppercase">
            @csrf
            @method('PUT')
            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Nama Lengkap</label>
                <input type="text" name="name" id="edit_name" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Email</label>
                <input type="email" name="email" id="edit_email" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Role & Akses</label>
                <select name="role" id="edit_role_select" onchange="toggleEditSchoolField()" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
                    @if(auth()->user()->role === 'superadmin')
                    <option value="superadmin">SUPER ADMINISTRATOR (AKSES PENUH)</option>
                    @endif
                    <option value="school_admin">ADMINISTRATOR INSTANSI (AKSES TERBATAS)</option>
                </select>
            </div>

            <div id="edit_school_field">
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Instansi</label>
                <select name="school_id" id="edit_school_id" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
                    <option value="">-- PILIH INSTANSI --</option>
                    @foreach($schools as $school)
                    <option value="{{ $school->id }}">{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Password Baru (Kosongkan jika tidak ubah)</label>
                <input type="password" name="password" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all active:scale-95 mt-4">
                Perbarui Administrator
            </button>
        </form>
    </div>
</div>

<script>
    function openUserModal() { document.getElementById('userModal').classList.remove('hidden'); }
    function closeUserModal() { document.getElementById('userModal').classList.add('hidden'); }
    
    function openEditModal(id, name, email, role, schoolId) {
        const modal = document.getElementById('editUserModal');
        const form = document.getElementById('editUserForm');
        
        form.action = `/users/${id}`;
        document.getElementById('edit_name').value = name;
        document.getElementById('edit_email').value = email;
        document.getElementById('edit_role_select').value = role;
        document.getElementById('edit_school_id').value = schoolId || '';
        
        modal.classList.remove('hidden');
        toggleEditSchoolField();
    }

    function closeEditModal() { document.getElementById('editUserModal').classList.add('hidden'); }

    function toggleSchoolField() {
        const role = document.getElementById('role_select').value;
        const field = document.getElementById('school_field');
        if (role === 'superadmin') {
            field.classList.add('hidden');
        } else {
            field.classList.remove('hidden');
        }
    }

    function toggleEditSchoolField() {
        const role = document.getElementById('edit_role_select').value;
        const field = document.getElementById('edit_school_field');
        if (role === 'superadmin') {
            field.classList.add('hidden');
        } else {
            field.classList.remove('hidden');
        }
    }
    
    // Initial call
    toggleSchoolField();
</script>
@endsection
