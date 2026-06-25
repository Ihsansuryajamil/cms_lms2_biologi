<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use App\Models\WebsiteSetting;

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
        if (Schema::hasTable('website_settings')) {
            // Mengambil baris pertama data setting (ID 1)
            $webSettings = WebsiteSetting::firstOrCreate(['id' => 1]);
            
            // Membagikan variabel $webSettings ke seluruh view blade di aplikasi
            View::share('webSettings', $webSettings);
        }
    }
}
