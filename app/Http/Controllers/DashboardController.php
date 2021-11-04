<?php

namespace App\Http\Controllers;
use View;
use App\Models\Remark;
use App\Models\Registration;
use App\Models\Application;
use App\Models\Case_document;
use App\Models\Application_status;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Providers\RouteServiceProvider;
use App\Http\Controllers\CaseManagementController;

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

    private function getAllForwardedApplications(){
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Pending')
            ->get();
        return $cases;    
    }

    private function setFinalStatus(){
        foreach(Application_status::all() as $case){
            $counts = array_count_values(array_slice($case->toArray(), 2, 5));
            if(array_key_exists('Pending',$counts)){
                if($counts['Pending']>1)
                    $case->final_status = 'Pending';
            }elseif(array_key_exists('Declined',$counts)){
                if($counts['Declined']>1)
                    $case->final_status = 'Declined';
            }elseif(array_key_exists('Approved',$counts)){
                if($counts['Approved']>1)
                    $case->final_status = 'Approved';
            }
            $case->save();
        }
    }

    private function getApplications(){
        $this->setFinalStatus();
        $cases = null;
        if(Auth::user()->hasRole('student')){
            $cases = $this->getStudentApplications();
        }elseif(Auth::user()->hasRole('secretary')){
            $cases = $this->getAllApplications();
        }elseif(Auth::user()->hasRole('jury')){
            $cases = $this->getAllForwardedApplications();
        }
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
            $case->approvals = $this->getApprovals($case);
            $case->adc_remarks = $this->getRemarks($case);
        }
        // echo '<pre>';
        // print_r($case->approvals);
        // die();
        return $cases;
    }

    private function getApprovals($case){
        if(Application_status::where(['case_id'=>$case->case_id])->exists())
            return Application_status::where(['case_id'=>$case->case_id])->first();
        else
            return null;
    }

    private function getCaseFiles($case){
        if(Case_document::where(['case_id'=>$case->case_id])->exists())
            return Case_document::where(['case_id'=>$case->case_id])->get();
        else
            return null;
    }

    private function getRemarks($case){
        if(Remark::where(['case_id'=>$case->case_id])->exists())
            return Remark::where(['case_id'=>$case->case_id])->first();
        else
            return null;
    }
    
    private function getCasesCount($status){
        if($status == 'Approved' || $status == 'Declined'){
            return  DB::table('applications')
                    ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
                    ->where('applications.student_id', '=', Auth::user()->reg_id)
                    ->where('application_statuses.final_status', '=', $status)
                    ->count();
        }else if($status == 'Forwarded'){
            return  DB::table('applications')
                    ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
                    ->where('applications.student_id', '=', Auth::user()->reg_id)
                    ->where('applications.status', '=', $status)
                    ->where('application_statuses.final_status', '=', 'Pending')
                    ->count();
        }else{
            return Application::where(['status'=>$status, 'student_id'=>Auth::user()->reg_id])->count();
        }
    }
}