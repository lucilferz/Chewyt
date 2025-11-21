<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                <!-- Tombol Kembali -->
                <div class="mb-4">
                    <a href="{{ route('notes.index') }}" class="btn btn-link text-decoration-none text-muted fw-bold ps-0">
                        &larr; Kembali ke Daftar
                    </a>
                </div>

                <!-- Konten Catatan -->
                <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                    
                    <!-- Header Catatan -->
                    <div class="card-header bg-white border-bottom border-light p-4 d-flex justify-content-between align-items-center">
                        <span class="badge bg-primary bg-opacity-10 text-primary rounded-pill px-3 py-2 fw-bold">
                            {{ $note->category->name }}
                        </span>
                        <small class="text-muted fw-bold">
                            {{ $note->created_at->format('d F Y, H:i') }}
                        </small>
                    </div>

                    <div class="card-body p-5">
                        <!-- Judul -->
                        <h2 class="fw-bold text-dark mb-4">{{ $note->title }}</h2>

                        <!-- Gambar (Jika Ada) -->
                        @if($note->file_path)
                            <div class="mb-4 rounded-4 overflow-hidden shadow-sm border">
                                <img src="{{ asset('storage/' . $note->file_path) }}" class="img-fluid w-100" alt="Lampiran Gambar">
                            </div>
                        @endif

                        <!-- Isi Teks -->
                        <div class="text-secondary" style="line-height: 1.8; font-size: 1.05rem; white-space: pre-wrap;">{{ $note->content }}</div>
                    </div>

                    <!-- Footer Aksi -->
                    <div class="card-footer bg-light border-0 p-4 d-flex justify-content-end gap-2">
                        <form action="{{ route('notes.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Pindahkan catatan ini ke sampah?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger rounded-pill px-4 fw-bold">
                                <i class="bi bi-trash me-1"></i> Hapus
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>