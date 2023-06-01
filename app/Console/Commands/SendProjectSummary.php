<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class SendProjectSummary extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'email:project-summary';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send project summary to all users through mail';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $users = DB::table('users')
            ->where('role','!=',2)
            ->pluck('email')->toArray();

        $projects = DB::table('salesrequests')
            ->orderBy('sales_request_id', 'desc')
            ->where('projects.project_code','!=',null)
            ->leftJoin('malls', 'salesrequests.mall_id', '=', 'malls.mall_id')
            ->leftJoin('projects', 'salesrequests.sales_request_id', '=', 'projects.sales_request_id')
            ->leftJoin('biddings', 'salesrequests.sales_request_id', '=', 'biddings.sales_request_id')
            ->leftJoin('users', 'salesrequests.pm_assigned_id', '=', 'users.id')
            ->select('salesrequests.*',
                'users.username',
                'projects.project_id',
                'biddings.pm_remarks',
                'malls.mall_name',
                'projects.remarks',
                'projects.project_code',
//                DB::raw("DATEDIFF(now(),salesrequests.created_at)AS project_age"))
                DB::raw("DATEDIFF(CASE WHEN salesrequests.status = 'Project Completed' THEN salesrequests.updated_at ELSE NOW() END, salesrequests.created_at) AS project_age"))
            ->get();

        $projectAll = DB::table('projects')
            ->join('salesrequests','projects.sales_request_id','=','salesrequests.sales_request_id')
            ->select('salesrequests.*','project_code')
            ->count();

        $projectOngoing = DB::table('projects')
            ->join('salesrequests','projects.sales_request_id','=','salesrequests.sales_request_id')
            ->where('salesrequests.status','!=','Project Completed')
            ->select('salesrequests.*','project_code')
            ->count();
        $projectCompleted = DB::table('projects')
            ->join('salesrequests','projects.sales_request_id','=','salesrequests.sales_request_id')
            ->where('salesrequests.status','=','Project Completed')
            ->select('salesrequests.*','project_code')
            ->count();

        $emailData = [
            'projects' => $projects,
            'allProjectsCount' => $projectAll,
            'ongoingProjectsCount' => $projectOngoing,
            'completedProjectsCount' => $projectCompleted,
        ];



        $html = view('projectSummary',$emailData)->render();

//        Mail::send('projectSummary', $emailData, function ($message) use ($users) {
//            $message->to($users)
//                ->subject('Weekly Project Summary');
//        });
        Mail::send([], [], function ($message) use ($users, $html) {
            $message->to($users)
                ->cc('Dexter.Bagtang@philcom.com')
                ->subject('Project Summary')
                ->setBody($html, 'text/html');
        });

        $this->info('Project summary emails sent successfully');
//        dd($salesrequests,$users);
    }
}
