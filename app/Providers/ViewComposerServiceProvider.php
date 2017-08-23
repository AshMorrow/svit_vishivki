<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composerNavigation();
        $this->composerRestoreSmallCart();
        $this->composerProductFilter();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    public function composerNavigation(){
        view()->composer('pages.include._mainNav','App\Http\Composer\NavigationComposer');
    }

    public function composerRestoreSmallCart(){
        view()->composer('pages.include._smallCart','App\Http\Composer\SmallCartComposer');
    }

    public function composerProductFilter(){
        view()->composer('pages.include._productFilter', 'App\Http\Composer\ProductFilterComposer');
    }
}
