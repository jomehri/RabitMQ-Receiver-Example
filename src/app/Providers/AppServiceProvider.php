<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\Rabbit\ProduceMessagesService;
use App\Services\Rabbit\ConsumeMessagesService;
use App\Services\Notification\SmsNotificationService;
use App\Services\Notification\EmailNotificationService;
use App\Repositories\Notification\NotificationRepository;
use App\Interfaces\Services\Notification\IProduceMessageService;
use App\Interfaces\Services\Notification\IConsumeMessageService;
use App\Interfaces\Services\Notification\ISmsNotificationService;
use App\Interfaces\Services\Notification\IEmailNotificationService;
use App\Interfaces\Repositories\Notification\INotificationRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->registerServices();
        $this->registerRepositories();
    }

    /**
     * @return void
     */
    public function registerServices(): void
    {
        /**
         * Notification services bindings
         */
        $this->app->bind(IConsumeMessageService::class, ConsumeMessagesService::class);
        $this->app->bind(IProduceMessageService::class, ProduceMessagesService::class);
        $this->app->bind(IEmailNotificationService::class, EmailNotificationService::class);
        $this->app->bind(ISmsNotificationService::class, SmsNotificationService::class);
    }

    /**
     * @return void
     */
    public function registerRepositories(): void
    {
        /**
         * Notification Repository
         */
        $this->app->singleton(INotificationRepository::class, NotificationRepository::class);
    }


}
