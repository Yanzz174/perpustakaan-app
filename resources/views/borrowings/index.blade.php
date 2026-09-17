<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
                    {{ __('Transaksi Peminjaman') }}
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Persetujuan pengajuan mandiri dan peminjaman manual.</p>
            </div>
            <a href="{{ route('borrowings.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Peminjaman
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
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kode Transaksi</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Peminjam</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Buku</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Tgl Pinjam / Batas</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Status</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Denda</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            @forelse($borrowings as $borrowing)
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition">
                                    <td class="p-4 text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">{{ $borrowing->borrow_code }}</td>
                                    <td class="p-4 text-sm">
                                        <div class="font-bold text-slate-900 dark:text-white">{{ $borrowing->member->name }}</div>
                                        <div class="text-xs text-slate-400">{{ $borrowing->member->class }}</div>
                                    </td>
                                    <td class="p-4 text-sm text-slate-600 dark:text-slate-300">
                                        @foreach($borrowing->details as $detail)
                                            <div>• {{ $detail->book->title }}</div>
                                        @endforeach
                                    </td>
                                    <td class="p-4 text-xs text-slate-500 dark:text-slate-400">
                                        <div>Pinjam: <span class="font-semibold text-slate-700 dark:text-slate-300">{{ $borrowing->borrow_date }}</span></div>
                                        <div>Batas: <span class="font-semibold text-rose-600 dark:text-rose-400">{{ $borrowing->return_date }}</span></div>
                                    </td>
                                    <td class="p-4 text-sm">
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
                                    </td>
                                    <td class="p-4 text-sm font-bold text-slate-900 dark:text-white">
                                        Rp {{ number_format($borrowing->total_fine, 0, ',', '.') }}
                                    </td>
                                    <td class="p-4 text-sm text-right space-x-1">
                                        @if($borrowing->status === 'pending')
                                            <form action="{{ route('borrowings.approve', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-lg shadow-sm transition">Setujui</button>
                                            </form>
                                            <form action="{{ route('borrowings.reject', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-slate-200 dark:bg-slate-700 hover:bg-slate-300 dark:hover:bg-slate-600 text-slate-700 dark:text-slate-200 text-xs font-bold rounded-lg transition">Tolak</button>
                                            </form>
                                        @elseif($borrowing->status === 'dipinjam')
                                            <form action="{{ route('borrowings.return', $borrowing->id) }}" method="POST" class="inline">
                                                @csrf
                                                @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-lg shadow-sm transition">Kembalikan</button>
                                            </form>
                                        @else
                                            <span class="text-xs text-slate-400">-</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="7" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada transaksi peminjaman.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
