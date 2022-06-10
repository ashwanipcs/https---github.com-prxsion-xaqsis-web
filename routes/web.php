<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProjectsController;
use App\Http\Controllers\RecipientController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\ProjectActivityController;
use App\Http\Controllers\SimulationController;
use App\Http\Controllers\SummaryController;
use App\Http\Controllers\PERTAnalysisController;
use App\Http\Controllers\MCSAnalysisController;
use App\Http\Controllers\LicenseController;
use App\Http\Controllers\EventsController;
use App\Http\Controllers\ProjectEventMasterController;
use App\Http\Controllers\ContactController;


use App\Http\Controllers\XaqsisController;
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


//=============Login================
Route::get('/', [LoginController::class, 'indexAction'])->name('');
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/save', [LoginController::class, 'store'])->name('login.save');
Route::get('register', [LoginController::class, 'register'])->name('register');
Route::post('login/saveregister', [LoginController::class, 'createRegister'])->name('login.saveregister');
Route::get('forgotpassword', [LoginController::class, 'forgotPassword'])->name('forgotpassword');
Route::post('login/resetpassword', [LoginController::class, 'resetPassword'])->name('login.resetpassword');
Route::post('login/updatepassword', [LoginController::class, 'updatePassword'])->name('login.updatepassword');
Route::get('createaccountinvite', [LoginController::class, 'createAccountByInvitation'])->name('createaccountinvite');
Route::post('createaccountinvite', [LoginController::class, 'createAccountInviteAction'])->name('createaccountinvite');



//=============Dashboard================
Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('dashboard/profile', [DashboardController::class, 'getAccountProfile'])->name('dashboard.profile');
Route::get('editprofile', [DashboardController::class, 'getEditAccountProfile'])->name('editprofile');
Route::get('changeaccountpassword', [DashboardController::class, 'changeAccountPassword'])->name('changeaccountpassword');
Route::post('updateaccountpassword', [DashboardController::class, 'postChangeAccountPassword'])->name('updateaccountpassword');
Route::post('updateprofile', [DashboardController::class, 'updateAccountProfile'])->name('updateprofile');
Route::post('uploads', [DashboardController::class, 'fileUpload'])->name('uploads');
Route::get('accounts', [DashboardController::class, 'accountIndex'])->name('accounts');
Route::post('invitation', [DashboardController::class, 'inviteSendIndex'])->name('invitation');
Route::get('logout', [DashboardController::class, 'authLogout'])->name('logout');
Route::get('accesscontrol', [DashboardController::class, 'accountAccessControlIndex'])->name('accesscontrol');
Route::post('addroles', [DashboardController::class, 'addAccessControlAction'])->name('addroles');
Route::get('refreshaccess', [DashboardController::class, 'ajaxRefreshAccess'])->name('refreshaccess');


//==========Projects=============
Route::get('projects', [ProjectsController::class, 'index'])->name('projects');
Route::get('projects/create', [ProjectsController::class, 'create'])->name('projects.create');
Route::post('projects/save', [ProjectsController::class, 'store'])->name('projects.save');
Route::get('projects/edit/{id}', [ProjectsController::class, 'edit'])->name('projects.edit');
Route::post('projects/update', [ProjectsController::class, 'update'])->name('projects.update');
Route::get('projects/remove/{id}', [ProjectsController::class, 'destroy'])->name('projects.remove');

//==========Register=============
/*	
Route::get('register', [RegisterController::class, 'index'])->name('register');
Route::post('register/save', [RegisterController::class, 'store'])->name('register.save');*/		
Route::get('register/list', [RegisterController::class, 'show'])->name('register.list');

//==========Recipients=============
Route::get('recipients', [RecipientController::class, 'index'])->name('recipients');
Route::get('recipients/create', [RecipientController::class, 'create'])->name('recipients.create');
Route::post('recipients/save', [RecipientController::class, 'store'])->name('recipients.save');
Route::get('recipients/remove/{id}', [RecipientController::class, 'destroy'])->name('recipients.remove');

