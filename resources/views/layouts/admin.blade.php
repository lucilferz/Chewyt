<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Panel - ChewytPad</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

    <style>
        :root {
            --sidebar-width: 260px;
            --topbar-height: 70px;
            --primary-color: #6366f1; /* Indigo modern */
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: #F3F4F6; /* Abu-abu muda soft */
            overflow-x: hidden;
        }
        
        /* 1. SIDEBAR STYLE */
        .sidebar {
            width: var(--sidebar-width);
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #1e293b; /* Slate gelap */
            color: white;
            z-index: 1000;
            transition: margin-left 0.3s;
        }
        
        .sidebar-header {
            height: var(--topbar-height);
            display: flex;
            align-items: center;
            padding: 0 25px;
            font-size: 1.25rem;
            font-weight: 800;
            color: #FFB4DA; 
            border-bottom: 1px solid rgba(255,255,255,0.05);
        }

        .menu-link {
            display: flex;
            align-items: center;
            padding: 14px 25px;
            color: #94a3b8;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s;
            border-left: 3px solid transparent;
        }

        .menu-link:hover, .menu-link.active {
            background-color: rgba(255,255,255,0.05);
            color: #fff;
            border-left-color: #FFB4DA;
        }

        .menu-link i {
            margin-right: 12px;
            font-size: 1.1rem;
        }

        /* 2. MAIN CONTENT WRAPPER */
        .main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            transition: margin-left 0.3s, width 0.3s;
        }

        /* 3. NAVBAR MODERN STYLE */
        .top-navbar {
            height: var(--topbar-height);
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px); /* Efek kaca */
            border-bottom: 1px solid #e5e7eb;
            padding: 0 30px;
            position: sticky;
            top: 0;
            z-index: 900;
            display: flex;
            align-items: center;
        }

        /* Search Box Styling */
        .search-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 50px;
            padding: 8px 20px;
            display: flex;
            align-items: center;
            width: 350px;
            transition: all 0.2s;
        }
        .search-box:focus-within {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            background: white;
        }
        .search-box input {
            border: none;
            background: transparent;
            outline: none;
            width: 100%;
            margin-left: 10px;
            font-size: 0.9rem;
            color: #475569;
        }

        /* Icon Buttons */
        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #64748b;
            transition: all 0.2s;
            background: transparent;
            border: none;
        }
        .btn-icon:hover {
            background-color: #f1f5f9;
            color: var(--primary-color);
        }

        .page-content {
            padding: 30px;
        }

        /* Responsiveness */
        @media (max-width: 768px) {
            .sidebar { margin-left: -260px; }
            .sidebar.show { margin-left: 0; }
            .main-content { margin-left: 0; width: 100%; }
            .search-box { display: none; } /* Sembunyikan search di HP */
        }
    </style>
</head>
<body>

<div id="wrapper">
    
    <div class="sidebar" id="sidebar">
        <div class="sidebar-header">
            <i class="bi bi-grid-1x2-fill"></i> ChewytPad
        </div>
        <div class="sidebar-menu mt-3">
            <a href="{{ route('dashboard') }}" class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="#" class="menu-link">
                <i class="bi bi-people"></i> Pengguna
            </a>
            <a href="#" class="menu-link">
                <i class="bi bi-collection"></i> Kategori
            </a>
            <a href="#" class="menu-link">
                <i class="bi bi-gear"></i> Pengaturan
            </a>
        </div>
    </div>
    <div class="main-content">
        
        <nav class="top-navbar justify-content-between">
            
            <div class="d-flex align-items-center gap-3">
                <button class="btn btn-link text-secondary p-0 d-md-none" onclick="toggleSidebar()">
                    <i class="bi bi-list fs-4"></i>
                </button>
                <h5 class="mb-0 fw-bold text-dark">Dashboard</h5>
            </div>

            <div class="d-none d-md-block">
                <div class="search-box">
                    <i class="bi bi-search text-secondary"></i>
                    <input type="text" placeholder="Cari data...">
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                
                <button class="btn-icon position-relative">
                    <i class="bi bi-bell fs-5"></i>
                    <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="width: 10px; height: 10px;"></span>
                </button>

                <div class="vr h-50 mx-1 text-secondary"></div>

                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle p-1 rounded-pill hover-bg-light" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name ?? 'Admin' }}&background=6366f1&color=fff" width="36" height="36" class="rounded-circle border shadow-sm me-2">
                        <div class="d-none d-md-block text-start me-2">
                            <div class="fw-bold text-dark" style="font-size: 0.9rem; line-height: 1.2;">{{ Auth::user()->name ?? 'User' }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Administrator</div>
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2">
                        <li><a class="dropdown-item" href="#"><i class="bi bi-person me-2"></i> Profil Saya</a></li>
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gear me-2"></i> Settings</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Log Out</button>
                            </form>
                        </li>
                    </ul>
                </div>

            </div>
        </nav>
        <div class="page-content">
            @yield('content')
        </div>

    </div>
</div>

<script>
    function toggleSidebar() {
        document.getElementById('sidebar').classList.toggle('show');
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>