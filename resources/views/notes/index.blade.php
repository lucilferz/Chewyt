<x-app-layout>
    <div class="container">
        
        <!-- Header Action -->
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mb-5 gap-3">
            <div>
                <h2 class="fw-bolder m-0">Catatan Saya 📒</h2>
                <p class="text-muted m-0 small">Total ide tersimpan rapi.</p>
            </div>
            <div class="d-flex gap-2">
                <a href="{{ route('notes.trash') }}" class="btn btn-light text-secondary fw-bold border">
                    <i class="bi bi-trash"></i> Sampah
                </a>
                <a href="{{ route('notes.exportPdf') }}" class="btn btn-light text-danger fw-bold border">
                    <i class="bi bi-file-pdf-fill"></i> PDF
                </a>
                <a href="{{ route('notes.create') }}" class="btn btn-dark-fun shadow">
                    + Tulis Baru
                </a>
            </div>
        </div>

        <!-- Alert Success -->
        @if(session('success'))
            <div class="alert border-0 shadow-sm rounded-4 d-flex align-items-center gap-3 mb-4" style="background-color: #D5FFC9; color: #155724;">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div class="fw-bold">{{ session('success') }}</div>
            </div>
        @endif

        <!-- Search Bar (Capsule Style) -->
        <div class="card mb-5 p-2 rounded-pill shadow-sm mx-auto" style="max-width: 800px;">
            <form method="GET" action="{{ route('notes.index') }}" class="d-flex align-items-center gap-2 p-1">
                <div class="input-group input-group-merge border-0">
                    <span class="input-group-text bg-transparent border-0 ps-3 text-muted"><i class="bi bi-search"></i></span>
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control border-0 bg-transparent shadow-none" placeholder="Cari sesuatu...">
                </div>
                <select name="category_id" class="form-select border-0 bg-light rounded-pill shadow-none" style="max-width: 180px; cursor: pointer;" onchange="this.form.submit()">
                    <option value="">📂 Semua</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                    @endforeach
                </select>
                <button class="btn btn-berry rounded-circle p-2" style="width: 42px; height: 42px;"><i class="bi bi-arrow-right"></i></button>
            </form>
        </div>

        <!-- Grid Catatan -->
        <div class="row g-4">
            @forelse($notes as $note)
            <div class="col-md-6 col-lg-4">
                <div class="card h-100 border-0 position-relative overflow-hidden">
                    <!-- Hiasan atas -->
                    <div class="position-absolute top-0 start-0 w-100 h-1" style="background: var(--berry-pink);"></div>
                    
                    <div class="card-body p-4 d-flex flex-column">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <span class="badge-pill bg-light text-dark border">
                                {{ $note->category->name }}
                            </span>
                            <small class="fw-bold text-muted" style="font-size: 0.7rem;">{{ $note->created_at->format('d M') }}</small>
                        </div>

                        <h4 class="card-title fw-bold mb-2 text-dark">{{ $note->title }}</h4>
                        <p class="card-text text-muted small flex-grow-1" style="line-height: 1.6;">
                            {{ Str::limit($note->content, 120) }}
                        </p>

                        <div class="d-flex justify-content-between align-items-center mt-4 pt-3 border-top border-light">
                            <a href="{{ route('notes.show', $note->id) }}" class="text-decoration-none fw-bold text-dark small">
                                Baca Detail <i class="bi bi-arrow-right ms-1"></i>
                            </a>
                            
                            <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Yakin hapus?');">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light text-danger rounded-circle" style="width: 32px; height: 32px;">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="col-12 text-center py-5">
                <div class="mb-3 fs-1">🍃</div>
                <h5 class="fw-bold text-muted">Belum ada catatan</h5>
                <p class="small text-muted">Yuk mulai menulis sekarang!</p>
            </div>
            @endforelse
        </div>

    </div>
</x-app-layout>