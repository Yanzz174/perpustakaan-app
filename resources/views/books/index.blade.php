<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
                    {{ __('Data Buku') }}
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Kelola katalog koleksi dan stok fisik buku.</p>
            </div>

            <!-- Tombol Mengirim Event Global ke Modal Pop-Up -->
            <button @click="$dispatch('open-create-book-modal')"
                    type="button"
                    class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all flex items-center gap-1.5 cursor-pointer">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Buku Baru
            </button>
        </div>
    </x-slot>

    <!-- Content Utama + Event Listener Alpine.js -->
    <div class="py-8"
         x-data="{ openCreateModal: false }"
         @open-create-book-modal.window="openCreateModal = true">

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            @if($errors->any())
                <div class="p-4 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 rounded-2xl text-sm space-y-1 shadow-sm">
                    <div class="font-bold flex items-center gap-2">
                        <svg class="w-5 h-5 text-rose-600 dark:text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        <span>Gagal menambahkan buku. Harap periksa inputan Anda:</span>
                    </div>
                    <ul class="list-disc list-inside text-xs pl-7 space-y-0.5">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <!-- Tabel Data Buku -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 overflow-hidden transition-colors">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/40 border-b border-slate-100 dark:border-slate-700/60">
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Cover</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Judul & ISBN</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kategori</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Pengarang/Penerbit</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Stok (Tersedia)</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Rak</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            @forelse($books as $book)
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition">
                                    <td class="p-4">
                                        @if($book->cover_image)
                                            <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-10 h-14 object-cover rounded-lg border border-slate-200 dark:border-slate-700">
                                        @else
                                            <div class="w-10 h-14 bg-slate-100 dark:bg-slate-900 rounded-lg flex items-center justify-center text-[10px] text-slate-400 text-center font-medium">No Image</div>
                                        @endif
                                    </td>
                                    <td class="p-4">
                                        <div class="font-bold text-slate-900 dark:text-white text-sm">{{ $book->title }}</div>
                                        <div class="text-xs font-mono text-slate-400 mt-0.5">ISBN: {{ $book->isbn ?? '-' }} ({{ $book->publication_year }})</div>
                                    </td>
                                    <td class="p-4">
                                        <span class="px-2.5 py-1 text-xs font-bold text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60 rounded-lg border border-indigo-100 dark:border-indigo-900/50">
                                            {{ $book->category->name }}
                                        </span>
                                    </td>
                                    <td class="p-4 text-sm text-slate-600 dark:text-slate-300">
                                        <div>{{ $book->author }}</div>
                                        <div class="text-xs text-slate-400">{{ $book->publisher }}</div>
                                    </td>
                                    <td class="p-4 text-sm font-bold">
                                        <span class="{{ $book->available_stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-500' }}">
                                            {{ $book->available_stock }}
                                        </span>
                                        <span class="text-slate-400 font-normal"> / {{ $book->total_stock }}</span>
                                    </td>
                                    <td class="p-4 text-sm font-medium text-slate-700 dark:text-slate-300">
                                        {{ $book->rack_location ?? 'Umum' }}
                                    </td>
                                    <td class="p-4 text-sm text-right">
                                        <form action="{{ route('books.destroy', $book->id) }}" method="POST" onsubmit="return confirm('Hapus buku ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada data buku terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>

        <!-- Pop-Up Modal Tambah Buku Baru -->
        <div x-show="openCreateModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50 overflow-y-auto" x-cloak>

            <div @click.away="openCreateModal = false"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                 class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-2xl w-full p-6 space-y-5 border border-slate-200/60 dark:border-slate-700 my-8">

                <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <div class="p-2 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 rounded-xl">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                        Tambah Koleksi Buku Baru
                    </h3>
                    <button @click="openCreateModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl font-bold transition-colors">&times;</button>
                </div>

                <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data" class="space-y-4">
                    @csrf

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Kategori Buku</label>
                            <select name="category_id" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Kode ISBN</label>
                            <input type="text" name="isbn" value="{{ old('isbn') }}" placeholder="978-xxx-xxx" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Judul Buku</label>
                        <input type="text" name="title" value="{{ old('title') }}" placeholder="Masukkan Judul Lengkap Buku..." class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Pengarang</label>
                            <input type="text" name="author" value="{{ old('author') }}" placeholder="Nama Pengarang" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Penerbit</label>
                            <input type="text" name="publisher" value="{{ old('publisher') }}" placeholder="Nama Penerbit" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Tahun Terbit</label>
                            <input type="number" name="publication_year" value="{{ old('publication_year', date('Y')) }}" placeholder="2024" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Jumlah Stok</label>
                            <input type="number" name="total_stock" value="{{ old('total_stock', 1) }}" min="1" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Lokasi Rak</label>
                            <input type="text" name="rack_location" value="{{ old('rack_location') }}" placeholder="Contoh: Rak A-01" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-1">Cover Buku (Opsional)</label>
                        <input type="file" name="cover_image" accept="image/*" class="w-full text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-950/80 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900 transition">
                        <span class="text-[11px] text-slate-400 block mt-1">Format: JPG, JPEG, PNG (Maksimal 2MB)</span>
                    </div>

                    <div class="flex justify-end gap-2 pt-3 border-t border-slate-100 dark:border-slate-700/60">
                        <button type="button" @click="openCreateModal = false" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-semibold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 active:scale-95 transition-all">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                            Simpan Buku
                        </button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-app-layout>
