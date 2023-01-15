<?php

namespace Tripteki\SettingProfile\Providers;

use Tripteki\Repository\Providers\RepositoryServiceProvider as ServiceProvider;

class SettingProfileServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories =
    [
        \Tripteki\SettingProfile\Contracts\Repository\ISettingProfileRepository::class => \Tripteki\SettingProfile\Repositories\Eloquent\SettingProfileRepository::class,
        \Tripteki\SettingProfile\Contracts\Repository\Admin\ISettingProfileEnvironmentRepository::class => \Tripteki\SettingProfile\Repositories\Eloquent\Admin\SettingProfileEnvironmentRepository::class,
    ];

    /**
     * @var bool
     */
    public static $runsMigrations = true;

    /**
     * @return bool
     */
    public static function shouldRunMigrations()
    {
        return static::$runsMigrations;
    }

    /**
     * @return void
     */
    public static function ignoreMigrations()
    {
        static::$runsMigrations = false;
    }

    /**
     * @return void
     */
    public function boot()
    {
        parent::boot();

        $this->registerPublishers();
        $this->registerMigrations();
    }

    /**
     * @return void
     */
    protected function registerMigrations()
    {
        if ($this->app->runningInConsole() && static::shouldRunMigrations()) {

            $this->loadMigrationsFrom(__DIR__."/../../database/migrations");
        }
    }

    /**
     * @return void
     */
    protected function registerPublishers()
    {
        if (! static::shouldRunMigrations()) {

            $this->publishes(
            [
                __DIR__."/../../database/migrations" => database_path("migrations"),
            ],

            "tripteki-laravelphp-setting-profile-migrations");
        }
    }
};
