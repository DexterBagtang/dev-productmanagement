<?php

namespace App\Http\Controllers;

use Illuminate\Http\File;
use Illuminate\Database\Query\Builder;
use Illuminate\Http\Request;
use App\Salesrequest;
use App\Project;
use App\Helpers\Helper as Helper;
use DB;
use Auth;
use App\Bidding;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Storage;

use App\Mail\EmailNotification;

//use App\Mail\SaleRequestDisapproved;
//use App\Mail\SaleRequestApproved;


class SalesrequestController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('revalidate');
        $this->middleware('timeout');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$salesrequests = Salesrequest::all();
        //return view('salesrequests.viewsalesrequest', compact(['salesrequests']));
        //$salesrequests = DB::select('select a.sales_request_code,a.qoutation_addressee,a.requester,b.mall_name from salesrequests a left join malls b on a.mall_id = b.mall_id');

        //return view('salesrequests.viewsalesrequest', compact(['salesrequests']));

        $salesrequests = DB::table('salesrequests')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*',
                'users.username',
                'projects.project_code',
                'malls.mall_name',
                DB::raw("DATE_FORMAT(salesrequests.date_needed,'%d-%b-%Y') AS date_needed"),
                DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age")
            )
            ->orderBy('salesrequests.created_at', 'desc')
            ->get();
//    dd($salesrequests);

        return view('salesrequests.viewsalesrequest', compact(['salesrequests']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $malls = DB::table('malls')
            ->select('malls.mall_id', 'malls.mall_name')
            ->orderBy('mall_name')
            ->get();

        $data = view('salesrequests.createsalesrequest', compact(['malls']))->render();

        return response()->json($data);
    }

    public function notify()
    {
//        Notification::send('Dexter.Bagtang@philcom.com', new NewSaleNotification());

        $emailToNotify = array_filter(DB::table('users')->where('role', 1)->where('active', 'yes')->pluck('email')->toArray());


//        dd($emailToNotify);

        $emailData = [
            'subject' => 'Notification Test',
            'body' => 'Notification Test with emails',
            'title' => 'test title',
            'targetDate' => now(),
            'status' => 'notification test',
        ];
//
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        dd('sent');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'mall_id' => 'required',
            'requester' => 'required',
            'project_title' => 'required',
            'date_needed' => 'required',
            'category' => 'required',
            'project_requirements_files' => 'required',
            'project_requirements_files_2' => 'nullable',
            'project_requirements_files_3' => 'nullable'
//      'project_requirements_files_4' => 'nullable'

        ]);
//111

        if ($request->hasfile('project_requirements_files')) {
            $fileName = request()->project_requirements_files->getClientOriginalName();
            $unique_id = uniqid();
            $fileName = $unique_id . '-' . $fileName;
            $request->project_requirements_files->storeAs('public/uploads', $fileName);
        } else {
            $fileName = '';
        }


//222

        if ($request->hasfile('project_requirements_files_2')) {
            $fileName202 = request()->project_requirements_files_2->getClientOriginalName();
            $unique_id = uniqid();
            $fileName202 = $unique_id . '-' . $fileName202;
            $request->project_requirements_files_2->storeAs('public/uploads', $fileName202);
        } else {
            $fileName202 = '';
        }

//333

        if ($request->hasfile('project_requirements_files_3')) {
            $fileName303 = request()->project_requirements_files_3->getClientOriginalName();
            $unique_id = uniqid();
            $fileName303 = $unique_id . '-' . $fileName303;
            $request->project_requirements_files_3->storeAs('public/uploads', $fileName303);
        } else {
            $fileName303 = '';
        }

//444
//        if($request->hasfile('project_requirements_files_4'))
//     {
//   $fileName404 = request()->project_requirements_files_4->getClientOriginalName();
//    $unique_id = uniqid();
//    $fileName404 = $unique_id.'-'.$fileName404;
//    $request->project_requirements_files_4->storeAs('public/uploads',$fileName404);
//   }
//    else {
//      $fileName404 = '';
//    }


        if ($request->get('category') == 'Special') {
            $status = 'Revenue Mark Up';
        } else {
            $status = 'PM Review of Request';
        }


        $salerequests = new Salesrequest([
            'mall_id' => $request->get('mall_id'),
            'qoutation_addressee' => $request->get('qoutation_addressee'),
            'sales_request_code' => Helper::auto_generate_sr(),
            'requester' => $request->get('requester'),
            'date_needed' => $request->get('date_needed'),
            'on_site_survey' => $request->get('on_site_survey'),
            'comment' => $request->get('comment'),
            'project_requirements_files' => $fileName,
            'project_requirements_files_2' => $fileName202,
            'project_requirements_files_3' => $fileName303,
//      'project_requirements_files_4'=> $fileName404,

            'project_title' => $request->get('project_title'),
            'category' => $request->get('category'),
            'status' => $status,
            'revision' => '0'
        ]);
        $salerequests->save();


        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Create Sales Request', 'query' => $salerequests, 'created_at' => now()]
        );

        $sales_request_id = DB::table('salesrequests')->max('sales_request_id');

        if (Bidding::where('sales_request_id', $sales_request_id)->count() <= 0) {

            $biddings = new Bidding([
                'sales_request_id' => $sales_request_id
            ]);
            $biddings->save();
        }

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $sales_request_id, 'action' => 'Create Sales Request', 'query' => $salerequests, 'date_time' => now()]
        );

        $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'New Sales Request',
            'body' => ' A sales request has been created.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,
        ];

        Mail::to($emailToNotify)->send(new EmailNotification($emailData));

        return redirect('/salesrequests')->with('success', 'Sales Request has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //$salesrequests = Salesrequest::find($id);
        $salesrequest = DB::table('salesrequests')
            ->where('sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->select('salesrequests.*', 'malls.mall_name')
            ->first();

        $malls = DB::table('malls')
            ->where('mall_id', '!=', $id)
            ->select('malls.mall_id', 'malls.mall_name')
            ->get();

        $data = view('salesrequests.editsalesrequest', compact('salesrequest'), compact('malls'))->render();

        return response()->json($data);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'mall_id' => 'required',
            'requester' => 'required',
            'project_title' => 'required',
            'date_needed' => 'required',
            'category' => 'required',
            'project_requirements_files' => 'file'
//      'project_requirements_files_2' => 'file'
//      'project_requirements_files_3' => 'file',
//      'project_requirements_files_4' => 'file'
        ]);

