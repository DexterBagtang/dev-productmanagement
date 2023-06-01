<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Project;
use App\Salesrequest;
use App\Sld;
use App\Bom;
use App\Bidding;
use App\Biddingdetail;
use App\Layout;
use App\Mark_up;
use App\Request_log;
use DB;
use Auth;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class BiddingController extends Controller
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
    public function index($id)
    {
        $result = DB::table('users')->select('role')->where('id', $id)->first();
        $role = $result->role;

        if ($role == '4') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.status', '=', 'Purchasing Bidding')
                ->orwhere('salesrequests.status', '=', 'Purchasing Rebidding')
                ->orWhere('salesrequests.status', '=', 'Purchasing Rebidding(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        } else if ($role == '3') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.status', '=', 'PM Review Bidders')
                ->orWhere('salesrequests.status', '=', 'PM Review Bidders(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        } else if ($role == '5') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.status', '=', 'Revenue Mark Up')
                ->orwhere('salesrequests.status', '=', 'Revenue Re-Mark Up')
                ->orWhere('salesrequests.status', '=', 'Revenue Re-Mark Up(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        } else {
            $salesrequests = DB::table('salesrequests')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        }
//    dd($salesrequests,$role);

        return view('biddings.viewbidding', compact(['salesrequests']))->with('role', $role);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('projects.project_id', '=', $id)
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->select('salesrequests.*', 'users.username', 'projects.project_code', 'projects.project_id')
            ->get();

        $boms = DB::table('boms')
            ->where('project_id', '=', $id)
            ->select('boms.*')
            ->get();

        $slds = DB::table('slds')
            ->where('project_id', '=', $id)
            ->select('slds.*')
            ->get();

        $layouts = DB::table('layouts')
            ->where('project_id', '=', $id)
            ->select('layouts.*')
            ->get();

        $result = DB::table('projects')->select('sales_request_id')->where('project_id', $id)->first();
        $sales_request_id = $result->sales_request_id;

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $sales_request_id)->first();
        $bidding_id = $result->bidding_id;

        $biddings = DB::table('biddingdetails')
            ->where('bidding_id', '=', $bidding_id)
            ->select('biddingdetails.*')
            ->get();

        return view('biddings.viewbiddingdetails', compact('salesrequests'))->with('boms', $boms)->with('slds', $slds)->with('layouts', $layouts)->with('biddings', $biddings);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('projects.project_id', '=', $id)
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->select('salesrequests.*', 'users.username', 'projects.project_code', 'projects.project_id', 'biddings.*')
            ->get();

        $boms = DB::table('boms')
            ->where('project_id', '=', $id)
            ->select('boms.*')
            ->get();

        $slds = DB::table('slds')
            ->where('project_id', '=', $id)
            ->select('slds.*')
            ->get();

        $layouts = DB::table('layouts')
            ->where('project_id', '=', $id)
            ->select('layouts.*')
            ->get();

        $result = DB::table('projects')->select('sales_request_id')->where('project_id', $id)->first();
        $sales_request_id = $result->sales_request_id;

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $sales_request_id)->first();
        $bidding_id = $result->bidding_id;

        $biddings = DB::table('biddingdetails')
            ->where('bidding_id', '=', $bidding_id)
            ->select('biddingdetails.*')
            ->get();
