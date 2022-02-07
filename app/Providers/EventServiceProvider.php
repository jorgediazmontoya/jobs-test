<?php

namespace App\Providers;

use App\Events\CreateUser;
use App\Events\TenantQueueIdentified;
use App\Listeners\SetTenantQueueConnection;
use App\Listeners\StoreUser;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CreateUser::class => [
            StoreUser::class,
        ],
        TenantQueueIdentified::class => [
            SetTenantQueueConnection::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
