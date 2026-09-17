<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
            <div>
                <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-100 leading-tight">
                    {{ __('Dashboard Ringkasan') }}
                </h2>
                <p class="text-xs text-gray-500 dark:text-gray-400">Pantau aktivitas inventaris dan peminjaman buku harian.</p>
            </div>
            <span class="text-xs font-semibold px-3 py-1.5 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 rounded-full border border-indigo-200 dark:border-indigo-800/50 w-fit">
                Status Sistem: Online
            </span>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">

            <!-- Grid Card Ringkasan Statistik -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                <!-- Card 1: Total Stok Buku -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Buku</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalBooks) }}</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Eksemplar terdaftar</p>
                        </div>
                        <div class="p-3 bg-indigo-50 dark:bg-indigo-900/40 text-indigo-600 dark:text-indigo-400 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Total Anggota -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Siswa Terdaftar</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-gray-900 dark:text-white">{{ number_format($totalMembers) }}</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Anggota aktif</p>
                        </div>
                        <div class="p-3 bg-blue-50 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Sedang Dipinjam -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Buku Dipinjam</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-amber-600 dark:text-amber-400">{{ number_format($activeBorrowings) }}</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Transaksi berjalan</p>
                        </div>
                        <div class="p-3 bg-amber-50 dark:bg-amber-900/40 text-amber-600 dark:text-amber-400 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </div>
                    </div>
                </div>

                <!-- Card 4: Kas Denda -->
                <div class="p-6 bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 hover:shadow-md transition-all duration-200">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Total Kas Denda</p>
                            <h3 class="mt-2 text-3xl font-extrabold text-emerald-600 dark:text-emerald-400">Rp {{ number_format($totalFines, 0, ',', '.') }}</h3>
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-1">Terkumpul</p>
                        </div>
                        <div class="p-3 bg-emerald-50 dark:bg-emerald-900/40 text-emerald-600 dark:text-emerald-400 rounded-xl">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabel Transaksi Terbaru -->
            <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-sm border border-gray-100 dark:border-gray-700/60 overflow-hidden">
                <div class="p-6 flex justify-between items-center border-b border-gray-100 dark:border-gray-700/60">
                    <div>
                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">Transaksi Peminjaman Terbaru</h3>
                        <p class="text-xs text-gray-500 dark:text-gray-400">5 riwayat transaksi terakhir di perpustakaan.</p>
                    </div>
                    <a href="{{ route('borrowings.index') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400 hover:text-indigo-800 transition">
                        Lihat Semua Transaksi &rarr;
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50/50 dark:bg-gray-900/40 border-b border-gray-100 dark:border-gray-700/60">
                                <th class="p-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Kode</th>
                                <th class="p-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Peminjam</th>
                                <th class="p-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Buku</th>
                                <th class="p-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Batas Kembali</th>
                                <th class="p-4 text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700/60">
                            @forelse($recentBorrowings as $borrowing)
                                <tr class="hover:bg-gray-50/60 dark:hover:bg-gray-700/30 transition">
                                    <td class="p-4 text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">{{ $borrowing->borrow_code }}</td>
                                    <td class="p-4 text-sm font-semibold text-gray-900 dark:text-gray-100">{{ $borrowing->member->name }}</td>
                                    <td class="p-4 text-sm text-gray-600 dark:text-gray-300">
                                        @foreach($borrowing->details as $detail)
                                            <span>{{ $detail->book->title }}</span>
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-sm text-gray-500 dark:text-gray-400">{{ $borrowing->return_date }}</td>
                                    <td class="p-4 text-sm">
                                        @if($borrowing->status === 'pending')
                                            <span class="px-3 py-1 text-xs font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/80 border border-blue-200 dark:border-blue-800/60 rounded-full">Menunggu</span>
                                        @elseif($borrowing->status === 'dipinjam')
                                            <span class="px-3 py-1 text-xs font-semibold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/80 border border-amber-200 dark:border-amber-800/60 rounded-full">Dipinjam</span>
                                        @elseif($borrowing->status === 'dikembalikan')
                                            <span class="px-3 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-200 dark:border-emerald-800/60 rounded-full">Dikembalikan</span>
                                        @elseif($borrowing->status === 'ditolak')
                                            <span class="px-3 py-1 text-xs font-semibold text-gray-600 dark:text-gray-400 bg-gray-100 dark:bg-gray-700 rounded-full">Ditolak</span>
                                        @else
                                            <span class="px-3 py-1 text-xs font-semibold text-red-700 dark:text-red-300 bg-red-50 dark:bg-red-950/80 border border-red-200 dark:border-red-800/60 rounded-full">Terlambat</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="p-6 text-center text-sm text-gray-500 dark:text-gray-400">Belum ada aktivitas transaksi.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
