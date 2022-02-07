<?php
namespace App\Queue\Connectors;

use App\Queue\DatabaseQueue;
use Illuminate\Queue\Connectors\DatabaseConnector as DBConnector;

class DatabaseConnector extends DBConnector
{

    public function connect(array $config)
    {
        return new DatabaseQueue(
            $this->connections->connection($config['connection'] ?? null),
            $config['table'],
            $config['queue'],
            $config['retry_after'] ?? 60
        );
    }
}
