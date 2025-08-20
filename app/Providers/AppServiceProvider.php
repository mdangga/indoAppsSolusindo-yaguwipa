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
        // Cache untuk data profile, sosial media, dan institusi
        $siteData = Cache::remember('yayasan_site_data', now()->addHours(2), function () {
            return [
                'yayasanProfile' => Profiles::first(),
                'yayasanSosmed' => SosialMedia::where('status', 'show')->get(),
                'lembaga' => Institusi::where('status', 'show')->get(),
            ];
        });

        View::share('site', $siteData);

        // Cache untuk menu
        View::composer('*', function ($view) {
            $menus = Cache::remember('yayasan_menus', now()->addHours(1), function () {
                return Menu::with(['children' => function ($query) {
                    $query->where('status', 'show')
                        ->orderBy('id_menus');
                }])
                    ->whereNull('parent_menu')
                    ->where('status', 'show')
                    ->orderBy('id_menus')
                    ->get();
            });

            $view->with('menus', $menus);
        });
    }
}
