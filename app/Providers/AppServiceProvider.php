<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Profiles;
use App\Models\SosialMedia;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
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
        $profile = Cache::remember('yayasan_profile', now()->addHours(1), function () {
            // Log::info('profile dari DB');
            return Profiles::first();
        });

        $sosialMedia = Cache::remember('yayasan_sosmed', now()->addHours(1), function () {
            return SosialMedia::where('status', 'show')->get();
        });

        View::share('site', [
            'yayasanProfile' => $profile,
            'yayasanSosmed' => $sosialMedia,
        ]);

        View::composer('*', function ($view) {
            $menus = Cache::remember('yayasan_menus', now()->addHours(1), function () {
                return Menu::with(['children' => function ($q) {
                    $q->where('status', 'show')->orderBy('id_menus');
                }])
                    ->whereNull('parent_menu')
                    ->orderByRaw('id_menus')
                    ->where('status', 'show')
                    ->get();
            });

            $view->with('menus', $menus);
        });
    }
}
