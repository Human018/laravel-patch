<?php

namespace Human018\LaravelPatch\Providers;

use Human018\LaravelPatch\Commands\PatchMigration;
use Illuminate\Support\ServiceProvider;

class LaravelPatchServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                PatchMigration::class,
            ]);
        }
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(EventServiceProvider::class);
    }

}