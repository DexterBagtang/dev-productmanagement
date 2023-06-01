<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Rules\Captcha;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use DB;

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


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
            return 'username';
    }
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => new Captcha()
        ]);
    }
    function authenticated(Request $request, $user)
    {
    $user = $request->user();
    $request->session()->put('user_last_login',$user->last_login_at);
    $user->update([
        'last_login_at' => Carbon::now()->toDateTimeString(),
    ]);

    $request->session()->forget('password_expired_id');
    $password_changed_at = new Carbon(($user->password_changed_at) ? $user->password_changed_at : $user->created_at);

        DB::table('logs')->insert(
            ['user_id' => $user->id, 'form' => 'Login', 'query' => $request->ip().json_encode($request->all()), 'created_at' => now()]
        );

//    if (Carbon::now()->diffInDays($password_changed_at) >= 182) {
//      $request->session()->put('password_expired_id',$user->id);
//        auth()->logout();
//        return redirect('/expirechangePassword')->withErrors(['Your password has expired, please change it.']);
//    }

        // check if password is in default
        if ((Hash::check('pms@philcom',Auth::user()->password))) {
            // The passwords matches
            return redirect('expirechangePassword')->withErrors(['Password is in default please change your password !']);
        }


  }
}
