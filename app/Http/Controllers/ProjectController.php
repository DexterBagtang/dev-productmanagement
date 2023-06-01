<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Project;
use App\Salesrequest;
use App\Sld;
use App\Bom;
use App\Bidding;
use App\Layout;
use DB;
use Auth;

use App\Mail\EmailNotification;

//use App\Mail\ProjectDesignUploaded;
//use App\Mail\ProjectDesignDisapproved;
use Illuminate\Support\Facades\Mail;

class ProjectController extends Controller
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

        if ($role == '2') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.pm_approval_status', '=', 'Yes')
                ->where('salesrequests.status', '=', 'PM Designing')
                ->orWhere('salesrequests.status', '=', 'PM -> Redesign')
                ->orWhere('salesrequests.status', '=', 'PM -> Redesign(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        } else if ($role == '3') {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.pm_approval_status', '=', 'Yes')
                ->where('salesrequests.status', '=', 'PM Review of Design')
                ->orWhere('salesrequests.status', '=', 'PM Review of Design(Revision)')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'projects.remarks', 'projects.project_code', 'malls.mall_name',
                    DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        } else {
            $salesrequests = DB::table('salesrequests')
                ->where('salesrequests.pm_approval_status', '=', 'Yes')
                ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
                ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
                ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
                ->select('salesrequests.*', 'users.username', 'projects.project_id', 'projects.remarks', 'projects.project_code', 'malls.mall_name', DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
                ->orderBy('salesrequests.created_at', 'desc')
                ->get();
        }
//    dd($salesrequests,$role);

        return view('projects.viewproject', compact(['salesrequests']))->with('role', $role);
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
//            dd($salesrequests,$boms,$slds,$layouts);

        return view('projects.editproject', compact('salesrequests'))
            ->with('boms', $boms)
            ->with('slds', $slds)
            ->with('layouts', $layouts);
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
//        dd($request->all());


        //remove old uploads
        DB::table('slds')->where('project_id', '=', $id)->delete();
        DB::table('boms')->where('project_id', '=', $id)->delete();
        DB::table('layouts')->where('project_id', '=', $id)->delete();

        if (isset($request->existing_sld_name)) {
            for ($a = 0; $a < count($request->existing_sld_name); $a++) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_sld_name[$a];
                unlink($file_path);
            }
        }

        if (isset($request->existing_bom_name)) {
            for ($a = 0; $a < count($request->existing_bom_name); $a++) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_bom_name[$a];
                unlink($file_path);
            }
        }

        if (isset($request->existing_layout_name)) {
            for ($a = 0; $a < count($request->existing_layout_name); $a++) {
                $file_path = public_path() . '/storage/uploads/' . $request->existing_layout_name[$a];
                unlink($file_path);
            }
        }

        //sld uploads
        for ($i = 0; $i < count($request->sld_number); $i++) {
            if ($request->hasfile('sld.' . $i)) {
                $fileName = $request->sld[$i]->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->sld[$i]->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_sld[$i])) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_sld[$i];
                    unlink($file_path);
                }
            } else if (!empty($request->existing_sld[$i])) {
                $fileName = $request->existing_sld[$i];
            } else {
                $request->validate([
//                    'sld' => 'required'
                ]);
                $fileName = null;
            }


                $slds = new Sld([
                    'project_id' => $id,
                    'sld_file' => $fileName
                ]);
                $slds->save();

                DB::table('logs')->insert(
                    ['user_id' => Auth::user()->id, 'form' => 'Upload Project SLD', 'query' => $slds, 'created_at' => now()]
                );

        }

        //bom uploads
        for ($i = 0; $i < count($request->bom_number); $i++) {
            if ($request->hasfile('bom.' . $i)) {
                $fileName = $request->bom[$i]->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->bom[$i]->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_bom[$i])) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_bom[$i];
                    unlink($file_path);
                }
            } else if (!empty($request->existing_bom[$i])) {
                $fileName = $request->existing_bom[$i];
            } else {
                $request->validate([
                    'bom' => 'required'
                ],[
                    'bom.required' => 'Bill of Quantities required !'
                ]);
            }

            $boms = new Bom([
                'project_id' => $id,
                'bom_file' => $fileName
            ]);
            $boms->save();
            DB::table('logs')->insert(
                ['user_id' => Auth::user()->id, 'form' => 'Upload Project BOM', 'query' => $boms, 'created_at' => now()]
            );
        }

        //layout uploads
        for ($i = 0; $i < count($request->layout_number); $i++) {
            if ($request->hasfile('layout.' . $i)) {
                $fileName = $request->layout[$i]->getClientOriginalName();
                $unique_id = uniqid();
                $fileName = $unique_id . '-' . $fileName;
                $request->layout[$i]->storeAs('public/uploads', $fileName);

                if (!empty($request->existing_layout[$i])) {
                    $file_path = public_path() . '/storage/uploads/' . $request->existing_layout[$i];
                    unlink($file_path);
                }
            } else if (!empty($request->existing_layout[$i])) {
                $fileName = $request->existing_layout[$i];
            } else {
                $request->validate([
//                    'layout' => 'required'
                ]);
                $fileName=null;
            }


                $layouts = new Layout([
                    'project_id' => $id,
                    'layout_file' => $fileName
                ]);
                $layouts->save();
                DB::table('logs')->insert(
                    ['user_id' => Auth::user()->id, 'form' => 'Upload Project Layout', 'query' => $layouts, 'created_at' => now()]
                );

        }

        //project update
        $result = DB::table('projects')->select('sales_request_id')->where('project_id', $id)->first();
        $id2 = $result->sales_request_id;

        $salerequests = Salesrequest::find($id2);
        $salerequests->status = 'PM Review of Design';
        $salerequests->save();

        $projects = Project::find($id);
        $projects->pm_uploader = Auth::user()->id;
        $projects->save();

        DB::table('request_logs')->insert(
            ['user_id' => Auth::user()->id, 'sales_request_id' => $id2, 'action' => 'Upload Project Design', 'query' => $projects, 'date_time' => now()]
        );

        /*email notification*/
        $emailToNotify = array_filter(DB::table('users')->where('role', 3)->where('active', 'yes')->pluck('email')->toArray());
        $emailData = [
            'subject' => 'Project Design Uploaded',
            'body' =>'A project design has been uploaded and needs to be reviewed.',
            'title' => $salerequests->project_title,
            'targetDate' => $salerequests->date_needed,
            'status' => $salerequests->status,
        ];
        Mail::to($emailToNotify)->send(new EmailNotification($emailData));
        /*end of email notification*/


        return redirect('/project' . Auth::user()->id)->with('success', 'Upload Success');
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

    public function approved_project_detail($id)
    {
        $salesrequests = DB::table('salesrequests')
            ->where('salesrequests.sales_request_id', '=', $id)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*', 'malls.mall_name', 'projects.project_code', 'users.username')
            ->get();


        $result = DB::table('projects')->select('project_id')->where('sales_request_id', $id)->first();
        $id2 = $result->project_id;

        $boms = DB::table('boms')
            ->where('project_id', '=', $id2)
            ->select('boms.*')
            ->get();

        $slds = DB::table('slds')
            ->where('project_id', '=', $id2)
            ->select('slds.*')
            ->get();

        $layouts = DB::table('layouts')
            ->where('project_id', '=', $id2)
            ->select('layouts.*')
            ->get();
//            dd($salesrequests,$boms,$slds,$layouts);

        return view('projects.approveproject', compact('salesrequests'))->with('boms', $boms)->with('slds', $slds)->with('layouts', $layouts);
    }