//1111
        if ($request->hasfile('project_requirements_files')) {
            $fileName = $request->project_requirements_files->getClientOriginalName();
            $unique_id = uniqid();
            $fileName = $unique_id . '-' . $fileName;
            $request->project_requirements_files->storeAs('public/uploads', $fileName);

            if (!empty($request->existing_project_requirements)) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_project_requirements;
                unlink($file_path);
            }
        } else if (!empty($request->existing_project_requirements)) {
            $fileName = $request->existing_project_requirements;
        } else {
            $request->validate([
                'project_requirements_files' => 'required'
            ]);
        }


        if ($request->get('category') == 'Special') {
            $status = 'Revenue Mark Up';
        } else {
            $status = 'PM Review of Request';
        }

        $salerequests = Salesrequest::find($id);
        $salerequests->mall_id = $request->get('mall_id');
        $salerequests->qoutation_addressee = $request->get('qoutation_addressee');
        $salerequests->requester = $request->get('requester');
        $salerequests->date_needed = $request->get('date_needed');
        $salerequests->on_site_survey = $request->get('on_site_survey');
        $salerequests->comment = $request->get('comment');
        $salerequests->project_title = $request->get('project_title');
        $salerequests->category = $request->get('category');
        $salerequests->status = $status;
        $salerequests->pm_supervisor_id = '';
        $salerequests->pm_approval_status = '';
        $salerequests->pm_remarks = '';

        if ($request->get('pm_approval_status') == 'Yes') {
            $salerequests->revision = $request->get('revision') + 1;
        }

//111
        if ($fileName !== '') {
            $salerequests->project_requirements_files = $fileName;
        }
        $salerequests->save();


        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Update Sales Request', 'query' => $salerequests, 'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Edit Sales Request', 'query' => $salerequests, 'date_time' => now()]
        );

        $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'Sales Request Updated',
            'body' => 'A sales request has been updated.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,

        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));

