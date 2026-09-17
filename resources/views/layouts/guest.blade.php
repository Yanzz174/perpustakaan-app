<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ $siteSetting->site_name ?? config('app.name', 'Laravel') }} - Login Petugas</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

        <!-- Script Anti-FOUC Mode Gelap -->
        <script>
            if (localStorage.getItem('theme') === 'dark' || (!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
                document.documentElement.classList.add('dark');
            } else {
                document.documentElement.classList.remove('dark');
            }
        </script>
    </head>
    <body class="font-sans antialiased bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col justify-center items-center py-12 px-4 sm:px-6 lg:px-8 transition-colors duration-300"
          x-data="{ isDark: localStorage.getItem('theme') === 'dark' }">

        <!-- Header Logo & Nama Web -->
        <div class="sm:mx-auto sm:w-full sm:max-w-md text-center mb-6">
            <a href="{{ route('catalog.index') }}" class="inline-flex items-center gap-3 group transition-transform active:scale-95">
                @if(isset($siteSetting) && $siteSetting->site_logo)
                    <img src="{{ asset('storage/' . $siteSetting->site_logo) }}" class="h-10 w-auto">
                @else
                    <div class="p-2.5 bg-indigo-600 text-white rounded-2xl shadow-lg shadow-indigo-500/20 group-hover:bg-indigo-500 transition-colors">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    </div>
                @endif
                <span class="font-bold text-xl text-slate-900 dark:text-white tracking-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                    {{ $siteSetting->site_name ?? 'Perpustakaan Digital' }}
                </span>
            </a>
        </div>

        <!-- Auth Card Container -->
        <div class="w-full sm:max-w-md bg-white dark:bg-slate-800 p-8 rounded-2xl shadow-xl border border-slate-100 dark:border-slate-700/60 transition-colors">
            {{ $slot }}
        </div>

        <!-- Footer Link & Beralih Tema -->
        <div class="mt-8 flex items-center justify-between gap-4 text-xs text-slate-500 dark:text-slate-400 max-w-md w-full px-2">
            <a href="{{ route('catalog.index') }}" class="flex items-center gap-1.5 hover:text-indigo-600 dark:hover:text-indigo-400 font-semibold transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Katalog
            </a>

            <button @click="isDark = !isDark; if(isDark){ document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); } else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); }"
                    type="button"
                    class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-200/60 dark:hover:bg-slate-800 rounded-xl transition-transform active:scale-90 flex items-center gap-1.5 font-medium"
                    title="Beralih Tema">
                <svg x-show="!isDark" class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                <svg x-show="isDark" class="w-4 h-4 text-amber-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                <span x-show="!isDark">Mode Gelap</span>
                <span x-show="isDark" x-cloak>Mode Terang</span>
            </button>
        </div>
    </body>
</html>
