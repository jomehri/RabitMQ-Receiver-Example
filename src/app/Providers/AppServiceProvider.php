<?php

namespace App\Providers;

use App\Interfaces\Repositories\Notification\INotificationRepository;
use App\Repositories\Notification\NotificationRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerRepositories();
    }

    /**
     * @return void
     */
    public function registerRepositories(): void
    {
        $this->app->singleton(INotificationRepository::class, NotificationRepository::class);
    }


}