//            dd($salesrequests,$boms,$slds,$layouts,$biddings);

        return view('biddings.editbidding', compact('salesrequests'))->with('boms', $boms)->with('slds', $slds)->with('layouts', $layouts)->with('biddings', $biddings);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $result = DB::table('biddings')->select('bidding_id', 'revision')->where('sales_request_id', $id)->first();
        $bidding_id = $result->bidding_id;
        $revision = $result->revision;

        //remove old uploads
        DB::table('biddingdetails')->where('bidding_id', '=', $bidding_id)->delete();


        //Bidders uploads
        for ($i = 0; $i < count($request->contractor_name); $i++) {

            $contractor_name = $request->contractor_name[$i];
            $total_cost = $request->total_cost[$i];
            $bid_trade = $request->bid_trade[$i];
            $biddingdetails = new Biddingdetail([
                'bidding_id' => $bidding_id,
                'contractor_name' => $contractor_name,
                'total_cost' => $total_cost,
                'bid_trade' => $bid_trade
            ]);
            $biddingdetails->save();
            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Upload Bidders', 'query' => $biddingdetails, 'created_at' => now()]
            );
        }


        //bidding update
        if ($revision == '1') {
            $salesrequest_status = 'Revenue Mark Up';
        } else {
            $salesrequest_status = 'PM Review Bidders';
        }

        $salerequests = Salesrequest::find($id);
        $salerequests->status = $salesrequest_status;
        $salerequests->save();


        if ($request->hasfile('bid_file')) {
            $bidFile = $request->bid_file->getClientOriginalName();
            $unique_id = uniqid();
            $bidFile = $unique_id . '-' . $bidFile;
            $request->bid_file->storeAs('public/uploads', $bidFile);

            if (!empty($request->existing_bid_file)) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_bid_file;
                unlink($file_path);
            }
        } else if (!empty($request->existing_bid_file)) {
            $bidFile = $request->existing_bid_file;
        } else {
            $bidFile = '';
        }


        if ($request->hasfile('bid_file_revenue')) {
            $bidFileRevenue = $request->bid_file_revenue->getClientOriginalName();
            $unique_id = uniqid();
            $bidFileRevenue = $unique_id . '-' . $bidFileRevenue;
            $request->bid_file_revenue->storeAs('public/uploads', $bidFileRevenue);

            if (!empty($request->existing_bid_file_revenue)) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_bid_file_revenue;
                unlink($file_path);
            }
        } else if (!empty($request->existing_bid_file_revenue)) {
            $bidFileRevenue = $request->existing_bid_file_revenue;
        } else {
            $bidFileRevenue = '';
        }

        $biddings = Bidding::find($bidding_id);
        $biddings->purchasing_uploader = Auth::user()->id;
        $biddings->bid_file = $bidFile;
        $biddings->bid_file_revenue = $bidFileRevenue;
        $biddings->revision = '';
        $biddings->save();

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Upload Bidders', 'query' => $biddingdetails, 'date_time' => now()]
        );


        /*email notification*/
        $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'Bidders Updated - Review Bidding',
            'body' => ' Bidders have been updated for the project. Please log in to the system and review the bidders\' details.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,

        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        /*end of email notification*/

        return redirect('/bidding_index' . Auth::user()->id)->with('success', 'Upload Success');
    }

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

    public function pm_approve_bidder_detail($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.*')
            ->get();

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->select('biddingdetails.*')
            ->get();
//            dd($salesrequests,$biddingdetails);

        return view('biddings.approvebidder', compact('salesrequests'))->with('biddingdetails', $biddingdetails);
    }

    public function pm_approved_bidding(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ], [
            'approved_status.required' => 'You have to select a bid winner !'
        ]);

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $bidding_id = $result->bidding_id;

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {
            $request->validate([
                'bidder' => 'required'
            ]);

            Biddingdetail::where('bidding_id', $bidding_id)
                ->update(['bid_status' => '']);
            for ($i = 0; $i < count($request->bidder); $i++) {
                $bidder = $request->bidder[$i];

                $biddingdetails = Biddingdetail::find($bidder);
                $biddingdetails->bid_status = '1';
                $biddingdetails->save();
            }

            $salerequests->status = 'Revenue Mark Up';
            $biddings = Bidding::find($bidding_id);
            $biddings->pm_remarks_yes = $request->get('remarks');
            $biddings->pm_supervisor_id = Auth::user()->id;
            $biddings->save();


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'PM Approved/Choose Bid Winner',
                    'remarks' => $request->get('remarks'),
                    'query' => $biddings, 'date_time' => now()]
            );

            $emailToNotify = array_filter(DB::table('users')->where('role', 5)->where('active', 'yes')->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Approved Bidders',
                'body' => 'Review of the bidders for the project has been approved. Kindly log in to the system to proceed with the next steps in the project.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

            Mail::to($emailToNotify)->send(new EmailNotification($emailData));

        } else {

            $request->validate([
                'remarks' => 'required',
            ]);
            $salerequests->status = 'Purchasing Rebidding';
            $biddings = Bidding::find($bidding_id);
            $biddings->pm_remarks = $request->get('remarks');
            $biddings->pm_supervisor_id = Auth::user()->id;
            $biddings->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'PM Disapproved Bidding', 'remarks' => $request->get('remarks'), 'query' => $biddings, 'date_time' => now()]
            );

            $emailToNotify = array_filter(DB::table('users')->where('role', 4)->where('active', 'yes')->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Disapproved Bidders',
                'body' => 'Review of the bidders for the project has been disapproved. Please log in to the system to review the details and make the necessary adjustments or provide feedback.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Approve Bidding', 'query' => $salerequests, 'created_at' => now()]
        );

        return redirect('/bidding_index' . Auth::user()->id)->with('success', 'Bidding has been reviewed');
    }

    public function revenue_approve_bidder_detail($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'mark_ups.mark_up_file',
                'mark_ups.project_size', 'biddings.bid_file', 'biddings.bid_file_revenue', 'biddings.pm_remarks_yes', 'mark_ups.pnl_file', 'biddings.bid_file_revenue')
            ->get();
