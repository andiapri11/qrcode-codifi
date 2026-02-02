<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice {{ $transaction->reference }} | Schola CBT</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Outfit', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        
        /* A5 Dimensions: 148mm x 210mm */
        .invoice-box {
            width: 148mm;
            height: 210mm;
            background: white;
            margin: 0 auto;
            position: relative;
            box-sizing: border-box;
            overflow: hidden;
            border: 1px solid #e2e8f0;
        }

        .header-bg {
            background: #0f172a;
            height: 140px;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            z-index: 0;
        }

        .main-content {
            position: relative;
            z-index: 10;
            padding: 40px;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .badge-paid {
            position: absolute;
            top: 100px;
            right: 40px;
            transform: rotate(-12deg);
            border: 3px solid #10b981;
            color: #10b981;
            padding: 4px 12px;
            font-size: 20px;
            font-weight: 900;
            border-radius: 6px;
            opacity: 0.3;
            letter-spacing: 2px;
            z-index: 20;
        }

        .table-custom {
            width: 100%;
            margin-top: 30px;
        }

        .table-custom th {
            text-align: left;
            font-size: 8px;
            font-weight: 900;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-bottom: 10px;
            border-bottom: 1px solid #f1f5f9;
        }

        .table-custom td {
            padding: 15px 0;
            border-bottom: 1px solid #f1f5f9;
        }

        @media print {
            .no-print { display: none !important; }
            body { background: white; }
            .invoice-box { border: none; box-shadow: none; margin: 0; }
        }
    </style>
</head>
<body class="py-10">

    <!-- Invoice Area -->
    <div id="invoice-content" class="invoice-box shadow-2xl">
        <div class="header-bg"></div>
        <div class="badge-paid">LUNAS</div>

        <div class="main-content">
            <!-- Header Row -->
            <div class="flex justify-between items-center text-white mb-10">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('assets/images/logo.png') }}" class="w-10 h-10 brightness-0 invert">
                    <div>
                        <h1 class="text-xl font-black tracking-tighter uppercase leading-none">Schola <span class="text-blue-500">CBT</span></h1>
                        <p class="text-[7px] font-bold text-slate-400 uppercase tracking-widest mt-1">Enterprise System</p>
                    </div>
                </div>
                <div class="text-right">
                    <h2 class="text-2xl font-black uppercase opacity-20">Invoice</h2>
                    <p class="text-[9px] font-black tracking-tighter text-blue-400">{{ $transaction->reference }}</p>
                </div>
            </div>

            <!-- Client Info Card -->
            <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-100 flex justify-between items-start mt-4">
                <div>
                    <h3 class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2">Tagihan Untuk:</h3>
                    <p class="text-sm font-black text-slate-900 uppercase tracking-tight">{{ $transaction->school->name }}</p>
                    <p class="text-[9px] font-medium text-slate-500 mt-1 uppercase leading-tight">{{ $transaction->school->address ?? 'Institutional Partner' }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-2">Tanggal Bayar:</h3>
                    <p class="text-sm font-black text-slate-900">{{ $transaction->paid_at->format('d/m/Y') }}</p>
                    <p class="text-[9px] font-medium text-blue-500 mt-1 uppercase">Midtrans Verified</p>
                </div>
            </div>

            <!-- Table -->
            <table class="table-custom">
                <thead>
                    <tr>
                        <th width="70%">Deskripsi Layanan</th>
                        <th class="text-right">Nominal</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <div class="text-[11px] font-black text-slate-900 uppercase">Aktivasi Paket Premium ({{ str_replace('_', ' ', $transaction->type) }})</div>
                            <div class="text-[8px] font-bold text-slate-400 uppercase mt-1">Sistem ujian mandiri berbasis barcode</div>
                        </td>
                        <td class="text-right text-[11px] font-black text-slate-900">
                            Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                        </td>
                    </tr>
                </tbody>
            </table>

            <!-- Summary Area -->
            <div class="mt-auto pt-10">
                <div class="flex flex-col items-end gap-2">
                    <div class="flex justify-between w-[180px] items-center">
                        <span class="text-[9px] font-bold text-slate-400 uppercase">Subtotal</span>
                        <span class="text-[10px] font-black text-slate-700">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between w-[180px] items-center pt-3 border-t border-slate-100">
                        <span class="text-[10px] font-black text-slate-900 uppercase">Total Bayar</span>
                        <span class="text-xl font-black text-blue-600 tracking-tighter">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="mt-10 pt-6 border-t border-slate-50 text-center">
                    <p class="text-[8px] font-black text-slate-400 uppercase tracking-[0.3em]">Terima Kasih Atas Kerja Sama Anda</p>
                    <p class="text-[7px] font-medium text-slate-300 mt-2">www.codifi.id | support@codifi.id</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Area (Not Printed) -->
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
            
            // Configuration optimized for A5 (148mm x 210mm)
            const opt = {
                margin: 0,
                filename: 'Invoice-{{ $transaction->reference }}.pdf',
                image: { type: 'jpeg', quality: 1 },
                html2canvas: { 
                    scale: 4, 
                    useCORS: true,
                    logging: false,
                    windowWidth: 559 // Adjust to A5 width in pixels at standard DPI
                },
                jsPDF: { unit: 'mm', format: 'a5', orientation: 'portrait' }
            };

            const btn = document.querySelector('button[onclick="downloadPdf()"]');
            if (btn) {
                btn.disabled = true;
                btn.innerHTML = '<span class="animate-pulse">GENERATING...</span>';
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
                    }, 1500);
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
