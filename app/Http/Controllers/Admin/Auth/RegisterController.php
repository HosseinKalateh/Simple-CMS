<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    use AuthenticatesUsers;

    protected $guardName   = 'admin';
    protected $maxAttempt  = 3;
    protected $decayMinute = 2;

    protected $loginRoute;
}
