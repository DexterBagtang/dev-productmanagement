<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use DB;
use App\Salesrequest;
use Auth;
use Carbon\Carbon;
use App\User;
use Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['showExpireChangePasswordForm', 'user_expirechangePassword']]);
        $this->middleware('revalidate');
        $this->middleware('timeout');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        //$showCounts = DB::table('salesrequests')->count();
        $showCounts = Salesrequest::where('pm_approval_status', '')
            ->orwhereNull('pm_approval_status')->count();

        $showCounts2 = Salesrequest::where('status','like', '%PM Check Contractor Cost%')->count();

        $showCounts3 = Salesrequest::where('status','like', '%Revenue Mark Up%')
            ->orwhere('status', 'Revenue Re-Mark Up')->count();
        $showCounts4 = Salesrequest::where('status','like','%PM Mark Up Technical Check%')->count();

        $showCounts5 = Salesrequest::where('status','like', '%Purchasing Bidding%')
            ->orwhere('status', 'like', "Purchasing Rebidding%")->count();

        $showCounts6 = Salesrequest::where('status','like', '%PM Designing%')
            ->orwhere('status', 'PM -> Redesign')->count();

        $showCounts7 = Salesrequest::where('status','like', '%Revenue Head Unit for Checking%')->count();

        $showCounts8 = Salesrequest::where('status','like', '%Finance Head Mark Up Approval%')
            ->orwhere('status', 'Finance Head Mark Up Approval(Revision)')->count();

        $showCounts9 = Salesrequest::where('status','like', '%Sales Proposal Status%')->count();

        $showCounts10 = Salesrequest::where('status','like', '%PM Review of Design%')->count();
        $showCounts11 = Salesrequest::where('status','like', '%Sales Releasing of Proposal%')->count();
        $showCounts12 = Salesrequest::where('status','like', '%Revenue Upload Contractor Bid Summary%')->count();

        $showCounts14 = Salesrequest::where('status', 'Sales -> Disapproved')->count();
        $user_last_login = $request->session()->get('user_last_login');
        Session::put('user_last_login', $user_last_login);

        return view('home', ['showCounts' => $showCounts])->with('showCounts2', $showCounts2)->with('showCounts3', $showCounts3)->with('showCounts4', $showCounts4)->with('showCounts5', $showCounts5)->with('showCounts6', $showCounts6)->with('showCounts7', $showCounts7)->with('showCounts8', $showCounts8)->with('showCounts9', $showCounts9)->with('showCounts10', $showCounts10)->with('showCounts11', $showCounts11)->with('showCounts12', $showCounts12)->with('showCounts14', $showCounts14)->with('user_last_login', $user_last_login);
    }
    public function manual(){
        $modal = '<div class="modal fade" tabindex="-1" role="dialog">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Modal title</h4>
      </div>
      <div class="modal-body">
        <p>One fine body&hellip;</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->';
        return $modal;
    }

    public function showFlowChart()
    {
        return view('flowchart');
    }

    public function showChangePasswordForm()
    {
        return view('auth.changepassword');
    }


    public function user_changePassword(Request $request)
    {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:12|confirmed',
        ]);
        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->password_changed_at = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect('/home')->with('success', 'Password changed successfully !');
    }

    public function showResetPasswordForm()
    {
        return view('auth.resetpassword');
    }

    public function user_resetPassword(Request $request)
    {

        $validatedData = $request->validate([
            'new-password' => 'required|string|min:6',
        ]);
        //Change Password

        $result = DB::table('users')->select('id')->where('username', $request->get('username'))->first();
        $user_id = $result->id;
        $user = User::find($user_id);
        $user->password = bcrypt($request->get('new-password'));
        $user->password_changed_at = '2000-01-01 00:00:00';
        $user->save();
        return redirect('/home')->with('success', 'Password changed successfully !');
    }


    public function showExpireChangePasswordForm()
    {
        return view('auth.expirechangepassword');
    }

    public function user_expirechangePassword(Request $request)
    {
        $password_expired_id = $request->session()->get('password_expired_id');
        if (!isset($password_expired_id)) {
            return redirect('/login');
        }

        $user = User::find($password_expired_id);
        if (!(Hash::check($request->get('current-password'), $user->password))) {
            // The passwords matches
            return redirect()->back()->with("error", "Your current password does not matches with the password you provided. Please try again.");
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {
            //Current password and new password are same
            return redirect()->back()->with("error", "New Password cannot be same as your current password. Please choose a different password.");
        }
        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:12|confirmed',
        ]);
//Change Password

        $user->password = bcrypt($request->get('new-password'));
        $user->password_changed_at = Carbon::now()->toDateTimeString();
        $user->save();
        return redirect('/login')->withErrors('Expired Password changed successfully, You can now login!');
    }
}
