<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
{
    $setting = new Setting([
        'site_name' => 'Perpustakaan Digital',
        'fine_per_day' => 1000,
        'max_borrow_days' => 7,
    ]);

    try {
        if (Schema::hasTable('settings')) {
            $setting = Setting::firstOrCreate([], [
                'site_name' => 'Perpustakaan Digital',
                'fine_per_day' => 1000,
                'max_borrow_days' => 7,
            ]);
        }
    } catch (\Throwable $e) {
        // DB belum siap (misalnya saat composer install / package:discover) — abaikan, pakai default di atas
    }

    View::share('siteSetting', $setting);
}
}
