<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Auth;
use DB;
use Carbon\Carbon;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
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
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('timeout');

    }

    public function register(Request $request)
    {

      $this->validator($request->all())->validate();

//        dd($request->all());

        $this->create($request->all());

    return redirect('/viewusers')->with('success', 'Success');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'email' => ['required','email'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'string', 'max:255'],
            'active' => ['required'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'role' => $data['role'],
            'password_changed_at' => '2000-01-01 00:00:00',
            'active' => $data['active'],
        ]);
    }

    public function viewusers()
    {
      $users = DB::table('users')
              ->leftJoin('role', 'users.role', '=', 'role.role')
              ->select('users.*','role.role_name')
              ->get();

      return view('auth.viewusers', compact('users'));
    }

    public function users_edit_view($id)
    {
      $users = DB::table('users')
              ->where('users.id', '=', $id)
              ->leftJoin('role', 'users.role', '=', 'role.role')
              ->select('users.*','role.role_name')
              ->get();

      return view('auth.editusers', compact('users'));
    }

    public function users_update(Request $request, $id)
    {
      $request->validate([
        'username'=>'required',
        'role'=> 'required'
      ]);
//      dd($request);


      $user = User::find($id);
      $user->username = $request->get('username');
      $user->email= $request->get('email');
      $user->role = $request->get('role');
      $user->active = $request->get('active');
      $user->save();

      DB::table('logs')->insert(
    ['user_id' => Auth::user()->id,'form' => 'Update Users','query' => $user,'created_at'=>now()]
);
      return redirect('/viewusers')->with('success', 'User has been updated');
    }


}
