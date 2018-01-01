<?php
/**
 * Created by PhpStorm.
 * User: william
 * Date: 01/01/2018
 * Time: 14:55
 */

namespace App\Http\Controllers\Auth;


use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

trait ApiAuthenticatesUsers
{
    use AuthenticatesUsers;

    protected function sendLoginResponse(Request $request)
    {
        $this->clearLoginAttempts($request);
        return $this->authenticateClient($request);
    }


    protected function authenticateClient(Request $request)
    {
        //dd(config('p'))
        $request->request->add(config('passport') + [
                'username' => $request->input($this->username()),
                'password' => $request->input('password'),
            ]);

        $proxy = Request::create(
            'oauth/token',
            'POST'
        );

        $response = \Route::dispatch($proxy);
        return $response;
    }


}