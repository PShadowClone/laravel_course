<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    protected $loginPath = '/login';
    protected $redirectPath = '/home';
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    protected function attemptLogin(Request $request)
    {
        if (Auth::attempt(['email' => $request->input('email'),
            "password" => $request->input('password')],
            $request->filled('remember'))) {
            return true;
        } elseif (Auth::attempt(['username' => $request->input('email'),
            "password" => $request->input('password')],
            $request->filled('remember'))) {
            return true;
        } else if (Auth::guard('library')->attempt(['email' => $request->input('email'),
            "password" => $request->input('password')],
            $request->filled('remember'))) {
            return true;
        }
        return false;
    }
}
