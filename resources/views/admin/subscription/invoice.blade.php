<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaction->reference }} | Schola CBT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; margin: 0; padding: 0; }
        @media print {
            .no-print { display: none; }
            body { background: white; padding: 0; margin: 0; }
            .print-shadow-none { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>
</head>
<body class="bg-slate-50">
    <div id="invoice-content" class="max-w-2xl mx-auto bg-white shadow-xl border border-slate-100 overflow-hidden print-shadow-none">
        <!-- Header -->
        <div class="bg-slate-900 p-8 text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 w-48 h-48 bg-blue-600/10 rounded-full -mr-24 -mt-24 blur-3xl"></div>
            <div class="relative flex justify-between items-center gap-4">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-12 h-12 brightness-0 invert">
                    <div>
                        <h1 class="text-xl font-black tracking-tighter uppercase leading-none">Schola <span class="text-blue-500 italic">CBT</span></h1>
                        <p class="text-[8px] font-bold text-slate-400 uppercase tracking-[0.2em] mt-1">Enterprise System</p>
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="text-2xl font-black tracking-tighter uppercase opacity-20">Invoice</h2>
                    <p class="text-[9px] font-black tracking-widest uppercase text-blue-400">{{ $transaction->reference }}</p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-8">
            <!-- Info Grid -->
            <div class="grid grid-cols-2 gap-8 mb-10">
                <div>
                    <h3 class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Tagihan Untuk:</h3>
                    <p class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $transaction->school->name }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wide truncate">{{ $transaction->school->address ?? 'Alamat tidak tersedia' }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] mb-2">Detail Transaksi:</h3>
                    <div class="space-y-1">
                        <div class="flex justify-end gap-3 text-[9px] font-bold uppercase tracking-wide">
                            <span class="text-slate-400">Tanggal:</span>
                            <span class="text-slate-900">{{ $transaction->paid_at->format('d M Y') }}</span>
                        </div>
                        <div class="flex justify-end gap-3 text-[9px] font-bold uppercase tracking-wide">
                            <span class="text-slate-400">Status:</span>
                            <span class="text-emerald-600 font-black">LUNAS</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="border border-slate-100 rounded-2xl overflow-hidden mb-8">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-6 py-3 text-[8px] font-black text-slate-400 uppercase tracking-[0.2em]">Deskripsi</th>
                            <th class="px-6 py-3 text-[8px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Harga</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="px-6 py-6">
                                <p class="text-xs font-black text-slate-900 uppercase tracking-tight">
                                    {{ str_replace('_', ' ', $transaction->type) }} - Schola CBT Premium
                                </p>
                            </td>
                            <td class="px-6 py-6 text-right font-black text-slate-900 text-xs text-nowrap">
                                Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="flex flex-col items-end gap-2 px-2">
                <div class="flex items-center gap-12 py-4 border-t border-slate-100 w-full justify-end">
                    <span class="text-[10px] font-black text-slate-900 uppercase tracking-[0.2em]">Total Bayar</span>
                    <span class="text-xl font-black text-blue-600 tracking-tighter">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-12 pt-6 border-t border-slate-100 text-center">
                <p class="text-[7px] font-black text-slate-300 uppercase tracking-[0.3em]">Invoice otomatis oleh sistem Schola CBT</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="max-w-2xl mx-auto mt-10 flex justify-center gap-6 no-print">
        <button onclick="downloadPdf()" class="px-8 py-4 bg-slate-900 text-white rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] hover:scale-105 active:scale-95 transition-all shadow-xl flex items-center gap-3">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg>
            Download PDF
        </button>
        <a href="{{ route('subscription.index') }}" class="px-8 py-4 bg-white text-slate-400 rounded-2xl font-black text-[10px] uppercase tracking-[0.3em] border border-slate-200 hover:bg-slate-50 transition-all">
            Kembali
        </a>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>
    <script>
        function downloadPdf() {
            const element = document.getElementById('invoice-content');
            const opt = {
                margin:       [0, 0], // No page margin for half A4
                filename:     'Invoice-{{ $transaction->reference }}.pdf',
                image:        { type: 'jpeg', quality: 1 },
                html2canvas:  { 
                    scale: 3, 
                    useCORS: true,
                    scrollY: 0,
                    windowWidth: 800 // Smaller window width for better fitting
                },
                jsPDF:        { unit: 'mm', format: 'a5', orientation: 'portrait' }
            };

            // Show loading state
            const btn = document.querySelector('button[onclick="downloadPdf()"]');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<span class="animate-pulse text-[8px]">GENERATING...</span>';
            }

            html2pdf().set(opt).from(element).save().then(() => {
                if (btn) {
                    btn.disabled = false;
                    btn.innerHTML = '<svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4" /></svg> Download PDF';
                }

                if (window.location.search.includes('download')) {
                    setTimeout(() => { 
                        if (window.parent && window.parent.postMessage) {
                            window.parent.postMessage('download-complete', '*');
                        }
                    }, 1000);
                }
            });
        }

        window.addEventListener('load', () => {
            if (window.location.search.includes('download')) {
                downloadPdf();
            }
        });
    </script>
</body>
</html>