//        return redirect('/salesrequests')->with('success', 'Sales Request has been updated');
        return back()->with('success', 'Sales Request has been updated');

    }

    public function revise($id)
    {
        //$salesrequests = Salesrequest::find($id);
//        $salesrequests = DB::table('salesrequests')
        $salesrequest = Salesrequest::query()
            ->where('sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->select('salesrequests.*', 'malls.mall_name')
            ->first();

        $malls = DB::table('malls')
            ->where('mall_id', '!=', $id)
            ->select('malls.mall_id', 'malls.mall_name')
            ->get();

        return view('salesrequests.revise_salesrequest', compact('salesrequest'), compact('malls'));
    }

    public function revise_project()
    {
//        $dir = public_path();
//        $data = Storage::files($dir);
//
////        $files = File::allFiles($dir);
//
////        $data = $files->only(['filename']);
////        $data = Builder::for(File::allFiles($dir))->where('filename','=','chowking');
////        $data = scandir($dir)->only(['5cf0bee3609d9-SMPP Chowking Annex .jpg']);
////        foreach ($files as $file){
////            $cut = substr($file,14);
////            $data[] = $cut;
////        }
////        $filtered = array_filter($data,function ($yellow){
////            return $yellow !== 'RFQ - STRUCTURED CABLING.pdf';
////        });
////        $data = array_values($filtered);
//        dd($data);

        $salesrequests = DB::table('salesrequests')
            ->take(100)
//            ->where('salesrequests.reason_for_revision', '!=', null)
//            ->orwhere('salesrequests.status', 'like', "Project Completed%")
//            ->orwhere('salesrequests.status', '=', 'Sales Proposal Status')
//            ->orwhere('salesrequests.status', '=', 'Project Completion/Uploading of Documents')
//            ->orWhere('salesrequests.status','=','Project Completed (For Revision)')
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'users.password', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();
//        dd($filtered);

        return view('salesrequests.revise_projects', compact(['salesrequests']));
    }

    public function timeline($id)
    {
//        $dir = public_path().'/storage/uploads/';
//        $files = scandir($dir);
//        $timeline = DB::table('request_logs')
//            ->where('sales_request_id','=',$id)
//            ->leftJoin('users', 'request_logs.user_id', '=', 'users.id')
//            ->select('request_logs.*','users.username')
//            ->get();

//        dd($files);


//        return view('salesrequests.timeline')->with('timeline',$timeline);
    }

    public function revised(Request $request, $id)
    {
//        $request->validate([
//            'reason_for_revision' => 'required',
//            'return' => 'required',
//        ]);

        if ($request->get('return') == 'projectdesign') {
            $status = 'PM -> Redesign(Revision)';
        } elseif ($request->get('return') == 'bidding') {
            $status = 'Purchasing Rebidding(Revision)';
        } elseif ($request->get('return') == 'markup') {
            $status = 'Revenue Re-Mark Up(Revision)';
        } elseif ($request->get('return') == 'reviewrequest') {
            $status = 'PM Review of Request(Revision)';
        } elseif ($request->get('return') == 'reviewdesign') {
            $status = 'PM Review of Design(Revision)';
        } elseif ($request->get('return') == 'checkbidding') {
            $status = 'PM Review Bidders(Revision)';
        } elseif ($request->get('return') == 'technicalcheck') {
            $status = 'PM Mark Up Technical Check(Revision)';
        } elseif ($request->get('return') == 'revenuehead') {
            $status = 'Revenue Head Unit for Checking(Revision)';
        } elseif ($request->get('return') == 'financehead') {
            $status = 'Finance Head Mark Up Approval(Revision)';
        }


        $salerequests = Salesrequest::find($id);
        $salerequests->status = $status;
        $salerequests->reason_for_revision = $request->get('reason_for_revision');
        $salerequests->revision = $request->get('revision') + 1;

        $salerequests->update();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id,
                'form' => 'Update Sales Request',
                'query' => $salerequests,
                'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id,
                'sales_request_id' => $id,
                'action' => $status,
                'remarks' => $request->get('reason_for_revision'),
                'query' => $salerequests,
                'date_time' => now()]
        );

        return redirect('/revise_project')->with('success', 'Sales Request has been updated');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function approved_header()
    {
        $salesrequests = DB::table('salesrequests')
//            ->where('pm_approval_status', '=', '')
            ->where('salesrequests.status', 'like', '%PM Review of Request%')
            ->orWhere('salesrequests.status', '=', 'PM Review of Request(Revision)')
            ->where('salesrequests.status', '!=', 'Cancelled Project')
//            ->orwhereNull('pm_approval_status')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->select('salesrequests.*', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();

//    dd($salesrequests);
        return view('salesrequests.approveheadersalesrequest', compact('salesrequests'));
    }

    public function approved_detail($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->select('salesrequests.*', 'malls.mall_name')
            ->get();

        $users = DB::table('users')
            ->where('role', '=', '2')
            ->where('active', '=', 'Yes')
            ->select('users.id', 'users.username')
            ->get();


//    dd($salesrequests,$users);
        return view('salesrequests.approvedetailsalesrequest', compact('salesrequests'), compact('users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function approved_sr(Request $request, $id)
    {

        $request->validate([
            'approved_status' => 'required'
        ]);

        $salerequests = Salesrequest::find($id);
        $salerequests->pm_supervisor_id = $request->get('approver_id');
        $salerequests->pm_approval_status = $request->get('approved_status');
        $salerequests->pm_remarks = $request->get('remarks');

//        dd($salerequests);
        if ($request->get('approved_status') == 'Yes') {

            $request->validate([
                'pm_assigned_id' => 'required',
                'remarks' => 'required'
            ]);

            $salerequests->status = 'PM Designing';
            $salerequests->pm_assigned_id = $request->get('pm_assigned_id');
            $mall_id = $request->get('mall_id2');
//            dd($salerequests);

            if (Project::where('sales_request_id', $request->get('sales_request_id2'))->count() <= 0) {

                $projects = new Project([
                    'sales_request_id' => $request->get('sales_request_id2'),
                    'project_code' => Helper::auto_generate_pc($mall_id)
                ]);
                $projects->save();
            }
            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'Approved Sales Request',
                    'remarks' => $request->get('remarks'),
                    'query' => $salerequests,
                    'date_time' => now()]
            );

            //------Email Notification ---------
//            $emailToNotify = DB::table('users')->where('role', 2)->where('id', $salerequests->pm_assigned_id)->where('active', 'yes')->pluck('email');
            $emailToNotify = array_filter(
                DB::table('users')
                    ->where('role', 2)
                    ->where('active', 'yes')
                    ->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Project Design',
                'body' => ' The request has been approved. Please log in to the system to view the project details and proceed with uploading the design.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

        } else {
            $request->validate([
                'remarks' => 'required'
            ]);
            $salerequests->status = 'Sales -> Disapproved';

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'Disapproved Sales Request',
                    'remarks' => $request->get('remarks'),
                    'query' => $salerequests, 'date_time' => now()]
            );

            $emailToNotify = DB::table('users')->where('role', 8)->where('active', 'yes')->pluck('email');
            $emailData = [
                'subject' => 'Sales Request Disapproved',
                'body' => ' Request disapproved, Please log in to the system and view the details of the request.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
                'status' => $salerequests->status,

            ];
        }

        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Approve Sales Request', 'query' => $salerequests, 'created_at' => now()]
        );


        Mail::to($emailToNotify)->send(new EmailNotification($emailData));

        return redirect('/approved_header')->with('success', 'Sales Request has been reviewed');
    }

    public function sr_disapproved_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Sales -> Disapproved')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.sr_disapproved_header', compact(['salesrequests']));
    }

    public function po_ntp_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Sales Proposal Status')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.po_ntp_header', compact(['salesrequests']));
    }

    public function po_ntp_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();
