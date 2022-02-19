<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth as Aut;
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
    protected $redirectTo = RouteServiceProvider::HOME;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }
    public function showAdminLoginForm()
    {
        return view('auth.adminLogin', ['url' => 'admin']);
    }

    public function adminLogin(Request $request)
    {
       
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
            'g-recaptcha-response' => 'required|recaptchav3:validate,0.5'
        ]);

        if (Aut::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function AdminLogout(Request $request)
    {

       
       
        if(Aut::guard('admin')->check()) // this means that the admin was logged in.
      {
        auth()->guard()->logout();

        $request->session()->flush();
        return redirect()->route('welcome');
    }

    $this->guard()->logout();
    $request->session()->invalidate();
    return $this->loggedOut($request) ?: redirect('/');
    }

}
