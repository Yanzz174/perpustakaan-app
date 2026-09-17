<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-slate-900 dark:text-white leading-tight">
            {{ __('Pengaturan Sistem Website') }}
        </h2>
        <p class="text-xs text-slate-500 dark:text-slate-400">Atur identitas perpustakaan, tarif denda, dan batas durasi peminjaman.</p>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-6">

            @if(session('success'))
                <div class="p-4 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl text-sm flex items-center gap-2 shadow-sm">
                    <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    <span>{{ session('success') }}</span>
                </div>
            @endif

            <div class="p-6 sm:p-8 bg-white dark:bg-slate-800 rounded-2xl shadow-sm border border-slate-100 dark:border-slate-700/60 transition-colors">
                <form action="{{ route('settings.update') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <!-- Nama Website -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Nama Website / Perpustakaan</label>
                        <input type="text" name="site_name" value="{{ old('site_name', $setting->site_name) }}" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" required>
                        @error('site_name') <span class="text-rose-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <!-- Logo Website -->
                    <div>
                        <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Logo Website</label>
                        @if($setting->site_logo)
                            <div class="mb-3">
                                <img src="{{ asset('storage/' . $setting->site_logo) }}" class="h-16 w-auto object-contain border border-slate-200 dark:border-slate-700 p-2 rounded-xl bg-slate-50 dark:bg-slate-900">
                            </div>
                        @endif
                        <input type="file" name="site_logo" class="text-xs text-slate-500 dark:text-slate-400 file:mr-4 file:py-2 file:px-4 file:rounded-xl file:border-0 file:text-xs file:font-bold file:bg-indigo-50 dark:file:bg-indigo-950/80 file:text-indigo-700 dark:file:text-indigo-300 hover:file:bg-indigo-100 dark:hover:file:bg-indigo-900 transition">
                        <span class="text-[11px] text-slate-400 block mt-1">Format: JPG, PNG, SVG (Maks. 2MB)</span>
                        @error('site_logo') <span class="text-rose-500 text-xs block mt-1">{{ $message }}</span> @enderror
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                        <!-- Nominal Denda Per Hari -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Tarif Denda Keterlambatan (Rp / Hari)</label>
                            <input type="number" name="fine_per_day" value="{{ old('fine_per_day', $setting->fine_per_day) }}" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" min="0" required>
                            @error('fine_per_day') <span class="text-rose-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>

                        <!-- Batas Maksimal Hari Pinjam -->
                        <div>
                            <label class="block text-xs font-bold text-slate-700 dark:text-slate-300 uppercase tracking-wider mb-2">Durasi Pinjam Standar (Hari)</label>
                            <input type="number" name="max_borrow_days" value="{{ old('max_borrow_days', $setting->max_borrow_days) }}" class="w-full text-sm border-slate-300 dark:border-slate-700 dark:bg-slate-900 text-slate-900 dark:text-white rounded-xl shadow-sm focus:ring-2 focus:ring-indigo-500" min="1" required>
                            @error('max_borrow_days') <span class="text-rose-500 text-xs block mt-1">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="flex justify-end pt-4 border-t border-slate-100 dark:border-slate-700/60">
                        <button type="submit" class="px-6 py-2.5 bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold rounded-xl shadow-md shadow-indigo-500/20 active:scale-95 transition-all">
                            Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