//==========Activity=============
Route::get('activity', [ActivityController::class, 'index'])->name('activity');
Route::post('activity/save', [ActivityController::class, 'store'])->name('activity.save');
Route::post('activity/edit', [ActivityController::class, 'edit'])->name('activity.edit');
Route::post('activity/update', [ActivityController::class, 'update'])->name('activity.update');
Route::get('activity/remove/{id}', [ActivityController::class, 'destroy'])->name('activity.remove');
Route::post('activity/syncActivity', [ActivityController::class, 'syncImportActivity'])->name('activity.syncActivity');	

//==========Project Activity=============
Route::get('projectactivity', [ProjectActivityController::class, 'index'])->name('projectactivity');
Route::get('projectactivity/create/{id}', [ProjectActivityController::class, 'create'])->name('projectactivity.create');
Route::post('projectactivity/save', [ProjectActivityController::class, 'store'])->name('projectactivity.save');
Route::get('projectactivity/edit', [ProjectActivityController::class, 'edit'])->name('projectactivity.edit');
Route::post('projectactivity/update', [ProjectActivityController::class, 'update'])->name('projectactivity.update');
Route::get('projectactivity/remove/{id}', [ProjectActivityController::class, 'destroy'])->name('projectactivity.remove');
Route::post('projectactivity/add', [ProjectActivityController::class, 'doCreate'])->name('projectactivity.add');
Route::post('projectactivity/updateprojectactivity', [ProjectActivityController::class, 'updateProjectActivities'])->name('projectactivity.updateprojectactivity');
Route::post('projectactivity/updateajax', [ProjectActivityController::class, 'ajaxProjectActivities'])->name('projectactivity.updateajax');
Route::get('projectactivity/updateOrder', [ProjectActivityController::class, 'updateOrderAction'])->name('projectactivity.updateOrder');

//==========Run Simulation=============
Route::get('simulation', [SimulationController::class, 'index'])->name('simulation');
Route::post('simulation/save', [SimulationController::class, 'store'])->name('simulation.save');
Route::post('simulation/update', [SimulationController::class, 'update'])->name('simulation.update');
Route::get('simulation/remove/{id}', [SimulationController::class, 'destroy'])->name('simulation.remove');
Route::get('simulation/simulationbyprojectuuid', [SimulationController::class, 'getSimulationByProjectuuid'])->name('simulation.simulationbyprojectuuid');
Route::get('simulation/simulation_run', [SimulationController::class, 'runSimulation'])->name('simulation.simulation_run');
Route::post('simulation/defaultsimulation', [SimulationController::class, 'defaultSimulation'])->name('simulation.defaultsimulation');

//==========Summary=============
Route::get('summary', [SummaryController::class, 'index'])->name('summary');
Route::get('summary/create/{id}', [SummaryController::class, 'doCreate'])->name('summary.create');
Route::get('summary/costanalysis', [SummaryController::class, 'costAnalysis'])->name('summary.costanalysis');
Route::post('summary/save', [SummaryController::class, 'store'])->name('summary.save');
Route::get('summary/views', [SummaryController::class, 'getxviews'])->name('summary.views');

//==========PERT Analysis=============
Route::get('pert-analysis', [PERTAnalysisController::class, 'index'])->name('pert-analysis');
//Route::get('pert-analysis/create/{project_uuid}/{simulation_type}', [PERTAnalysisController::class, 'doCreate'])->name('pert-analysis.create');
Route::get('pert-analysis/create', [PERTAnalysisController::class, 'doCreate'])->name('pert-analysis.create');

//==========MCS Analysis=============
Route::get('mcs-analysis', [MCSAnalysisController::class, 'index'])->name('mcs-analysis');
Route::get('mcs-analysis/create', [MCSAnalysisController::class, 'doCreate'])->name('mcs-analysis.create');

