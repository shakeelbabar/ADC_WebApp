<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Registration;
use App\Models\Course;
use App\Models\Instructor;



class CaseRegistrationController extends Controller
{
    public function newCase(){
        return view('components.add-application');
    }

    public function withdrawalCase(){
        return view('components.withdraw-form');
    }

    public function attendanceCase(){
        return view('components.attendance-form');
    }

    public function makeupExamCase(){
        return view('components.makeupexam-form');
    }

    public static function getRegisteredCourses(){
        $users = DB::table('registrations')
            ->join('courses', 'courses.crs_id', '=', 'registrations.course_id')
            ->join('instructors', 'instructors.reg_id', '=', 'registrations.instructor_id')
            ->join('attendance_records', 'attendance_records.course_id', '=', 'registrations.course_id')
            ->select('courses.name', 'instructors.first_name', 'instructors.last_name', 'courses.credit_hours', 'attendance_records.presents', 'attendance_records.absents')
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
