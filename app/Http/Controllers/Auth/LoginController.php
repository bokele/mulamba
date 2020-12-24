<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    public function redirectTo()
    {

        // User role


        $status = Auth::user()->status;

        if ($status == 'active') {
            $role = Auth::user()->type;

            // Check user role
            switch ($role) {
                case 'admin':
                    return '/admin';
                    break;
                case 'seller':
                    return '/home';
                    break;
                case 'user':
                    return '/';
                    break;
                default:
                    return '/login';
                    break;
            }
        } else {

            return route('login', ['error' => 'Your account is desactive, please contact the adamin to active it']);
        }
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
}