//        dd($salesrequests);

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $id2 = $result->bidding_id;

        $biddingdetails = DB::table('biddingdetails')
            ->where('bidding_id', '=', $id2)
            ->select('biddingdetails.*')
            ->get();
//            dd($salesrequests,$biddingdetails);

        return view('biddings.revenueapprove', compact('salesrequests'))->with('biddingdetails', $biddingdetails);
    }

    public function revenue_approved_bidding(Request $request, $id)
    {
//        dd($request->all());
        $request->validate([
            'approved_status' => 'required'
        ]);

        $result = DB::table('biddings')->select('bidding_id')->where('sales_request_id', $id)->first();
        $bidding_id = $result->bidding_id;

        if (Mark_up::where('sales_request_id', $id)->count() > 0) {
            $result = DB::table('mark_ups')->select('mark_up_id')->where('sales_request_id', $id)->first();
            $mark_up_id = $result->mark_up_id;
        }

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {
            $request->validate([
                'project_size' => 'required'
            ]);

            if ($request->hasfile('mark_up_file')) {
                $fileName = request()->mark_up_file->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->mark_up_file->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_mark_up_file)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_mark_up_file;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_mark_up_file)) {
                $fileName = $request->existing_mark_up_file;
            } else {
                $request->validate([
                    'mark_up_file' => 'required'
                ]);
                $fileName = '';
            }

            if ($request->hasfile('pnl_file')) {
                $fileNamepnl = $request->pnl_file->getClientOriginalName();
                $unique_id = uniqid();
                $fileNamepnl = $unique_id . '-' . $fileNamepnl;
                $request->pnl_file->storeAs('public/uploads', $fileNamepnl);

                if (!empty($request->existing_pnl_file)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_pnl_file;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_pnl_file)) {
                $fileNamepnl = $request->existing_pnl_file;
            } else {
                $request->validate([
                    'pnl_file' => 'required'
                ]);
                $fileNamepnl = '';
            }


            $salerequests->status = 'PM Mark Up Technical Check';

            if (Mark_up::where('sales_request_id', $id)->count() <= 0) {
                $mark_ups = new Mark_up([
                    'sales_request_id' => $id,
                    'markup_uploader' => Auth::user()->id,
                    'mark_up_file' => $fileName,
                    'pnl_file' => $fileNamepnl,
                    'project_size' => $request->get('project_size')
                ]);
                $mark_ups->save();

            } else {
                $mark_ups = Mark_up::find($mark_up_id);
                $mark_ups->markup_uploader = Auth::user()->id;
                $mark_ups->mark_up_file = $fileName;
                $mark_ups->pnl_file = $fileNamepnl;
                $mark_ups->project_size = $request->get('project_size');
                $mark_ups->save();
            }

