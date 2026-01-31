@extends('layouts.admin')

@section('content')
<div class="rounded-sm border border-stroke bg-white shadow-sm border-slate-200 overflow-hidden">
    <div class="px-6 py-8 md:px-8 xl:px-10 border-b border-slate-100 bg-slate-50/30">
        <h4 class="text-xl font-extrabold text-slate-900 tracking-tight uppercase">Penghasil Kode QR Ujian</h4>
        <p class="text-slate-400 text-xs font-bold uppercase tracking-widest mt-1">Buat link ujian aman untuk aplikasi android khusus.</p>
    </div>

    <div class="p-6 md:p-8 xl:p-10">
        <div class="flex flex-col xl:flex-row gap-10">
            <!-- Form Side -->
            <div class="w-full xl:w-[450px]">
                <form id="qrForm" class="space-y-6">
                    @csrf
                    <div>
                        <label class="mb-2.5 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Pilih Sekolah Mitra</label>
                        <select name="school_id" id="school_id" required class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-sm shadow-inner">
                            @foreach($schools as $school)
                                <option value="{{ $school->id }}" {{ Auth::user()->school_id == $school->id ? 'selected' : '' }}>{{ $school->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="mb-2.5 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">Judul / Nama Ujian</label>
                        <input type="text" name="title" required placeholder="Contoh: Penilaian Akhir Semester" class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-sm shadow-inner">
                    </div>

                    <div>
                        <label class="mb-2.5 block font-black text-slate-400 text-[9px] uppercase tracking-[0.2em] ml-1">URL Link Ujian</label>
                        <input type="url" name="exam_url" required placeholder="https://forms.gle/..." class="w-full rounded-2xl border border-slate-200 bg-slate-50 py-4 px-6 font-bold text-slate-900 outline-none focus:ring-2 focus:ring-indigo-500 transition text-xs shadow-sm shadow-inner">
                    </div>

                    <button type="submit" id="generateBtn" class="group w-full cursor-pointer rounded-2xl border-0 bg-indigo-600 py-5 font-black text-white transition-all hover:bg-indigo-700 hover:shadow-indigo-200 active:scale-[0.98] shadow-xl shadow-indigo-100 uppercase tracking-[0.3em] text-[10px] flex items-center justify-center gap-3">
                        <span>Generate Secure QR Code</span>
                        <svg class="w-4 h-4 group-hover:translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M13 7l5 5m0 0l-5 5m5-5H6"/></svg>
                    </button>
                </form>
            </div>

            <!-- QR Preview Side -->
            <div class="flex-1 bg-slate-50/50 rounded-[2.5rem] border border-slate-100 flex items-center justify-center min-h-[500px] relative overflow-hidden">
                <div id="loading" class="absolute inset-0 bg-white/90 z-20 flex flex-col items-center justify-center hidden backdrop-blur-sm">
                    <div class="w-12 h-12 border-4 border-indigo-600 border-t-transparent rounded-full animate-spin"></div>
                    <p class="mt-4 font-black text-indigo-600 text-[9px] tracking-[0.3em] uppercase">Mengesahkan Token & Mengolah Logo...</p>
                </div>

                <!-- QR Result (Hidden by default) -->
                <div id="qrcode-wrapper" class="hidden text-center z-10 p-10">
                    <div class="bg-white p-10 rounded-[3rem] shadow-2xl mb-8 border border-white inline-block">
                        <img id="qrImage" src="" alt="QR Code" class="w-72 h-72 object-contain mx-auto">
                    </div>
                    
                    <div class="animate-in fade-in slide-in-from-bottom-4 duration-700">
                        <span class="text-[9px] font-black text-slate-400 uppercase tracking-[0.4em] block mb-3">SECURE TOKEN AUTHORIZED</span>
                        <div class="bg-slate-900 px-10 py-5 rounded-2xl border border-slate-800 inline-block shadow-2xl mb-8">
                            <p id="tokenDisplay" class="font-mono text-xl font-black text-indigo-400 tracking-widest"></p>
                        </div>
                        
                        <div class="flex flex-col gap-3 max-w-[300px] mx-auto">
                            <button id="downloadBtn" class="w-full bg-emerald-500 text-white py-5 rounded-2xl font-black text-[10px] shadow-xl shadow-emerald-100 hover:bg-emerald-600 transition-all uppercase tracking-[0.2em] flex items-center justify-center gap-3 active:scale-95">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/></svg>
                                <span>Simpan Gambar QR</span>
                            </button>
                            <p class="text-[8px] text-slate-400 font-bold uppercase tracking-widest mt-2 italic">Scannable only via Schola CBT App</p>
                        </div>
                    </div>
                </div>
                
                <!-- Initial Placeholder -->
                <div id="placeholder" class="text-center p-10 flex flex-col items-center">
                    <div class="w-24 h-24 bg-indigo-50 rounded-[2rem] flex items-center justify-center text-5xl shadow-inner border border-indigo-100/50 mb-8 animate-bounce transition-all duration-1000">
                        🛡️
                    </div>
                    <h5 class="text-slate-900 font-extrabold text-sm uppercase tracking-widest mb-4">Security Authorized Area</h5>
                    <p class="text-slate-400 text-[10px] font-bold tracking-widest max-w-[300px] leading-loose uppercase">Data QR akan dienkripsi dengan signature khusus untuk menjamin hanya aplikasi resmi yang dapat mengakses link ujian ini.</p>
                </div>

                <!-- Decoration elements -->
                <div class="absolute -right-20 -bottom-20 w-64 h-64 bg-indigo-600/5 rounded-full"></div>
                <div class="absolute -left-10 -top-10 w-32 h-32 bg-slate-900/5 rounded-full"></div>
            </div>
        </div>
    </div>
</div>

<script>
    const qrForm = document.getElementById('qrForm');
    const qrWrapper = document.getElementById('qrcode-wrapper');
    const qrImage = document.getElementById('qrImage');
    const placeholder = document.getElementById('placeholder');
    const tokenDisplay = document.getElementById('tokenDisplay');
    const loading = document.getElementById('loading');
    const schoolSelect = document.getElementById('school_id');
    const downloadBtn = document.getElementById('downloadBtn');

    qrForm.onsubmit = async function(e) {
        e.preventDefault();
        loading.classList.remove('hidden');
        qrWrapper.classList.add('hidden');
        placeholder.classList.add('hidden');
        
        const formData = new FormData(qrForm);
        
        try {
            const response = await fetch("{{ route('links.store') }}", {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            });
            
            const data = await response.json();
            
            if (data.success) {
                const schoolId = schoolSelect.value;
                const token = data.token;
                
                // Construct QR URL from our backend
                const qrUrl = `{{ route('qr.generate') }}?token=${encodeURIComponent(token)}&school_id=${schoolId}`;
                
                qrImage.onload = () => {
                    loading.classList.add('hidden');
                    qrWrapper.classList.remove('hidden');
                    tokenDisplay.innerText = token;
                };

                qrImage.onerror = () => {
                    alert('Gagal memproses QR. Cek koneksi atau coba lagi.');
                    loading.classList.add('hidden');
                    placeholder.classList.remove('hidden');
                };
                
                qrImage.src = qrUrl;
                
            } else {
                alert(data.message || 'Error creating link');
                loading.classList.add('hidden');
                placeholder.classList.remove('hidden');
            }
        } catch (err) {
            console.error(err);
            alert('Terjadi kesalahan sistem. Silakan coba beberapa saat lagi.');
            loading.classList.add('hidden');
            placeholder.classList.remove('hidden');
        }
    }

    // Function to download SVG as PNG using Canvas
    downloadBtn.addEventListener('click', () => {
        const img = new Image();
        img.crossOrigin = 'anonymous'; // Ensure CSS/Images inside SVG can be drawn
        
        // Wait for current SVG image to be fully ready
        const svgUrl = qrImage.src;
        
        fetch(svgUrl)
            .then(response => response.text())
            .then(svgData => {
                const canvas = document.createElement('canvas');
                canvas.width = 1000;
                canvas.height = 1000;
                const ctx = canvas.getContext('2d');
                
                const svgBlob = new Blob([svgData], {type: 'image/svg+xml;charset=utf-8'});
                const url = URL.createObjectURL(svgBlob);
                
                const downloadImg = new Image();
                downloadImg.onload = () => {
                    // Fill background white (since QR usually is on white)
                    ctx.fillStyle = 'white';
                    ctx.fillRect(0, 0, canvas.width, canvas.height);
                    ctx.drawImage(downloadImg, 0, 0, canvas.width, canvas.height);
                    
                    const pngUrl = canvas.toDataURL('image/png');
                    const downloadLink = document.createElement('a');
                    downloadLink.href = pngUrl;
                    downloadLink.download = `SCHOLA-QR-${tokenDisplay.innerText}.png`;
                    downloadLink.click();
                    
                    URL.revokeObjectURL(url);
                };
                downloadImg.src = url;
            })
            .catch(err => {
                console.error('Download error:', err);
                alert('Gagal mendownload sebagai PNG. Coba klik kanan gambar untuk simpan.');
            });
    });
</script>
@endsection
