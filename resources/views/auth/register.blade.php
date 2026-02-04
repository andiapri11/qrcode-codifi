<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Instansi | Schola Exambro</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="icon" type="image/png" href="{{ asset('assets/images/logo.png') }}">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    
    <script>
        tailwind.config = {
            darkMode: 'class',
            theme: {
                extend: {
                    colors: {
                        brand: {
                            50: '#eff6ff', 100: '#dbeafe', 200: '#bfdbfe', 300: '#93c5fd', 400: '#60a5fa',
                            500: '#3b82f6', 600: '#2563eb', 700: '#1d4ed8', 800: '#1e40af', 900: '#1e3a8a',
                        }
                    }
                }
            }
        }
    </script>

    <style>
        body { 
            font-family: 'Outfit', sans-serif; 
            opacity: 0;
            transition: opacity 0.4s ease-in-out, background-color 0.3s ease;
        }
        body.loaded { opacity: 1; }
        
        /* Dark Mode Transitions */
        .dark body { background-color: #0f172a; color: #f8fafc; }
        .dark .input-pill { background-color: #1e293b; color: #f1f5f9; }
        .dark .icon-circle { background-color: #334155; }
        .dark .text-slate-600 { color: #cbd5e1; }
        .dark .text-slate-400 { color: #94a3b8; }
        .dark h1, .dark h2 { color: #ffffff; }

        .btn-blue {
            background-color: #3b82f6;
            box-shadow: 0 4px 14px 0 rgba(59, 130, 246, 0.39);
        }
        .input-pill {
            background-color: #f1f5f9;
            border-radius: 9999px;
            border: 1px solid transparent;
            transition: all 0.2s ease-out;
        }
        .input-pill:focus-within {
            border-color: #3b82f6;
            background-color: white;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
        }
        .dark .input-pill:focus-within {
            background-color: #1e293b;
            border-color: #3b82f6;
        }
        .icon-circle {
            background-color: #eef2ff;
            border-radius: 9999px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 44px;
            height: 44px;
            flex-shrink: 0;
        }
        
        .spinner {
            display: none;
            width: 20px;
            height: 20px;
            border: 3px solid rgba(255,255,255,0.3);
            border-radius: 50%;
            border-top-color: #fff;
            animation: spin 0.8s linear infinite;
            margin-right: 10px;
        }
        @keyframes spin { to { transform: rotate(360deg); } }
        .loading .spinner { display: inline-block; }
        
        #toast {
            visibility: hidden;
            min-width: 250px;
            background-color: #1e293b;
            color: #fff;
            text-align: center;
            border-radius: 12px;
            padding: 16px;
            position: fixed;
            z-index: 100;
            left: 50%;
            bottom: 30px;
            transform: translateX(-50%);
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            gap: 12px;
        }
        #toast.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }
    </style>
</head>
<body class="bg-white text-slate-900 antialiased min-h-screen transition-colors duration-300">

    <!-- Top Bar: Settings -->
    <div class="fixed top-4 md:top-6 right-4 md:right-6 flex items-center gap-3 z-50">
        <div class="flex bg-slate-100 dark:bg-slate-800 p-1 rounded-full text-[10px] md:text-xs font-bold uppercase tracking-wider">
            <button onclick="changeLanguage('id')" id="lang-id" class="px-2.5 md:px-3 py-1 md:py-1.5 rounded-full transition-all">ID</button>
            <button onclick="changeLanguage('en')" id="lang-en" class="px-2.5 md:px-3 py-1 md:py-1.5 rounded-full transition-all">EN</button>
        </div>
        <button onclick="toggleDarkMode()" class="p-2 md:p-2.5 bg-slate-100 dark:bg-slate-800 rounded-full hover:bg-slate-200 dark:hover:bg-slate-700 transition-all">
            <svg id="moonIcon" class="w-4 h-4 md:w-5 md:h-5 text-slate-600 dark:hidden" fill="currentColor" viewBox="0 0 20 20"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
            <svg id="sunIcon" class="w-4 h-4 md:w-5 md:h-5 text-yellow-400 hidden dark:block" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
        </button>
    </div>

    <!-- Main Content -->
    <div class="h-screen flex items-center justify-center p-4 overflow-hidden">
        <div class="max-w-6xl w-full flex flex-col md:flex-row items-center gap-8 md:gap-24">
            
            <!-- Left Side: Form -->
            <div class="w-full md:w-1/2 max-w-[420px] flex flex-col justify-center order-2 md:order-1">
                <div class="mb-5 text-left">
                    <div class="flex items-center gap-3 mb-4">
                        <img src="{{ asset('assets/images/logo.png') }}" alt="Logo" class="w-8 h-8 md:w-10 md:h-10">
                        <div class="border-l border-slate-200 dark:border-slate-700 pl-3">
                            <h2 class="text-sm md:text-base font-black text-slate-800 dark:text-white uppercase tracking-tighter leading-none">Schola <span class="text-blue-600 italic">CBT</span></h2>
                            <p class="text-[7px] md:text-[8px] text-slate-400 dark:text-slate-500 font-bold uppercase tracking-[0.2em] mt-0.5" data-i18n="slogan">Smart Examination System</p>
                        </div>
                    </div>
                    <h1 class="text-xl md:text-2xl font-bold text-[#111827] dark:text-white tracking-tight leading-none" data-i18n="reg_title">Daftar</h1>
                    <p class="text-[11px] md:text-xs text-slate-400 dark:text-slate-500 font-medium mt-1.5" data-i18n="reg_subtitle">Daftarkan instansi Anda dan mulai trial gratis hari ini.</p>
                </div>

                <form method="POST" action="{{ route('register') }}" class="space-y-2.5" id="registerForm" onsubmit="return handleFormSubmit()" novalidate>
                    @csrf
                    
                    @if ($errors->any())
                        <div class="mb-2 p-3 bg-red-50 dark:bg-red-900/20 rounded-xl border border-red-100 dark:border-red-900/30 text-red-600 dark:text-red-400 text-[11px] font-medium">
                            {{ $errors->first() }}
                        </div>
                    @endif

                    <div class="space-y-2.5">
                        <div class="space-y-1">
                            <div class="input-pill flex items-center p-1 md:p-1 group">
                                <div class="icon-circle mr-3 md:mr-3 w-9 h-9">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" /></svg>
                                </div>
                                <input type="text" name="name" id="name" required placeholder="Nama Lengkap Admin" data-i18n-placeholder="name_placeholder" class="bg-transparent w-full outline-none text-slate-600 dark:text-slate-300 font-semibold text-xs md:text-sm placeholder:text-slate-400 pr-4" />
                            </div>
                            <p id="error-name" class="hidden text-[10px] text-red-500 font-bold ml-6 uppercase tracking-wider" data-i18n="error_name">Silakan isi nama lengkap!</p>
                        </div>

                        <div class="space-y-1">
                            <div class="input-pill flex items-center p-1 md:p-1 group">
                                <div class="icon-circle mr-3 md:mr-3 w-9 h-9">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M21.75 6.75v10.5a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V6.75m19.5 0A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25m19.5 0v.243a2.25 2.25 0 0 1-1.07 1.916l-7.5 4.615a2.25 2.25 0 0 1-2.36 0L4.12 8.91a2.25 2.25 0 0 1-1.07-1.916V6.75" /></svg>
                                </div>
                                <input type="email" name="email" id="email" required placeholder="Alamat Email" data-i18n-placeholder="email_placeholder" class="bg-transparent w-full outline-none text-slate-600 dark:text-slate-300 font-semibold text-xs md:text-sm placeholder:text-slate-400 pr-4" />
                            </div>
                            <p id="error-email" class="hidden text-[10px] text-red-500 font-bold ml-6 uppercase tracking-wider" data-i18n="error_email">Alamat email tidak boleh kosong!</p>
                        </div>

                        <div class="space-y-1">
                            <div class="input-pill flex items-center p-1 md:p-1 group">
                                <div class="icon-circle mr-3 md:mr-3 w-9 h-9">
                                    <svg class="w-4 h-4 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M3.75 21h16.5M4.5 3h15M5.25 3v18m13.5-18v18M9 6.75h1.5m-1.5 3h1.5m-1.5 3H10.5m3-6H15m-1.5 3H15m-1.5 3H15M9 21v-3.375c0-.621.504-1.125 1.125-1.125h3.75c.621 0 1.125.504 1.125 1.125V21" /></svg>
                                </div>
                                <input type="text" name="school_name" id="school_name" required placeholder="Nama Sekolah / Instansi" data-i18n-placeholder="school_placeholder" class="bg-transparent w-full outline-none text-slate-600 dark:text-slate-300 font-semibold text-xs md:text-sm placeholder:text-slate-400 pr-4" />
                            </div>
                            <p id="error-school_name" class="hidden text-[10px] text-red-500 font-bold ml-6 uppercase tracking-wider" data-i18n="error_school">Nama instansi wajib diisi!</p>
                        </div>

                        <div class="space-y-1">
                            <div class="input-pill flex items-center p-1 md:p-1 group">
                                <div class="icon-circle mr-3 md:mr-3 w-9 h-9">
                                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" /></svg>
                                </div>
                                <input type="password" name="password" id="password" required placeholder="Buat Kata Sandi" data-i18n-placeholder="password_placeholder" class="bg-transparent w-full outline-none text-slate-600 dark:text-slate-300 font-semibold text-xs md:text-sm placeholder:text-slate-400 pr-4" />
                            </div>
                            <div class="mt-1 flex flex-wrap gap-x-2 gap-y-1 ml-6">
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1">
                                    <span class="w-1 h-1 bg-blue-500 rounded-full"></span> Min. 8 Karakter
                                </span>
                                <span class="text-[8px] font-bold text-slate-400 uppercase tracking-widest flex items-center gap-1">
                                    <span class="w-1 h-1 bg-blue-500 rounded-full"></span> Huruf & Angka
                                </span>
                            </div>
                            <p id="error-password" class="hidden text-[10px] text-red-500 font-bold ml-6 uppercase tracking-wider" data-i18n-error-password>Sandi harus 8+ karakter dengan kombinasi huruf & angka!</p>
                        </div>

                        <div class="space-y-1">
                            <div class="input-pill flex items-center p-1 md:p-1 group">
                                <div class="icon-circle mr-3 md:mr-3 w-9 h-9">
                                    <svg class="w-4 h-4 text-slate-400" fill="currentColor" viewBox="0 0 24 24"><path fill-rule="evenodd" d="M12 1.5a5.25 5.25 0 0 0-5.25 5.25v3a3 3 0 0 0-3 3v6.75a3 3 0 0 0 3 3h10.5a3 3 0 0 0 3-3v-6.75a3 3 0 0 0-3-3v-3c0-2.9-2.35-5.25-5.25-5.25Zm3.75 8.25v-3a3.75 3.75 0 1 0-7.5 0v3h7.5Z" clip-rule="evenodd" /></svg>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Konfirmasi Kata Sandi" data-i18n-placeholder="confirm_password_placeholder" class="bg-transparent w-full outline-none text-slate-600 dark:text-slate-300 font-semibold text-xs md:text-sm placeholder:text-slate-400 pr-4" />
                            </div>
                            <p id="error-password-mismatch" class="hidden text-[10px] text-red-500 font-bold ml-6 uppercase tracking-wider" data-i18n="error_password_mismatch">Konfirmasi sandi tidak cocok!</p>
                        </div>
                    </div>

                    <div class="space-y-3 pt-4">
                        <button type="submit" id="submitBtn" class="w-full btn-blue py-3 rounded-full text-white font-black text-sm md:text-base hover:scale-[1.01] active:scale-[0.99] transition-all flex items-center justify-center">
                            <span class="spinner"></span>
                            <span class="btn-text" data-i18n="reg_btn">Daftar Sekarang</span>
                        </button>

                        <div class="relative flex items-center py-2">
                            <div class="flex-grow border-t border-slate-100 dark:border-slate-800"></div>
                            <span class="flex-shrink mx-4 text-[8px] font-black text-slate-300 uppercase tracking-[0.2em]">Atau</span>
                            <div class="flex-grow border-t border-slate-100 dark:border-slate-800"></div>
                        </div>

                        <a href="{{ route('google.login') }}" class="flex items-center justify-center gap-2 py-2.5 px-4 rounded-full border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900/50 hover:bg-slate-50 dark:hover:bg-slate-800 transition-all group">
                            <svg class="w-4 h-4" viewBox="0 0 24 24">
                                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z" fill="#FBBC05"/>
                                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
                            </svg>
                            <span class="font-bold text-xs tracking-tight text-slate-700 dark:text-slate-300 group-hover:text-blue-600 transition-colors">Daftar dengan Google</span>
                        </a>
                    </div>

                    <div class="text-[#8a94a6] font-bold text-[10px] text-center pt-2">
                        <span data-i18n="has_account">Sudah memiliki akun?</span>
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline ml-1" data-i18n="login_now">Log in sekarang</a>
                    </div>
                </form>

                <div class="mt-8 pt-4 text-center">
                    <div class="flex flex-wrap items-center justify-center gap-x-4 gap-y-1 text-[9px] text-[#8a94a6] font-bold uppercase tracking-widest mb-3">
                        <a href="{{ route('help') }}" class="hover:text-blue-500 transition-colors" data-i18n="footer_help">Bantuan</a>
                        <a href="{{ route('terms') }}" class="hover:text-blue-500 transition-colors" data-i18n="footer_tos">S&K</a>
                        <a href="{{ route('privacy') }}" class="hover:text-blue-500 transition-colors" data-i18n="footer_privacy">Privasi</a>
                    </div>
                    <p class="text-[9px] text-slate-400 font-medium uppercase tracking-tight">Copyright © 2026 <span class="text-blue-500 font-bold">ScholaCBT</span></p>
                </div>
            </div>

            <!-- Right Side: Social Proof -->
            <div class="hidden md:flex w-1/2 flex-col items-center justify-center order-1 md:order-2">
                <img src="{{ asset('assets/images/illustration.png') }}" class="max-w-[320px] lg:max-w-[400px] h-auto mb-6" loading="lazy">
                <div class="text-center px-4 max-w-sm">
                    <p class="text-slate-400 dark:text-slate-500 text-xs font-medium" data-i18n="trusted_text">Dipercaya oleh lebih dari <span class="text-blue-500 font-bold">500+</span> instansi pendidikan di seluruh Indonesia.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Toast Notification -->
    <div id="toast">
        <svg class="w-5 h-5 text-blue-400 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span id="toastMsg" class="text-sm font-bold tracking-tight"></span>
    </div>

    <script>
        // Dictionary
        const translations = {
            id: {
                slogan: "Smart Examination System",
                reg_title: "Daftar",
                reg_subtitle: "Daftarkan instansi Anda dan mulai trial gratis hari ini.",
                name_placeholder: "Nama Lengkap Admin",
                email_placeholder: "Alamat Email",
                school_placeholder: "Nama Sekolah / Instansi",
                password_placeholder: "Buat Kata Sandi",
                confirm_password_placeholder: "Konfirmasi Kata Sandi",
                error_name: "Silakan isi nama lengkap!",
                error_email: "Alamat email tidak boleh kosong!",
                error_school: "Nama instansi wajib diisi!",
                error_password: "Kata sandi minimal 8 karakter!",
                error_password_mismatch: "Konfirmasi sandi tidak cocok!",
                reg_btn: "Daftar",
                has_account: "Sudah memiliki akun?",
                login_now: "Log in sekarang",
                footer_help: "Bantuan",
                footer_tos: "Syarat & Ketentuan",
                footer_privacy: "Privasi",
                trusted_text: "Dipercaya oleh lebih dari <span class='text-blue-500 font-bold'>500+</span> instansi pendidikan di seluruh Indonesia.",
                dark_mode_on: "Mode Gelap Aktif",
                dark_mode_off: "Mode Terang Aktif"
            },
            en: {
                slogan: "Digitalized Examination Solution",
                reg_title: "Sign Up",
                reg_subtitle: "Register your institution and start your free trial today.",
                name_placeholder: "Full Admin Name",
                email_placeholder: "Email Address",
                school_placeholder: "Institution / School Name",
                password_placeholder: "Create Password",
                confirm_password_placeholder: "Confirm Password",
                error_name: "Please enter full name!",
                error_email: "Email address cannot be empty!",
                error_school: "Institution name is required!",
                error_password: "Password min. 8 characters!",
                error_password_mismatch: "Passwords do not match!",
                reg_btn: "Sign Up",
                has_account: "Already have an account?",
                login_now: "Sign in now",
                footer_help: "Help",
                footer_tos: "Terms of Service",
                footer_privacy: "Privacy Policy",
                trusted_text: "Trusted by more than <span class='text-blue-500 font-bold'>500+</span> educational institutions across Indonesia.",
                dark_mode_on: "Dark Mode Enabled",
                dark_mode_off: "Light Mode Enabled"
            }
        };

        let currentLang = localStorage.getItem('app-lang') || 'id';

        function applyLanguage(lang) {
            currentLang = lang;
            localStorage.setItem('app-lang', lang);
            document.querySelectorAll('[data-i18n]').forEach(el => {
                const key = el.getAttribute('data-i18n');
                if (translations[lang][key]) el.innerHTML = translations[lang][key];
            });
            document.querySelectorAll('[data-i18n-placeholder]').forEach(el => {
                const key = el.getAttribute('data-i18n-placeholder');
                if (translations[lang][key]) el.placeholder = translations[lang][key];
            });
            const btnId = document.getElementById('lang-id');
            const btnEn = document.getElementById('lang-en');
            if (lang === 'id') {
                btnId.className = "px-2.5 md:px-3 py-1 md:py-1.5 rounded-full bg-white dark:bg-slate-700 shadow-sm text-blue-600 dark:text-blue-400";
                btnEn.className = "px-2.5 md:px-3 py-1 md:py-1.5 rounded-full text-slate-400";
            } else {
                btnEn.className = "px-2.5 md:px-3 py-1 md:py-1.5 rounded-full bg-white dark:bg-slate-700 shadow-sm text-blue-600 dark:text-blue-400";
                btnId.className = "px-2.5 md:px-3 py-1 md:py-1.5 rounded-full text-slate-400";
            }
        }

        function changeLanguage(lang) {
            applyLanguage(lang);
            showToast(lang === 'id' ? 'Bahasa Indonesia Aktif' : 'English Language Active');
        }

        if (localStorage.getItem('dark-mode') === 'true') document.documentElement.classList.add('dark');
        function toggleDarkMode() {
            const isDark = document.documentElement.classList.toggle('dark');
            localStorage.setItem('dark-mode', isDark);
            showToast(isDark ? translations[currentLang].dark_mode_on : translations[currentLang].dark_mode_off);
        }
        window.addEventListener('DOMContentLoaded', () => { applyLanguage(currentLang); document.body.classList.add('loaded'); });
        function showToast(msg) {
            const toast = document.getElementById('toast');
            document.getElementById('toastMsg').innerText = msg;
            toast.className = "show";
            setTimeout(() => { toast.className = toast.className.replace("show", ""); }, 3000);
        }
        function handleFormSubmit() {
            if (!validateForm()) return false;
            document.getElementById('submitBtn').classList.add('loading');
            return true;
        }
        function validateForm() {
            let isValid = true;
            // Clear all errors first
            document.querySelectorAll('[id^="error-"]').forEach(el => el.classList.add('hidden'));
            
            ['name', 'email', 'school_name', 'password', 'password_confirmation'].forEach(field => {
                if (!document.getElementById(field).value.trim()) {
                    const errEl = document.getElementById('error-' + field);
                    if (errEl) errEl.classList.remove('hidden');
                    isValid = false;
                }
            });

            // Specific check for password match
            const pass = document.getElementById('password').value;
            const confirm = document.getElementById('password_confirmation').value;
            if (pass && confirm && pass !== confirm) {
                document.getElementById('error-password-mismatch').classList.remove('hidden');
                isValid = false;
            }

            return isValid;
        }
    </script>
</body>
</html>
