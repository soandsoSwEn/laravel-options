<?php

namespace Soandso\LaravelOptions;

use Illuminate\Support\ServiceProvider;

class OptionProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Option', OptionService::class);
    }
}