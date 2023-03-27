<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

Route::resource('malls','MallController');
Route::resource('salesrequests','SalesrequestController');
Route::resource('projects','ProjectController');
Route::resource('biddings','BiddingController');

Route::get('/', function () {
    return view('index');
});


//-----------------------test email notification----------------------------//


//---------------------------------------------------//

Route::get('/test',function(){
    $dir = public_path().'/storage/uploads/';
    $data = scandir($dir);
//            $data = File::allFiles($dir);

//    foreach ($data as $x){
//        $y = substr($x,14);
//        $datas[]= $y;
//    }
//    dd($data);

//    $data = File::allFiles;
//    return $data;
//   dd($data);
    return view('salesrequests.timeline')->with('data',$data)->with('dir',$dir);
});

//Auth::routes();

//sales only
Route::group(['middleware' => 'App\Http\Middleware\SalesMiddleware'], function()
{
Route::get('/mall/create_malls', function () {
   return view('malls.createmall');
})->name('create_malls');

Route::get('malls', 'MallController@index');
Route::get('edit_mall{id}', 'MallController@edit');

Route::get('salesrequest', 'SalesrequestController@index');
Route::get('create_salesrequest', 'SalesrequestController@create');
Route::get('edit_salesrequest{id}', 'SalesrequestController@edit');
Route::get('revise_project', 'SalesrequestController@revise_project');
Route::get('revise_salesrequest{id}', 'SalesrequestController@revise');
Route::post('revised_salesrequest{id}', 'SalesrequestController@revised');
Route::get('timeline{id}', 'SalesrequestController@timeline');





Route::get('sr_disapproved_header', 'SalesrequestController@sr_disapproved_header');

Route::get('po_ntp_header', 'SalesrequestController@po_ntp_header');
Route::get('po_ntp_details{id}', 'SalesrequestController@po_ntp_details');
Route::post('po_ntp_upload{id}', 'SalesrequestController@po_ntp_upload');

Route::get('release_proposal_header', 'SalesrequestController@release_proposal_header');
Route::get('release_proposal_details{id}', 'SalesrequestController@release_proposal_details');
Route::post('proof_upload{id}', 'SalesrequestController@proof_upload');

Route::get('cancel_request{id}', 'SalesrequestController@cancel_request');
Route::post('cancel_request_details{id}', 'SalesrequestController@cancel_request_details');

});

//pm supervisor only
Route::group(['middleware' => 'App\Http\Middleware\PmsvMiddleware'], function()
{
Route::get('approved_header', 'SalesrequestController@approved_header');
Route::get('approve_detail{id}', 'SalesrequestController@approved_detail');
Route::get('approved_sr{id}', 'SalesrequestController@approved_sr');

Route::get('approve_project_detail{id}', 'ProjectController@approved_project_detail');
Route::post('approved_project{id}', 'ProjectController@approved_project');

Route::get('pm_approve_bidder_detail{id}', 'BiddingController@pm_approve_bidder_detail');
Route::get('pm_approved_bidding{id}', 'BiddingController@pm_approved_bidding');

Route::get('pm_technicalcheck_header', 'BiddingController@pm_technicalcheck_header');
Route::get('pm_technicalcheck_details{id}', 'BiddingController@pm_technicalcheck_details');
Route::get('pm_approved_markup{id}', 'BiddingController@pm_approved_markup');
});

//pm
Route::group(['middleware' => 'App\Http\Middleware\PmMiddleware'], function()
{
Route::get('upload_design{id}', 'ProjectController@edit');
});

//pm and pm supervisor
Route::group(['middleware' => 'App\Http\Middleware\PmpmsvMiddleware'], function()
{
Route::get('project{id}', 'ProjectController@index');
});

//pm supervisor , purchasing , revenue
Route::group(['middleware' => 'App\Http\Middleware\PmsvpurrevMiddleware'], function()
{
Route::get('bidding_index{id}', 'BiddingController@index');
});

