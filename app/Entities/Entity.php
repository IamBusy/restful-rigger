<?php

namespace App\Entities;

use Illuminate\Database\Eloquent\Model;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

class Entity extends Model implements Transformable
{
    use TransformableTrait;

    /*
    |--------------------------------------------------------------------------
    | Dynamic table
    |--------------------------------------------------------------------------
    |
    | Ref: https://stackoverflow.com/questions/18044577/laravel-4-dynamic-table-names-using-settable
    |
    */
    protected static $_table;


    protected $guarded = ['created_at', 'updated_at', 'deleted_at', 'id'];


    public function setTable($table)
    {
        static::$_table = $table;
    }

    public function getTable()
    {
        return static::$_table;
    }

}
