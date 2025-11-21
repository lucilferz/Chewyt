<x-app-layout>
    <div class="container">
        <div class="row g-5">
            
            <!-- KOLOM KIRI: FORM (Sticky) -->
            <div class="col-md-4">
                <div class="card p-4 sticky-top shadow-sm" style="top: 100px; background-color: #FEF7C5;">
                    <div class="card-body">
                        <h4 class="fw-bold mb-3">✨ Buat Kategori</h4>
                        <p class="small text-muted mb-4">Bikin label biar catatanmu gak berantakan.</p>
                        
                        <form action="{{ route('categories.store') }}" method="POST">
                            @csrf
                            <div class="mb-3">
                                <input type="text" name="name" class="form-control bg-white border-0 shadow-sm" placeholder="Nama kategori..." required>
                            </div>
                            <button type="submit" class="btn btn-dark-fun w-100 py-2">Simpan</button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- KOLOM KANAN: DAFTAR -->
            <div class="col-md-8">
                <h4 class="fw-bold mb-4">Daftar Kategori</h4>
                
                @if(session('success'))
                    <div class="alert bg-success-subtle text-success border-0 rounded-4 fw-bold mb-4 px-4">
                        {{ session('success') }}
                    </div>
                @endif

                <div class="card overflow-hidden">
                    <div class="list-group list-group-flush">
                        @forelse ($categories as $category)
                        <div class="list-group-item p-4 d-flex justify-content-between align-items-center border-light hover-bg-light">
                            <div class="d-flex align-items-center gap-3">
                                <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white" 
                                     style="width: 45px; height: 45px; background-color: {{ $loop->even ? '#FFB4DA' : '#BCD3F9' }};">
                                    {{ substr($category->name, 0, 1) }}
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0 text-dark">{{ $category->name }}</h6>
                                    <small class="text-muted font-monospace">#{{ $category->slug }}</small>
                                </div>
                            </div>
                            
                            <div>
                                @if($category->user_id)
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus?');">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-bold">
                                            Hapus
                                        </button>
                                    </form>
                                @else
                                    <span class="badge bg-light text-secondary border rounded-pill px-3 py-2">ADMIN</span>
                                @endif
                            </div>
                        </div>
                        @empty
                        <div class="p-5 text-center text-muted">Kosong.</div>
                        @endforelse
                    </div>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>