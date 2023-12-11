<?php

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

   
    



    
    // ... other dashboard routes
});







