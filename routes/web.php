<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Admin\FRMController;
use App\Http\Controllers\Admin\FBAjaxController;
use App\Http\Controllers\Admin\QbController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Admin\UserController;
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
    Route::post('/monitor_visits', [QbController::class,'monitor_visits'])->name('monitor_visits');
    Route::post('/action_points', [QbController::class,'action_points'])->name('action_points');
    Route::post('/attachments', [QbController::class,'attachments'])->name('attachments');

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
