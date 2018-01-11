<?php
/**
 * Created by PhpStorm.
 * User: weixiaole
 * Date: 03/01/2018
 * Time: 5:11 PM
 */

return [

    /*
    |--------------------------------------------------------------------------
    | Default Entity List
    |--------------------------------------------------------------------------
    |
    | In order to handle the restful request, entities should be defined here
    |
    */

    'user'  =>  [

        /*
        |--------------------------------------------------------------------------
        | Relations
        |--------------------------------------------------------------------------
        |
        | You can define this relation by provided an entity name simply, for example:
        |
        | 'hasOne'  =>  ['phone']
        |
        | And of course, a given array which defines foreginKey and localKey is also ok.
        |
        | 'hasOne'  =>  [ ['phone', 'user_id', 'id'] ];
        |
        | All these defines are consistent to the doc in https://laravel.com/docs/5.5/eloquent-relationships
        */
        'hasOne'    =>  [],
        'belongsTo' =>  [],
        'hasMany'   =>  [],
        'belongsToMany' =>  [],

        /*
        |--------------------------------------------------------------------------
        | Routes
        |--------------------------------------------------------------------------
        |  Set a subset of actions the controller should handle instead of the full set of default actions
        */
        'routes'    =>  [],

    ],

    'role'  =>  [

    ],
];