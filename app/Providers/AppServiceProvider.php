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
        if (Schema::hasTable('settings')) {
            $setting = Setting::firstOrCreate([], [
                'site_name' => 'Perpustakaan Digital',
                'fine_per_day' => 1000,
                'max_borrow_days' => 7,
            ]);
            View::share('siteSetting', $setting);
        }
    }
}
