<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&display=swap" rel="stylesheet">

        <!-- Scripts -->
        <script src="https://cdn.tailwindcss.com"></script>
        <script>
            tailwind.config = {
                theme: {
                    extend: {
                        fontFamily: { sans: ['Outfit', 'sans-serif'] },
                        colors: { brand: { 500: '#3C50E0' } }
                    }
                }
            }
        </script>
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-slate-50 selection:bg-brand-500 selection:text-white">
        <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 relative overflow-hidden">
            <!-- Background Decor -->
            <div class="absolute top-0 left-0 w-full h-full z-0 opacity-40 pointer-events-none">
                <div class="absolute top-[-10%] right-[-10%] w-[500px] h-[500px] bg-brand-500/10 rounded-full blur-[120px]"></div>
                <div class="absolute bottom-[-10%] left-[-10%] w-[500px] h-[500px] bg-emerald-500/10 rounded-full blur-[120px]"></div>
            </div>

            <div class="z-10 mb-8 transform hover:scale-105 transition-transform duration-500">
                <a href="/" class="flex flex-col items-center gap-4">
                    <x-application-logo class="w-16 h-16 shadow-2xl shadow-brand-500/20 rounded-2xl" />
                    <div class="text-2xl font-black tracking-tight flex items-center">
                        <span class="text-slate-900 uppercase">SCHOLA</span>
                        <span class="text-brand-500 uppercase ml-2">EXAMBRO</span>
                    </div>
                </a>
            </div>

            <div class="w-full sm:max-w-md px-8 py-10 bg-white/80 backdrop-blur-xl shadow-[0_20px_50px_rgba(0,0,0,0.05)] border border-white overflow-hidden sm:rounded-[2.5rem] z-10">
                {{ $slot }}
            </div>
            
            <p class="mt-8 text-[10px] font-black text-slate-400 uppercase tracking-widest z-10">
                &copy; {{ date('Y') }} CODIFI.ID
            </p>
        </div>
    </body>
</html>
