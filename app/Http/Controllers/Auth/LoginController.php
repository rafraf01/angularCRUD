<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Request;
use App\Types\AccountType;

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
//    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function redirectPath(){

        switch(Auth::user()->account_type){
            case AccountType::ADM:
                $url = '/admin';
                break;
            case AccountType::USR:
                $url = '/users';
                break;
            default :
                $url = '/';
                break;
        }

        return $url;
    }

    /**
     * Redirect to Login Page
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout(){
        Auth::logout();
        return redirect()->to('login');
    }
}
