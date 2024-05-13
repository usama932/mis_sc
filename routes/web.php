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
use App\Http\Controllers\Admin\CloseRecordController;
use App\Http\Controllers\Admin\ProjectReviewController;
use App\Http\Controllers\Admin\ProjectProfileController;
use Illuminate\Support\Facades\Route;



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
        Route::post('getprofiletehsil', [FBAjaxController::class,'getprofiletehsil'])->name('getprofile_tehsil');
        Route::post('getprofileuc', [FBAjaxController::class,'getprofile_uc'])->name('getprofile_uc');
        Route::post('getprojectDistrict', [FBAjaxController::class,'getprojectDistrict'])->name('getprojectDistrict');
        Route::post('getTehsil', [FBAjaxController::class,'getTehsil'])->name('getTehsil');
        Route::post('getUnionCouncil', [FBAjaxController::class,'getUnionCouncil'])->name('getUnionCouncil');
        Route::post('/update-province', [FBAjaxController::class,'update_province'])->name('update_province');
        Route::get('get-project', [FBAjaxController::class,'getproject'])->name('get-project');
        Route::post('getSubTheme', [FBAjaxController::class,'getSubTheme'])->name('getSubTheme');
        Route::post('getactivitySubTheme', [FBAjaxController::class,'getactivitySubTheme'])->name('getactivitySubTheme');
        Route::post('getprojecttheme', [FBAjaxController::class,'getprojecttheme'])->name('getprojecttheme');
        Route::get('/get-email-recommendations', [FBAjaxController::class,'getEmailRecommendations'])->name('getEmailRecommendations');

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
        Route::post('get_activity_quarters', [DipActivityController::class,'get_activity_quarters'])->name('admin.get_activity_quarters');
        Route::post('view_activity_dips', [DipActivityController::class,'view_activity_dips'])->name('admin.view_activity_dips');
        Route::get('/activity_dips/delete/{id}', [DipActivityController::class,'destroy'])->name('activity_dips.delete');

        //progress routes
        Route::get('/activity_progress/delete/{id}', [DipActivityController::class,'delete_progress'])->name('delete_progress.delete');
        Route::get('/activity/progress', [DipActivityController::class,'activity_progress'])->name('activity_dips.progress');
        Route::get('/delete_month/delete/{id}', [DipActivityController::class,'delete_month'])->name('delete_month.delete');
        Route::get('postprogress/{id}', [DipActivityController::class,'postprogress'])->name('postprogress');
        Route::post('updateprogress', [DipActivityController::class,'updateprogress'])->name('updateprogress');
        Route::post('add_progress', [DipActivityController::class,'add_progress'])->name('add_progress');
        Route::post('update_status', [DipActivityController::class,'update_status'])->name('update_status');
        Route::post('edit_progress', [DipActivityController::class,'edit_progress'])->name('edit_progress');

        Route::post('fetchquartertarget', [DipActivityController::class,'fetchquartertarget'])->name('fetchquartertarget');
        Route::post('activity_Quarters', [DipActivityController::class,'activityQuarters'])->name('admin.activityQuarters');
        Route::get('/activity/create', [DipActivityController::class,'create'])->name('create_activity');
        Route::post('activtyquarter_update/{id}', [DipActivityController::class,'activtyquarter_update'])->name('activtyquarter.update');
        //Download activity progress
        Route::get('/download/{filename}', [DipActivityController::class,'download_progress_attachment'])->name('download_progress_attachment');
        Route::post('quarterstatus.update/{id}', [DipActivityController::class,'quarterstatus_update'])->name('quarterstatus.update');
        Route::post('quarterstatus.edit/{id}', [DipActivityController::class,'quarterstatus_edit'])->name('quarterstatus.edit');
        //Master Projects  routes
        Route::resource('/projects', ProjectController::class);
        Route::post('get_projects', [ProjectController::class,'get_projects'])->name('admin.get_projects');
        Route::post('project/update', [ProjectController::class,'project_update'])->name('project.update');
        Route::get('/project/delete/{id}', [ProjectController::class,'destroy'])->name('project.delete');
        Route::get('project_activities/export/{id}', [ProjectController::class,'getexport'])->name('project-export');
        //Project detail Routes
        Route::get('/project/detailupdate/{id}', [ProjectController::class,'createProject_details'])->name('project.detail');
        Route::get('/project/detailview/{id}', [ProjectController::class,'project_view'])->name('project.view');
        Route::get('/project/details', [ProjectController::class,'get_project_index'])->name('get_project_index');
        Route::post('get_project_details', [ProjectController::class,'get_project_details'])->name('admin.get_project_details');

        //Project Theme Routes
        Route::post('project_themes', [ProjectThemeController::class,'project_themes'])->name('admin.project_themes');
        Route::post('edit_project_theme', [ProjectThemeController::class,'edit_project_theme'])->name('edit_project_theme');
        Route::resource('/projectthemes', ProjectThemeController::class);
        Route::get('/project_theme/delete/{id}', [ProjectThemeController::class,'destroy'])->name('project_theme.delete');

        //Project Partner routes
        Route::resource('/projectpartners', ProjectPartnerController::class);
        Route::post('project_partners', [ProjectPartnerController::class,'project_partners'])->name('admin.project_partners');
        Route::post('edit_project_partner', [ProjectPartnerController::class,'edit_project_partner'])->name('edit_project_partner');
        Route::get('/project_partner/delete/{id}', [ProjectPartnerController::class,'destroy'])->name('project_partner.delete');

        //Project Reviews Route
        Route::resource('/projectreviews', ProjectReviewController::class);
        Route::get('/project_partner/create/{id}', [ProjectReviewController::class,'createreview'])->name('project_review.create');
        Route::post('project_reviews', [ProjectReviewController::class,'project_reviews'])->name('admin.project_reviews');
        Route::post('project_reviews_actionpoint', [ProjectReviewController::class,'project_reviews_actionpoint'])->name('admin.project_reviews_actionpoint');
        Route::post('view_review', [ProjectReviewController::class,'view_review'])->name('view_review');
        Route::get('/project_review/delete/{id}', [ProjectReviewController::class,'destroy'])->name('project_review.delete');
        //close Records routes
        Route::resource('/close_records', CloseRecordController::class);

        //Project Profile Route
        Route::resource('/projectprofiles', ProjectProfileController::class);
        Route::post('project_profile', [ProjectProfileController::class,'project_profile'])->name('admin.project_profile');
        Route::post('profile_detail', [ProjectProfileController::class,'profile_detail'])->name('admin.profile_detail');
        Route::get('/project_profile/delete/{id}', [ProjectProfileController::class,'destroy'])->name('project_profile.delete');
    });

    Route::get('/error', function () {
        abort(500);
    });

    Route::get('/auth/redirect/{provider}', [SocialiteController::class, 'redirect']);
    Route::get('otp/form/{email}', [StaffLoginController::class,'otp_form'])->name('otp.form');
    Route::post('postguest/login', [StaffLoginController::class,'login'])->name('postguest.login');
    Route::post('postguest/otp', [StaffLoginController::class,'login_otp'])->name('post_otp');
    require __DIR__ . '/auth.php';


