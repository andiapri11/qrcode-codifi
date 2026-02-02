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
    <style>
        body { font-family: 'Outfit', sans-serif; background: #f8fafc; margin: 0; padding: 0; }
        .invoice-card { 
            width: 148mm; 
            min-height: 210mm; 
            background: white; 
            margin: 0 auto; 
            position: relative;
            overflow: hidden;
        }
        .header-gradient {
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 100%);
            padding: 40px;
            color: white;
            position: relative;
        }
        .header-accent {
            position: absolute;
            top: -20px;
            right: -20px;
            width: 150px;
            height: 150px;
            background: rgba(59, 130, 246, 0.1);
            border-radius: 50%;
            filter: blur(40px);
        }
        .table-header {
            background: #f1f5f9;
            text-transform: uppercase;
            font-size: 8px;
            font-weight: 900;
            letter-spacing: 0.15em;
            color: #64748b;
        }
        .total-box {
            background: #f8fafc;
            border-radius: 20px;
            padding: 20px;
        }
    </style>
</head>
<body>
    <div id="invoice-content" class="invoice-card shadow-2xl">
        <!-- Luxury Header -->
        <div class="header-gradient">
            <div class="header-accent"></div>
            <div class="flex justify-between items-start relative z-10">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-white/10 rounded-2xl backdrop-blur-md flex items-center justify-center border border-white/20">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-10 h-10 brightness-0 invert">
                    </div>
                    <div>
                        <h1 class="text-2xl font-black tracking-tighter uppercase leading-none">Schola <span class="text-blue-400 italic">CBT</span></h1>
                        <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.3em] mt-2">Enterprise Examination</p>
                    </div>
                </div>
                <div class="text-right">
                    <div class="text-[10px] font-black text-blue-400 uppercase tracking-[0.3em] mb-1">Official Invoice</div>
                    <div class="text-3xl font-black text-white tracking-widest opacity-20 uppercase leading-none">PAID</div>
                </div>
            </div>

            <div class="mt-12 flex justify-between items-end relative z-10">
                <div>
                    <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Reference Number</div>
                    <div class="text-sm font-black tracking-tighter text-white">{{ $transaction->reference }}</div>
                </div>
                <div class="text-right">
                    <div class="text-[8px] font-black text-slate-400 uppercase tracking-widest mb-1">Payment Date</div>
                    <div class="text-sm font-black tracking-tighter text-white">{{ $transaction->paid_at->format('d M Y') }}</div>
                </div>
            </div>
        </div>

        <!-- Corporate Info -->
        <div class="p-10">
            <div class="grid grid-cols-2 gap-10 mb-12">
                <div>
                    <h3 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Account Holder</h3>
                    <div class="p-1 bg-gradient-to-r from-blue-500 to-indigo-600 rounded-xl w-fit mb-3">
                        <div class="bg-white px-3 py-1 rounded-lg">
                            <span class="text-[8px] font-black text-slate-900 uppercase">Premium Member</span>
                        </div>
                    </div>
                    <p class="text-lg font-black text-slate-900 uppercase tracking-tighter">{{ $transaction->school->name }}</p>
                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wide mt-1 leading-relaxed">{{ $transaction->school->address ?? 'Institutional Partner' }}</p>
                </div>
                <div class="text-right">
                    <h3 class="text-[9px] font-black text-slate-400 uppercase tracking-[0.2em] mb-4">Issued By</h3>
                    <p class="text-[10px] font-black text-slate-900 uppercase">Schola CBT Finance Team</p>
                    <p class="text-[9px] font-bold text-slate-400 uppercase mt-1">support@codifi.id</p>
                    <p class="text-[9px] font-bold text-slate-400 uppercase">www.codifi.id</p>
                </div>
            </div>

            <!-- Transaction Table -->
            <div class="rounded-2xl border border-slate-100 overflow-hidden mb-10 shadow-sm">
                <table class="w-full text-left">
                    <thead>
                        <tr>
                            <th class="table-header px-8 py-4">Item Description</th>
                            <th class="table-header px-8 py-4 text-right">Amount</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-50">
                        <tr>
                            <td class="px-8 py-8">
                                <p class="text-[11px] font-black text-slate-900 uppercase tracking-tight">
                                    {{ str_replace('_', ' ', $transaction->type) }} Premium License
                                </p>
                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-[0.15em] mt-1.5 flex items-center gap-2">
                                    <span class="w-1.5 h-1.5 rounded-full bg-blue-500"></span>
                                    Cloud Based Secure Examination
                                </p>
                            </td>
                            <td class="px-8 py-8 text-right font-black text-slate-900 text-sm">
                                Rp{{ number_format($transaction->amount, 0, ',', '.') }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Summary -->
            <div class="flex justify-end">
                <div class="w-full max-w-[280px]">
                    <div class="total-box">
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-[9px] font-black text-slate-400 uppercase tracking-widest">Subtotal</span>
                            <span class="text-[11px] font-black text-slate-900">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                        <div class="flex justify-between items-center pt-4 border-t border-slate-200">
                            <span class="text-[10px] font-black text-slate-900 uppercase tracking-widest">Total Paid</span>
                            <span class="text-2xl font-black text-blue-600 tracking-tighter">Rp{{ number_format($transaction->amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Signature Stripe -->
            <div class="mt-16 text-center">
                <div class="inline-block px-10 py-3 bg-emerald-50 border border-emerald-100 rounded-full">
                    <p class="text-[8px] font-black text-emerald-600 uppercase tracking-[0.2em] flex items-center gap-2">
                        <svg class="w-3 h-3" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path></svg>
                        Electronically Verified Transaction
                    </p>
                </div>
                <p class="text-[7px] font-extrabold text-slate-300 uppercase tracking-[0.4em] mt-8">Thank you for choosing Schola CBT</p>
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
