<?php

namespace App\Queue;

use App\Queue\Connectors\DatabaseConnector;
use Illuminate\Queue\QueueServiceProvider as QueueProvider;

class QueueServiceProvider extends QueueProvider
{
    protected function registerDatabaseConnector($manager)
    {
        $manager->addConnector('database', function () {
            return new DatabaseConnector($this->app['db']);
        });
    }
}
