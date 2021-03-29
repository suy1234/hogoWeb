<?php

namespace Modules\RealEstate\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The root namespace to assume when generating URLs to actions.
     *
     * @var string
     */
    protected $namespace = 'Modules\RealEstate\Http\Controllers';

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
            'module' => "real_estate",
            'prefix' => "tkadmin/real-estate",
            'middleware' => ['web'],
            'namespace' => $this->namespace.'\Admin'
        ], function ($router) {
            require (__DIR__ . '/../Routes/admin.php');
        });
    }
}
