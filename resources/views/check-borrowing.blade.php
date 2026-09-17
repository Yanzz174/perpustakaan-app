<x-guest-catalog-layout>
    <div class="max-w-4xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
        <div class="bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 mb-8 text-center space-y-4">
            <div class="inline-flex p-3 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 rounded-2xl">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            </div>
            <div>
                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">Cek Status Pinjaman & Denda</h2>
                <p class="text-slate-500 dark:text-slate-400 text-xs mt-1">Masukkan NISN Anda untuk memantau status persetujuan dan riwayat pengajuan.</p>
            </div>

            <form action="{{ route('catalog.check') }}" method="GET" class="flex gap-2 justify-center max-w-md mx-auto pt-2">
                <input type="text" name="nisn" value="{{ $nisn }}" placeholder="Masukkan NISN Siswa..." class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                <button type="submit" class="px-5 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all shrink-0">Cek Data</button>
            </form>
        </div>

        @if($nisn)
            @if($member)
                <div class="bg-white dark:bg-slate-800 p-6 rounded-2xl shadow-sm border border-slate-200/60 dark:border-slate-700/60 space-y-6">
                    <div class="border-b border-slate-100 dark:border-slate-700/60 pb-4 flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white">{{ $member->name }}</h3>
                            <p class="text-xs text-slate-500 dark:text-slate-400">NISN: {{ $member->nisn }} | Kelas: {{ $member->class }}</p>
                        </div>
                        <span class="px-3 py-1 bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 text-xs font-bold rounded-lg border border-indigo-200 dark:border-indigo-800">Siswa Terdaftar</span>
                    </div>

                    <h4 class="font-bold text-sm text-slate-800 dark:text-slate-200">Riwayat Transaksi:</h4>
                    <div class="space-y-3">
                        @forelse($member->borrowings as $borrowing)
                            <div class="p-4 border border-slate-100 dark:border-slate-700/60 rounded-xl flex justify-between items-center bg-slate-50/50 dark:bg-slate-900/40 hover:border-slate-300 dark:hover:border-slate-600 transition-colors">
                                <div>
                                    @foreach($borrowing->details as $detail)
                                        <div class="font-bold text-slate-900 dark:text-white text-sm">{{ $detail->book->title }}</div>
                                    @endforeach
                                    <div class="text-xs text-slate-500 dark:text-slate-400 mt-1">Pinjam: {{ $borrowing->borrow_date }} | Batas: {{ $borrowing->return_date }}</div>
                                </div>
                                <div class="text-right">
                                    @if($borrowing->status === 'pending')
                                        <span class="px-3 py-1 text-xs font-semibold text-blue-700 dark:text-blue-300 bg-blue-50 dark:bg-blue-950/80 border border-blue-200 dark:border-blue-800/60 rounded-full">Menunggu</span>
                                    @elseif($borrowing->status === 'dipinjam')
                                        <span class="px-3 py-1 text-xs font-semibold text-amber-700 dark:text-amber-300 bg-amber-50 dark:bg-amber-950/80 border border-amber-200 dark:border-amber-800/60 rounded-full">Dipinjam</span>
                                    @elseif($borrowing->status === 'dikembalikan')
                                        <span class="px-3 py-1 text-xs font-semibold text-emerald-700 dark:text-emerald-300 bg-emerald-50 dark:bg-emerald-950/80 border border-emerald-200 dark:border-emerald-800/60 rounded-full">Dikembalikan</span>
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
                            <p class="text-slate-500 dark:text-slate-400 text-xs text-center py-4">Belum ada riwayat transaksi peminjaman.</p>
                        @endforelse
                    </div>
                </div>
            @else
                <div class="p-4 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-700 dark:text-rose-300 rounded-2xl text-center text-xs">
                    Data siswa dengan NISN <strong>{{ $nisn }}</strong> tidak ditemukan.
                </div>
            @endif
        @endif
    </div>
</x-guest-catalog-layout>
