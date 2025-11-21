<section>
    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <!-- Password Lama -->
        <div class="mb-3">
            <label for="current_password" class="form-label fw-bold">Password Saat Ini</label>
            <input type="password" name="current_password" id="current_password" class="form-control" autocomplete="current-password">
            @error('current_password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password Baru -->
        <div class="mb-3">
            <label for="password" class="form-label fw-bold">Password Baru</label>
            <input type="password" name="password" id="password" class="form-control" autocomplete="new-password">
            @error('password')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Konfirmasi Password -->
        <div class="mb-3">
            <label for="password_confirmation" class="form-label fw-bold">Konfirmasi Password Baru</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" autocomplete="new-password">
            @error('password_confirmation')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark fw-bold px-4">Update Password</button>

            @if (session('status') === 'password-updated')
                <p class="text-success fw-bold mb-0 small fade-in">✅ Password Berhasil Diganti!</p>
            @endif
        </div>
    </form>
</section>