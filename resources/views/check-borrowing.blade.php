<x-guest-catalog-layout>
    <div class="max-w-4xl mx-auto py-10 px-4 sm:px-6 lg:px-8">
        @if($nisn)
            @if($member)
                <div class="bg-white dark:bg-slate-800 p-6 sm:p-8 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 space-y-6 transition-colors">
                    <div class="border-b border-slate-100 dark:border-slate-700/60 pb-5 flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3">
                        <div>
                            <span class="text-[10px] font-bold uppercase tracking-wider text-indigo-600 dark:text-indigo-400">Hasil Pencarian Siswa</span>
                            <h3 class="text-xl font-bold text-slate-900 dark:text-white mt-0.5">{{ $member->name }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400 mt-0.5">NISN: <span class="font-mono font-semibold text-slate-700 dark:text-slate-300">{{ $member->nisn }}</span> | Kelas: {{ $member->class }}</p>
                        </div>

                        <div class="flex items-center gap-2">
                            <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-xs font-bold rounded-lg border border-indigo-200 dark:border-indigo-800/60">
                                Anggota Aktif
                            </span>
                            <button @click="openCheckModal = true" class="px-3 py-1 bg-slate-100 dark:bg-slate-700 hover:bg-slate-200 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-semibold rounded-lg transition-colors flex items-center gap-1">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                                Cari NISN Lain
                            </button>
                        </div>
                    </div>

                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200 flex items-center gap-2">
                        <svg class="w-4 h-4 text-indigo-600 dark:text-indigo-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Riwayat & Status Transaksi Peminjaman:
                    </h4>

                    <div class="space-y-3">
                        @forelse($member->borrowings as $borrowing)
                            <div class="p-4 border border-slate-100 dark:border-slate-700/60 rounded-xl flex flex-col sm:flex-row sm:justify-between sm:items-center gap-3 bg-slate-50/50 dark:bg-slate-900/40 hover:border-slate-300 dark:hover:border-slate-600 transition-colors">
                                <div>
                                    <span class="text-[10px] font-mono font-bold text-indigo-600 dark:text-indigo-400 block mb-0.5">{{ $borrowing->borrow_code }}</span>
                                    @foreach($borrowing->details as $detail)
                                        <div class="font-bold text-slate-900 dark:text-white text-sm">{{ $detail->book->title }}</div>
                                    @endforeach
                                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pinjam: {{ $borrowing->borrow_date }} | Batas Kembali: <span class="text-rose-600 dark:text-rose-400 font-medium">{{ $borrowing->return_date }}</span></div>
                                </div>

                                <div class="sm:text-right shrink-0">
                                    @if($borrowing->status === 'pending')
                                        <span class="px-3 py-1 text-xs font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/80 border border-blue-200 dark:border-blue-800/60 rounded-full">Menunggu Approval</span>
                                    @elseif($borrowing->status === 'dipinjam')
                                        <span class="px-3 py-1 text-xs font-semibold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/80 border border-amber-200 dark:border-amber-800/60 rounded-full">Sedang Dipinjam</span>
                                    @elseif($borrowing->status === 'dikembalikan')
                                        <span class="px-3 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-200 dark:border-emerald-800/60 rounded-full">Sudah Dikembalikan</span>
                                    @elseif($borrowing->status === 'ditolak')
                                        <span class="px-3 py-1 text-xs font-semibold text-slate-600 dark:text-slate-400 bg-slate-100 dark:bg-slate-700 rounded-full">Ditolak</span>
                                    @else
                                        <span class="px-3 py-1 text-xs font-semibold text-rose-700 dark:text-rose-300 bg-rose-50 dark:bg-rose-950/80 border border-rose-200 dark:border-rose-800/60 rounded-full">Terlambat</span>
                                    @endif

                                    @if($borrowing->total_fine > 0)
                                        <div class="text-xs text-rose-600 dark:text-rose-400 font-bold mt-1.5">Denda: Rp {{ number_format($borrowing->total_fine, 0, ',', '.') }}</div>
                                    @endif
                                </div>
                            </div>
                        @empty
                            <p class="text-slate-500 dark:text-slate-400 text-xs text-center py-6 border border-dashed border-slate-200 dark:border-slate-700 rounded-xl">Belum ada riwayat peminjaman untuk siswa ini.</p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 text-center space-y-4">
                    <div class="inline-flex p-3 bg-rose-50 dark:bg-rose-950/60 text-rose-600 dark:text-rose-400 rounded-2xl">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <div>
                        <h3 class="text-lg font-bold text-slate-900 dark:text-white">Siswa Tidak Ditemukan</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400 mt-1">Data siswa dengan NISN <strong class="text-slate-800 dark:text-slate-200">{{ $nisn }}</strong> belum terdaftar di sistem perpustakaan.</p>
                    </div>
                    <button @click="openCheckModal = true" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all">
                        Coba Masukkan NISN Lain
                    </button>
                </div>
            @endif
        @else
            <!-- Tampilan Kosong jika Akses Langsung Halaman -->
            <div class="bg-white dark:bg-slate-800 p-10 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 text-center space-y-4">
                <div class="inline-flex p-3 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 rounded-2xl">
                    <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
                </div>
                <div>
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Pencarian Status Pinjaman</h2>
                    <p class="text-xs text-slate-500 dark:text-slate-400 mt-1 max-w-sm mx-auto">Klik tombol di bawah ini atau tombol di navbar atas untuk memasukkan NISN Anda.</p>
                </div>
                <button @click="openCheckModal = true" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-bold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all">
                    Buka Form Cek NISN
                </button>
            </div>
        @endif
    </div>
</x-guest-catalog-layout>
