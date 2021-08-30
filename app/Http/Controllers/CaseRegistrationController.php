<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use App\Models\Course;
use App\Models\Instructor;



class CaseRegistrationController extends Controller
{
    public function newCase(){
        return View::make('components.add-application')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function withdrawalCase(){
        return View::make('components.withdraw-form')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function attendanceCase(){
        return View::make('components.attendance-form')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function makeupExamCase(){
        return View::make('components.makeupexam-form')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function confirmWithdrawalCase(Request $request){
        // echo 'hello';
        // echo '<pre>';
        // echo $request->data['crs_id'].'<br>';
        // echo $request->data['name'].'<br>';
        // echo $request->data['first_name'].' '.$request->data['last_name'].'<br>';
        // echo $request->data['credit_hours'].'<br>';
        // echo $request->data['presents'].'<br>';
        // echo $request->data['absents'].'<br>';
        // die();

        $data = array(
            'course_name'=>$request->data['name'],
            'course_id'=>$request->data['crs_id'],
            'instructor_name'=>$request->data['first_name'].' '.$request->data['last_name'],
            'credit_hours'=>$request->data['credit_hours'],
            'presents'=>$request->data['presents'],
            'absents'=>$request->data['absents']
        );
        return View::make('components.register-withdrawal')->with($data);
    }

    public function submitWithdrawalCase(Request $request){
        echo '<pre>';
        echo 'Application ID: ATT00'.strtoupper(substr($request->_token,0,7));
        return redirect()->route('dashboard');
    }

    public static function getRegisteredCourses(){
        $users = DB::table('registrations')
            ->join('courses', 'courses.crs_id', '=', 'registrations.course_id')
            ->join('instructors', 'instructors.reg_id', '=', 'registrations.instructor_id')
            ->join('attendance_records', 'attendance_records.course_id', '=', 'registrations.course_id')
            ->select('courses.crs_id', 'courses.name', 'instructors.first_name', 'instructors.last_name', 'courses.credit_hours', 'attendance_records.presents', 'attendance_records.absents')
            ->where('registrations.student_id','=',Auth::user()->reg_id)
            ->where('attendance_records.student_id', '=', Auth::user()->reg_id)
            ->get();
        return $users;
        // echo '<pre>';
        // foreach($users as $user){
        //     echo $user->name.'<br>';
        //     echo $user->first_name.'<br>';
        //     echo $user->last_name.'<br>';
        //     echo $user->credit_hours.'<br>';
        //     echo $user->presents.'<br>';
        //     echo $user->absents.'<br>';
        // }
        // die();
    }

    /*

    select distinct crs.name, ins.first_name, ins.last_name,
    crs.credit_hours, att.presents, att.absents
    from registrations as rg,  courses as crs, instructors as ins,
    attendance_records as att
    where crs.crs_id=rg.course_id
    and ins.reg_id = rg.instructor_id 
    and att.student_id='021-17-0037'
    and rg.student_id='021-17-0037'
    and crs.crs_id=att.course_id;
    
    */


}
