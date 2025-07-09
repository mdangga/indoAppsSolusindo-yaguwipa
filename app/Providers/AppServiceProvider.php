<?php

namespace App\Providers;

use App\Models\Menu;
use App\Models\Profiles;
use App\Models\SosialMedia;
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

        View::share('site', [
            'yayasanProfile' => $profile,
            'yayasanSosmed' => $sosialMedia,
        ]);

        View::composer('*', function ($view) {
            $menus = Menu::with(['children' => function ($q) {
                $q->orderBy('id_menus');
            }])
                ->whereNull('parent_menu')
                ->orderByRaw('id_menus')
                ->get();

            $view->with('menus', $menus);
        });
    }
}