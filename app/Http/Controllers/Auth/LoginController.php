<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Auth;
use Illuminate\Http\Request;

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
    protected $redirectTo = '/home';
    public function redirectPath()
    {
        // Logic that determines where to send the user
        if (\Auth::user()->type == 'admin') {
            return '/admin';
        }
        if (\Auth::user()->type == 'Mgr') {
            return '/inventory';
        }
        if (\Auth::user()->type == 'accountant') {
            return '/accountant';
        }
        if (\Auth::user()->type == 'cashier') {
            return '/cashier';
        }
    
        return '/dashboard';
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
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/login');
      }
   
}
