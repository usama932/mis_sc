<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Admin\FRMController;
use App\Http\Controllers\Admin\FBAjaxController;
use App\Http\Controllers\Admin\QBAjaxController;
use App\Http\Controllers\Admin\QbController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\MonitorVisitsController;
use App\Http\Controllers\Admin\QBAttachmentsController;
use App\Http\Controllers\Admin\QBActionPointController;
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
    
    //Ajax Destrict
    Route::post('getDistrict', [FBAjaxController::class,'getDistrict'])->name('getDistrict');
    Route::post('getTehsil', [FBAjaxController::class,'getTehsil'])->name('getTehsil');
    Route::post('getUnionCouncil', [FBAjaxController::class,'getUnionCouncil'])->name('getUnionCouncil');

    //Quality Bench Routes
    Route::resource('/quality-benchs', QbController::class);
    Route::post('get_qbs', [QbController::class,'get_qbs'])->name('admin.get_qbs');
    Route::post('view_qb', [QbController::class,'view_qb'])->name('admin.view_qb');
    Route::get('/qb/delete/{id}', [QbController::class,'destroy'])->name('qb.delete');
    //montior visits Routes
    Route::resource('/monitor_visits', MonitorVisitsController::class);
    Route::post('get_monitor_visits', [MonitorVisitsController::class,'get_monitor_visits'])->name('get_monitor_visits');
    Route::post('view_monitor_visit', [MonitorVisitsController::class,'view_monitor_visit'])->name('view_monitor_visit');
    Route::get('/monitor_visit/delete/{id}', [MonitorVisitsController::class,'destroy'])->name('monitor_visit.delete');

    //Action Points Routes
    Route::post('getactivity', [QBAjaxController::class,'getactivity'])->name('getactivity');
    Route::resource('/action_points', QBActionPointController::class);
    Route::post('get_action_points', [QBActionPointController::class,'get_action_points'])->name('get_action_points');
    Route::post('view_action_point', [QBActionPointController::class,'view_action_point'])->name('view_action_point');
    Route::get('/action_point/delete/{id}', [QBActionPointController::class,'destroy'])->name('action_point.delete');

    //Qbattachments Routes
    Route::resource('/attachments', QBAttachmentsController::class);
    Route::post('get_qb_attachments', [QBAttachmentsController::class,'get_qb_attachments'])->name('get_qb_attachments');
    Route::post('view_qb_attachments', [QBAttachmentsController::class,'view_qb_attachments'])->name('view_qb_attachments');
    Route::get('/qb_attachments/delete/{id}', [QBAttachmentsController::class,'destroy'])->name('qb_attachments.delete');
    Route::get('/download/qb_attachments/{id}', [QBAttachmentsController::class,'download_attachment'])->name('download.qb_attachments');

    //Reset Password
    Route::get('reset/password', [UserController::class,'reset_password'])->name('reset_password');
    Route::post('update/password', [UserController::class,'password_update'])->name('update_password');
    Route::post('getuserDistrict', [FBAjaxController::class,'getuserDistrict'])->name('getuserDistrict');
});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
