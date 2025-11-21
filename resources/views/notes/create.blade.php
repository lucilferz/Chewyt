<x-app-layout>
    <div class="container">
        
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Header Sederhana --}}
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <a href="{{ route('notes.index') }}" class="text-decoration-none text-muted fw-bold small">
                        <i class="bi bi-arrow-left me-1"></i> Kembali ke Daftar
                    </a>
                    <h5 class="fw-bold text-dark m-0">Tulis Cerita Baru 📝</h5>
                </div>

                {{-- Card Form --}}
                <div class="card border-0 shadow-sm rounded-4 bg-white">
                    <div class="card-body p-4 p-lg-5">
                        
                        {{-- PENTING: Tambahkan enctype="multipart/form-data" untuk support upload file --}}
                        <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            {{-- Input Judul --}}
                            <div class="mb-4">
                                <label for="title" class="form-label fw-bold text-secondary small text-uppercase ls-1">Judul Catatan</label>
                                <input type="text" 
                                       class="form-control form-control-lg border-0 bg-light rounded-3 px-3" 
                                       id="title" 
                                       name="title" 
                                       placeholder="Beri judul yang menarik..." 
                                       required>
                            </div>

                            {{-- Input Kategori (Optional) --}}
                            <div class="mb-4">
                                <label for="category_id" class="form-label fw-bold text-secondary small text-uppercase ls-1">Kategori</label>
                                <div class="input-group">
                                    <span class="input-group-text border-0 bg-light rounded-start-3 ps-3 text-muted">
                                        <i class="bi bi-tag"></i>
                                    </span>
                                    <select class="form-select border-0 bg-light rounded-end-3 py-2 text-muted" id="category_id" name="category_id">
                                        <option value="" selected>Tanpa Kategori</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            {{-- Input Upload Gambar (BARU) --}}
                            <div class="mb-4">
                                <label for="file" class="form-label fw-bold text-secondary small text-uppercase ls-1">
                                    Dokumen Tambahan <span class="text-muted fw-normal text-lowercase">(opsional)</span>
                                </label>
                                <input type="file" 
                                       class="form-control border-0 bg-light rounded-3 px-3 py-2 text-muted" 
                                       id="file" 
                                       name="file" 
                                       accept="image/*">
                                <div class="form-text text-muted small ms-1">Format: JPG, PNG, JPEG. Maksimal 2MB.</div>
                            </div>

                            {{-- Input Isi (Textarea) --}}
                            <div class="mb-5">
                                <label for="content" class="form-label fw-bold text-secondary small text-uppercase ls-1">Isi Catatan</label>
                                <textarea class="form-control border-0 bg-light rounded-3 p-3" 
                                          id="content" 
                                          name="content" 
                                          rows="8" 
                                          placeholder="Apa yang ada di pikiranmu saat ini?..." 
                                          required></textarea>
                            </div>

                            {{-- Action Buttons --}}
                            <div class="d-flex justify-content-end gap-2 align-items-center">
                                <a href="{{ route('notes.index') }}" class="btn btn-light rounded-pill px-4 py-2 fw-bold text-muted">
                                    Batal
                                </a>
                                <button type="submit" class="btn btn-dark rounded-pill px-5 py-2 fw-bold shadow-sm">
                                    <i class="bi bi-save2 me-2"></i> Simpan
                                </button>
                            </div>

                        </form>

                    </div>
                </div>
            </div>
        </div>

    </div>

    {{-- CSS Tambahan Khusus Halaman Ini --}}
    <style>
        /* Efek fokus pada input agar sesuai tema */
        .form-control:focus, .form-select:focus {
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(33, 37, 41, 0.1); /* Ring halus warna dark */
            border: 1px solid #dee2e6;
        }
        .ls-1 {
            letter-spacing: 1px;
        }
        /* Custom styling untuk input file agar lebih cantik di Bootstrap 5 */
        input[type="file"]::file-selector-button {
            border: none;
            background: #e9ecef;
            padding: 0.375rem 0.75rem;
            border-radius: 0.375rem;
            color: #495057;
            margin-right: 1rem;
            transition: all .2s;
            font-weight: 600;
            font-size: 0.85rem;
        }
        input[type="file"]::file-selector-button:hover {
            background: #dde0e3;
            cursor: pointer;
        }
    </style>
</x-app-layout>