//            dd($mark_ups);

            Biddingdetail::where('bidding_id', $bidding_id)
                ->update(['bid_status' => '']);

            if (isset($request->bidder)) {
                for ($i = 0; $i < count($request->bidder); $i++) {
                    $bidder = $request->bidder[$i];

                    $biddingdetails = Biddingdetail::find($bidder);
                    $biddingdetails->bid_status = '1';
                    $biddingdetails->save();
                }
            }

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Approved/Choose Bid Winner', 'query' => 'logs', 'date_time' => now()]
            );

            $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Technical Check Required',
                'body' => 'Revenue team has completed the markup and has uploaded the necessary files for the project. Please login and review project. ',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

            Mail::to($emailToNotify)->send(new EmailNotification($emailData));

        } else {

            $request->validate([
                'remarks' => 'required'
            ]);

            if (Mark_up::where('sales_request_id', $id)->count() <= 0) {

                $mark_ups = new Mark_up([
                    'sales_request_id' => $id,
                    'markup_uploader' => Auth::user()->id,
                    'mark_up_remarks' => $request->get('remarks')
                ]);
                $mark_ups->save();

            } else {
                $mark_ups = Mark_up::find($mark_up_id);
                $mark_ups->markup_uploader = Auth::user()->id;
                $mark_ups->mark_up_remarks = $request->get('remarks');
                $mark_ups->save();
            }

            $result = DB::table('salesrequests')->select('category')->where('sales_request_id', $id)->first();
            $category = $result->category;

            if ($category == 'Special') {
                $salerequests->status = 'Sales -> Disapproved';
            } else {
                $salerequests->status = 'Purchasing Rebidding';
            }
            $biddings = Bidding::find($bidding_id);
            $biddings->remarks_id = '2';
            $biddings->revision = $request->get('revision');
            $biddings->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Disapproved Bidding', 'remarks' => $request->get('remarks'), 'query' => $biddings, 'date_time' => now()]
            );

            $emailToNotify = array_filter(DB::table('users')->where('role', 4)->where('active', 'yes')->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Revenue Disapproved',
                'body' => 'Please log in to the system to review the feedback provided and take necessary actions to address the disapproval.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Revenue Approve Bidding', 'query' => '$salerequests', 'created_at' => now()]
        );

        return redirect('/bidding_index' . Auth::user()->id)->with('success', 'Review Success');
    }

    public function pm_technicalcheck_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'PM Mark Up Technical Check')
            ->orWhere('salesrequests.status', 'like', '%PM Mark Up Technical Check%')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
            ->orderBy('salesrequests.created_at', 'desc')
            ->get();


        return view('biddings.pm_technical_check', compact(['salesrequests']));
    }

    public function pm_technicalcheck_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'mark_ups.mark_up_file', 'biddings.bid_file')
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

        return view('biddings.pm_technicalcheck_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function pm_approved_markup(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        $result = DB::table('mark_ups')->select('mark_up_id')->where('sales_request_id', $id)->first();
        $mark_up_id = $result->mark_up_id;

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {
            $salerequests->status = 'Revenue Head Unit for Checking';
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->pm_supervisor_id = Auth::user()->id;
            $mark_ups->pm_remarks_yes = $request->get('remarks');
            $mark_ups->pm_status = 'Yes';
            $mark_ups->save();


            DB::table('request_logs')->insert([
                'user_id' => Auth::user()->id,
                'sales_request_id' => $id,
                'action' => 'PM Approved Technical Checking',
                'remarks' => $request->get('remarks'),
                'query' => $mark_ups, 'date_time' => now()
            ]);
            $emailToNotify = array_filter(DB::table('users')->where('role', 6)->where('active', 'yes')->pluck('email')->toArray());

            $emailData = [
                'subject' => 'Technical Check Approved',
                'body' => 'PM Supervisor has approved the technical check for the project. Please log in to the system to review project and take any necessary actions.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];

            Mail::to($emailToNotify)->send(new EmailNotification($emailData));

        } else {
            $request->validate([
                'remarks' => 'required'
            ]);
            $salerequests->status = 'Revenue Re-Mark Up';
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->pm_supervisor_id = Auth::user()->id;
            $mark_ups->pm_status = 'No';
            $mark_ups->pm_remarks = $request->get('remarks');
            $mark_ups->save();


            DB::table('request_logs')->insert(
                [
                    'user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'PM Disapproved Technical Checking',
                    'remarks' => $request->get('remarks'),
                    'query' => $mark_ups, 'date_time' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 5)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Technical Check Disapproved',
                'body' => 'PM Supervisor has disapproved the technical check for the project.
                Please log in to the system to review the feedback provided and take necessary actions to address the disapproval.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Approval Technical Checking', 'query' => $salerequests, 'created_at' => now()]
        );

        return redirect('/pm_technicalcheck_header')->with('success', 'Technical Checking Done');
    }

    public function revenue_head_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Revenue Head Unit for Checking')
            ->orwhere('salesrequests.status', '=', 'Revenue Head Unit for Checking(Revision)')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
            ->get();


        return view('biddings.revenue_head_header', compact(['salesrequests']));
    }

    public function revenue_head_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'biddings.bid_file_revenue',
                'mark_ups.mark_up_file', 'mark_ups.pm_remarks_yes', 'mark_ups.pnl_file')
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

        return view('biddings.revenue_head_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function revenue_head_approved_markup(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        $result = DB::table('mark_ups')->select('mark_up_id')->where('sales_request_id', $id)->first();
        $mark_up_id = $result->mark_up_id;

        $result = DB::table('mark_ups')->select('project_size')->where('sales_request_id', $id)->first();
        $project_size = $result->project_size;

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {


            if ($project_size == 'Small') {
                $salerequests->status = 'Sales Releasing of proposal';

                //-----Email Notification-----
                $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
                $emailData = [
                    'subject' => 'Revenue Head Check Approved - Sales Release of Proposal',
                    'body' => 'Revenue Head reviewed the project and approved the proposal',
                    'title' => $salerequests->project_title,
                    'targetDate' => $salerequests->date_needed,
                    'status' => $salerequests->status,
                ];
                Mail::to($emailToNotify)->send(new EmailNotification($emailData));
                //-----Email Notification----
            } else if ($project_size == 'Big') {
                $salerequests->status = 'Finance Head Mark Up Approval';

                //-----Email Notification-----
                $emailToNotify = array_filter(DB::table('users')->where('role', 7)->where('active', 'yes')->pluck('email')->toArray());
                $emailData = [
                    'subject' => 'Revenue Head Check Approved - Finance Head Check',
                    'body' => 'The Revenue Head has reviewed and approved the proposal, and now it is necessary for the Finance Head to review the project. Please login to the system and check the project',
                    'title' => $salerequests->project_title,
                    'targetDate' => $salerequests->date_needed,
                    'status' => $salerequests->status,
                ];
                Mail::to($emailToNotify)->send(new EmailNotification($emailData));
                //-----Email Notification----
            }

//            if ($request->hasfile('pnl_file')) {
//                $fileName = $request->pnl_file->getClientOriginalName();
//                $unique_id = uniqid();
//                $fileName = $unique_id . '-' . $fileName;
//                $request->pnl_file->storeAs('public/uploads', $fileName);
//
//                if (!empty($request->existing_pnl_file)) {
//                    $file_path = public_path() . '/storage/uploads/' . $request->existing_pnl_file;
//                    unlink($file_path);
//                }
//            } else if (!empty($request->existing_pnl_file)) {
//                $fileName = $request->existing_pnl_file;
//            } else {
//                $request->validate([
//                    'pnl_file' => 'required'
//                ]);
//            }
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->rev_head_id = Auth::user()->id;
            $mark_ups->rev_head_status = 'Yes';
//            $mark_ups->pnl_file = $fileName;
            $mark_ups->save();


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Head Approved Mark Up', 'query' => $mark_ups, 'date_time' => now()]
            );

        } else {
            $request->validate([
                'remarks' => 'required'
            ]);
            $salerequests->status = 'Revenue Re-Mark Up';
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->rev_head_id = Auth::user()->id;
            $mark_ups->rev_head_status = 'No';
            $mark_ups->rev_head_remarks = $request->get('remarks');
            $mark_ups->save();


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Revenue Head Disapproved Mark Up', 'remarks' => $request->get('remarks'), 'query' => $mark_ups, 'date_time' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 5)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Revenue Head Check Disapproved',
                'body' => 'Revenue Head reviewed the project and disapproved the proposal. Please log in to the system to review the feedback provided and take necessary actions to address the disapproval.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Revenue Head Approval', 'query' => $salerequests, 'created_at' => now()]
        );
