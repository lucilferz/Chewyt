<x-app-layout>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                
                <!-- Header -->
                <h2 class="fw-bold text-dark mb-4">Pengaturan Profil ⚙️</h2>

                <!-- 1. Update Info Profil -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-primary">Informasi Profil</h5>
                        <small class="text-muted">Perbarui nama dan alamat email akun Anda.</small>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-profile-information-form')
                    </div>
                </div>

                <!-- 2. Update Password -->
                <div class="card mb-4 border-0 shadow-sm">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-primary">Ganti Password</h5>
                        <small class="text-muted">Pastikan akun Anda aman dengan password yang kuat.</small>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.update-password-form')
                    </div>
                </div>

                <!-- 3. Hapus Akun -->
                <div class="card border-0 shadow-sm border-start border-4 border-danger">
                    <div class="card-header bg-white py-3">
                        <h5 class="mb-0 fw-bold text-danger">Hapus Akun</h5>
                        <small class="text-muted">Tindakan ini tidak dapat dibatalkan.</small>
                    </div>
                    <div class="card-body p-4">
                        @include('profile.partials.delete-user-form')
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>