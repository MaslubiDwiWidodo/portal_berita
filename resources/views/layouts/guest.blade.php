<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Portal Berita - Autentikasi</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <!-- Tailwind CSS CDN Fallback & Vite -->
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: linear-gradient(135deg, #0f172a 0%, #1e293b 50%, #0f172a 100%);
            min-height: 100vh;
        }
        .glass-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.25);
        }
    </style>
</head>
<body class="font-sans antialiased text-gray-900 flex items-center justify-center min-h-screen p-4 sm:p-6">
    <div class="w-full max-w-md my-auto">
        <!-- Logo & Header -->
        <div class="text-center mb-8">
            <a href="/" class="inline-flex items-center gap-2 text-3xl font-extrabold text-white tracking-tight hover:opacity-90 transition-opacity">
                <span class="bg-blue-600 text-white px-3.5 py-1.5 rounded-2xl shadow-lg shadow-blue-500/30">Portal</span>
                <span class="text-blue-400">Berita</span>
            </a>
            <p class="text-gray-400 text-sm mt-3 font-medium">Panel Masuk Pengelola Portal Berita</p>
        </div>

        <!-- Card Container -->
        <div class="glass-card rounded-3xl p-8 sm:p-10 shadow-2xl">
            {{ $slot }}
        </div>

        <!-- Footer link -->
        <div class="text-center mt-8">
            <a href="/" class="text-sm font-semibold text-gray-400 hover:text-white transition-colors duration-200 inline-flex items-center gap-2">
                <span>&larr;</span> Kembali ke Halaman Utama Website
            </a>
        </div>
    </div>
</body>
</html>
