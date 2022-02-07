<?php

namespace App\Providers;

use App\Events\TenantQueueIdentified;
use App\Services\Contracts\IFileService;
use App\Services\FileCustomService;
use App\Services\FileService;
use Illuminate\Support\ServiceProvider;
use Spatie\Multitenancy\Models\Tenant;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(IFileService::class, FileCustomService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot() {
        /* $this->app['queue']->createPayloadUsing(function () {
            return [
                'tenantId' => session('tenant')
            ];
        });*/

        /* $this->app['events']->listen(\Illuminate\Queue\Events\JobProcessing::class, function ($event) {
            if (isset($event->job->payload()['tenantId'])) {
                $tenant = $this->resolveTenant($event->job->payload()['tenantId']);
                event(new TenantQueueIdentified($tenant));
            }
        }); */
    }

    /**
     * resolveTenant
     *
     * @param  mixed $id
     * @return Tenant
     */
    protected function resolveTenant($id) {
        return Tenant::findOrFail($id);
    }
}
