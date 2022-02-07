<?php

namespace App\Queue\Jobs;

use App\Models\Client;
use App\Helpers\ClientConnector;
use Illuminate\Queue\Jobs\DatabaseJob as DBJob;
use Spatie\Multitenancy\Models\Tenant;

class DatabaseJob extends DBJob
{
    public function fire()
    {
        if ($this->job) {
            $tenant = Tenant::findOrFail($this->payload()['tenantId']);

            $this->db->createConnection($tenant);
        }

        parent::fire();
    }
}