//    dd($salerequests,$mark_ups);

        return redirect('/revenue_head_header')->with('success', 'Mark Up Approval Done');
    }

    public function finance_head_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'Finance Head Mark Up Approval')
            ->orWhere('salesrequests.status', '=', 'Finance Head Mark Up Approval(Revision)')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->orderByDesc('salesrequests.created_at')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
            ->get();


        return view('biddings.finance_head_header', compact(['salesrequests']));
    }

    public function finance_head_details($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'biddings.bid_file_revenue', 'mark_ups.mark_up_file', 'mark_ups.pm_remarks_yes', 'mark_ups.pnl_file')
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

        return view('biddings.finance_head_details', compact('salesrequests'))->with('biddingdetails', $biddingdetails)->with('mark_ups', $mark_ups);
    }

    public function finance_head_approved_markup(Request $request, $id)
    {
        $request->validate([
            'approved_status' => 'required'
        ]);

        $result = DB::table('mark_ups')->select('mark_up_id')->where('sales_request_id', $id)->first();
        $mark_up_id = $result->mark_up_id;

        $result = DB::table('mark_ups')->select('project_size')->where('sales_request_id', $id)->first();
        $project_size = $result->project_size;

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {

            $salerequests->status = 'Sales Releasing of proposal';
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->finance_head_id = Auth::user()->id;
            $mark_ups->finance_head_status = 'Yes';
            $mark_ups->save();


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Finance Head Approved Mark Up', 'query' => $mark_ups, 'date_time' => now()]
            );

            //-----Email Notification-----//
            $emailToNotify = array_filter(DB::table('users')->where('role', 8)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Finance Head Approved - Sales Release of Proposal',
                'body' => 'Finance Head has reviewed and approved the proposal for the project. ',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----End Email Notification----//
        } else {
            $request->validate([
                'remarks' => 'required',
                'project_return' => 'required'
            ]);
            if ($request->get('project_return') == 'Revenue') {
                $salerequests->status = 'Revenue Re-Mark Up';
                $action = 'Finance Head Disapproved Mark Up';
            } else if ($request->get('project_return') == 'Revenue_Head') {
                $salerequests->status = 'Revenue Head Unit for Checking';
                $action = 'Finance Head Disapproved P&L';
            } else {
                $salerequests->status = 'Purchasing Rebidding';
                $action = 'Finance Head Disapproved Bidding';
            }
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->finance_head_id = Auth::user()->id;
            $mark_ups->finance_head_status = 'No';
            $mark_ups->finance_head_remarks = $request->get('remarks');
            $mark_ups->save();


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => $action, 'remarks' => $request->get('remarks'), 'query' => $mark_ups, 'date_time' => now()]
            );

            //-----Email Notification-----
            $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Finance Head Disapproved',
                'body' => 'Finance Head has disapproved the project during their review. Please log in to the system, review the feedback provided, and take appropriate action accordingly.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            //-----Email Notification----
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Finance Head Approval', 'query' => $salerequests, 'created_at' => now()]
        );

        return redirect('/finance_head_header')->with('success', 'Mark Up Approval Done');
    }

    public function viewLogs($id)
    {
        $request_log = DB::table('request_logs')
            ->select('action', 'remarks', 'date_time')
            ->where('sales_request_id', '=', $id)
            ->where('remarks', '<>', '')
            ->whereNotNull('remarks')
            ->get();

        $result = DB::table('salesrequests')->select('project_title')->where('sales_request_id', $id)->first();
        $project_title = $result->project_title;

        $view_return1 = "<table class='table table-hover'>
    <thead>Project Title: <b>$project_title </b> <tr>
    <th>Action</th><th>Remarks</th><th>Date&Time</th></tr> </thead>
    <tbody>";
        $view_return2 = '';
        foreach ($request_log as $request_logs) {
            $action = $request_logs->action;
            $remarks = $request_logs->remarks;
//      $date_time = Carbon::parse($request_logs->date_time)->format('d-F-Y h:i a');
            $date_time = Carbon::parse($request_logs->date_time)->format('l jS \of F Y\n h:i A');

            $view_return2 = $view_return2 . "<tr><td>$action  </td>
          <td>$remarks</td>
          <td>$date_time</td></tr>";
        }

        $view_return3 = "</tbody>
        </table>";

        $view_return = $view_return1 . $view_return2 . $view_return3;
//dd($view_return);
        return $view_return;
    }

    public function viewReportlogs($id)
    {
        $request_log = DB::table('request_logs')
            ->select('action', 'remarks', 'date_time', 'username')
            ->leftJoin('users', 'request_logs.user_id', '=', 'users.id')
            ->where('sales_request_id', '=', $id)
//            ->orderByDesc('date_time')
            ->get();

        $result = DB::table('salesrequests')->select('project_title')->where('sales_request_id', $id)->first();
        $project_title = $result->project_title;

        $view_return1 =
            "<table class='table table-centered table-sm align-middle'>
                <thead>
                    <tr class=''>
                    Project Title: <b> $project_title </b>
                    </tr>
                    <tr class='thead-light'>
                        <th class='text-center'>User</th>
                        <th class='text-center'>Action</th>
                        <th class='text-center'>Remarks</th>
                        <th class='text-center'>Date&Time</th>
                    </tr>
                </thead>
        <tbody>";
        $view_return2 = '';
        foreach ($request_log as $request_logs) {
            $username = Str::upper($request_logs->username);
            $action = $request_logs->action;
            $remarks = $request_logs->remarks;
            $date_time = Carbon::parse($request_logs->date_time)->format('d-F-Y  h:i A');

            $svg = "";
            $iconColor = "";
            if (str_contains($request_logs->action, 'Upload') || str_contains($request_logs->action, 'upload')) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path d="M19.5 21a3 3 0 003-3v-4.5a3 3 0 00-3-3h-15a3 3 0 00-3 3V18a3 3 0 003 3h15zM1.5 10.146V6a3 3 0 013-3h5.379a2.25 2.25 0 011.59.659l2.122 2.121c.14.141.331.22.53.22H19.5a3 3 0 013 3v1.146A4.483 4.483 0 0019.5 9h-15a4.483 4.483 0 00-3 1.146z" />
                                       </svg>
                                        ';
                $iconColor = "warning";
            }
            if (str_contains($request_logs->action, 'Create') || str_contains($request_logs->action, 'Create')) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
                                        <path fill-rule="evenodd" d="M12 2.25c-5.385 0-9.75 4.365-9.75 9.75s4.365 9.75 9.75 9.75 9.75-4.365 9.75-9.75S17.385 2.25 12 2.25zM12.75 9a.75.75 0 00-1.5 0v2.25H9a.75.75 0 000 1.5h2.25V15a.75.75 0 001.5 0v-2.25H15a.75.75 0 000-1.5h-2.25V9z" clip-rule="evenodd" />
                                        </svg>';
                $iconColor = "info";
            }
            if (str_contains($request_logs->action, 'Edit') || str_contains($request_logs->action, 'edit')) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M21.731 2.269a2.625 2.625 0 00-3.712 0l-1.157 1.157 3.712 3.712 1.157-1.157a2.625 2.625 0 000-3.712zM19.513 8.199l-3.712-3.712-12.15 12.15a5.25 5.25 0 00-1.32 2.214l-.8 2.685a.75.75 0 00.933.933l2.685-.8a5.25 5.25 0 002.214-1.32L19.513 8.2z" />
