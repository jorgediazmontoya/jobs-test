<?php

namespace App\Listeners;

use App\Events\TenantQueueIdentified;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\Capsule\Manager;
use Illuminate\Queue\InteractsWithQueue;

class SetTenantQueueConnection
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
    public function handle(TenantQueueIdentified $event)
    {
        app(Manager::class)->setTenant($event->tenant);

        $this->db->createConnection($event->tenant);
        $this->db->purge();
    }
}
