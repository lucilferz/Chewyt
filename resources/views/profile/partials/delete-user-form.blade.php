<section>
    <p class="text-muted small mb-4">
        Setelah akun dihapus, semua data dan sumber daya akan hilang secara permanen. Silakan unduh data penting sebelum menghapus.
    </p>

    <!-- Tombol Pemicu Modal -->
    <button type="button" class="btn btn-outline-danger fw-bold" data-bs-toggle="modal" data-bs-target="#confirmUserDeletionModal">
        Hapus Akun Saya
    </button>

    <!-- Modal Konfirmasi (Bootstrap Modal) -->
    <div class="modal fade" id="confirmUserDeletionModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="post" action="{{ route('profile.destroy') }}" class="modal-content">
                @csrf
                @method('delete')

                <div class="modal-header bg-danger text-white">
                    <h5 class="modal-title fw-bold" id="modalLabel">Konfirmasi Penghapusan</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="fw-bold text-dark">Apakah Anda yakin ingin menghapus akun?</p>
                    <p class="text-muted small">Masukkan password Anda untuk mengonfirmasi bahwa Anda benar-benar ingin menghapus akun ini secara permanen.</p>

                    <div class="mt-3">
                        <label for="password" class="form-label visually-hidden">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Masukkan Password Anda" required>
                        @error('password')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fw-bold" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-danger fw-bold">Ya, Hapus Akun</button>
                </div>
            </form>
        </div>
    </div>
</section>