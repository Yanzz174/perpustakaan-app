<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $siteSetting->site_name ?? 'Perpustakaan Digital' }}</title>
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
<body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 min-h-screen flex flex-col justify-between font-sans antialiased transition-colors duration-300"
      x-data="{
          isDark: localStorage.getItem('theme') === 'dark',
          logoClicks: 0
      }"
      @keydown.window.ctrl.shift.a.prevent="window.location.href = '{{ route('login') }}'">

    <div>
        <!-- Navbar Minimalis -->
        <nav class="bg-white/80 dark:bg-slate-800/80 backdrop-blur-md sticky top-0 z-40 border-b border-slate-200/60 dark:border-slate-700/60 transition-colors duration-300">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-3.5 flex justify-between items-center">

                <!-- Logo Web + Trigger Rahasia 5x Klik -->
                <a href="{{ route('catalog.index') }}"
                   @click="logoClicks++; if(logoClicks >= 5) { $event.preventDefault(); window.location.href = '{{ route('login') }}'; } setTimeout(() => logoClicks = 0, 2000);"
                   class="flex items-center gap-2.5 group transition-transform active:scale-95"
                   title="{{ $siteSetting->site_name ?? 'Perpustakaan Digital' }}">
                    @if(isset($siteSetting) && $siteSetting->site_logo)
                        <img src="{{ asset('storage/' . $siteSetting->site_logo) }}" class="h-8 w-auto">
                    @else
                        <div class="p-2 bg-indigo-600 text-white rounded-xl shadow-md group-hover:bg-indigo-500 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                        </div>
                    @endif
                    <h1 class="font-bold text-lg text-slate-900 dark:text-white tracking-tight group-hover:text-indigo-600 dark:group-hover:text-indigo-400 transition-colors">
                        {{ $siteSetting->site_name ?? 'Perpustakaan Digital' }}
                    </h1>
                </a>

                <div class="flex items-center space-x-2 sm:space-x-4">
                    <a href="{{ route('catalog.index') }}" class="px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('catalog.index') ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60' : 'text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                        Katalog Buku
                    </a>

                    <a href="{{ route('catalog.check') }}" class="px-3 py-2 rounded-lg text-xs sm:text-sm font-semibold transition-all duration-200 flex items-center gap-1.5 {{ request()->routeIs('catalog.check') ? 'text-indigo-600 dark:text-indigo-400 bg-indigo-50 dark:bg-indigo-950/60' : 'text-slate-600 dark:text-slate-300 hover:text-indigo-600 dark:hover:text-indigo-400 hover:bg-slate-100 dark:hover:bg-slate-800' }}">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-6 9l2 2 4-4"></path></svg>
                        Cek NISN
                    </a>

                    <!-- Switcher Mode Gelap/Terang -->
                    <button @click="isDark = !isDark; if(isDark){ document.documentElement.classList.add('dark'); localStorage.setItem('theme', 'dark'); } else { document.documentElement.classList.remove('dark'); localStorage.setItem('theme', 'light'); }"
                            type="button"
                            class="p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-xl transition-transform active:scale-90"
                            title="Beralih Tema">
                        <svg x-show="!isDark" class="w-5 h-5 transition-transform duration-300 rotate-0 hover:rotate-45" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.354 15.354A9 9 0 018.646 3.646 9.003 9.003 0 0012 21a9.003 9.003 0 008.354-5.646z"></path></svg>
                        <svg x-show="isDark" class="w-5 h-5 text-amber-400 transition-transform duration-300 rotate-0 hover:rotate-90" fill="none" stroke="currentColor" viewBox="0 0 24 24" x-cloak><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 3v1m0 16v1m9-9h-1M4 12H3m15.364 6.364l-.707-.707M6.343 6.343l-.707-.707m12.728 0l-.707.707M6.343 17.657l-.707.707M16 12a4 4 0 11-8 0 4 4 0 018 0z"></path></svg>
                    </button>

                    <!-- Hanya tampilkan tombol Dashboard jika admin sudah login -->
                    @auth
                        <a href="{{ route('dashboard') }}" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-500 text-white rounded-xl text-xs sm:text-sm font-semibold shadow-md shadow-indigo-500/20 active:scale-95 transition-all">Dashboard Admin</a>
                    @endauth
                </div>
            </div>
        </nav>

        <!-- Main Content -->
        <main>
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 pt-4">
                @if(session('success'))
                    <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300 transform opacity-0 scale-95" class="p-4 mb-4 bg-emerald-50 dark:bg-emerald-950/60 border border-emerald-200 dark:border-emerald-800 text-emerald-800 dark:text-emerald-200 rounded-2xl text-sm flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-emerald-600 dark:text-emerald-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('success') }}</span>
                        </div>
                        <button @click="show = false" class="text-emerald-500 hover:text-emerald-700 font-bold">&times;</button>
                    </div>
                @endif
                @if(session('error'))
                    <div x-data="{ show: true }" x-show="show" x-transition:leave="transition ease-in duration-300 transform opacity-0 scale-95" class="p-4 mb-4 bg-rose-50 dark:bg-rose-950/60 border border-rose-200 dark:border-rose-800 text-rose-800 dark:text-rose-200 rounded-2xl text-sm flex items-center justify-between shadow-sm">
                        <div class="flex items-center gap-2">
                            <svg class="w-5 h-5 text-rose-600 dark:text-rose-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            <span>{{ session('error') }}</span>
                        </div>
                        <button @click="show = false" class="text-rose-500 hover:text-rose-700 font-bold">&times;</button>
                    </div>
                @endif
            </div>

            {{ $slot }}
        </main>
    </div>

    <!-- Footer -->
    <footer class="bg-white dark:bg-slate-800 border-t border-slate-200/60 dark:border-slate-700/60 py-6 text-center text-xs text-slate-500 dark:text-slate-400 mt-16 transition-colors duration-300">
        <p>&copy; {{ date('Y') }} {{ $siteSetting->site_name ?? 'Perpustakaan Digital' }}. All rights reserved.</p>
    </footer>
</body>
</html>
