<x-guest-catalog-layout>
    <div x-data="{ openModal: false, selectedBookId: null, selectedBookTitle: '' }">

        <!-- Hero Banner Selaras Mode Gelap & Terang -->
        <div class="relative bg-gradient-to-br from-indigo-600 via-indigo-700 to-slate-900 dark:from-slate-900 dark:via-indigo-950 dark:to-slate-900 text-white py-16 px-4 sm:px-6 lg:px-8 text-center transition-colors duration-300">
            <div class="max-w-3xl mx-auto space-y-4 relative z-10">
                <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-white/10 dark:bg-slate-800/60 backdrop-blur-md rounded-full text-xs font-semibold tracking-wide text-indigo-100 dark:text-indigo-300 border border-white/10 dark:border-slate-700">
                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    Katalog Resmi Perpustakaan
                </span>
                <h2 class="text-3xl sm:text-4xl font-extrabold tracking-tight">Katalog Koleksi Buku Digital</h2>
                <p class="text-indigo-100/90 dark:text-slate-300 text-sm max-w-xl mx-auto">Cari buku favoritmu, cek ketersediaan stok, dan lakukan pengajuan peminjaman mandiri secara efisien.</p>

                <!-- Search Box -->
                <form action="{{ route('catalog.index') }}" method="GET" class="max-w-xl mx-auto flex gap-2 pt-3">
                    <div class="relative w-full">
                        <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                        </div>
                        <input type="text" name="search" value="{{ $search }}" placeholder="Ketik judul buku atau pengarang..." class="w-full text-slate-900 dark:text-white bg-white dark:bg-slate-800 rounded-xl border-none pl-10 pr-4 py-3 text-sm focus:ring-2 focus:ring-amber-400 shadow-lg placeholder-slate-400 transition-all">
                    </div>
                    <button type="submit" class="px-6 py-3 bg-amber-500 hover:bg-amber-400 text-slate-900 font-bold rounded-xl shadow-lg hover:shadow-amber-500/20 active:scale-95 transition-all text-sm shrink-0 flex items-center gap-1.5">
                        Cari
                    </button>
                </form>
            </div>
        </div>

        <!-- Grid Katalog Buku -->
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between mb-8 border-b border-slate-200/60 dark:border-slate-700/60 pb-4">
                <div>
                    <h3 class="text-xl font-bold text-slate-900 dark:text-white">Daftar Buku Terdaftar</h3>
                    <p class="text-xs text-slate-500 dark:text-slate-400">Pilih salah satu buku untuk mengajukan peminjaman.</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
                @forelse($books as $book)
                    <div class="group bg-white dark:bg-slate-800 rounded-2xl shadow-sm hover:shadow-xl border border-slate-200/60 dark:border-slate-700/60 transition-all duration-300 flex flex-col justify-between overflow-hidden hover:-translate-y-1">
                        <div>
                            <div class="relative overflow-hidden bg-slate-100 dark:bg-slate-900">
                                @if($book->cover_image)
                                    <img src="{{ asset('storage/' . $book->cover_image) }}" class="w-full h-52 object-cover group-hover:scale-105 transition-transform duration-500">
                                @else
                                    <div class="w-full h-52 flex items-center justify-center text-slate-400 dark:text-slate-600 font-medium text-xs">Tanpa Gambar</div>
                                @endif
                                <span class="absolute top-3 left-3 px-2.5 py-1 bg-white/90 dark:bg-slate-900/90 backdrop-blur-md text-[10px] font-bold text-indigo-600 dark:text-indigo-400 uppercase rounded-lg shadow-sm">
                                    {{ $book->category->name }}
                                </span>
                            </div>

                            <div class="p-5 space-y-2">
                                <h4 class="font-bold text-slate-900 dark:text-white text-base leading-snug line-clamp-1 group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                                    {{ $book->title }}
                                </h4>
                                <p class="text-xs text-slate-500 dark:text-slate-400">Penulis: <span class="text-slate-700 dark:text-slate-300 font-medium">{{ $book->author }}</span></p>

                                <div class="inline-flex items-center gap-1.5 text-[11px] text-slate-600 dark:text-slate-300 bg-slate-100 dark:bg-slate-700/50 px-2.5 py-1 rounded-lg">
                                    <svg class="w-3.5 h-3.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                                    <span>Rak: <strong>{{ $book->rack_location ?? 'Umum' }}</strong></span>
                                </div>
                            </div>
                        </div>

                        <div class="p-4 border-t border-slate-100 dark:border-slate-700/60 bg-slate-50/50 dark:bg-slate-800/50 flex items-center justify-between">
                            <div>
                                <span class="text-[10px] text-slate-400 uppercase font-bold block">Tersedia</span>
                                <span class="text-xs font-bold {{ $book->available_stock > 0 ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-500' }}">
                                    {{ $book->available_stock }} / {{ $book->total_stock }} Unit
                                </span>
                            </div>

                            @if($book->available_stock > 0)
                                <button @click="openModal = true; selectedBookId = {{ $book->id }}; selectedBookTitle = '{{ addslashes($book->title) }}'"
                                        class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/10 active:scale-95 transition-all flex items-center gap-1">
                                    <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    Pinjam
                                </button>
                            @else
                                <button disabled class="px-3 py-1.5 bg-slate-200 dark:bg-slate-700 text-slate-400 dark:text-slate-500 text-xs font-bold rounded-xl cursor-not-allowed">
                                    Habis
                                </button>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="col-span-full p-12 bg-white dark:bg-slate-800 rounded-2xl border border-slate-200/60 dark:border-slate-700/60 text-center text-slate-500 dark:text-slate-400">
                        Tidak ada koleksi buku yang sesuai dengan pencarian.
                    </div>
                @endforelse
            </div>

            <div class="mt-10">
                {{ $books->links() }}
            </div>
        </div>

        <!-- Pop-Up Modal -->
        <div x-show="openModal"
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             x-transition:leave="transition ease-in duration-200"
             x-transition:leave-start="opacity-100"
             x-transition:leave-end="opacity-0"
             class="fixed inset-0 bg-slate-900/60 backdrop-blur-sm flex items-center justify-center p-4 z-50" x-cloak>

            <div @click.away="openModal = false"
                 x-transition:enter="transition ease-out duration-300 transform"
                 x-transition:enter-start="opacity-0 scale-90 translate-y-4"
                 x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                 x-transition:leave="transition ease-in duration-200 transform"
                 x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                 x-transition:leave-end="opacity-0 scale-90 translate-y-4"
                 class="bg-white dark:bg-slate-800 rounded-2xl shadow-2xl max-w-md w-full p-6 space-y-5 border border-slate-200/60 dark:border-slate-700">

                <div class="flex justify-between items-center border-b border-slate-100 dark:border-slate-700/60 pb-3">
                    <h3 class="text-base font-bold text-slate-900 dark:text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Form Pengajuan Peminjaman
                    </h3>
                    <button @click="openModal = false" class="text-slate-400 hover:text-slate-600 dark:hover:text-slate-200 text-xl font-bold transition-colors">&times;</button>
                </div>

                <form action="{{ route('catalog.request') }}" method="POST" class="space-y-4">
                    @csrf
                    <input type="hidden" name="book_id" :value="selectedBookId">
                    <input type="hidden" name="borrow_date" value="{{ date('Y-m-d') }}">

                    <div>
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-wider mb-1">Buku yang Dipilih</label>
                        <div class="p-3 bg-indigo-50/70 dark:bg-indigo-950/40 border border-indigo-100 dark:border-indigo-900/50 rounded-xl text-sm font-bold text-indigo-700 dark:text-indigo-300" x-text="selectedBookTitle"></div>
                    </div>

                    <div>
                        <label class="block text-xs font-semibold text-slate-700 dark:text-slate-300 mb-1">Nomor Induk Siswa Nasional (NISN)</label>
                        <input type="text" name="nisn" placeholder="Masukkan NISN Siswa..." class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 transition-all" required>
                    </div>

                    <div class="flex justify-end gap-2 pt-2">
                        <button type="button" @click="openModal = false" class="px-4 py-2 bg-slate-100 dark:bg-slate-700 text-slate-600 dark:text-slate-300 text-xs font-semibold rounded-xl hover:bg-slate-200 dark:hover:bg-slate-600 active:scale-95 transition-all">Batal</button>
                        <button type="submit" class="px-5 py-2 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all">Kirim Pengajuan</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
</x-guest-catalog-layout>
