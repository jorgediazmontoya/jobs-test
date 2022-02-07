<?php
namespace App\Queue;

use App\Queue\Jobs\DatabaseJob;

class DatabaseQueue extends \Illuminate\Queue\DatabaseQueue
{

    /**
     * Marshal the reserved job into a DatabaseJob instance.
     *
     * @param  string  $queue
     * @param  \Illuminate\Queue\Jobs\DatabaseJobRecord  $job
     * @return \App\Queue\Jobs\DatabaseJob
     */
    protected function marshalJob($queue, $job){
        $job = $this->markJobAsReserved($job);

        return new DatabaseJob(
            $this->container, $this, $job, $this->connectionName, $queue
        );
    }
}
