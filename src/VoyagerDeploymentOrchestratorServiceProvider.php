<?php

namespace DrudgeRajen\VoyagerDeploymentOrchestrator;

use Illuminate\Support\ServiceProvider;
use DrudgeRajen\VoyagerDeploymentOrchestrator\Providers\OrchestratorEventServiceProvider;

class VoyagerDeploymentOrchestratorServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $publishablePath = dirname(__DIR__) . '/publishable';

        $publishable = [
            'seeders' => [
                "{$publishablePath}/database/seeds/" => database_path('seeders'),
            ],
        ];

        foreach ($publishable as $group => $paths) {
            $this->publishes($paths, $group);
        }

        $this->commands(Commands\VDOSeed::class);
    }

    public function register()
    {
        $this->app->register(OrchestratorEventServiceProvider::class);
    }
}
