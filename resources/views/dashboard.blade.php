<x-app-layout>
    {{-- Menggunakan Component Layout (<x-app-layout>) agar navbar User (layouts/navigation) muncul --}}

    <div class="container"> {{-- Gunakan 'container' agar lurus dengan Navbar, bukan 'container-fluid' --}}
        
        {{-- Welcome Card --}}
        <div class="row justify-content-center mb-4">
            <div class="col-lg-12"> {{-- Lebarkan jadi full width container --}}
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden bg-white">
                    <div class="card-body p-5 text-center position-relative">
                        {{-- Background decoration --}}
                        <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at top left, #f8fafc 0%, transparent 50%); opacity: 0.5;"></div>
                        
                        <h1 class="fw-bold text-dark mb-2 display-6">Halo, {{ Auth::user()->name }}! 👋</h1>
                        <p class="text-muted mb-4">Apa yang ingin kamu catat hari ini? Ide cemerlang jangan sampai hilang.</p>
                        
                        <div class="d-flex justify-content-center gap-3 position-relative">
                            <a href="{{ route('notes.create') }}" class="btn btn-dark rounded-pill px-4 py-2 fw-bold shadow-sm">
                                <i class="bi bi-plus-lg me-2"></i> Buat Catatan Baru
                            </a>
                            <a href="{{ route('notes.index') }}" class="btn btn-outline-dark rounded-pill px-4 py-2 fw-bold">
                                Lihat Semua
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row g-4">
            {{-- Kolom Kiri: Akses Cepat --}}
            <div class="col-lg-8">
                <h5 class="fw-bold text-dark mb-3 px-2">Akses Cepat 🚀</h5>
                <div class="row g-3">
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-3 rounded-4 hover-shadow transition">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-primary bg-opacity-10 p-3 rounded-circle text-primary">
                                    <i class="bi bi-folder2-open fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Kategori</h6>
                                    <a href="{{ route('categories.index') }}" class="stretched-link text-decoration-none text-muted small">Kelola Label &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card border-0 shadow-sm h-100 p-3 rounded-4 hover-shadow transition">
                            <div class="card-body d-flex align-items-center gap-3">
                                <div class="bg-info bg-opacity-10 p-3 rounded-circle text-info">
                                    <i class="bi bi-person-gear fs-4"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Akun Saya</h6>
                                    <a href="{{ route('profile.edit') }}" class="stretched-link text-decoration-none text-muted small">Edit Profil &rarr;</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Kolom Kanan: Riwayat Pencarian --}}
            <div class="col-lg-4">
                <h5 class="fw-bold text-dark mb-3 px-2">Riwayat Pencarian 🔍</h5>
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">
                            @php
                                // Pastikan model SearchHistory ada dan sudah di-migrate
                                // Gunakan try-catch atau cek null agar tidak error jika tabel kosong/belum ada
                                $histories = collect([]);
                                try {
                                    if (class_exists(\App\Models\SearchHistory::class)) {
                                        $histories = \App\Models\SearchHistory::where('user_id', Auth::id())
                                                        ->latest()
                                                        ->take(8)
                                                        ->get()
                                                        ->unique('keyword');
                                    }
                                } catch (\Exception $e) {
                                    // Silent fail jika tabel belum ada
                                }
                            @endphp

                            @forelse($histories as $history)
                                <a href="{{ route('notes.index', ['search' => $history->keyword]) }}" 
                                   class="btn btn-light btn-sm rounded-pill border text-secondary small px-3">
                                    {{ $history->keyword }}
                                </a>
                            @empty
                                <div class="text-center w-100 py-4 text-muted small">
                                    <i class="bi bi-search mb-2 d-block fs-4 opacity-25"></i>
                                    Belum ada riwayat pencarian.
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</x-app-layout>