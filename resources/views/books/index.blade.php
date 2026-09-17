<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
                    {{ __('Data Buku') }}
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Kelola katalog koleksi dan stok fisik buku.</p>
            </div>
            <a href="{{ route('books.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Buku Baru
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

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
    </div>
</x-app-layout>
