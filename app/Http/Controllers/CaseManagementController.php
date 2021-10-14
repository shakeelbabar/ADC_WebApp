<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\Case_document;
use App\Models\Application_status;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CaseManagementController extends Controller
{
    public function declineCase(Request $request){
        try{
            $case = Application::where(['case_id'=>$request->case_id])->firstOrFail();
            if($case->status!='Withdrawn' && $case->status!='Declined' && $case->status!='Forwarded' && $case->status!='Approved'){
                $case->status = 'Declined';
                $case->remarks = 'Case has been decline by Secretary due to certain reasons.';
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
                $status->instructor = 'Pending';
                $status->final_status = 'Pending';
                $status->save();

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
        $this->setFinalStatus();
        return View::make('components.secretary.approved-cases')->with(['cases'=>$this->getApprovedCases()]);
    }

    private function setFinalStatus(){
        foreach(Application_status::all() as $case){
            $counts = array_count_values(array_slice($case->toArray(), 2, 5));
            if(array_key_exists('Pending',$counts))
                if($counts['Pending']>1)
                    $case->final_status = 'Pending';
            elseif(array_key_exists('Declined',$counts))
                if($counts['Declined']>2)
                    $case->final_status = 'Declined';
            elseif(array_key_exists('Approved',$counts))
                if($counts['Approved']>2)
                    $case->final_status = 'Approved';
            $case->save();
        }

    }

    private function getApprovedCases(){
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->join('application_statuses', 'application_statuses.case_id', '=', 'applications.case_id')
            ->select('applications.*', 'application_statuses.*' , 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('application_statuses.final_status','=','Approved')
            ->get();
        foreach($cases as $case){
            $case->files = $this->getCaseFiles($case);
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
    
}
