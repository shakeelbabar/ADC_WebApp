<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CaseRegistrationController;
use App\Http\Controllers\CaseManagementController;
use App\Http\Controllers\VirtualMeetingController;
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
    Route::get('download', [CaseRegistrationController::class, 'downloadFile'])->name('download');
});

// Only for students
Route::group(['middleware' => ['auth', 'role:student']], function(){
    Route::get('withdrawal-case', [CaseRegistrationController::class, 'withdrawalCase'])->name('withdrawal_case');
    Route::get('attendance-case', [CaseRegistrationController::class, 'attendanceCase'])->name('attendance_case');
    Route::get('makeupexam-case', [CaseRegistrationController::class, 'makeupExamCase'])->name('makeupexam_case');
    Route::get('new-case', [CaseRegistrationController::class, 'newCase'])->name('new_case');
    Route::get('confirm-wth-case', [CaseRegistrationController::class, 'confirmWithdrawalCase'])->name('confirm_withdrawal_case');
    Route::get('confirm-att-case', [CaseRegistrationController::class, 'confirmAttendanceCase'])->name('confirm_attendance_case');
    Route::get('confirm-mkp-case', [CaseRegistrationController::class, 'confirmMakeupExamCase'])->name('confirm_makeupexam_case');
    Route::post('submit-wth-case', [CaseRegistrationController::class, 'submitWithdrawalCase'])->name('submit_withdrawal_case');
    Route::post('submit-att-case', [CaseRegistrationController::class, 'submitAttendanceCase'])->name('submit_attendance_case');
    Route::post('submit-mkp-case', [CaseRegistrationController::class, 'submitMakeupExamCase'])->name('submit_makeupexam_case');
    Route::get('withdrawal_case_ajax', [CaseRegistrationController::class, 'withdrawalCaseAjax'])->name('withdrawal_case_ajax');
    Route::get('requestCancel', [CaseRegistrationController::class, 'requestCancel'])->name('requestCance');
    // Route::get('requestCancel', [CaseRegistrationController::class, 'requestCancel'])->name('requestCancel1');
});

// Only for secretary
Route::group(['middleware'=>['auth', 'role:secretary']], function(){
    Route::get('adc-approved-cases', [CaseManagementController::class, 'approvedCases'])->name('adc-approved-cases');
    Route::get('adc-declined-cases', [CaseManagementController::class, 'declinedCases'])->name('adc-declined-cases');
    Route::get('decline-case', [CaseManagementController::class, 'declineCase'])->name('decline-case');
    Route::get('forward-to-adc', [CaseManagementController::class, 'forwardToADC'])->name('forward-to-adc');
    Route::get('meetings', [VirtualMeetingController::class, 'scheduleMeeting'])->name('meetings');
});

// Route::post('/register', [RegisteredUserController::class, 'store'])->name('register');

require __DIR__.'/auth.php';


// select distinct crs.name, ins.first_name, ins.last_name, crs.credit_hours, att.presents, att.absents from registrations as rg,  courses as crs, instructors as ins, attendance_records as att where crs.crs_id=rg.course_id and ins.reg_id = rg.instructor_id  and att.student_id='021-17-0037' and rg.student_id='021-17-0037' and crs.crs_id=att.course_id;
