<?php

namespace NotiConnect\Providers;

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
        //
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Bind EloquentNotificationRepository to the NotificationRepository contract
        $this->app->bind('NotiConnect\Repositories\Contracts\NotificationRepository',
                         'NotiConnect\Repositories\EloquentNotificationRepository');
    }
}
