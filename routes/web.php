<?php

use App\Http\Controllers\Apps\PermissionManagementController;
use App\Http\Controllers\Apps\RoleManagementController;
use App\Http\Controllers\Apps\UserManagementController;
use App\Http\Controllers\Admin\FRMController;
use App\Http\Controllers\Admin\FBAjaxController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\DashboardController;
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
    Route::get('frm/update/{id}', [FRMController::class,'getUpdate_response'])->name('frm-update-response');

    //Ajax Destrict
    Route::post('getDistrict', [FBAjaxController::class,'getDistrict'])->name('getDistrict');
    Route::post('getTehsil', [FBAjaxController::class,'getTehsil'])->name('getTehsil');
    Route::post('getUnionCouncil', [FBAjaxController::class,'getUnionCouncil'])->name('getUnionCouncil');


});

Route::get('/error', function () {
    abort(500);
});

Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);

require __DIR__ . '/auth.php';
