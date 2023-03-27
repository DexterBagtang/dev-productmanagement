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
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
                ->get();
        } else if ($role == '3') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.status', '=', 'PM Check Contractor Cost')
                ->orWhere('salesrequests.status', '=', 'PM Check Contractor Cost(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
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
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
                ->get();
        } else {
            $salesrequests = DB::table('salesrequests')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
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
            $salesrequest_status = 'PM Check Contractor Cost';
        }

        $salerequests = Salesrequest::find($id);
        $salerequests->status = $salesrequest_status;
        $salerequests->save();


        if ($request->hasfile('bid_file')) {
            $fileName = $request->bid_file->getClientOriginalName();
            $unique_id = uniqid();
            $fileName = $unique_id . '-' . $fileName;
            $request->bid_file->storeAs('public/uploads', $fileName);

            if (!empty($request->existing_bid_file)) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_bid_file;
                unlink($file_path);
            }
        } else if (!empty($request->existing_bid_file)) {
            $fileName = $request->existing_bid_file;
        } else {
            $fileName = '';
        }

        $biddings = Bidding::find($bidding_id);
        $biddings->purchasing_uploader = Auth::user()->id;
        $biddings->bid_file = $fileName;
        $biddings->revision = '';
        $biddings->save();

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'Upload Bidders', 'query' => $biddingdetails, 'date_time' => now()]
        );
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
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'PM Approved/Choose Bid Winner', 'query' => $biddings, 'date_time' => now()]
            );
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
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Approve Bidding', 'query' => $salerequests, 'created_at' => now()]
        );

        return redirect('/bidding_index' . Auth::user()->id)->with('success', 'Bidding has been review');
    }

    public function revenue_approve_bidder_detail($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('mark_ups', 'salesrequests.sales_request_id', '=', 'mark_ups.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'mark_ups.mark_up_file', 'mark_ups.project_size', 'biddings.bid_file', 'biddings.pm_remarks_yes')
            ->get();

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


            $salerequests->status = 'PM Mark Up Technical Check';

            if (Mark_up::where('sales_request_id', $id)->count() <= 0) {

                $mark_ups = new Mark_up([
                    'sales_request_id' => $id,
                    'markup_uploader' => Auth::user()->id,
                    'mark_up_file' => $fileName,
                    'project_size' => $request->get('project_size')
                ]);
                $mark_ups->save();

            } else {
                $mark_ups = Mark_up::find($mark_up_id);
                $mark_ups->markup_uploader = Auth::user()->id;
                $mark_ups->mark_up_file = $fileName;
                $mark_ups->project_size = $request->get('project_size');
                $mark_ups->save();
            }


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
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Revenue Approve Bidding', 'query' => '$salerequests', 'created_at' => now()]
        );

        return redirect('/bidding_index' . Auth::user()->id)->with('success', 'Mark-up Success');
    }

    public function pm_technicalcheck_header()
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.status', '=', 'PM Mark Up Technical Check')
            ->orWhere('salesrequests.status', '=', 'PM Mark Up Technical Check(Revision)')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
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


            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'PM Approved Technical Checking', 'query' => $mark_ups, 'date_time' => now()]
            );
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
                ['user_id' => Auth::user()->id, 'sales_request_id' => $id, 'action' => 'PM Disapproved Technical Checking', 'remarks' => $request->get('remarks'), 'query' => $mark_ups, 'date_time' => now()]
            );
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
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
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
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file', 'mark_ups.pm_remarks_yes', 'mark_ups.pnl_file')
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
            } else if ($project_size == 'Big') {
                $salerequests->status = 'Finance Head Mark Up Approval';
            }

            if ($request->hasfile('pnl_file')) {
                $fileName = $request->pnl_file->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->pnl_file->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_pnl_file)) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_pnl_file;
                    unlink($file_path);
                }
            } else if (!empty($request->existing_pnl_file)) {
                $fileName = $request->existing_pnl_file;
            } else {
                $request->validate([
                    'pnl_file' => 'required'
                ]);
            }
            $mark_ups = Mark_up::find($mark_up_id);
            $mark_ups->rev_head_id = Auth::user()->id;
            $mark_ups->rev_head_status = 'Yes';
            $mark_ups->pnl_file = $fileName;
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
            ->select('salesrequests.*', 'users.username', 'projects.project_id', 'biddings.pm_remarks', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
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
            ->select('salesrequests.*', 'projects.project_code', 'users.username', 'biddings.bid_file', 'mark_ups.mark_up_file', 'mark_ups.pm_remarks_yes', 'mark_ups.pnl_file')
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
            ->get();

        $result = DB::table('salesrequests')->select('project_title')->where('sales_request_id', $id)->first();
        $project_title = $result->project_title;

        $view_return1 =
            "<table class='table table-striped table-hover'>
        <thead>Project Title: <b> $project_title </b>
            <tr class='info'>
                <th>User</th>
                <th>Action</th>
                <th>Remarks</th>
                <th>Date&Time</th>
            </tr>
        </thead>
       <tbody>";
        $view_return2 = '';
        foreach ($request_log as $request_logs) {
            $username = Str::upper($request_logs->username);
            $action = $request_logs->action;
            $remarks = $request_logs->remarks;
            $date_time = Carbon::parse($request_logs->date_time)->format('l jS \of F Y  h:i A');

            $view_return2 = $view_return2 .
                "<tr>
        <td>$username  </td>
        <td>$action  </td>
        <td>$remarks</td>
        <td>$date_time</td>
        </tr>";
        }

        $view_return3 = "</tbody>
      </table>";

        $view_return = $view_return1 . $view_return2 . $view_return3;

        return $view_return;
    }


}
