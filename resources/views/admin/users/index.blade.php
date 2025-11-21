@extends('layouts.admin')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-dark mb-0">Kelola Pengguna 👥</h3>
        <span class="badge bg-dark rounded-pill px-3">{{ $users->count() }} User Terdaftar</span>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 fw-bold mb-4 shadow-sm rounded-4">
            <i class="bi bi-check-circle-fill me-2"></i> {{ session('success') }}
        </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4 py-3 text-uppercase text-secondary small fw-bold">User</th>
                            <th class="text-uppercase text-secondary small fw-bold">Email</th>
                            <th class="text-uppercase text-secondary small fw-bold">Bergabung</th>
                            <th class="text-end pe-4 text-uppercase text-secondary small fw-bold">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="ps-4">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 35px; height: 35px;">
                                        {{ substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="fw-bold text-dark">{{ $user->name }}</span>
                                </div>
                            </td>
                            <td class="text-muted">{{ $user->email }}</td>
                            <td><span class="badge bg-light text-dark border">{{ $user->created_at->format('d M Y') }}</span></td>
                            <td class="text-end pe-4">
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" onsubmit="return confirm('Hapus user ini permanen?');">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger rounded-pill px-3 fw-bold shadow-sm">
                                        <i class="bi bi-trash-fill me-1"></i> Hapus
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr><td colspan="4" class="text-center py-5 text-muted">Hanya ada Anda (Admin) di sistem ini.</td></tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection