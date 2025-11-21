<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-gray-800">🗑️ Sampah (Backup)</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-4">
                <a href="{{ route('notes.index') }}" class="text-gray-600 hover:text-gray-900 font-bold">&larr; Kembali ke Catatan</a>
            </div>

            <div class="card p-6 bg-white">
                <table class="w-full">
                    <thead>
                        <tr class="bg-gray-100 text-left">
                            <th class="p-3 rounded-l-lg">Judul</th>
                            <th class="p-3">Dihapus Pada</th>
                            <th class="p-3 rounded-r-lg text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notes as $note)
                        <tr class="border-b">
                            <td class="p-3 font-bold">{{ $note->title }}</td>
                            <td class="p-3 text-gray-500">{{ $note->deleted_at->diffForHumans() }}</td>
                            <td class="p-3 flex justify-center gap-2">
                                <form action="{{ route('notes.restore', $note->id) }}" method="POST">
                                    @csrf @method('PUT')
                                    <button class="text-green-600 font-bold text-sm bg-green-100 px-3 py-1 rounded">Restore</button>
                                </form>
                                <form action="{{ route('notes.force_delete', $note->id) }}" method="POST" onsubmit="return confirm('Hapus permanen? Tidak bisa balik loh.');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-600 font-bold text-sm bg-red-100 px-3 py-1 rounded">Hapus Permanen</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="p-6 text-center text-gray-500">Sampah kosong.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>