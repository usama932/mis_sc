<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Admin\FRMController;
use App\Http\Controllers\Admin\FBAjaxController;
use App\Http\Controllers\Admin\QBAjaxController;
use App\Http\Controllers\Admin\QbController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\LearningLogController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MonitorVisitsController;
use App\Http\Controllers\Admin\generalobservationsConroller;
use App\Http\Controllers\Admin\QBAttachmentsController;
use App\Http\Controllers\Admin\QBActionPointController;
use App\Http\Controllers\Admin\DipController;
use App\Http\Controllers\Admin\DipActivityController;
use App\Http\Controllers\Admin\OldQbController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ProjectThemeController;
use App\Http\Controllers\Admin\ProjectPartnerController;
use App\Http\Controllers\Auth\StaffLoginController;
use Illuminate\Support\Facades\Route;

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
Route::post('getuserDistrict', [FBAjaxController::class,'getuserDistrict'])->name('getuserDistrict');
Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/', [DashboardController::class, 'index']);

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::name('dashboards.')->group(function () {
        Route::get('frm_dashboard', [DashboardController::class,'frm_dashboard'])->name('frm_dashboard');
        Route::get('qb_dashboard', [DashboardController::class,'qb_dashboard'])->name('qb_dashboard');
        Route::get('medical_exit_interview', [DashboardController::class,'medical_exit_interview'])->name('medical_exit_interview');
    });
    

    Route::name('user-management.')->group(function () {
        Route::resource('/user-management/users', UserManagementController::class);
        Route::resource('/user-management/roles', RoleManagementController::class);
        Route::resource('/user-management/permissions', PermissionManagementController::class);
    });
    //FRM Routes
    Route::resource('/frm-managements', FRMController::class);
    Route::post('get-frms', [FRMController::class,'getFrms'])->name('admin.getFrms');
    Route::post('get-frm', [FRMController::class,'FrmDetail'])->name('admin.getFrm');
    Route::get('frm/create_update/{id}', [FRMController::class,'getUpdate_response'])->name('frm-update-response');
    Route::post('frm/response_update/{id}', [FRMController::class,'postUpdate_response'])->name('frm-response.update');
    Route::get('frm-managements/frm/export', [FRMController::class,'getexportform'])->name('frm-export');
    Route::post('getfrm/export', [FRMController::class,'getexportfrm'])->name('getfrm-export');
    
    //Ajax Destrict Routes
    Route::post('getDistrict', [FBAjaxController::class,'getDistrict'])->name('getDistrict');
    Route::post('getlearningDistrict', [FBAjaxController::class,'getlearningDistrict'])->name('getlearningDistrict');
    Route::post('getTehsil', [FBAjaxController::class,'getTehsil'])->name('getTehsil');
    Route::post('getUnionCouncil', [FBAjaxController::class,'getUnionCouncil'])->name('getUnionCouncil');
    Route::post('/update-province', [FBAjaxController::class,'update_province'])->name('update_province');
    Route::get('get-project', [FBAjaxController::class,'getproject'])->name('get-project');
    
    //Quality Bench Routes
    Route::resource('/quality-benchs', QbController::class);
    Route::post('get_qbs', [QbController::class,'get_qbs'])->name('admin.get_qbs');
    Route::get('/qb/delete/{id}', [QbController::class,'destroy'])->name('qb.delete');
    Route::get('qb/export', [QbController::class,'getqbexportform'])->name('qb-export');
    Route::get('qbaction_points/export', [QbController::class,'getqbactionpointexportform'])->name('qbactionpoint-export');
    Route::post('getqb/export', [QbController::class,'getexportqb'])->name('getqb-export');
    Route::post('/getactionpoint/export', [QbController::class,'getexportqbactionpoint'])->name('getactionpoint.export');
    //Old Qbs
    Route::get('get_old_qbs', [OldQbController::class,'index'])->name('get_oldqbs');
    Route::post('get_old_qbs', [OldQbController::class,'get_old_qbs'])->name('admin.get_old_qbs');
    Route::get('get_old_action_points/{id}', [OldQbController::class,'get_old_action_points'])->name('get_old_action_points');
    Route::post('get_old_action_points', [OldQbController::class,'old_action_points'])->name('admin.get_old_action_points');

    //montior visits Routes
    Route::resource('/monitor_visits', MonitorVisitsController::class);
    Route::post('get_monitor_visits', [MonitorVisitsController::class,'get_monitor_visits'])->name('get_monitor_visits');
    Route::post('view_monitor_visit', [MonitorVisitsController::class,'view_monitor_visit'])->name('view_monitor_visit');
    Route::post('edit_monitor_visit', [MonitorVisitsController::class,'edit_monitor_visit'])->name('edit_monitor_visit');
    Route::get('/monitor_visit/delete/{id}', [MonitorVisitsController::class,'destroy'])->name('monitor_visit.delete');

    //Action Points Routes
    Route::post('getactivity', [QBAjaxController::class,'getactivity'])->name('getactivity');
    Route::resource('action_points', QBActionPointController::class);
    Route::post('get_action_points', [QBActionPointController::class,'get_action_points'])->name('get_action_points');
  
    Route::post('get_qbs_actionpoints', [QBActionPointController::class,'get_qbs_actionpoints'])->name('get_qbs_actionpoints');
    Route::post('view_action_point', [QBActionPointController::class,'view_action_point'])->name('view_action_point');
    Route::get('/action_point/delete/{id}', [QBActionPointController::class,'destroy'])->name('action_point.delete');
    Route::get('/getupdate_actionpoint/{id}', [QBActionPointController::class,'getupdate_actionpoint'])->name('getupdate_actionpoint');
    Route::post('/postupdate_actionpoint/{id}', [QBActionPointController::class,'postupdate_actionpoint'])->name('postupdate_actionpoint');

    //Qbattachments Routes
    Route::resource('/attachments', QBAttachmentsController::class);
    Route::post('get_qb_attachments', [QBAttachmentsController::class,'get_qb_attachments'])->name('get_qb_attachments');
    Route::post('view_qb_attachments', [QBAttachmentsController::class,'view_qb_attachments'])->name('view_qb_attachments');
    Route::get('/qb_attachments/delete/{id}', [QBAttachmentsController::class,'destroy'])->name('qb_attachments.delete');
    Route::get('/download/qb_attachments/{id}', [QBAttachmentsController::class,'download_attachment'])->name('download.qb_attachments');
    Route::get('/pdf/shows/{id}', [QBAttachmentsController::class,'showPDF'])->name('showPDF.qb_attachments');
    // QB AJAX Routes
    Route::post('getproject_type', [QBAjaxController::class,'getproject_type'])->name('getproject_type');
    //Reset Password
    Route::get('reset/password', [UserController::class,'reset_password'])->name('reset_password');
    Route::post('update/password', [UserController::class,'password_update'])->name('update_password');
  

    //Learning Log Routes
    Route::resource('/learning-logs', LearningLogController::class);
    Route::post('get_learninglogs', [LearningLogController::class,'get_learninglogs'])->name('admin.get_learninglogs');
    Route::post('view_learninglog', [LearningLogController::class,'view_learninglog'])->name('admin.view_learninglog');
    Route::get('/learninglog/delete/{id}', [LearningLogController::class,'destroy'])->name('learninglog.delete');
    Route::post('/search/learninglog', [LearningLogController::class,'search'])->name('learninglog.search');
    Route::get('/download/log/{id}', [LearningLogController::class,'downloadFile'])->name('download.log_file');

    //Dip Routes
    Route::resource('/dips', DipController::class);
    Route::get('/dip/create/{id}', [DipController::class,'dip_create'])->name('dip.create');
    Route::post('get_dips', [DipController::class,'get_dips'])->name('admin.get_dips');
    Route::post('view_dip', [DipController::class,'view_dip'])->name('admin.view_dip');
    Route::get('/dip/delete/{id}', [DipController::class,'destroy'])->name('dip.delete');

    //Dip Activity Routes
    Route::resource('/activity_dips', DipActivityController::class);
    Route::post('edit_activity_dips', [DipActivityController::class,'edit_activity_dips'])->name('admin.edit_activity_dips');
    Route::post('get_activity_dips', [DipActivityController::class,'get_activity_dips'])->name('admin.get_activity_dips');
    Route::post('view_activity_dips', [DipActivityController::class,'view_activity_dips'])->name('admin.view_activity_dips');
    Route::get('/activity_dips/delete/{id}', [DipActivityController::class,'destroy'])->name('activity_dips.delete');
    Route::get('/delete_month/delete/{id}', [DipActivityController::class,'delete_month'])->name('delete_month.delete');

    //Master Projects  routes
    Route::resource('/projects', ProjectController::class);
    Route::post('get_projects', [ProjectController::class,'get_projects'])->name('admin.get_projects');
    Route::post('project/update', [ProjectController::class,'project_update'])->name('project.update');
    Route::get('/project/delete/{id}', [ProjectController::class,'destroy'])->name('project.delete');
    
    //Project detail Routes
    Route::get('/project/detailupdate/{id}', [ProjectController::class,'createProject_details'])->name('project.detail');
    Route::get('/project/details', [ProjectController::class,'get_project_index'])->name('get_project_index');
    Route::post('get_project_details', [ProjectController::class,'get_project_details'])->name('admin.get_project_details');
 
    //Project Theme Routes
    Route::post('project_themes', [ProjectThemeController::class,'project_themes'])->name('admin.project_themes');
    Route::resource('/projectthemes', ProjectThemeController::class);
    Route::get('/project_theme/delete/{id}', [ProjectThemeController::class,'destroy'])->name('project_theme.delete');

    //Project Partner
    Route::resource('/projectpartners', ProjectPartnerController::class);
    Route::post('project_partners', [ProjectPartnerController::class,'project_partners'])->name('admin.project_partners');
    Route::get('/project_partner/delete/{id}', [ProjectPartnerController::class,'destroy'])->name('project_partner.delete');

});

Route::get('/error', function () {
    abort(500);
});
// Route::get('send-mail', function () {

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);
Route::get('otp/form/{email}', [StaffLoginController::class,'otp_form'])->name('otp.form');
Route::post('postguest/login', [StaffLoginController::class,'login'])->name('postguest.login');
Route::post('postguest/otp', [StaffLoginController::class,'login_otp'])->name('post_otp');
require __DIR__ . '/auth.php';


   
//     $details = [
//         'title' => 'Save the Children',
//         'body' => 'Please use the verification code below to sign in.',
//         'otp' => '2121'
//     ];
   
//     \Mail::to('usama1517a@gmail.com')->send(new \App\Mail\sendMail($details));
   
//     dd("Email is Sent.");
// });