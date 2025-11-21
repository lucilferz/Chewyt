<x-app-layout>
    <div class="container">
        
        <!-- Header -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
            <div>
                <h2 class="fw-bold text-dark mb-1">Admin Panel 🛡️</h2>
                <p class="text-muted mb-0">Ringkasan statistik sistem ChewytPad.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('admin.users.index') }}" class="btn btn-dark btn-sm px-4 py-2 fw-bold shadow-sm rounded-pill">
                    <i class="bi bi-people-fill me-2"></i> Kelola User
                </a>
                <button onclick="window.print()" class="btn btn-outline-secondary btn-sm px-4 py-2 fw-bold rounded-pill">
                    <i class="bi bi-printer me-2"></i> Cetak
                </button>
            </div>
        </div>

        <!-- Kartu Statistik -->
        <div class="row g-4 mb-5">
            <!-- Total User -->
            <div class="col-md-4">
                <div class="card h-100 p-4 bg-white border-start border-4 border-primary">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                            <i class="bi bi-people fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0 display-5">{{ $totalUsers }}</h2>
                            <span class="text-muted small fw-bold text-uppercase">Total User</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Catatan -->
            <div class="col-md-4">
                <div class="card h-100 p-4 bg-white border-start border-4 border-warning">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-warning bg-opacity-10 p-3 rounded-circle text-warning">
                            <i class="bi bi-journal-text fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0 display-5">{{ $totalNotes }}</h2>
                            <span class="text-muted small fw-bold text-uppercase">Total Catatan</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Total Kategori -->
            <div class="col-md-4">
                <div class="card h-100 p-4 bg-white border-start border-4 border-success">
                    <div class="d-flex align-items-center gap-3">
                        <div class="bg-success bg-opacity-10 p-3 rounded-circle text-success">
                            <i class="bi bi-tags fs-3"></i>
                        </div>
                        <div>
                            <h2 class="fw-bold mb-0 display-5">{{ $totalCategories }}</h2>
                            <span class="text-muted small fw-bold text-uppercase">Total Kategori</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Grafik Progress Kategori -->
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white py-3 border-bottom">
                        <h6 class="fw-bold m-0">🔥 Kategori Terpopuler</h6>
                    </div>
                    <div class="card-body">
                        @foreach($popularCategories as $cat)
                            <div class="mb-4 last:mb-0">
                                <div class="d-flex justify-content-between small mb-1">
                                    <span class="fw-bold text-dark">{{ $cat->name }}</span>
                                    <span class="text-muted fw-bold">{{ $cat->notes_count }} Notes</span>
                                </div>
                                <div class="progress" style="height: 8px; border-radius: 10px;">
                                    <div class="progress-bar bg-dark" role="progressbar" 
                                         style="width: {{ ($totalNotes > 0) ? ($cat->notes_count / $totalNotes) * 100 : 0 }}%">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        @if($popularCategories->isEmpty())
                            <div class="text-center text-muted py-4 small">Belum ada data.</div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- User Terbaru -->
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                        <h6 class="fw-bold m-0">👋 User Baru Bergabung</h6>
                        <a href="{{ route('admin.users.index') }}" class="text-decoration-none small fw-bold">Lihat Semua &rarr;</a>
                    </div>
                    <div class="list-group list-group-flush">
                        @forelse($latestUsers as $user)
                            <div class="list-group-item border-0 px-4 py-3 d-flex align-items-center gap-3">
                                <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 36px; height: 36px;">
                                    {{ substr($user->name, 0, 1) }}
                                </div>
                                <div>
                                    <div class="fw-bold text-dark small">{{ $user->name }}</div>
                                    <div class="text-muted small" style="font-size: 12px;">{{ $user->email }}</div>
                                </div>
                                <span class="ms-auto badge bg-light text-dark border">{{ $user->created_at->diffForHumans() }}</span>
                            </div>
                        @empty
                            <div class="text-center py-5 text-muted small">Belum ada user baru.</div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>