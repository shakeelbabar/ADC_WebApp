<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Judge;
use App\Models\Remark;
use App\Models\Application;
use App\Models\Case_document;
use App\Models\Application_status;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CaseManagementController extends Controller
{
    public function declineCaseBySecretary(Request $request){
        try{
            $case = Application::where(['case_id'=>$request->case_id])->firstOrFail();
            if($case->status!='Withdrawn' && $case->status!='Declined' && $case->status!='Forwarded' && $case->status!='Approved'){
                $case->status = 'Declined';
                $case->remarks = 'Case has been decline by ADC.';
                $case->save();
                echo 'true';
            }else{
                echo $case->status;
            }
        }catch(ModelNotFoundException $e){
            echo 'false';
        }
    }
    public function forwardToADC(Request $request){
        try{
            $case = Application::where(['case_id'=>$request->case_id])->firstOrFail();
            if($case->status!='Withdrawn' && $case->status!='Declined' && $case->status!='Forwarded' && $case->status!='Approved'){

                // Initialize new Application_status Object
                $status = new Application_status;
                $status->case_id = $request->case_id;
                $status->jury1 = 'Pending';
                $status->jury2 = 'Pending';
                $status->jury3 = 'Pending';
                $status->instructor = 'NA';
                $status->final_status = 'Pending';
                $status->save();

                // Initialize the Remark Object
                $remarks = new Remark;
                $remarks->case_id = $request->case_id;
                $remarks->jury1 = 'NA';
                $remarks->jury2 = 'NA';
                $remarks->jury3 = 'NA';
                $remarks->save();

                // Change status to Forwarded
                $case->status = 'Forwarded';
                $case->remarks = 'Case has been forwarded to ADC for approval.';
                $case->save();
                echo 'true';
            }else{
                echo $case->status;
            }
        }catch(ModelNotFoundException $e){
            echo 'false';
        }
    }

    public function approvedCases(){
        if(Auth::user()->hasRole('secretary'))
            return View::make('components.secretary.approved-cases')->with(['cases'=>$this->getApprovedCases()]);
        else if(Auth::user()->hasRole('jury'))
            return View::make('components.jury.approved-cases')->with(['cases'=>$this->getApprovedCases()]);
        else if(Auth::user()->hasRole('student'))
            return View::make('components.student.approved-cases')->with(['cases'=>$this->getStudentApprovedCases()]);
    }

    public function declinedCases(){
        if(Auth::user()->hasRole('secretary'))
            return View::make('components.secretary.declined-cases')->with(['cases'=>$this->getDeclinedCases()]);
        else if(Auth::user()->hasRole('jury'))
            return View::make('components.jury.declined-cases')->with(['cases'=>$this->getDeclinedCases()]);
        else if(Auth::user()->hasRole('student'))
            return View::make('components.student.declined-cases')->with(['cases'=>$this->getStudentDeclinedCases()]);
        
    }

    public function approveCase(Request $request){
        if(Judge::where(['reg_id'=>Auth::user()->reg_id])->exists())
            $role = strtolower(Judge::where(['reg_id'=>Auth::user()->reg_id])->first()->role);

        // Create Application_Statuses Model Object
        if(Application_status::where(['case_id'=>$request->case_id])->exists()){
            $obj = Application_status::where('case_id',$request->case_id)->first();
            if($obj->$role == 'Approved' || $obj->$role == 'Declined'){
                echo $obj->$role;
            }else{
                $obj->$role='Approved';
                $obj->save();
                echo 'true';
                // Create Application_Statuses Model Object
                if(Remark::where(['case_id'=>$request->case_id])->exists()){
                    $remarks = Remark::where('case_id',$request->case_id)->first();
                    $remarks->$role = $request->remarks."";
                    $remarks->save();
                }
            }
        }else{
            echo 'false';
        }
            // // Create Application_Statuses Model Object
            // $obj = Application_status::updateOrCreate(
            //     ['case_id'=>$request->case_id],
            //     [$jury=>'Approved']
            // );
            // $remarks = Remark::updateOrCreate(
            //     ['case_id'=>$request->case_id],
            //     [$jury=>$request->remarks]
            // );    

    }

    public function declineCase(Request $request){
        if(Judge::where(['reg_id'=>Auth::user()->reg_id])->exists())
            $role = strtolower(Judge::where(['reg_id'=>Auth::user()->reg_id])->first()->role);

        // Create Application_Statuses Model Object
        if(Application_status::where(['case_id'=>$request->case_id])->exists()){
            $obj = Application_status::where('case_id',$request->case_id)->first();
            if($obj->$role == 'Approved' || $obj->$role == 'Declined'){
                echo $obj->$role;
            }else{
                $obj->$role='Declined';
                $obj->save();
                echo 'true';
                // Create Application_Statuses Model Object
                if(Remark::where(['case_id'=>$request->case_id])->exists()){
                    $remarks = Remark::where('case_id',$request->case_id)->first();
                    $remarks->$role = $request->remarks."";
                    $remarks->save();
                }
            }
        }else{
            echo 'false';
        }
            // // Create Application_Statuses Model Object
            // $obj = Application_status::updateOrCreate(
            //     ['case_id'=>$request->case_id],
            //     [$jury=>'Approved']
            // );
            // $remarks = Remark::updateOrCreate(
            //     ['case_id'=>$request->case_id],
            //     [$jury=>$request->remarks]
            // );    

    }

    private function setFinalStatus(){
        foreach(Application_status::all() as $case){
            $counts = array_count_values(array_slice($case->toArray(), 2, 4));
            if(array_key_exists('Pending',$counts)){
                if($counts['Pending']>1)
                    $case->final_status = 'Pending';
            }if(array_key_exists('Declined',$counts)){
                if($counts['Declined']>1)
                    $case->final_status = 'Declined';
            }if(array_key_exists('Approved',$counts)){
                if($counts['Approved']>1)
                    $case->final_status = 'Approved';
            }
            $case->save();
        }
    }

    private function getApprovedCases(){
        $this->setFinalStatus();
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Approved')
            ->get();
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
            $case->approvals = $this->getApprovals($case);
            $case->adc_remarks = $this->getRemarks($case);
        }
        return $cases;
    }

    private function getDeclinedCases(){
        $this->setFinalStatus();
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Declined')
            ->get();
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
            $case->approvals = $this->getApprovals($case);
            $case->adc_remarks = $this->getRemarks($case);
        }
        return $cases;
    }

    private function getStudentApprovedCases(){
        $this->setFinalStatus();
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Approved')
            ->where('applications.student_id', '=',Auth::user()->reg_id)
            ->get();
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
            $case->approvals = $this->getApprovals($case);
            $case->adc_remarks = $this->getRemarks($case);
        }
        return $cases;
    }

    private function getStudentDeclinedCases(){
        $this->setFinalStatus();
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Declined')
            ->where('applications.student_id', '=', Auth::user()->reg_id)
            ->get();
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
            $case->approvals = $this->getApprovals($case);
            $case->adc_remarks = $this->getRemarks($case);
        }
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
}
