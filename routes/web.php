<?php

use App\Http\Controllers\departmentReportController;
use App\Http\Controllers\dayReportController;
use App\Http\Controllers\ReasonReportController;
use App\Http\Controllers\IntervieweeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ApplyController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FrontDeskController;
use App\Http\Middleware\AuthenticatedMiddleware;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [HomeController::class, 'home'])->name('home');


Route::get('/applyForVisit', [ApplyController::class, 'apply'])->name('apply');
Route::get('/applyForVisit', [ApplyController::class, 'apply'])->name('apply');
Route::get('/getStaff/{id?}', [ApplyController::class, 'getStaff'])->name('getStaff');
Route::post('/applyStore', [ApplyController::class, 'applyStore'])->name('applyStore');

Route::get('/admin_login', [LoginController::class, 'login'])->name('login');
Route::post('/dashboard', [LoginController::class, 'log_in'])->name('log_in');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');






Route::group(['middleware' => ['web', AuthenticatedMiddleware::class]], function () {
    // Routes that require an active session
    Route::get('/dashboard', [FrontdeskController::class, 'dashboard'])->name('dashboard');

    // New Visitor route Start here
    Route::get('/new_visitors_application', [FrontdeskController::class, 'new_visitor'])->name('new_visitor');
    Route::get('/new_visitors_approve/{id}', [FrontdeskController::class, 'visitor_approve'])->name('visitor_approve');
    Route::post('/final_approve', [FrontdeskController::class, 'final_approve'])->name('final_approve');
    Route::get('/application_reject/{id}', [FrontdeskController::class, 'application_reject'])->name('application_reject');
    Route::get('/application_details/{id}', [FrontdeskController::class, 'application_details'])->name('application_details');
    Route::get('/new_visitor_add', [FrontdeskController::class, 'new_visitor_add'])->name('new_visitor_add');
    // New Visitor route End here

    Route::get('/total_visitors', [FrontdeskController::class, 'total_visitor'])->name('total_visitor');

    // Department route Start here
    Route::get('/department_list', [FrontdeskController::class, 'department_list'])->name('department_list');
    Route::get('/new_department_add', [FrontdeskController::class, 'new_department_add'])->name('new_department_add');
    Route::post('/deptStore', [FrontdeskController::class, 'deptStore'])->name('deptStore');
    Route::get('/department_delete/{id}', [FrontdeskController::class, 'department_delete'])->name('department_delete');
    Route::post('/edit_department', [FrontdeskController::class, 'deptUpdate'])->name('deptUpdate');
    // Department route End here

    // Staffs route Start here
    Route::get('/staff_list', [FrontdeskController::class, 'staff_list'])->name('staff_list');
    Route::get('/staff_delete/{id}', [FrontdeskController::class, 'staff_delete'])->name('staff_delete');
    Route::get('/new_staff_add', [FrontdeskController::class, 'new_staff_add'])->name('new_staff_add');
    Route::post('/staffStore', [FrontdeskController::class, 'staffStore'])->name('staffStore');
    Route::post('/edit_staff', [FrontdeskController::class, 'staffUpdate'])->name('staffUpdate');
    // Staffs route End here

    // Reasons route Start here
    Route::get('/reason_list', [FrontdeskController::class, 'reason_list'])->name('reason_list');
    Route::get('/reason_delete/{id}', [FrontdeskController::class, 'reason_delete'])->name('reason_delete');
    Route::get('/new_reason_add', [FrontdeskController::class, 'new_reason_add'])->name('new_reason_add');
    Route::post('/reasonStore', [FrontdeskController::class, 'reasonStore'])->name('reasonStore');
    Route::post('/edit_reason', [FrontdeskController::class, 'reasonUpdate'])->name('reasonUpdate');
    // Reason route End here

    //Department Wise Report Start 
    Route::get('/departmentWiseReport', [departmentReportController::class, 'departmentWiseReport'])->name('departmentWiseReport');
    Route::get('/departmentReportStore', [departmentReportController::class, 'departmentReportStore'])->name('departmentReportStore');
    //Department Wise Report End


     //Day Wise Report Start 
     Route::get('/dayWiseReport', [dayReportController::class, 'dayWiseReport'])->name('dayWiseReport');
     Route::get('/dayReportStore', [dayReportController::class, 'dayReportStore'])->name('dayReportStore');
     //Day Wise Report End

    //Day Wise Report Start 
    Route::get('/reasonWiseReport', [ReasonReportController::class, 'reasonWiseReport'])->name('reasonWiseReport');
    Route::get('/reasonReportStore', [ReasonReportController::class, 'reasonReportStore'])->name('reasonReportStore');
    //Day Wise Report End

   //Interviewee Start
   Route::get('/interviewee_registration', [IntervieweeController::class, 'interviewee_registration'])->name('interviewee_registration');
   Route::post('/intervieweeStore', [IntervieweeController::class, 'intervieweeStore'])->name('intervieweeStore');
   //Interviewee End
    



    
    // ... other dashboard routes
});







