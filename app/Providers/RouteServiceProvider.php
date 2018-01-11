<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Str;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //
        $this->mapDynamicRoutes();

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::prefix('api')
             ->middleware('api')
             ->namespace($this->namespace)
             ->group(base_path('routes/api.php'));
    }

    protected function mapDynamicRoutes() {
        $validMethod =  [
            'store' =>  'post',
            'index' =>  'get',
            'show'  =>  'get',
            'update'    =>  'put',
            'destroy'   =>  'delete'
        ];
        Route::prefix(config('rigger.api.prefix'))
            ->namespace($this->namespace)
            ->middleware(['extract.entity','api'])
            ->group(function() use ($validMethod) {
                foreach (config('entity', []) as $name => $config) {
                    if(! class_exists('App\Http\Controllers\\'.$name.'Controller')) {
                        $options = [];
                        if(array_key_exists('routes', $config)) {
                            $options = $config['routes'];
                        }
                        Route::resource(Str::plural($name), 'BaseController', $options);
                    }
                }
            });


    }
}
