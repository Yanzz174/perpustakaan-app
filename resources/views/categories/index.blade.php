<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
                    {{ __('Kategori Buku') }}
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Kelola kelompok dan klasifikasi koleksi buku.</p>
            </div>
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

            <!-- Card Form Tambah Kategori -->
            <div class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 transition-colors">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-4">Tambah Kategori Baru</h3>
                <form action="{{ route('categories.store') }}" method="POST" class="flex flex-col sm:flex-row gap-3">
                    @csrf
                    <div class="relative w-full">
                        <input type="text" name="name" placeholder="Nama Kategori (contoh: Novel, Sains, Pemrograman)" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500 placeholder-slate-400" required>
                    </div>
                    <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all shrink-0">
                        Simpan Kategori
                    </button>
                </form>
            </div>

            <!-- Card Tabel Kategori -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 overflow-hidden transition-colors">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/40 border-b border-slate-100 dark:border-slate-700/60">
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">#</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Kategori</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Slug</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Buku</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            @forelse($categories as $index => $category)
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition">
                                    <td class="p-4 text-sm font-semibold text-slate-500 dark:text-slate-400">{{ $index + 1 }}</td>
                                    <td class="p-4 text-sm font-bold text-slate-900 dark:text-white">{{ $category->name }}</td>
                                    <td class="p-4 text-sm font-mono text-slate-500 dark:text-slate-400">{{ $category->slug }}</td>
                                    <td class="p-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $category->books_count ?? 0 }} Buku</td>
                                    <td class="p-4 text-sm text-right">
                                        <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada kategori terdaftar.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
