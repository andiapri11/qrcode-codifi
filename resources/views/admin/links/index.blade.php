@extends('layouts.admin')

@section('content')
<div class="mb-8 flex items-center justify-between">
    <div>
        <h2 class="text-2xl font-extrabold text-slate-900 tracking-tight uppercase">Daftar Barcode Ujian</h2>
        <p class="text-[10px] text-slate-400 font-bold uppercase tracking-[0.2em] mt-1">Manajemen Link & Riwayat QR Code yang Telah Dibuat</p>
    </div>
    <div class="flex items-center gap-3">
        <!-- Bulk Delete Button (Hidden initially) -->
        <button id="bulkDeleteBtn" onclick="openBulkDeleteModal()" class="hidden bg-rose-500 text-white px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-rose-100 hover:bg-rose-600 transition-all flex items-center gap-2">
            <span>🗑️</span> Hapus Terpilih (<span id="selectedCount">0</span>)
        </button>
        
        <!-- Trigger Modal Create -->
        <button onclick="openCreateModal()" class="bg-indigo-600 text-white px-6 py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center gap-2">
            <span>➕</span> Buat Barcode Baru
        </button>
    </div>
</div>

<div class="bg-white rounded-[2.5rem] border border-slate-200 shadow-sm overflow-hidden">
    <form id="bulkForm" action="{{ route('links.bulk-delete') }}" method="POST">
        @csrf
        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-slate-50/50 border-b border-slate-100">
                        <th class="px-8 py-6 w-10">
                            <input type="checkbox" id="selectAll" class="w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </th>
                        <th class="px-4 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Instansi</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Nama Ujian</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest">Token</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-center">QR</th>
                        <th class="px-8 py-6 text-[10px] font-black text-slate-400 uppercase tracking-widest text-right">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($links as $link)
                    <tr class="hover:bg-slate-50/30 transition-colors group">
                        <td class="px-8 py-6">
                            <input type="checkbox" name="ids[]" value="{{ $link->id }}" class="row-checkbox w-4 h-4 rounded border-slate-300 text-indigo-600 focus:ring-indigo-500 cursor-pointer">
                        </td>
                        <td class="px-4 py-6">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 bg-indigo-50 rounded-lg flex items-center justify-center text-indigo-600 font-black text-[9px] border border-indigo-100 overflow-hidden shrink-0">
                                    @if($link->school->logo_url)
                                        <img src="{{ $link->school->logo_url }}" class="w-full h-full object-cover">
                                    @else
                                        {{ $link->school->initials }}
                                    @endif
                                </div>
                                <span class="text-[11px] font-bold text-slate-600 truncate max-w-[120px]">{{ $link->school->name }}</span>
                            </div>
                        </td>
                        <td class="px-8 py-6">
                            <div class="text-xs font-black text-slate-900 leading-tight uppercase">{{ $link->title }}</div>
                            <div class="text-[9px] text-slate-400 mt-1 font-medium truncate max-w-[200px]">{{ $link->exam_url }}</div>
                        </td>
                        <td class="px-8 py-6">
                            <code class="bg-slate-900 text-indigo-400 px-3 py-1.5 rounded-lg font-mono text-[10px] font-bold tracking-tighter">
                                {{ $link->secure_token }}
                            </code>
                        </td>
                        <td class="px-8 py-6 text-center">
                            <button type="button" onclick="showQR('{{ $link->secure_token }}', {{ $link->school_id }})" class="p-2 bg-white border border-slate-200 rounded-xl hover:border-indigo-500 hover:text-indigo-600 transition-all shadow-sm group-hover:scale-110">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01M5 8h2a1 1 0 001-1V5a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1zm12 0h2a1 1 0 001-1V5a1 1 0 00-1-1h-2a1 1 0 00-1 1v2a1 1 0 001 1zM5 20h2a1 1 0 001-1v-2a1 1 0 00-1-1H5a1 1 0 00-1 1v2a1 1 0 001 1z" /></svg>
                            </button>
                        </td>
                        <td class="px-8 py-6 text-right">
                            <button type="button" onclick="confirmDelete({{ $link->id }})" class="p-2.5 text-slate-400 hover:text-rose-600 hover:bg-rose-50 rounded-xl transition-all">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" /></svg>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-8 py-20 text-center">
                            <div class="w-20 h-20 bg-slate-50 rounded-full flex items-center justify-center text-3xl mx-auto mb-4">📭</div>
                            <p class="text-slate-400 font-bold text-xs uppercase tracking-widest">Belum ada link yang dibuat.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </form>

    @if($links->hasPages())
    <div class="px-8 py-6 border-t border-slate-100 bg-slate-50/30">
        {{ $links->links() }}
    </div>
    @endif
</div>

