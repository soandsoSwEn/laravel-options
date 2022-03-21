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
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_options_table.php.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_options_table.php'),
            ], 'migrations');
        }
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