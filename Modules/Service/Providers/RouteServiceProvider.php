<?php

namespace Modules\Service\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\Service\Http\Controllers';

    /**
     * Called before routes are registered.
     *
     * Register any model bindings or pattern based filters.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapAdminRoutes();
    }

    protected function mapAdminRoutes()
    {
        Route::group([
            'module' => "service",
            'prefix' => "tkadmin/services",
            'middleware' => ['web'],
            'namespace' => $this->namespace.'\Admin'
        ], function ($router) {
            require (__DIR__ . '/../Routes/admin.php');
        });
    }
}
