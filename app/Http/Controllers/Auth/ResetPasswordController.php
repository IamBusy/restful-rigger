<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\UnauthorizedException;
use Illuminate\Auth\Events\PasswordReset;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */


    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function reset(Request $request)
    {
        $payload = $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|confirmed|min:6',
        ]);
        $user = $request->user();
        if($user->email == $payload['email']) {
            $this->resetPassword($user, $payload['password']);
            return response(['message' => '重置成功']);
        }
        throw new UnauthorizedException();
    }


    protected function sendResetFailedResponse(Request $request, $response)
    {
        return response(['message' => '重置失败']);
    }

    public function resetPassword($user, $password)
    {
        $user->password = Hash::make($password);

        $user->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
    }
}
