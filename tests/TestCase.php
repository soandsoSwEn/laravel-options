<?php

namespace Soandso\LaravelOptions\Tests;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Soandso\LaravelOptions\Option;
use Soandso\LaravelOptions\OptionProvider;
use Soandso\LaravelOptions\OptionService;

class TestCase extends \Orchestra\Testbench\TestCase
{
    use RefreshDatabase;

    protected $optionService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__ . '/database/migrations');

        $this->optionService = new OptionService();
    }

    protected function tearDown(): void
    {
        parent::tearDown();

        unset($this->optionService);
    }

    /**
     * Get package providers.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getPackageProviders($app): array
    {
        return [
            OptionProvider::class
        ];
    }

    /**
     * Override application aliases.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return string[]
     */
    protected function getApplicationAliases($app)
    {
        return [
            'Option' => Option::class,
        ];
    }

    /**
     * Define environment setup.
     *
     * @param \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver' => 'sqlite',
            'database' => ':memory:',
        ]);
    }

    protected function defineDatabaseMigrations()
    {
        $this->artisan('migrate', ['--database' => 'testbench'])->run();

        $this->beforeApplicationDestroyed(function () {
            $this->artisan('migrate:rollback', ['--database' => 'testbench'])->run();
        });
    }
}