//revenue
Route::group(['middleware' => 'App\Http\Middleware\RevenueMiddleware'], function()
{
Route::get('revenue_approve_bidder_detail{id}', 'BiddingController@revenue_approve_bidder_detail');
Route::post('revenue_approved_bidding{id}', 'BiddingController@revenue_approved_bidding');

Route::get('bid_summary_header', 'SalesrequestController@bid_summary_header');
Route::get('bid_summary_details{id}', 'SalesrequestController@bid_summary_details');
Route::post('bid_summary_upload{id}', 'SalesrequestController@bid_summary_upload');
});

//revenue head
Route::group(['middleware' => 'App\Http\Middleware\RevenueheadMiddleware'], function()
{
Route::get('revenue_head_header', 'BiddingController@revenue_head_header');
Route::get('revenue_head_details{id}', 'BiddingController@revenue_head_details');
Route::post('revenue_head_approved_markup{id}', 'BiddingController@revenue_head_approved_markup');

});

//finance head
Route::group(['middleware' => 'App\Http\Middleware\FinanceheadMiddleware'], function()
{
Route::get('finance_head_header', 'BiddingController@finance_head_header');
Route::get('finance_head_details{id}', 'BiddingController@finance_head_details');
Route::get('finance_head_approved_markup{id}', 'BiddingController@finance_head_approved_markup');
});

// purchasing
Route::group(['middleware' => 'App\Http\Middleware\PurchasingMiddleware'], function()
{
Route::get('upload_bidder{id}', 'BiddingController@edit');

Route::get('cer_header', 'SalesrequestController@cer_header');
Route::get('cer_details{id}', 'SalesrequestController@cer_details');
Route::post('cer_upload{id}', 'SalesrequestController@cer_upload');
});

Route::get('viewLogs{id}', 'BiddingController@viewLogs');
Route::get('viewReportlogs{id}', 'BiddingController@viewReportlogs');
Route::get('viewprojectstatus', 'SalesrequestController@viewprojectstatus');
Route::get('viewprojectstatus_usr', 'SalesrequestController@viewprojectstatus_usr');

Route::get('viewprojectfiles', 'SalesrequestController@viewprojectfiles');
Route::get('viewprojectfiles_usr', 'SalesrequestController@viewprojectfiles_usr');

Route::get('viewdocs', 'SalesrequestController@viewdocs');
Route::get('viewdocs_usr', 'SalesrequestController@viewdocs_usr');
//purchasing and pm
Route::group(['middleware' => 'App\Http\Middleware\PmpurchasingMiddleware'], function()
{
Route::get('uploadfiles_details{id}', 'SalesrequestController@uploadfiles_details');
Route::post('uploadfiles{id}', 'SalesrequestController@uploadfiles');
});
Route::get('viewDesign{id}', 'SalesrequestController@viewDesign');


Route::get('/home', 'HomeController@index')->name('home');
Route::get('/changePassword','HomeController@showChangePasswordForm');
Route::post('user_changePassword', 'HomeController@user_changePassword');

Route::get('/expirechangePassword','HomeController@showExpireChangePasswordForm');
Route::post('user_expirechangePassword', 'HomeController@user_expirechangePassword');

Route::get('/flowchart','HomeController@showFlowChart');
Route::get('/viewprojectpdf','SalesrequestController@viewprojectpdf');



// Authentication Routes...
$this->get('login', 'Auth\LoginController@showLoginForm')->name('login');
$this->post('login', 'Auth\LoginController@login');
$this->post('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['middleware' => 'App\Http\Middleware\AdminMiddleware'], function()
{
// Registration Routes...
$this->get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
$this->post('register', 'Auth\RegisterController@register');
Route::get('users_edit_view{id}', 'Auth\RegisterController@users_edit_view');
Route::post('users_update{id}', 'Auth\RegisterController@users_update');
Route::get('/resetPassword','HomeController@showResetPasswordForm');
Route::post('user_resetPassword', 'HomeController@user_resetPassword');
Route::get('viewusers', 'Auth\RegisterController@viewusers');
Route::get('viewlogs', 'SalesrequestController@viewlogs');
});
