<?php

namespace App\Providers;

use App\Entities\Entity;
use App\Repositories\EloquentImpl\EntityRepositoryEloquent;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class RiggerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        foreach (config('entity', []) as $name => $config) {
            $className = Str::ucfirst($name);
            $this->bindEntity($className, $config);
            $this->bindRepository($className, $config);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    protected function bindEntity($name, $config) {
        $this->app->bindIf('App\Entities\\'.$name, function ($app, $parameters) use ($name, $config) {
            if(class_exists('App\Entities\\'.$name)) {
                $class = "App\Entities\\$name";
                $entity = new $class($parameters);
            } else {
                $table = array_key_exists('table', $config)? $config['table']:Str::plural(Str::lower($name));
                $entity = new Entity($parameters);
                $entity->setTable($table);
            }
            return $entity;
        });
    }

    protected function bindRepository($name, $config) {
        $this->app->bindIf('App\Repositories\\'.$name.'Repository', function ($app, $parameters) use ($name, $config) {
            $repository = new EntityRepositoryEloquent($app);
            $repository->setModelName('App\Entities\\'.$name);
            $repository->resetModel();
            return $repository;
        });
    }
}
