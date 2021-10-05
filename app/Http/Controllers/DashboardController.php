<?php

namespace App\Http\Controllers;
use View;
use App\Models\Registration;
use App\Models\Application;
use App\Models\Case_document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()){
            $data = array(
                'username'=>Auth::user()->name,
                'user_id'=>Auth::user()->reg_id,
                'email'=>Auth::user()->email,
                'cases'=>$this->getApplications(),
                'approved'=>$this->getCasesCount('Approved'),
                'pending'=>$this->getCasesCount('Pending'),
                'forwarded'=>$this->getCasesCount('Forwarded'),
                'withdrawn'=>$this->getCasesCount('Withdrawn'),
                'declined'=>$this->getCasesCount('Declined')
            );
            if(Auth::user()->hasRole('admin')){
                return View::make('dashboards.admin')->with(['data'=>$data]);
            }elseif(Auth::user()->hasRole('student')){
                return View::make('dashboards.student')->with(['data'=>$data]);
            }elseif(Auth::user()->hasRole('instructor')){
                return View::make('dashboards.instructor')->with(['data'=>$data]);
            }elseif(Auth::user()->hasRole('jury')){
                return View::make('dashboards.jury')->with(['data'=>$data]);
            }elseif(Auth::user()->hasRole('secretary')){
                return View::make('dashboards.secretary')->with(['data'=>$data]);
            }
        }else{
            return redirect()->intended(RouteServiceProvider::LOGIN);
        }
    }

    private function registerations(){
        $result = Registration::all();
        foreach ($result as $i){
            echo('(\''.$i->student_id.'\', \''.$i->course_id.'\', \'84\', \'5\',  \''.$i->created_at.'\', \''.$i->updated_at.'\'),');
            echo('<br>');
        }
        die();
    }

    private function getAllApplications(){
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->select('applications.*', 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->get();
        return $cases;
    }

    private function getStudentApplications(){
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->select('applications.*', 'courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name')
            ->where('applications.student_id', '=', Auth::user()->reg_id)
            ->get();
        return $cases;
    }

    private function getApplications(){
        // return Application::where(['student_id'=>Auth::user()->reg_id])->get();
        $cases = null;
        if(Auth::user()->hasRole('student')){
            $cases = $this->getStudentApplications();
        }elseif(Auth::user()->hasRole('secretary')){
            $cases = $this->getAllApplications();
        }
        foreach($cases as $case){
            if (Case_document::where(['case_id'=>$case->case_id])->count() > 0){
                $case->files = Case_document::where(['case_id'=>$case->case_id])->get();
            }else{
                $case->files = Null;
            }
        }
        return $cases;
    }
    
    private function getCasesCount($status){
        return Application::where(['status'=>$status, 'student_id'=>Auth::user()->reg_id])->count();
    }
}