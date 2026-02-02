<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaction->reference }} | Schola CBT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; }
        @media print {
            .no-print { display: none; }
            body { background: white; }
            .print-shadow-none { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        }
    </style>
</head>
<body class="bg-slate-50 p-4 md:p-12">
    <div id="invoice-content" class="max-w-4xl mx-auto bg-white rounded-[2.5rem] shadow-xl border border-slate-100 overflow-hidden print-shadow-none">
        <!-- Header -->
        <div class="bg-slate-900 p-10 md:p-16 text-white overflow-hidden relative">
            <div class="absolute top-0 right-0 w-64 h-64 bg-blue-600/10 rounded-full -mr-32 -mt-32 blur-3xl"></div>
            <div class="relative flex flex-col md:flex-row justify-between items-start md:items-center gap-8">
                <div class="flex items-center gap-4">
                    <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-16 h-16 brightness-0 invert">
                    <div>
                        <h1 class="text-3xl font-black tracking-tighter uppercase leading-none">Schola <span class="text-blue-500 italic">CBT</span></h1>
                        <p class="text-[10px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-2">Enterprise Examination System</p>
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="text-4xl font-black tracking-tighter uppercase opacity-20 mb-2">Invoice</h2>
                    <p class="text-xs font-black tracking-widest uppercase text-blue-400">{{ $transaction->reference }}</p>
                </div>
            </div>
        </div>

        <!-- Body -->
        <div class="p-10 md:p-16">
            <!-- Info Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 mb-16">
                <div>
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Tagihan Untuk:</h3>
                    <div class="space-y-1">
                        <p class="text-lg font-black text-slate-900 uppercase tracking-tight">{{ $transaction->school->name }}</p>
                        <p class="text-xs font-bold text-slate-500 uppercase tracking-wide">{{ $transaction->school->address ?? 'Alamat tidak tersedia' }}</p>
                    </div>
                </div>
                <div class="md:text-right">
                    <h3 class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Detail Transaksi:</h3>
                    <div class="space-y-2">
                        <div class="flex md:justify-end gap-4 text-xs font-bold uppercase tracking-wide">
                            <span class="text-slate-400">Tanggal:</span>
                            <span class="text-slate-900">{{ $transaction->paid_at->format('d F Y') }}</span>
                        </div>
                        <div class="flex md:justify-end gap-4 text-xs font-bold uppercase tracking-wide">
                            <span class="text-slate-400">Metode:</span>
                            <span class="text-slate-900">{{ strtoupper($transaction->midtrans_payload['payment_type'] ?? 'Midtrans') }}</span>
                        </div>
                        <div class="flex md:justify-end gap-4 text-xs font-bold uppercase tracking-wide">
                            <span class="text-slate-400">Status:</span>
                            <span class="text-emerald-600 font-black">LUNAS / PAID</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table -->
            <div class="border border-slate-100 rounded-[2rem] overflow-hidden mb-12">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="bg-slate-50 border-b border-slate-100">
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Deskripsi Layanan</th>
                            <th class="px-8 py-5 text-[10px] font-black text-slate-400 uppercase tracking-[0.2em] text-right">Harga Satuan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        <tr>
                            <td class="px-8 py-8">
                                <p class="text-sm font-black text-slate-900 uppercase tracking-tight">
                                    {{ str_replace('_', ' ', $transaction->type) }} - Schola CBT Premium
                                </p>
                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest mt-1">
                                    Akses sistem ujian mandiri berbasis barcode
                                </p>
                            </td>
                            <td class="px-8 py-8 text-right font-black text-slate-900 text-sm">
                                Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Total Section -->
            <div class="flex flex-col items-end gap-4 pr-8">
                <div class="flex items-center gap-12">
                    <span class="text-[10px] font-black text-slate-400 uppercase tracking-[0.2em]">Subtotal</span>
                    <span class="text-sm font-black text-slate-700">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                </div>
                <div class="flex items-center gap-12 py-6 border-t border-slate-100 w-full md:w-1/2 justify-end">
                    <span class="text-xs font-black text-slate-900 uppercase tracking-[0.2em]">Total Bayar</span>
                    <span class="text-2xl font-black text-blue-600 tracking-tighter">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                </div>
            </div>

            <!-- Footer Note -->
            <div class="mt-20 pt-10 border-t border-slate-100 text-center">
                <p class="text-[9px] font-black text-slate-400 uppercase tracking-[0.3em] mb-2">Terima kasih atas kerja sama Anda</p>
                <p class="text-[8px] font-bold text-slate-300 uppercase tracking-[0.2em]">Invoice ini sah dan dihasilkan secara otomatis oleh sistem Schola CBT</p>
            </div>
        </div>
    </div>

    <!-- Actions -->
    <div class="max-w-4xl mx-auto mt-10 flex justify-center gap-6 no-print">
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
                margin:       [0.2, 0],
                filename:     'Invoice-{{ $transaction->reference }}.pdf',
                image:        { type: 'jpeg', quality: 0.98 },
                html2canvas:  { 
                    scale: 2, 
                    useCORS: true,
                    scrollY: 0,
                    windowWidth: 1100
                },
                jsPDF:        { unit: 'in', format: 'a4', orientation: 'portrait' }
            };

            // Show loading state
            const btn = document.querySelector('button[onclick="downloadPdf()"]');
            const originalContent = btn.innerHTML;
            btn.disabled = true;
            btn.innerHTML = '<span class="animate-pulse">GENERATING PDF...</span>';

            html2pdf().set(opt).from(element).save().then(() => {
                btn.disabled = false;
                btn.innerHTML = originalContent;

                // Close tab if auto-downloaded
                const urlParams = new URLSearchParams(window.location.search);
                if (urlParams.has('download')) {
                    setTimeout(() => { window.close(); }, 1500);
                }
            });
        }

        // Auto download if query param exists
        window.addEventListener('load', () => {
            const urlParams = new URLSearchParams(window.location.search);
            if (urlParams.has('download')) {
                downloadPdf();
            }
        });
    </script>
</body>
</html>
