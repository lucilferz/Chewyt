<section>
    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <!-- Input Nama -->
        <div class="mb-3">
            <label for="name" class="form-label fw-bold">Nama Lengkap</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name">
            @error('name')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Input Email -->
        <div class="mb-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $user->email) }}" required autocomplete="username">
            @error('email')
                <div class="text-danger small mt-1">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tombol Simpan -->
        <div class="d-flex align-items-center gap-3">
            <button type="submit" class="btn btn-dark fw-bold px-4">Simpan Perubahan</button>

            @if (session('status') === 'profile-updated')
                <p class="text-success fw-bold mb-0 small fade-in">✅ Tersimpan!</p>
            @endif
        </div>
    </form>
</section>