<!-- CREATE QR MODAL (POPUP) -->
<div id="createModal" class="fixed inset-0 z-[120] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeCreateModal()"></div>
    <div class="relative bg-white rounded-[3rem] p-10 max-w-lg w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300">
        <button onclick="closeCreateModal()" class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-transform">✕</button>
        
        <div class="mb-8">
            <h3 class="text-lg font-black text-slate-900 uppercase tracking-tight">Buat Barcode Baru</h3>
            <p class="text-[9px] text-slate-400 font-bold uppercase tracking-widest mt-1">Input link ujian dan generate QR aman secara instan.</p>
        </div>

        <form id="qrForm" class="space-y-6">
            @csrf
            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Instansi Mitra</label>
                <select name="school_id" id="school_id" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
                    @foreach($schools as $school)
                        <option value="{{ $school->id }}" {{ Auth::user()->school_id == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Judul Ujian</label>
                <input type="text" name="title" required placeholder="Contoh: Tryout Nasional 2026" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <div>
                <label class="mb-2 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">URL Link Ujian</label>
                <input type="url" name="exam_url" required placeholder="https://forms.gle/..." class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-inner">
            </div>

            <button type="submit" id="generateBtn" class="w-full bg-indigo-600 text-white py-5 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] shadow-xl shadow-indigo-100 hover:bg-indigo-700 transition-all flex items-center justify-center gap-3 active:scale-95 mt-4">
                <span>⚡ Generate Secure QR</span>
            </button>
        </form>
    </div>
</div>

<!-- QR DISPLAY MODAL -->
<div id="qrModal" class="fixed inset-0 z-[130] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/40 backdrop-blur-sm" onclick="closeModal()"></div>
    <div class="relative bg-white rounded-[3rem] p-10 max-w-sm w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300">
        <button onclick="closeModal()" class="absolute -top-4 -right-4 w-10 h-10 bg-slate-900 text-white rounded-full flex items-center justify-center font-bold shadow-lg hover:scale-110 transition-transform">✕</button>
        <div class="text-center">
            <h3 class="text-sm font-black text-slate-900 uppercase tracking-widest mb-6">Barcode Authorized</h3>
            <div id="modalLoading" class="w-64 h-64 mx-auto flex items-center justify-center">
                <div class="w-10 h-10 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
            </div>
            <img id="modalQrImg" class="w-64 h-64 mx-auto hidden bg-white rounded-2xl p-4 border border-slate-100 mb-6">
            <p id="modalToken" class="font-mono text-lg font-black text-indigo-600 tracking-widest mb-8"></p>
            <button id="modalDownloadBtn" class="w-full bg-emerald-500 text-white py-4 rounded-2xl font-black text-[10px] uppercase tracking-widest shadow-xl shadow-emerald-100 flex items-center justify-center gap-2 hover:bg-emerald-600 active:scale-95 transition-all"><span>💾</span> Simpan Gambar</button>
            <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-4 italic">Scannable only via Schola CBT App</p>
        </div>
    </div>
</div>

<!-- DELETE MODAL -->
<div id="deleteModal" class="fixed inset-0 z-[110] flex items-center justify-center hidden">
    <div class="absolute inset-0 bg-slate-900/60 backdrop-blur-sm" onclick="closeDeleteModal()"></div>
    <div class="relative bg-white rounded-[2.5rem] p-10 max-w-sm w-full mx-4 shadow-2xl animate-in fade-in zoom-in duration-300">
        <div class="w-20 h-20 bg-rose-50 rounded-3xl flex items-center justify-center text-3xl mx-auto mb-6">⚠️</div>
        <h3 class="text-lg font-black text-slate-900 text-center uppercase tracking-tight">Konfirmasi Hapus</h3>
        <p id="deleteMsg" class="text-center text-slate-400 text-[11px] font-bold uppercase tracking-widest mt-2 mb-8 leading-loose">Apakah Anda yakin ingin menghapus data barcode ini?</p>
        <div class="flex gap-3">
            <button onclick="closeDeleteModal()" class="flex-1 px-6 py-4 bg-slate-100 text-slate-600 rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-slate-200 transition-all">Batal</button>
            <form id="singleDeleteForm" method="POST" class="flex-1">
                @csrf
                @method('DELETE')
                <button type="submit" class="w-full px-6 py-4 bg-rose-500 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-600 transition-all shadow-lg shadow-rose-100">Hapus</button>
            </form>
            <button id="confirmBulkBtn" onclick="submitBulkForm()" class="hidden flex-1 px-6 py-4 bg-rose-500 text-white rounded-2xl font-black text-[10px] uppercase tracking-widest hover:bg-rose-600 transition-all shadow-lg shadow-rose-100">Hapus Semua</button>
        </div>
    </div>
</div>

<script>
    const qrForm = document.getElementById('qrForm');
    const createModal = document.getElementById('createModal');
    
    function openCreateModal() {
        createModal.classList.remove('hidden');
    }
    
    function closeCreateModal() {
        createModal.classList.add('hidden');
    }

    qrForm.onsubmit = async function(e) {
        e.preventDefault();
        const generateBtn = document.getElementById('generateBtn');
        const btnText = generateBtn.querySelector('span');
        const originalText = btnText.innerText;
        
        btnText.innerText = 'SEDANG MEMPROSES...';
        generateBtn.disabled = true;
        
        const formData = new FormData(qrForm);
        try {
            const response = await fetch("{{ route('links.store') }}", {
                method: 'POST', 
                body: formData, 
                headers: { 
                    'X-Requested-With': 'XMLHttpRequest',
                    'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                }
            });

            const contentType = response.headers.get("content-type");
            if (!contentType || !contentType.includes("application/json")) {
                const text = await response.text();
                console.error("Server Error Response:", text);
                throw new Error("Respon server bukan JSON. Kemungkinan terjadi galat 500.");
            }

            const data = await response.json();
            if (data.success) {
                closeCreateModal();
                showQR(data.token, document.getElementById('school_id').value);
                window.refreshList = true;
            } else {
                alert(data.message || 'Gagal membuat barcode');
            }
        } catch (err) {
            console.error('Submission Error:', err);
            alert('Gagal membuat barcode: ' + (err.message.includes('JSON') ? 'Kesalahan Server Internal (500)' : err.message));
        } finally {
            btnText.innerText = originalText;
            generateBtn.disabled = false;
        }
    }

    // Modal QR Display Logic
    function showQR(token, schoolId) {
        document.getElementById('qrModal').classList.remove('hidden');
        document.getElementById('modalLoading').classList.remove('hidden');
        const modalImg = document.getElementById('modalQrImg');
        modalImg.classList.add('hidden');
        document.getElementById('modalToken').innerText = token;

        const qrUrl = "{{ route('qr.generate') }}?token=" + encodeURIComponent(token) + "&school_id=" + schoolId;
        modalImg.onload = () => {
            document.getElementById('modalLoading').classList.add('hidden');
            modalImg.classList.remove('hidden');
        };
        modalImg.src = qrUrl;
        document.getElementById('modalDownloadBtn').onclick = () => downloadFromUrl(qrUrl, token);
    }

    function closeModal() {
        document.getElementById('qrModal').classList.add('hidden');
        if (window.refreshList) window.location.reload();
    }

    // Bulk & Delete Logic
    const selectAll = document.getElementById('selectAll');
    const rowCheckboxes = document.querySelectorAll('.row-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    const selectedCount = document.getElementById('selectedCount');
    const deleteModal = document.getElementById('deleteModal');
    
    selectAll?.addEventListener('change', function() {
        rowCheckboxes.forEach(cb => cb.checked = this.checked);
        updateBulkButton();
    });
    rowCheckboxes.forEach(cb => cb.addEventListener('change', updateBulkButton));

    function updateBulkButton() {
        const checkedCount = document.querySelectorAll('.row-checkbox:checked').length;
        if (checkedCount > 0) {
            bulkDeleteBtn.classList.remove('hidden');
            selectedCount.innerText = checkedCount;
        } else {
            bulkDeleteBtn.classList.add('hidden');
        }
    }

    function confirmDelete(id) {
        deleteModal.classList.remove('hidden');
        document.getElementById('singleDeleteForm').classList.remove('hidden');
        document.getElementById('confirmBulkBtn').classList.add('hidden');
        document.getElementById('singleDeleteForm').action = `/links/${id}`;
    }

    function openBulkDeleteModal() {
        deleteModal.classList.remove('hidden');
        document.getElementById('singleDeleteForm').classList.add('hidden');
        document.getElementById('confirmBulkBtn').classList.remove('hidden');
        document.getElementById('deleteMsg').innerText = `Hapus data massal yang dipilih?`;
    }

    function closeDeleteModal() { deleteModal.classList.add('hidden'); }
    function submitBulkForm() { document.getElementById('bulkForm').submit(); }

    function downloadFromUrl(svgUrl, token) {
        fetch(svgUrl).then(res => res.text()).then(svgData => {
            const canvas = document.createElement('canvas');
            canvas.width = 1000; canvas.height = 1000;
            const ctx = canvas.getContext('2d');
            const svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
            const url = URL.createObjectURL(svgBlob);
            const img = new Image();
            img.onload = () => {
                ctx.fillStyle = 'white'; ctx.fillRect(0, 0, canvas.width, canvas.height);
                ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                const pngUrl = canvas.toDataURL('image/png');
                const link = document.createElement('a');
                link.href = pngUrl; link.download = `SCHOLA-QR-${token}.png`;
                link.click(); URL.revokeObjectURL(url);
            };
            img.src = url;
        });
    }
</script>
@endsection