</svg>
';
                $iconColor = "info";
            }
            if (str_contains($request_logs->action, 'Disapproved') || str_contains($request_logs->action, 'disapproved')) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M15.73 5.25h1.035A7.465 7.465 0 0118 9.375a7.465 7.465 0 01-1.235 4.125h-.148c-.806 0-1.534.446-2.031 1.08a9.04 9.04 0 01-2.861 2.4c-.723.384-1.35.956-1.653 1.715a4.498 4.498 0 00-.322 1.672V21a.75.75 0 01-.75.75 2.25 2.25 0 01-2.25-2.25c0-1.152.26-2.243.723-3.218C7.74 15.724 7.366 15 6.748 15H3.622c-1.026 0-1.945-.694-2.054-1.715A12.134 12.134 0 011.5 12c0-2.848.992-5.464 2.649-7.521.388-.482.987-.729 1.605-.729H9.77a4.5 4.5 0 011.423.23l3.114 1.04a4.5 4.5 0 001.423.23zM21.669 13.773c.536-1.362.831-2.845.831-4.398 0-1.22-.182-2.398-.52-3.507-.26-.85-1.084-1.368-1.973-1.368H19.1c-.445 0-.72.498-.523.898.591 1.2.924 2.55.924 3.977a8.959 8.959 0 01-1.302 4.666c-.245.403.028.959.5.959h1.053c.832 0 1.612-.453 1.918-1.227z" />
