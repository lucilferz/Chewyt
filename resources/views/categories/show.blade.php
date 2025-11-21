<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Detail Catatan
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">
                
                <!-- Header Detail -->
                <div class="mb-6 border-b pb-4">
                    <span class="bg-blue-100 text-blue-800 text-xs font-medium px-2.5 py-0.5 rounded">
                        {{ $note->category->name }}
                    </span>
                    <h1 class="text-3xl font-bold text-gray-900 mt-2">{{ $note->title }}</h1>
                    <p class="text-sm text-gray-500 mt-1">
                        Dibuat: {{ $note->created_at->format('d M Y, H:i') }}
                    </p>
                </div>

                <!-- Gambar (Jika ada) -->
                @if($note->file_path)
                    <div class="mb-6">
                        <img src="{{ asset('storage/' . $note->file_path) }}" alt="Lampiran" class="rounded-lg shadow-md max-h-96 w-full object-cover">
                    </div>
                @endif

                <!-- Isi Catatan -->
                <div class="prose max-w-none text-gray-800 leading-relaxed whitespace-pre-line">
                    {{ $note->content }}
                </div>

                <!-- Tombol Kembali -->
                <div class="mt-8 pt-6 border-t flex justify-between">
                    <a href="{{ route('notes.index') }}" class="text-gray-600 hover:text-gray-900 font-medium">
                        &larr; Kembali ke Daftar
                    </a>
                    <div class="flex gap-2">
                        <!-- Nanti kita isi tombol Edit/Hapus disini -->
                        <button class="text-red-500 hover:text-red-700 font-medium">Hapus Catatan</button>
                    </div>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>