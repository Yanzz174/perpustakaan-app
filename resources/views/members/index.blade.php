<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <div>
                <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
                    {{ __('Data Anggota Siswa') }}
                </h2>
                <p class="text-xs text-slate-500 dark:text-slate-400">Manajemen akun dan impor massal data siswa.</p>
            </div>
            <a href="{{ route('members.create') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white font-semibold text-xs rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all flex items-center gap-1.5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                + Tambah Anggota Manual
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

            @if(session('error'))
                <div class="p-4 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 rounded-2xl text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-rose-600 dark:text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('error') }}</span>
                </div>
            @endif

            <!-- Box Import Data Massal -->
            <div class="p-6 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 transition-colors">
                <h3 class="text-base font-bold text-slate-900 dark:text-white mb-1">Import Data Siswa Massal (.XLS / .CSV)</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 mb-4">
                    Gunakan file Excel untuk menambahkan banyak data siswa sekaligus.
                    <a href="{{ route('members.template') }}" class="text-indigo-600 dark:text-indigo-400 font-bold hover:underline inline-flex items-center gap-1">
                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                        Unduh Template Excel Rapi (.xls)
                    </a>
                </p>

                <form action="{{ route('members.import') }}" method="POST" enctype="multipart/form-data" class="flex flex-col sm:flex-row items-stretch sm:items-center gap-3">
                    @csrf
                    <input type="file" name="file" accept=".xls,.xlsx,.csv" class="text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-950/80 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900 transition" required>
                    <button type="submit" class="px-5 py-2.5 bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold rounded-xl shadow-md shadow-emerald-500/20 active:scale-95 transition-all">
                        Upload & Import Data
                    </button>
                </form>
            </div>

            <!-- Tabel Data Anggota -->
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 overflow-hidden transition-colors">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-slate-50/50 dark:bg-slate-900/40 border-b border-slate-100 dark:border-slate-700/60">
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">NISN</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Nama Lengkap</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Kelas</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">No. HP</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider">Total Pinjam</th>
                                <th class="p-4 text-xs font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">Aksi</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100 dark:divide-slate-700/60">
                            @forelse($members as $member)
                                <tr class="hover:bg-slate-50/60 dark:hover:bg-slate-700/30 transition">
                                    <td class="p-4 text-sm font-mono font-bold text-indigo-600 dark:text-indigo-400">{{ $member->nisn }}</td>
                                    <td class="p-4 text-sm font-bold text-slate-900 dark:text-white">{{ $member->name }}</td>
                                    <td class="p-4 text-sm text-slate-600 dark:text-slate-300">{{ $member->class }}</td>
                                    <td class="p-4 text-sm text-slate-500 dark:text-slate-400">{{ $member->phone ?? '-' }}</td>
                                    <td class="p-4 text-sm font-semibold text-indigo-600 dark:text-indigo-400">{{ $member->borrowings_count }} Kali</td>
                                    <td class="p-4 text-sm text-right">
                                        <form action="{{ route('members.destroy', $member->id) }}" method="POST" onsubmit="return confirm('Hapus anggota ini?');" class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs font-semibold text-rose-600 dark:text-rose-400 hover:underline">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="p-6 text-center text-sm text-slate-500 dark:text-slate-400">Belum ada data anggota.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