</svg>
';
                $iconColor = 'danger';
            }
            if (str_contains($request_logs->action, 'Approved')/* || str_contains($logs->action, 'approved')*/) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M7.493 18.75c-.425 0-.82-.236-.975-.632A7.48 7.48 0 016 15.375c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 012.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 00.322-1.672V3a.75.75 0 01.75-.75 2.25 2.25 0 012.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 01-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 00-1.423-.23h-.777zM2.331 10.977a11.969 11.969 0 00-.831 4.398 12 12 0 00.52 3.507c.26.85 1.084 1.368 1.973 1.368H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 01-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227z" />
</svg>
';
                $iconColor = 'success';
            }
            if (str_contains($request_logs->action, 'Releas')/* || str_contains($logs->action, 'approved')*/) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path d="M3.478 2.405a.75.75 0 00-.926.94l2.432 7.905H13.5a.75.75 0 010 1.5H4.984l-2.432 7.905a.75.75 0 00.926.94 60.519 60.519 0 0018.445-8.986.75.75 0 000-1.218A60.517 60.517 0 003.478 2.405z" />
</svg>
';
                $iconColor = 'info';
            }
            if (str_contains($request_logs->action, 'Cancel')/* || str_contains($logs->action, 'approved')*/) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path fill-rule="evenodd" d="M5.47 5.47a.75.75 0 011.06 0L12 10.94l5.47-5.47a.75.75 0 111.06 1.06L13.06 12l5.47 5.47a.75.75 0 11-1.06 1.06L12 13.06l-5.47 5.47a.75.75 0 01-1.06-1.06L10.94 12 5.47 6.53a.75.75 0 010-1.06z" clip-rule="evenodd" />
