<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="google-site-verification" content="W2cgEcBUfDyFXgYD7cgWT_b-ZnF0E5H0vYpPJfKxIys" />
        <link rel="shortcut icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
        <link rel="icon" href="{{ asset('favicon-new.ico') }}" type="image/x-icon">
        <link rel="icon" type="image/png" sizes="48x48" href="{{ asset('assets/images/logo.png') }}">
        <link rel="icon" type="image/png" sizes="96x96" href="{{ asset('assets/images/logo.png') }}">
        <link rel="icon" type="image/png" sizes="144x144" href="{{ asset('assets/images/logo.png') }}">
        <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('assets/images/logo.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('assets/images/logo.png') }}">
        <link rel="manifest" href="{{ asset('site.webmanifest') }}">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
