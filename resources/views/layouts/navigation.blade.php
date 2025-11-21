<nav class="navbar navbar-expand-lg navbar-glass fixed-top">
    <div class="container">
        <a class="navbar-brand fw-bold fs-4 d-flex align-items-center gap-2 text-dark" href="{{ route('dashboard') }}">
            🍬 Chewyt<span class="text-danger">Pad</span>
        </a>

        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mx-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active fw-bold text-primary' : '' }}" href="{{ route('dashboard') }}">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active fw-bold text-primary' : '' }}" href="{{ route('categories.index') }}">Kategori</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('notes.*') ? 'active fw-bold text-primary' : '' }}" href="{{ route('notes.index') }}">Catatan</a>
                </li>
            </ul>

            <div class="d-flex align-items-center gap-3">
                @if(Auth::user()->role === 'admin')
                    <a href="{{ route('admin.dashboard') }}" class="btn btn-dark btn-sm rounded-pill px-3 fw-bold d-flex align-items-center gap-2">
                        🛡️ <span class="d-none d-lg-inline">Admin Panel</span>
                    </a>
                @endif

                <div class="dropdown">
                    <a class="btn btn-light border rounded-pill px-3 py-1 d-flex align-items-center gap-2 dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="fw-bold small text-secondary">{{ Auth::user()->name }}</span>
                    </a>

                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-sm rounded-4 mt-2">
                        
                        @if(Auth::user()->role === 'admin')
                            <li>
                                <a class="dropdown-item text-primary fw-bold" href="{{ route('admin.dashboard') }}">
                                    🛡️ Ke Admin Panel
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                        @endif

                        <li>
                            <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                <i class="bi bi-person me-2"></i> Profile
                            </a>
                        </li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger">
                                    <i class="bi bi-box-arrow-right me-2"></i> Log Out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>