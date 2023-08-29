<?php

namespace App\Providers;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var array
     */
    protected $repositories = [];

    /**
     * @var array
     */
    protected $policies = [];

    /**
     * {@inheritdoc}
     *
     * @param  Application  $app
     */
    public function __construct($app)
    {
        parent::__construct($app);

        // Init app services
        $this->initServices();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerServices();
    }

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
     * App services binding
     *
     * @return void
     */
    protected function initServices()
    {
        $serviceBindings = config('binding.services');

        foreach ($serviceBindings as $modelClass => $binding) {
            $contract = $binding['contract'] ?? null;
            $repository = $binding['repository'] ?? null;
            $policy = $binding['policy'] ?? null;

            $this->repositories[] = [$contract, $repository, $modelClass];
            $this->policies[] = [$modelClass, $policy];
        }
    }

    protected function registerServices()
    {
        // Register repository
        foreach ($this->repositories as $repository) {
            [$contract, $repository, $modelClass] = $repository;
            $this->registerRepository($contract, $repository, $modelClass);
        }

        // Register policies
        foreach ($this->policies as $policy) {
            [$modelClass, $policy] = $policy;
            $this->registerPolicy($modelClass, $policy);
        }
    }

    protected function registerRepository($contract, $repository, $model)
    {
        if (! class_exists($model) || ! interface_exists($contract) || ! class_exists($repository)) {
            return;
        }

        $this->app->bind($contract, function () use ($repository, $model) {
            return new $repository(new $model());
        });
    }

    protected function registerPolicy($model, $policy)
    {
        if (! class_exists($model) || ! class_exists($policy)) {
            return;
        }
        Gate::policy($model, $policy);
    }
}
