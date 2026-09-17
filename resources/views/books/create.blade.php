<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tambah Buku Baru') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="p-6 bg-white shadow sm:rounded-lg">
                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kategori Buku</label>
                            <select name="category_id" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-sm font-medium text-gray-700">Kode ISBN</label>
                            <input type="text" name="isbn" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required placeholder="978-xxx-xxx">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Judul Buku</label>
                        <input type="text" name="title" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                    </div>

                    <div class="grid grid-cols-3 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Pengarang</label>
                            <input type="text" name="author" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Penerbit</label>
                            <input type="text" name="publisher" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Tahun Terbit</label>
                            <input type="number" name="publication_year" placeholder="2024" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Jumlah Stok</label>
                            <input type="number" name="total_stock" min="1" class="w-full mt-1 border-gray-300 rounded-md shadow-sm" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium text-gray-700">Lokasi Rak</label>
                            <input type="text" name="rack_location" placeholder="Rak A-01" class="w-full mt-1 border-gray-300 rounded-md shadow-sm">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700">Cover Buku (Opsional)</label>
                        <input type="file" name="cover_image" class="w-full mt-1 text-sm text-gray-500">
                    </div>

                    <div class="flex justify-end gap-2 pt-4">
                        <a href="{{ route('books.index') }}" class="px-4 py-2 bg-gray-300 text-gray-700 font-semibold rounded-md hover:bg-gray-400">Batal</a>
                        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white font-semibold rounded-md hover:bg-indigo-700">Simpan Buku</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
