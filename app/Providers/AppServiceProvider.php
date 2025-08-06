<?php

namespace App\Providers;

use App\Models\Institusi;
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
        $profile = Profiles::first();

        $sosialMedia = SosialMedia::where('status', 'show')->get();

        $lembaga = Institusi::where('status', 'show')->get();

        View::share('site', [
            'yayasanProfile' => $profile,
            'yayasanSosmed' => $sosialMedia,
            'lembaga' => $lembaga,
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
