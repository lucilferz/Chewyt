<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tulis Catatan Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-8">

                <!-- Form Start -->
                <!-- enctype="multipart/form-data" WAJIB ADA kalau mau upload file/gambar -->
                <form action="{{ route('notes.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <!-- Pilihan Kategori -->
                    <div class="mb-6">
                        <label for="category_id" class="block text-sm font-medium text-gray-700 mb-2">Kategori</label>
                        <select name="category_id" id="category_id" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <option value="" disabled selected>-- Pilih Kategori --</option>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Belum ada kategori? <a href="{{ route('categories.create') }}" class="text-blue-500 hover:underline">Buat di sini</a></p>
                    </div>

                    <!-- Input Judul -->
                    <div class="mb-6">
                        <label for="title" class="block text-sm font-medium text-gray-700 mb-2">Judul Catatan</label>
                        <input type="text" name="title" id="title" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Contoh: Resep Nasi Goreng Spesial" required>
                    </div>

                    <!-- Input Isi Catatan -->
                    <div class="mb-6">
                        <label for="content" class="block text-sm font-medium text-gray-700 mb-2">Isi Catatan</label>
                        <textarea name="content" id="content" rows="10" class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" placeholder="Tulis ide cemerlangmu di sini..." required></textarea>
                    </div>

                    <!-- Input File/Gambar (Opsional) -->
                    <div class="mb-6">
                        <label for="file" class="block text-sm font-medium text-gray-700 mb-2">Upload Gambar (Opsional)</label>
                        <input type="file" name="file" id="file" class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100">
                    </div>

                    <!-- Tombol Aksi -->
                    <div class="flex justify-end gap-4 border-t pt-6">
                        <a href="{{ route('notes.index') }}" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-md hover:bg-gray-300 font-medium">
                            Batal
                        </a>
                        <button type="submit" class="px-6 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700 font-bold shadow-lg transform hover:-translate-y-0.5 transition">
                            Simpan Catatan
                        </button>
                    </div>
                </form>
                <!-- Form End -->

            </div>
        </div>
    </div>
</x-app-layout>