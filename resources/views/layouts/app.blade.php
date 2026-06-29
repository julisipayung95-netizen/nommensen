<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'B University') — Universitas Pilihan Anda</title>
    <meta name="description" content="@yield('meta_description', 'Website resmi Universitas B University.')">

    {{-- Tailwind CSS via Vite --}}
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('head')
</head>
<body class="min-h-screen bg-white text-slate-800 antialiased font-sans">

    {{-- NAVBAR --}}
    @include('partials.navbar')

    {{-- MAIN CONTENT --}}
    <main class="min-h-[60vh]">
        @yield('content')
    </main>

    {{-- FOOTER --}}
    @include('partials.footer')

    @stack('scripts')
</body>
</html>