</svg>

';
                $iconColor = 'danger';
            }
            if (str_contains($request_logs->action, 'Revision')/* || str_contains($logs->action, 'approved')*/) {
                $svg = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="w-6 h-6">
  <path fill-rule="evenodd" d="M17.663 3.118c.225.015.45.032.673.05C19.876 3.298 21 4.604 21 6.109v9.642a3 3 0 01-3 3V16.5c0-5.922-4.576-10.775-10.384-11.217.324-1.132 1.3-2.01 2.548-2.114.224-.019.448-.036.673-.051A3 3 0 0113.5 1.5H15a3 3 0 012.663 1.618zM12 4.5A1.5 1.5 0 0113.5 3H15a1.5 1.5 0 011.5 1.5H12z" clip-rule="evenodd" />
  <path d="M3 8.625c0-1.036.84-1.875 1.875-1.875h.375A3.75 3.75 0 019 10.5v1.875c0 1.036.84 1.875 1.875 1.875h1.875A3.75 3.75 0 0116.5 18v2.625c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 013 20.625v-12z" />
  <path d="M10.5 10.5a5.23 5.23 0 00-1.279-3.434 9.768 9.768 0 016.963 6.963 5.23 5.23 0 00-3.434-1.279h-1.875a.375.375 0 01-.375-.375V10.5z" />
</svg>

';
                $iconColor = 'danger';
            }

            $view_return2 = $view_return2 .
                "<tr >
                    <td class=''>$username  </td>
                    <td class='align-middle'><span class='icon-shape icon-xs icon-shape-$iconColor rounded me-1'>$svg</span> $action  </td>
                    <td class='text-wrap text-center'>$remarks</td>
                    <td class='fw-bolder' >
                    <span>
                    <svg class='icon icon-xxs text-gray-400 me-1' fill='currentColor'
                                             viewBox='0 0 20 20' xmlns='http://www.w3.org/2000/svg'>
                                            <path fill-rule='evenodd'
                                                  d='M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z'
                                                  clip-rule='evenodd'></path>
                    </svg>
                    </span>
                    $date_time
                    </td>
                </tr>";
        }

        $view_return3 = "</tbody>
      </table>";

        $view_return = $view_return1 . $view_return2 . $view_return3;

        return $view_return;
    }


}
