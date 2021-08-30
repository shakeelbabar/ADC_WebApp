<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaseRegistrationController;
use App\Http\Controllers\Auth\RegisteredUserController;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('home', function(){
    return view('dashboards.student');
});
Route::get('home1', function(){
    return view('dashboards.student1');
});


// for All Users
Route::group(['middleware', ['auth']], function(){
    Route::get('registerations', [DashboardController::class, 'registerations'])->name('registrations');
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Only for students
Route::group(['middleware' => ['auth', 'role:student']], function(){
    Route::get('withdrawal-case', [CaseRegistrationController::class, 'withdrawalCase'])->name('withdrawal_case');
    Route::get('attendance-case', [CaseRegistrationController::class, 'attendanceCase'])->name('attendance_case');
    Route::get('makeupexam-case', [CaseRegistrationController::class, 'makeupExamCase'])->name('makeupexam_case');
    Route::get('new-case', [CaseRegistrationController::class, 'newCase'])->name('new_case');
    Route::get('submit-case', [CaseRegistrationController::class, 'confirmWithdrawalCase'])->name('confirm_withdrawal_case');
    Route::post('confirm-submit', [CaseRegistrationController::class, 'submitWithdrawalCase'])->name('submit_withdrawal_case');
});


// Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

require __DIR__.'/auth.php';


// select distinct crs.name, ins.first_name, ins.last_name, crs.credit_hours, att.presents, att.absents from registrations as rg,  courses as crs, instructors as ins, attendance_records as att where crs.crs_id=rg.course_id and ins.reg_id = rg.instructor_id  and att.student_id='021-17-0037' and rg.student_id='021-17-0037' and crs.crs_id=att.course_id;
