<?php
/**
 * Created by PhpStorm.
 * User: weixiaole
 * Date: 04/01/2018
 * Time: 10:33 PM
 */

return [
    'api'   =>  [
        'prefix'    =>  env('API_PREFIX','rigger'),
    ],


    /*
    |--------------------------------------------------------------------------
    | Global Authentication and Authorization
    |--------------------------------------------------------------------------
    | When define permission, you can use variables ${action}\${resource}, this will
    | be replaced in running time
    */
    'auth'  =>  [
        'authenticated' =>  true,
        'authorized'    =>  [
            'permission'    =>  '${action}-${resource}'
        ]
    ]
];