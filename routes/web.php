<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Admin\FRMController;
use App\Http\Controllers\Admin\FBAjaxController;
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
    Route::get('frm/export', [FRMController::class,'getexportform'])->name('frm-export');
    Route::post('getfrm/export', [FRMController::class,'getexportfrm'])->name('getfrm-export');
    //Ajax Destrict
    
    Route::post('getDistrict', [FBAjaxController::class,'getDistrict'])->name('getDistrict');
    Route::post('getTehsil', [FBAjaxController::class,'getTehsil'])->name('getTehsil');
    Route::post('getUnionCouncil', [FBAjaxController::class,'getUnionCouncil'])->name('getUnionCouncil');

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
