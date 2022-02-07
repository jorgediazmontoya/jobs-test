<?php

namespace App\Listeners;

use App\Events\CreateUser;
use App\Models\User;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Hash;
use Spatie\Multitenancy\Jobs\TenantAware;

class StoreUser implements ShouldQueue, TenantAware
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CreateUser $event)
    {
        $user = new User([
            'name' => $event->getUser()->name,
            'email' => $event->getUser()->email,
            'password' => Hash::make($event->getUser()->password)
        ]);

        $user->save();
    }
}
