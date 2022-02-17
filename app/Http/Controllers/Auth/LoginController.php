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
        $this->middleware('guest:admin')->except('logout');
        $this->middleware('guest')->except('logout');
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
            'g-recaptcha-response' => 'required|recaptchav3:contact-us,0.5'
        ]);

        if (Aut::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/admin/dashboard');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    public function AdminLogout(Request $request)
    {
       
        // Auth::guard('admin')->logout();
        
        // return redirect()->guest(route( 'admin.login' ));
        if(Auth::guard('admin')->check()){ // this means that the admin was logged in.
          Auth::guard('admin')->logout();
          $request->session()->invalidate();
          return redirect()->route('/welcome');
        }
    }

}
