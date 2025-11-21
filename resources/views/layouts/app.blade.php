<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ChewytPad') }}</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;500;700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            background-color: #FFFDF5;
            color: #333;
            
            /* PERBAIKAN: Tambahkan padding-top agar konten tidak tertutup navbar fixed */
            padding-top: 80px; 
        }
        
        .navbar-glass {
            background: rgba(255, 255, 255, 0.90);
            backdrop-filter: blur(12px);
            border-bottom: 1px solid rgba(0,0,0,0.05);
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
        }

        .card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.03);
        }
    </style>
</head>
<body>
    <div id="app" class="d-flex flex-column min-vh-100">
        @include('layouts.navigation')

        <main class="flex-grow-1 py-4">
            {{ $slot }}
        </main>
        
        <footer class="text-center py-4 text-muted small mt-auto">
            &copy; {{ date('Y') }} ChewytPad.
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>