<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ChewytPad') }}</title>

    <!-- 1. Bootstrap 5 CSS (CDN) - Biar Rapi -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- 2. Font Google (Outfit) - Biar Modern -->
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    
    <!-- 3. Icons Bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF5;
            color: #333;
        }
        .navbar-glass {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
        }
        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
        /* Style untuk badge admin */
        .admin-badge {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border: none;
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        <!-- Panggil Menu Navigasi -->
        @include('layouts.navigation')

        <!-- Isi Konten Halaman -->
        <main class="py-5 flex-grow-1">
            {{ $slot }}
        </main>
        
        <footer class="text-center py-4 text-muted small">
            &copy; {{ date('Y') }} ChewytPad.
        </footer>
    </div>

    <!-- Bootstrap JS (Wajib buat Dropdown & Mobile Menu) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>