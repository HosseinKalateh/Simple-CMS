<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName   = 'admin';
    protected $maxAttempt  = 3;
    protected $decayMinute = 2;

    protected $redirectToRouteAfterLogin;

    public function __construct()
    {
        $this->redirectToRouteAfterLogin = 'admin.index';
    }

    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    //login
    public function login(Request $request)
    {
        //validate inputs
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required|min:3'
        ]);

        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            $this->sendLockoutResponse($request);
        }

        $credential = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        //attempt to login admin
        if (Auth::guard($this->guardName)->attempt($credential)) {
            $request->session()->regenerate();
            $this->clearLoginAttempts($request);
            return redirect()->route($this->redirectToRouteAfterLogin);
        } else {
            $this->incrementLoginAttempts($request);

            return redirect()->back()
                ->withInput()
                ->withErrors(["loginError" => "Incorrect user login details!"]);
        }
    }

    //logout
    public function logout()
    {
       auth()->logout();

       return redirect()->route('admin.login.show-login-form');
    }
}
