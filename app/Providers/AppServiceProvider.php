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
        $sosialMedia = SosialMedia::where('id_profil_yayasan', $profile->id)->where('status', 'show')->get();

        View::share('site', [
            'yayasanProfile' => $profile,
            'yayasanSosmed' => $sosialMedia,
        ]);

        View::composer('*', function ($view) {
            $view->with('menus', Menu::with('MenuToSubMenu')->get());
        });
    }
}