//            dd($salesrequests,$biddingdetails,$mark_ups);

        return view('salesrequests.po_ntp_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function po_ntp_upload(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        if ($request->get('approved_status') == 'Yes') {
            if ($request->hasfile('po_ntp_files')) {
                $fileName = request()->po_ntp_files->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->po_ntp_files->storeAs('public/uploads', $fileName);

                if (!empty($request->po_ntp_files_exist)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->po_ntp_files_exist;
                    unlink($file_path);
                }
            } else if (!empty($request->po_ntp_files_exist)) {
                $fileName = $request->get('po_ntp_files_exist');
            } else {
                $request->validate([
                    'po_ntp_files' => 'required'
                ]);
            }

            if ($request->hasfile('proposal_files')) {
                $fileName2 = request()->proposal_files->getClientOriginalName();
                $unique_id = uniqid();
                $fileName2 = $unique_id . '-' . $fileName2;
                $request->proposal_files->storeAs('public/uploads', $fileName2);

                if (!empty($request->proposal_files_exist)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->proposal_files_exist;
                    unlink($file_path);
                }
            } else if (!empty($request->proposal_files_exist)) {
                $fileName2 = $request->get('proposal_files_exist');
            } else {
                $request->validate([
                    'proposal_files' => 'required'
                ]);
            }

            $salerequests = Salesrequest::find($id);
            $salerequests->status = 'Revenue Upload Contractor Bid Summary';
            $salerequests->po_ntp_files = $fileName;
            $salerequests->proposal_files = $fileName2;


            $salerequests->save();

            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'PO / NTP Upload', 'query' => $salerequests, 'created_at' => now()]
            );

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'PO / NTP Upload',
                    'query' => $salerequests,
                    'date_time' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 5)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'PO / NTP Uploaded',
                'body' => 'Purchase Order (PO) and Notice to Proceed (NTP) documents have been successfully uploaded for the project. ',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----

            return redirect('/po_ntp_header')->with('success', 'Transaction Success.');


        } else {
            $request->validate([
                'remarks' => 'required',
                'project_return' => 'required'
            ]);

            $salerequests = Salesrequest::find($id);

            if ($request->get('project_return') == 'Revenue') {
                $salerequests->status = 'Revenue Re-Mark Up';

                //-----Email Notification-----
                $emailToNotify = array_filter(DB::table('users')->where('role', 5)->where('active', 'yes')->pluck('email')->toArray());
                $emailData = [
                    'subject' => 'Revision Required',
                    'body' => 'Project has been returned to the Revenue team for revision. Please log in to the system and review the updates required.',
                    'title' => $salerequests->project_title,
                    'targetDate' => $salerequests->date_needed,
                    'status' => $salerequests->status,
                ];
                Mail::to($emailToNotify)->send(new EmailNotification($emailData));
                //-----Email Notification----
            } else if ($request->get('project_return') == 'Purchasing') {
                $salerequests->status = 'Purchasing Rebidding';
            } else if ($request->get('project_return') == 'PM') {
                $salerequests->status = 'PM -> Redesign';
                //-----Email Notification-----
                $emailToNotify = array_filter(DB::table('users')->where('role', 2)->where('active', 'yes')->pluck('email')->toArray());
                $emailData = [
                    'subject' => 'Revision Required',
                    'body' => 'Project has been returned to the PM Design team for revision. Please log in to the system and review the updates required.',
                    'title' => $salerequests->project_title,
                    'targetDate' => $salerequests->date_needed,
                    'status' => $salerequests->status,
                ];
                Mail::to($emailToNotify)->send(new EmailNotification($emailData));
                //-----Email Notification----
            }

            $salerequests->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'Sales Disapproved Proposal Revision',
                    'remarks' => $request->get('remarks'),
                    'query' => $salerequests, 'date_time' => now()]
            );
            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'PO / NTP Upload', 'query' => $salerequests, 'created_at' => now()]
            );


            return redirect('/po_ntp_header')->with('success', 'Update Successful.');
        }
    }

    public function release_proposal_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Sales Releasing of Proposal')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->orderBy('salesrequests.created_at', 'desc')
            ->get();


        return view('salesrequests.release_proposal_header', compact(['salesrequests']));
    }

    public function release_proposal_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();
//            dd($salesrequests,$biddingdetails,$mark_ups);

        return view('salesrequests.release_proposal_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function proof_upload(Request $request, $id)
    {
//        dd($request->all());
//        dd($request->proof_of_sending);
//        $allFiles = [];
        foreach ($request->proof_of_sending as $file) {
            if ($request->hasfile('proof_of_sending')) {
                $fileName = $file->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $file->storeAs('public/uploads', $fileName);

//                if (!empty($request->existing_proof_of_sending)) {
//                    $file_path = public_path() . '/storage/uploads/' . $request->existing_proof_of_sending;
//                    unlink($file_path);
//                }
                $allFiles[] = $fileName;
            } else if (!empty($request->existing_proof_of_sending)) {
                $fileName = $request->existing_proof_of_sending;
            } else {
                $request->validate([
                    'proof_of_sending' => 'required'
                ]);
            }
        }
        $allFilesStore = implode(',', $allFiles);
//        dd($allFiles,$allFilesStore);
        $salerequests = Salesrequest::find($id);
        $salerequests->status = 'Sales Proposal Status';
        $salerequests->proof_of_sending = $allFilesStore;


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Releasing of Proposal', 'query' => $salerequests, 'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Releasing of Proposal', 'query' => $salerequests, 'date_time' => now()]
        );


        //-----Email Notification-----
        $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'Sales Released Proposal and Uploaded Proof of Sending',
            'body' => 'Sales team has successfully released the proposal for the project and uploaded proof of sending.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,
        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        //-----Email Notification----

        return redirect('/release_proposal_header')->with('success', 'Proof of proposal uploaded.');
    }

    public function cancel_request($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->select('salesrequests.*', 'malls.mall_name')
            ->get();

        $users = DB::table('users')
            ->where('role', '=', 'PM')
            ->select('users.id', 'users.username')
            ->get();


        return view('salesrequests.cancel_request', compact('salesrequests'), compact('users'));
    }

    public function cancel_request_details(Request $request, $id)
    {
        $request->validate([
            'proof_of_cancellation' => 'required'
        ]);

        if ($request->hasfile('proof_of_cancellation')) {
            $fileName = request()->proof_of_cancellation->getClientOriginalName();
            $unique_id = uniqid();
            $fileName = $unique_id . '-' . $fileName;
            $request->proof_of_cancellation->storeAs('public/uploads', $fileName);
        } else {
            $fileName = '';
        }

        $salerequests = Salesrequest::find($id);
        $salerequests->status = 'Cancelled Project';
        $salerequests->proof_of_cancellation = $fileName;
        $salerequests->save();

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Cancel Sales Request', 'query' => $salerequests, 'date_time' => now()]
        );

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Cancel Sales Request', 'query' => $salerequests, 'created_at' => now()]
        );

        return redirect('/salesrequests')->with('success', 'Sales Request has been cancelled');
    }

    public function bid_summary_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Revenue Upload Contractor Bid Summary')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.bid_summary_header', compact(['salesrequests']));
    }

    public function bid_summary_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();