//
    public function approved_project(Request $request, $id)
    {

        $request->validate([
            'approved_status' => 'required'
        ]);
        $result = DB::table('projects')->select('project_id')->where('sales_request_id', $id)->first();
        $id2 = $result->project_id;

        $salerequests = Salesrequest::find($id);
        if ($request->get('approved_status') == 'Yes') {

//            //remove old uploads
//            DB::table('slds')->where('project_id', '=', $id2)->delete();
//            DB::table('boms')->where('project_id', '=', $id2)->delete();
//            DB::table('layouts')->where('project_id', '=', $id2)->delete();
//
//            if (isset($request->existing_sld_name)) {
//                for ($a = 0; $a < count($request->existing_sld_name); $a++) {
//                    $file_path = public_path() . '/storage/uploads/' . $request->existing_sld_name[$a];
//                    unlink($file_path);
//                }
//            }
//
//            if (isset($request->existing_bom_name)) {
//                for ($a = 0; $a < count($request->existing_bom_name); $a++) {
//                    $file_path = public_path() . '/storage/uploads/' . $request->existing_bom_name[$a];
//                    unlink($file_path);
//                }
//            }
//
//            if (isset($request->existing_layout_name)) {
//                for ($a = 0; $a < count($request->existing_layout_name); $a++) {
//                    $file_path = public_path() . '/storage/uploads/' . $request->existing_layout_name[$a];
//                    unlink($file_path);
//                }
//            }
//
//            //sld uploads
//            for ($i = 0; $i < count($request->sld_number); $i++) {
//                if ($request->hasfile('sld.' . $i)) {
//                    $fileName = $request->sld[$i]->getClientOriginalName();
//                    $unique_id = uniqid();
//                    $fileName = $unique_id . '-' . $fileName;
//                    $request->sld[$i]->storeAs('public/uploads', $fileName);
//
//                    if (!empty($request->existing_sld[$i])) {
//                        $file_path = public_path() . '/storage/uploads/' . $request->existing_sld[$i];
//                        unlink($file_path);
//                    }
//                } else if (!empty($request->existing_sld[$i])) {
//                    $fileName = $request->existing_sld[$i];
//                } else {
//                    $request->validate([
////                        'sld' => 'required'
//                    ]);
//                    $fileName = null;
//                }
//
//                $slds = new Sld([
//                    'project_id' => $id2,
//                    'sld_file' => $fileName
//                ]);
//                $slds->save();
//                DB::table('logs')->insert(
//                    ['user_id' => Auth::user()->id, 'form' => 'Upload Project SLD', 'query' => $slds, 'created_at' => now()]
//                );
//            }
//
//            //bom uploads
//            for ($i = 0; $i < count($request->bom_number); $i++) {
//                if ($request->hasfile('bom.' . $i)) {
//                    $fileName = $request->bom[$i]->getClientOriginalName();
//                    $unique_id = uniqid();
//                    $fileName = $unique_id . '-' . $fileName;
//                    $request->bom[$i]->storeAs('public/uploads', $fileName);
//
//                    if (!empty($request->existing_bom[$i])) {
//                        $file_path = public_path() . '/storage/uploads/' . $request->existing_bom[$i];
//                        unlink($file_path);
//                    }
//                } else if (!empty($request->existing_bom[$i])) {
//                    $fileName = $request->existing_bom[$i];
//                } else {
//                    $request->validate([
//                        'bom' => 'required'
//
//                    ]);
//                }
//
//                $boms = new Bom([
//                    'project_id' => $id2,
//                    'bom_file' => $fileName
//                ]);
//                $boms->save();
//                DB::table('logs')->insert(
//                    ['user_id' => Auth::user()->id, 'form' => 'Upload Project BOM', 'query' => $boms, 'created_at' => now()]
//                );
//            }
//
//            //layout uploads
//            for ($i = 0; $i < count($request->layout_number); $i++) {
//                if ($request->hasfile('layout.' . $i)) {
//                    $fileName = $request->layout[$i]->getClientOriginalName();
//                    $unique_id = uniqid();
//                    $fileName = $unique_id . '-' . $fileName;
//                    $request->layout[$i]->storeAs('public/uploads', $fileName);
//
//                    if (!empty($request->existing_layout[$i])) {
//                        $file_path = public_path() . '/storage/uploads/' . $request->existing_layout[$i];
//                        unlink($file_path);
//                    }
//                } else if (!empty($request->existing_layout[$i])) {
//                    $fileName = $request->existing_layout[$i];
//                } else {
//                    $request->validate([
////                        'layout' => 'required'
//                    ]);
//                    $fileName = null;
//                }
//
//                $layouts = new Layout([
//                    'project_id' => $id2,
//                    'layout_file' => $fileName
//                ]);
//                $layouts->save();
//                DB::table('logs')->insert(
//                    ['user_id' => Auth::user()->id, 'form' => 'Upload Project Layout', 'query' => $layouts, 'created_at' => now()]
//                );
//            }


            $salerequests->status = 'Purchasing Bidding';
            $projects = Project::find($id2);
            $projects->design_status = 'Approved';
            $projects->pm_supervisor_id = Auth::user()->id;
//            $projects->remarks = $request->get('remarks');
            $projects->save();

            if (Bidding::where('sales_request_id', $id)->count() <= 0) {

                $biddings = new Bidding([
                    'sales_request_id' => $id,
                    'pm_remarks' => $request->get('remarks')

                ]);
                $biddings->save();

            }
            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'Approved Project Design',
                    'remarks' => $request->get('remarks'),
                    'query' => $projects, 'date_time' => now()]
            );


            /*email notification*/
            $emailToNotify = array_filter(DB::table('users')->where('role', 4)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Project Design Approved - Project Ready for Bidding',
                'body' =>'The project design has been approved. The project is now in the bidding phase. Please log in to the system to proceed with adding bidders for the project.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            /*end of email notification*/

        } else {

            $request->validate([
                'remarks' => 'required'
            ]);

            $salerequests->status = 'PM -> Redesign';
            $projects = Project::find($id2);
            $projects->design_status = 'Disapproved';
            $projects->pm_supervisor_id = Auth::user()->id;
            $projects->remarks = $request->get('remarks');
            $projects->save();

            DB::table('request_logs')->insert(
                ['user_id' => Auth::user()->id,
                    'sales_request_id' => $id,
                    'action' => 'Disapproved Project Design',
                    'remarks' => $request->get('remarks'),
                    'query' => $projects, 'date_time' => now()]
            );


            /*email notification*/
            $emailToNotify = array_filter(DB::table('users')->where('role', 2)->where('active', 'yes')->pluck('email')->toArray());
            $emailData = [
                'subject' => 'Project Design Disapproved',
                'body' =>'Project design has been disapproved. Please log in to the system to review the details and make the necessary adjustments.',
                'title' => $salerequests->project_title,
                'targetDate' => $salerequests->date_needed,
                'status' => $salerequests->status,
            ];
            Mail::to($emailToNotify)->send(new EmailNotification($emailData));
            /*end of email notification*/
        }


        $salerequests->save();

        DB::table('logs')->insert(
            ['user_id' => Auth::user()->id, 'form' => 'Approve Project', 'query' => $salerequests, 'created_at' => now()]
        );



        return redirect('/project' . Auth::user()->id)->with('success', 'Project Design has been reviewed');
    }

}
