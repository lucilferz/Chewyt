<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - ChewytPad</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F8FAFC;
            overflow-x: hidden;
        }
        
        /* SIDEBAR STYLE */
        .sidebar {
            width: 260px;
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1e293b; /* Warna Gelap Elegan */
            color: white;
            transition: all 0.3s;
            z-index: 1000;
        }
        
        .sidebar-header {
            padding: 20px;
            font-size: 1.2rem;
            font-weight: 800;
            color: #FFB4DA; /* Aksen Pink */
            border-bottom: 1px solid rgba(255,255,255,0.1);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-menu {
            padding: 20px 0;
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 12px 25px;
            color: rgba(255,255,255,0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
        }

        .menu-link:hover, .menu-link.active {
            background-color: rgba(255,255,255,0.1);
            color: #fff;
            border-left: 4px solid #FFB4DA;
        }

        .menu-link i {
            margin-right: 10px;
            font-size: 1.1rem;
        }

        /* CONTENT STYLE */
        .main-content {
            margin-left: 260px; /* Geser konten ke kanan seukuran sidebar */
            width: calc(100% - 260px);
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* NAVBAR ATAS (Utk Profil Admin) */
        .top-navbar {
            background: white;
            height: 70px;
            padding: 0 30px;
            display: flex;
            align-items: center;
            justify-content: flex-end;
            box-shadow: 0 2px 10px rgba(0,0,0,0.03);
        }

        .page-content {
            padding: 30px;
        }

        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .main-content { margin-left: 0; width: 100%; }
            .sidebar.active { margin-left: 0; }
        }
    </style>
</head>
<body>

<div id="wrapper">
    <!-- 1. SIDEBAR KIRI -->
    <div class="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-shield-lock-fill"></i> Admin Panel
        </div>
        <div class="sidebar-menu">
            <div class="small text-uppercase text-secondary fw-bold px-4 mb-2" style="font-size: 0.7rem;">Menu Utama</div>
            
            <a href="{{ route('admin.dashboard') }}" class="menu-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2 me-2"></i> Dashboard
            </a>
            
            <a href="{{ route('admin.users.index') }}" class="menu-link {{ request()->routeIs('admin.users.index') ? 'active' : '' }}">
                <i class="bi bi-people-fill me-2"></i> Kelola User
            </a>

            <div class="small text-uppercase text-secondary fw-bold px-4 mb-2 mt-4" style="font-size: 0.7rem;">Navigasi Cepat</div>

            <a href="{{ route('notes.index') }}" class="menu-link">
                <i class="bi bi-arrow-left-circle"></i> Ke Halaman Utama
            </a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="menu-link w-100 border-0 text-danger" style="text-align: left;">
                    <i class="bi bi-box-arrow-right"></i> Logout
                </button>
            </form>
        </div>
    </div>

    <!-- 2. KONTEN KANAN -->
    <div class="main-content">
        <!-- Header Putih di Atas -->
        <div class="top-navbar">
            <div class="d-flex align-items-center gap-3">
                <div class="text-end d-none d-md-block">
                    <div class="fw-bold text-dark">{{ Auth::user()->name }}</div>
                    <div class="small text-muted" style="font-size: 0.75rem;">Administrator</div>
                </div>
                <div class="bg-dark text-white rounded-circle d-flex align-items-center justify-content-center fw-bold border" style="width: 40px; height: 40px;">
                    {{ substr(Auth::user()->name, 0, 1) }}
                </div>
            </div>
        </div>

        <!-- Isi Halaman Masuk Sini -->
        <div class="page-content">
            @yield('content')
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>