//            dd($salesrequests,$biddingdetails,$mark_ups);

        return view('salesrequests.bid_summary_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function bid_summary_upload(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        if ($request->get('approved_status') == 'Yes') {

            if ($request->hasfile('bid_summary_files')) {
                $fileName2 = request()->bid_summary_files->getClientOriginalName();
                $unique_id = uniqid();
                $fileName2 = $unique_id . '-' . $fileName2;
                $request->bid_summary_files->storeAs('public/uploads', $fileName2);

                if (!empty($request->bid_summary_files_exist)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->bid_summary_files_exist;
                    unlink($file_path);
                }
            } else if (!empty($request->bid_summary_files_exist)) {
                $fileName2 = $request->get('bid_summary_files_exist');
            } else {
                $request->validate([
                    'bid_summary_files' => 'required'
                ]);
            }

            $salerequests = Salesrequest::find($id);
//            $salerequests->status = 'Project Completion / Uploading of Documents';
            $salerequests->status = 'Upload CER';
            $salerequests->bid_summary_files = $fileName2;
            $salerequests->save();

            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Bid Summary Upload', 'query' => $salerequests, 'created_at' => now()]
            );

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Bid Summary Upload', 'query' => $salerequests, 'date_time' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Bid Summary Uploaded',
                'body' => 'Revenue team has uploaded the bid summary for the project.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----


            return redirect('/bid_summary_header')->with('success', 'Transaction Success.');
        } else {

            $request->validate([
                'remarks' => 'required',
            ]);

            $salerequests = Salesrequest::find($id);
            $salerequests->status = 'Sales Proposal Status';
            $salerequests->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Disapproved PO / NTP', 'remarks' => $request->get('remarks'), 'query' => $salerequests, 'date_time' => now()]
            );
            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Bid Summary Upload', 'query' => $salerequests, 'created_at' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 8)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Revenue Disapproved PO / NTP',
                'body' => 'Purchase Order (PO) and Notice to Proceed (NTP) documents uploaded for the project have been disapproved by the Revenue team.
                Log in to the system, review the feedback provided by the Revenue team, and take the necessary actions to rectify the identified issues.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----

            return redirect('bid_summary_header')->with('success', 'Review Success.');
        }
    }

    public function upload_cer_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', 'like', '%Upload CER%')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.upload_cer_header', compact(['salesrequests']));
    }

    public function upload_cer_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();
//        dd($salesrequests);

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();
//            dd($salesrequests,$biddingdetails,$mark_ups);

        return view('salesrequests.upload_cer_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function uploaded_cer(Request $request, $id)
    {
//        $request->validate([
//            'approved_status' => 'required'
//        ]);

//        if ($request->get('approved_status') == 'Yes') {

        if ($request->hasfile('cer_files')) {
            $fileName2 = request()->cer_files->getClientOriginalName();
            $unique_id = uniqid();
            $fileName2 = $unique_id . '-' . $fileName2;
            $request->cer_files->storeAs('public/uploads', $fileName2);

            if (!empty($request->cer_files_exist)) {
                $file_path = public_path() . '/storage/uploads/' . $request->cer_files_exist;
                unlink($file_path);
            }
        } else if (!empty($request->cer_files_exist)) {
            $fileName2 = $request->get('cer_files_exist');
        } else {
            $request->validate([
                'cer_files' => 'required'
            ]);
        }

        $salerequests = Salesrequest::find($id);
//            $salerequests->status = 'Project Completion / Uploading of Documents';
        $salerequests->status = 'Release NTP PO to Winning Contractor';
        $salerequests->cer_files = $fileName2;
        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'CER Upload', 'query' => $salerequests, 'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'CER Upload', 'query' => $salerequests, 'date_time' => now()]
        );

        //-----Email Notification-----
        $emailToNotify = array_filter(DB::table('users')->where('role', 4)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'CER Uploaded',
            'body' => 'Admin uploaded the CER for the project.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,
        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        //-----Email Notification----


        return redirect('/upload-cer-header')->with('success', 'Upload Success.');
//        } else {
//
//            $request->validate([
//                'remarks' => 'required',
//            ]);
//
//            $salerequests = Salesrequest::find($id);
//            $salerequests->status = 'Sales Proposal Status';
//            $salerequests->save();
//
//            DB::table('request_logs')->insert(
//                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Disapproved PO / NTP', 'remarks' => $request->get('remarks'), 'query' => $salerequests, 'date_time' => now()]
//            );
//            DB::table('logs')->insert(
//                ['user_id' => Auth::user()->id, 'form' => 'Bid Summary Upload', 'query' => $salerequests, 'created_at' => now()]
//            );
//
//            //-----Email Notification-----
//            $emailToNotify = array_filter(DB::table('users')->where('role', 8)->where('active', 'yes')->pluck('email')->toArray());
//            $emailData = [
//                'subject' => 'Revenue Disapproved PO / NTP',
//                'body' => 'Purchase Order (PO) and Notice to Proceed (NTP) documents uploaded for the project have been disapproved by the Revenue team.
//                Log in to the system, review the feedback provided by the Revenue team, and take the necessary actions to rectify the identified issues.',
//                'title' => $salerequests->project_title,
//                'targetDate' => $salerequests->date_needed,
//                'status' => $salerequests->status,
//            ];
//            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        //-----Email Notification----

        return redirect('bid_summary_header')->with('success', 'Review Success.');
//        }
    }

    public function release_pontp_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', 'like', '%Release NTP PO%')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.release_pontp_header', compact(['salesrequests']));
    }

    public function release_pontp_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();
