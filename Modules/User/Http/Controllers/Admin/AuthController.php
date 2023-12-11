<?php

namespace Modules\User\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
class AuthController extends Controller
{
	use AuthenticatesUsers;

    protected $redirectTo = '/tkadmin';

    public function getLogin()
    {
        return view('user::admin.auth.login');
    }

    public function username()
    {
        $text = 'email';
        if(!filter_var(request()->email, FILTER_VALIDATE_EMAIL)) {
            $text = 'username';
            request()->request->add(['username' => request()->email]);
            request()->except(['email']);
        }
dd($text);
        return $text;
    }

    public function logout(Request $request)
    {
        $this->guard()->logout();
        remove_session_user_login();
        return $this->loggedOut($request) ?: redirect()->route('admin.login');
    }

    // public function login(LoginRequest $request)
    // {
    //     if (method_exists($this, 'hasTooManyLoginAttempts') &&
    //         $this->hasTooManyLoginAttempts($request)) {
    //         $this->fireLockoutEvent($request);

    //         return $this->sendLockoutResponse($request);
    //     }

    //     if ($this->attemptLogin($request)) {
    //     	$user = User::where('email', $request->email)->where('status', 1)->first();
	   //      if(empty($user)){
	   //      	return $this->sendFailedLoginResponse($request, 'status');
	   //      }
    //         if(!empty($user->theme_admin)){
    //             session(['color_admin' => $user->theme_admin->config]);   
    //         }
    //         return $this->sendLoginResponse($request);
    //     }
    //     $this->incrementLoginAttempts($request);

    //     return $this->sendFailedLoginResponse($request);
    // }
    
}