//==========License=============
Route::get('license', [LicenseController::class, 'index'])->name('license');
Route::get('license/create', [LicenseController::class, 'doCreate'])->name('license.create');
Route::post('license/save', [LicenseController::class, 'store'])->name('license.save');
Route::get('license/invoice/{id}', [LicenseController::class, 'invoice'])->name('license.invoice');
Route::post('license/sendinvoice', [LicenseController::class, 'sendInvoice'])->name('license.sendinvoice');
Route::post('license/uploads', [LicenseController::class, 'uploadLicense'])->name('license.uploads');
Route::post('license/success', [LicenseController::class, 'paymentSuccess'])->name('license.success');
Route::post('license/failure', [LicenseController::class, 'paymentFailure'])->name('license.failure');


//==========Events=============
Route::get('events', [EventsController::class, 'index'])->name('events');
Route::post('events/save', [EventsController::class, 'store'])->name('events.save');
Route::post('events/update', [EventsController::class, 'update'])->name('events.update');
Route::get('events/remove/{id}', [EventsController::class, 'destroy'])->name('events.remove');
Route::get('events/projectevents/{project_uuid}', [EventsController::class, 'projectsEvents'])->name('events.projectevents');

//==========Projects Events=============
Route::get('projectevents', [ProjectEventMasterController::class, 'index'])->name('projectevents');
Route::post('projectevents/create', [ProjectEventMasterController::class, 'store'])->name('projectevents.create');
Route::post('projectevents/update', [ProjectEventMasterController::class, 'update'])->name('projectevents.update');
Route::get('projectevents/remove/{id}', [ProjectEventMasterController::class, 'destroy'])->name('projectevents.remove');
Route::get('projectevents/createevents/{project_uuid}', [ProjectEventMasterController::class, 'projectEvents'])->name('projectevents.createevents');
//==========Contact Forms=============
Route::post('contact-form', [ContactController::class, 'contactForm'])->name('contact-form');


//==================Xaqsis Test Route======================//
Route::get('xaqsis', [XaqsisController::class, 'index'])->name('xaqsis.xaqsis');
Route::get('postlogin', [XaqsisController::class, 'postLogin'])->name('postlogin');
Route::get('xaqsis/getlist', [XaqsisController::class, 'getDataGuzzleClient'])->name('xaqsis.getlist');
Route::get('xaqsis/orglists', [XaqsisController::class, 'OrgAccountsList'])->name('xaqsis.orglist');
Route::get('xaqsis/addpost', [XaqsisController::class, 'postDataGuzzleClient'])->name('xaqsis.addpost');
Route::get('xaqsis/curlpost', [XaqsisController::class, 'postDataByCurl'])->name('xaqsis.curlpost');
Route::get('xaqsis/list', [XaqsisController::class, 'show'])->name('xaqsis.list');
Route::get('xaqsis/getaccountorgcurl', [XaqsisController::class, 'getOrgByAccountUuidCurl'])->name('xaqsis.getaccountorgcurl');	
Route::get('xaqsis/importactivity', [XaqsisController::class, 'importActivity'])->name('xaqsis.importactivity');	




// ================Dashboards===================

Route::prefix('dashboard')->name('dashboard.')->group(function () {
    Route::get('manage', function () {
        return view('manage');
    })->name('manage');

    Route::get('project/summary', function () {
        return view('summary');
    })->name('summary');

    Route::get('project/project_edit', function () {
        return view('project_edit');
    })->name('project_edit');

});

//============== Manage===========
Route::prefix('manage')->name('manage.')->group(function () {
    Route::get('recipient', function () {
        return view('manage-recipient');
    })->name('recipient');
    Route::get('cost-head', function () {
        return view('cost-head');
    })->name('cost-head');
});

//============== Settings===========

Route::prefix('settings')->name('settings.')->group(function () {
     
    Route::get('pricing', function () {
        return view('pricing');
    })->name('pricing');

    
    Route::get('pricing', function () {
        return view('pricing');
        })->name('pricing');

});