//        dd($salesrequests);

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();
//            dd($salesrequests,$biddingdetails,$mark_ups);

        return view('salesrequests.release_pontp_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function released_pontp(Request $request, $id)
    {
//        if ($request->hasfile('cer_files')) {
//            $fileName2 = request()->cer_files->getClientOriginalName();
//            $unique_id = uniqid();
//            $fileName2 = $unique_id . '-' . $fileName2;
//            $request->cer_files->storeAs('public/uploads', $fileName2);
//
//            if (!empty($request->cer_files_exist)) {
//                $file_path = public_path() . '/storage/uploads/' . $request->cer_files_exist;
//                unlink($file_path);
//            }
//        } else if (!empty($request->cer_files_exist)) {
//            $fileName2 = $request->get('cer_files_exist');
//        } else {
//            $request->validate([
//                'cer_files' => 'required'
//            ]);
//        }

        $salerequests = Salesrequest::find($id);
        $salerequests->status = 'Project Completion / Uploading of Documents';
//        $salerequests->status = 'Release NTP PO to Winning Contractor';
//        $salerequests->cer_files = $fileName2;
        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'NTP PO Released to Contractor', 'query' => $salerequests, 'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'NTP PO Released to Contractor', 'query' => $salerequests, 'date_time' => now()]
        );

        //-----Email Notification-----
        $emailToNotify = array_filter(DB::table('users')/*->where('role', 4)*/ ->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'NTP PO Released to Contractor',
            'body' => 'NTP PO Released to winning contractor.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,
        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        //-----Email Notification----

        return redirect('/release-pontp-header')->with('success', 'Success.');
    }

    public function cer_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Purchasing Upload of CER')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

            ->get();


        return view('salesrequests.cer_header', compact(['salesrequests']));
    }

    public function cer_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file')
            ->get();

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->where('bid_status', '=', '1')
            ->select('biddingdetails.*')
            ->get();

        $mark_ups = DB::table('mark_ups')
            ->where('sales_request_id', '=', $id)
            ->select('mark_ups.*')
            ->get();

        return view('salesrequests.cer_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function cer_upload(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        if ($request->get('approved_status') == 'Yes') {

            if ($request->hasfile('cer_files')) {
                $fileName2 = request()->cer_files->getClientOriginalName();
                $unique_id = uniqid();
                $fileName2 = $unique_id . '-' . $fileName2;
                $request->cer_files->storeAs('public/uploads', $fileName2);
            } else if (!empty($request->cer_files_exist)) {
                $fileName2 = $request->get('cer_files_exist');
            } else {
                $request->validate([
                    'cer_files' => 'required'
                ]);
            }

            $salerequests = Salesrequest::find($id);
            $salerequests->status = 'PM/Revenue Uploading of Progress';
            $salerequests->cer_files = $fileName2;
            $salerequests->save();

            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Cer Upload', 'query' => $salerequests, 'created_at' => now()]
            );

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Cer Upload', 'query' => $salerequests, 'date_time' => now()]
            );

            return redirect('/cer_header')->with('success', 'Transaction Success.');
        } else {
            $request->validate([
                'remarks' => 'required',
            ]);

            $salerequests = Salesrequest::find($id);
            $salerequests->status = 'Revenue Upload Contractor Bid Summary';
            $salerequests->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Purchasing Disapproved Bid Summary', 'remarks' => $request->get('remarks'), 'query' => $salerequests, 'date_time' => now()]
            );
            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Cer Upload', 'query' => $salerequests, 'created_at' => now()]
            );

            return redirect('/cer_header')->with('success', 'Transaction Success.');
        }
    }

    public function viewprojectstatus()
    {
        $salesrequests = DB::table('salesrequests')
            ->take(100)
//            ->where('status', '=', 'none')
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code',
//                DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))

                DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
            ->get();

        return view('salesrequests.viewprojectstatus', compact(['salesrequests']));
    }

    public function viewprojectfiles()
    {
        $salesrequests = DB::table('salesrequests')
            ->take(100)
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->select('salesrequests.*', 'malls.mall_name', 'projects.project_id', 'biddings.bid_file', 'mark_ups.mark_up_file', 'mark_ups.pnl_file')
            ->get();

        return view('salesrequests.viewprojectfiles', compact(['salesrequests']));
    }

    public function viewprojectstatus_usr(Request $request)
    {
        $user_search = $request->get('usr_search');
        $search_opt = $request->get('search_opt');


        $salesrequests = DB::table('salesrequests')
            ->orderBy('salesrequests.created_at', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'malls.mall_name', 'projects.remarks', 'projects.project_code', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
;

        if ($search_opt == 'mall_name') {
            $salesrequests = $salesrequests->where('malls.mall_name', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'sales_request_code') {
            $salesrequests = $salesrequests->where('salesrequests.sales_request_code', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'project_title') {
            $salesrequests = $salesrequests->where('salesrequests.project_title', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'status') {
            $salesrequests = $salesrequests->where('salesrequests.status', 'like', '%' . $user_search . '%');
        }
        $salesrequests = $salesrequests->get();
//            dd($salesrequests);

        return view('salesrequests.viewprojectstatus', compact(['salesrequests']));
    }

    public function viewprojectfiles_usr(Request $request)
    {
        $user_search = $request->get('usr_search');
        $search_opt = $request->get('search_opt');

        $salesrequests = DB::table('salesrequests')
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->select('salesrequests.*', 'malls.mall_name', 'projects.project_id', 'biddings.bid_file', 'mark_ups.mark_up_file', 'mark_ups.pnl_file');

        if ($search_opt == 'mall_name') {
            $salesrequests = $salesrequests->where('malls.mall_name', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'sales_request_code') {
            $salesrequests = $salesrequests->where('salesrequests.sales_request_code', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'project_title') {
            $salesrequests = $salesrequests->where('salesrequests.project_title', 'like', '%' . $user_search . '%');
        }
        $salesrequests = $salesrequests->get();

        return view('salesrequests.viewprojectfiles', compact(['salesrequests']));
    }

    public function viewdocs()
    {
        $salesrequests = DB::table('salesrequests')
            ->take(100)
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->select('salesrequests.*', 'malls.mall_name', 'projects.project_id')
            ->get();

        return view('salesrequests.viewdocs', compact(['salesrequests']));
    }

    public function viewdocs_usr(Request $request)
    {
        $user_search = $request->get('usr_search');
        $search_opt = $request->get('search_opt');

        $salesrequests = DB::table('salesrequests')
            ->orderBy('sales_request_id', 'desc')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->select('salesrequests.*', 'malls.mall_name', 'projects.project_id');

        if ($search_opt == 'mall_name') {
            $salesrequests = $salesrequests->where('malls.mall_name', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'sales_request_code') {
            $salesrequests = $salesrequests->where('salesrequests.sales_request_code', 'like', '%' . $user_search . '%');
        } else if ($search_opt == 'project_title') {
            $salesrequests = $salesrequests->where('salesrequests.project_title', 'like', '%' . $user_search . '%');
        }
        $salesrequests = $salesrequests->get();

        return view('salesrequests.viewdocs', compact(['salesrequests']));
    }

    public function uploadfiles_details($id)
    {
        //$salesrequests = Salesrequest::find($id);
        $salesrequests = DB::table('salesrequests')
            ->where('sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->select('salesrequests.*', 'malls.mall_name')
            ->get();

        $malls = DB::table('malls')
            ->where('mall_id', '!=', $id)
            ->select('malls.mall_id', 'malls.mall_name')
            ->get();

        return view('salesrequests.uploadfiles_details', compact('salesrequests'), compact('malls'));
    }

    public function uploadfiles(Request $request, $id)
    {

        if (Auth::user()->role == '4' || Auth::user()->role == '5') {
            // contractor_ntp
            if ($request->hasfile('contractor_ntp')) {
                $fileName = $request->contractor_ntp->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->contractor_ntp->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_contractor_ntp)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_contractor_ntp;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_contractor_ntp)) {
                $fileName = $request->existing_contractor_ntp;
            } else {
                $fileName = '';
            }

            //contractor_po

            if ($request->hasfile('contractor_po')) {
                $fileName3 = $request->contractor_po->getClientOriginalName();
                $unique_id = uniqid();
                $fileName3 = $unique_id . '-' . $fileName3;
                $request->contractor_po->storeAs('public/uploads', $fileName3);

                if (!empty($request->existing_contractor_po)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_contractor_po;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_contractor_po)) {
                $fileName3 = $request->existing_contractor_po;
            } else {
                $fileName3 = '';
            }

            // cari
            if ($request->hasfile('cari')) {
                $fileName4 = $request->cari->getClientOriginalName();
                $unique_id = uniqid();
                $fileName4 = $unique_id . '-' . $fileName4;
                $request->cari->storeAs('public/uploads', $fileName4);

                if (!empty($request->existing_cari)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_cari;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_cari)) {
                $fileName4 = $request->existing_cari;
            } else {
                $fileName4 = '';
            }

        } else {


            //Cer

            if ($request->hasfile('cer_files')) {
                $fileName2 = $request->cer_files->getClientOriginalName();
                $unique_id = uniqid();
                $fileName2 = $unique_id . '-' . $fileName2;
                $request->cer_files->storeAs('public/uploads', $fileName2);

                if (!empty($request->existing_cer_files)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_cer_files;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_cer_files)) {
                $fileName2 = $request->existing_cer_files;
            } else {
                $fileName2 = '';
            }

            // 1st COPA
            if ($request->hasfile('first_copa')) {
                $fileName5 = $request->first_copa->getClientOriginalName();
                $unique_id = uniqid();
                $fileName5 = $unique_id . '-' . $fileName5;
                $request->first_copa->storeAs('public/uploads', $fileName5);

                if (!empty($request->existing_first_copa)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_first_copa;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_first_copa)) {
                $fileName5 = $request->existing_first_copa;
            } else {
                $fileName5 = '';
            }

            // 2nd COPA
            if ($request->hasfile('second_copa')) {
                $fileName6 = $request->second_copa->getClientOriginalName();
                $unique_id = uniqid();
                $fileName6 = $unique_id . '-' . $fileName6;
                $request->second_copa->storeAs('public/uploads', $fileName6);

                if (!empty($request->existing_second_copa)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_second_copa;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_second_copa)) {
                $fileName6 = $request->existing_second_copa;
            } else {
                $fileName6 = '';
            }

            //coca

            if ($request->hasfile('coca')) {
                $fileName7 = $request->coca->getClientOriginalName();
                $unique_id = uniqid();
                $fileName7 = $unique_id . '-' . $fileName7;
                $request->coca->storeAs('public/uploads', $fileName7);

                if (!empty($request->existing_coca)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_coca;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_coca)) {
                $fileName7 = $request->existing_coca;
            } else {
                $fileName7 = '';
            }

        }

        $salerequests = Salesrequest::find($id);
        if (Auth::user()->role == '4' || Auth::user()->role == '5') {
            $salerequests->contractor_ntp = $fileName;
            $salerequests->contractor_po = $fileName3;
            $salerequests->cari = $fileName4;
        } else {
            $salerequests->cer_files = $fileName2;
            $salerequests->first_copa = $fileName5;
            $salerequests->second_copa = $fileName6;
            $salerequests->coca = $fileName7;
        }
        if ($request->hasfile('coca')) {
            $salerequests->status = 'Project Completed';
        }
        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Uploaded Documents', 'query' => '$salerequests', 'created_at' => now()]
        );

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Uploaded Documents', 'query' => '$salerequests', 'date_time' => now()]
        );

        return redirect('/viewdocs')->with('success', 'Successfully Updated Documents');
    }

    public function viewDesign($id)
    {

        $showCounts = Project::where('sales_request_id', $id)->count();
        if ($showCounts > 0) {
            $result = DB::table('projects')->select('project_id')->where('sales_request_id', $id)->first();
            $id2 = $result->project_id;

            $showCounts2 = DB::table('boms')->where('project_id', $id2)->count();
            $showCounts3 = DB::table('slds')->where('project_id', $id2)->count();
            $showCounts4 = DB::table('layouts')->where('project_id', $id2)->count();

            $boms = DB::table('boms')
                ->select('bom_file')
                ->where('project_id', '=', $id2)
                ->get();

            $view_return1 = "<table class='table table-hover'>
    <thead>
        <tr>
            <th>Bill of Material</th>
        </tr>
    </thead>
    <tbody>";
            $view_return2 = '';
            foreach ($boms as $bom) {
                $bom_file = $bom->bom_file;
                $view_return2 .= "<tr>
        <td><a href='/storage/uploads/$bom_file' download><b>$bom_file</b></a></td>
    </tr>";
            }
            $view_return3 = "</tbody>
</table>";

            $slds = DB::table('slds')
                ->select('sld_file')
                ->where('project_id', '=', $id2)
                ->get();

            $view_return4 = "<table class='table table-hover'>
    <thead>
        <tr>
            <th>SLD</th>
        </tr>
    </thead>
    <tbody>";
            $view_return5 = '';
            foreach ($slds as $sld) {
                $sld_file = $sld->sld_file;
                $view_return5 .= "<tr>
        <td><a href='/storage/uploads/$sld_file' download><b>$sld_file</b></a></td>
    </tr>";
            }
            $view_return6 = "</tbody>
</table>";


            $layouts = DB::table('layouts')
                ->select('layout_file')
                ->where('project_id', '=', $id2)
                ->get();

            $view_return7 = "<table class='table table-hover'>
            <thead> <tr>
            <th>Layout</th></tr> </thead>
            <tbody>";
            $view_return8 = '';
            foreach ($layouts as $layout) {
                $layout_file = $layout->layout_file;

                $view_return8 = $view_return8 . "<tr><td><a href='/storage/uploads/$layout_file' download><b>$layout_file</a>  </td></tr>";
            }

            $view_return9 = "</tbody>
                </table>";


            if ($showCounts2 == 0 && $showCounts3 == 0 && $showCounts4 == 0) {
                $view_return = '<h2>NO PROJECT DESIGN AVAILABLE</h2>';
            } else {
                $view_return = $view_return1 . $view_return2 . $view_return3 . $view_return4 . $view_return5 . $view_return6 . $view_return7 . $view_return8 . $view_return9;
            }
        } else {
            $view_return = '<h2>NO PROJECT DESIGN AVAILABLE</h2>';
        }
        return $view_return;
    }

    public function viewlogs()
    {
        $request_logs = DB::table('request_logs')
            ->orderBy('request_logs.id', 'desc')
            ->select('request_logs.action', 'request_logs.remarks', 'request_logs.date_time', 'users.username', 'salesrequests.project_title')
            ->leftJoin('users', 'request_logs.user_id', '=', 'users.id')
            ->leftJoin('salesrequests', 'salesrequests.sales_request_id', '=', 'request_logs.sales_request_id')
            ->get();

        return view('salesrequests.viewlogs', compact(['request_logs']));
    }

    public function viewprojectpdf()
    {
        return view('viewprojectpdf');
    }

    public function addMore()
    {
        return view("addMore");
    }

    public function addMorePost(Request $request)
    {
        $rules = [];

        foreach ($request->input('name') as $key => $value) {
            $rules["name.$key}"] = 'required';
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->passes()) {


            foreach ($request->input('name') as $key => $value) {
                TagList::create(['name' => $value]);
            }

            return response()->json(['success' => 'done']);
        }

        return response()->json(['error' => $validator->errors()->all()]);
    }


}
