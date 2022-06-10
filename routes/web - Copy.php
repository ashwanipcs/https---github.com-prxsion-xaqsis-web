<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ForgotPasswordController;
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

/* Route for Register by API*/

Route::get('login', [LoginController::class, 'index'])->name('login'); 
Route::post('login/save', [LoginController::class, 'store'])->name('login.save'); 
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


Route::get('register', [RegisterController::class, 'create'])->name('register'); 
Route::post('register/save', [RegisterController::class, 'store'])->name('register.save'); 

Route::get('forget-password', [ForgotPasswordController::class, 'index'])->name('forget-password');
Route::post('forget-password/save', [ForgotPasswordController::class, 'store'])->name('forget.password.save'); 

//Route::get('registration', [RegisterController::class, 'registration'])->name('register-user');



// ================Dashboards===================

Route::prefix('dashboard')->name('dashboard.')->group(function () {

    Route::get('analytics', function () {
        return view('analytics');
    })->name('analytics');

    Route::get('project', function () {
        return view('projects');
    })->name('project');

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
// ================Dashboards===================



//============== Manage===========
Route::prefix('manage')->name('manage.')->group(function () {
    Route::get('recipient', function () {
        return view('manage-recipient');
    })->name('recipient');
    Route::get('cost-head', function () {
        return view('cost-head');
    })->name('cost-head');
});
//============== /Manage===========



//============== Settings===========

Route::prefix('settings')->name('settings.')->group(function () {
    Route::get('profile', function () {
        return view('profile');
    })->name('profile');

    Route::get('pricing', function () {
        return view('pricing');
    })->name('pricing');

    Route::get('pricing', function () {
        return view('pricing');
        })->name('pricing');

});

//============== Settings===========


