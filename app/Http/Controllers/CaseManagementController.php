<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Application;
use App\Models\Case_document;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CaseManagementController extends Controller
{
    public function declineCase(Request $request){
        try{
            $case = Application::where(['case_id'=>$request->case_id])->firstOrFail();
            if($case->status!='Withdrawn' && $case->status!='Declined'){
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
            if($case->status!='Withdrawn' && $case->status!='Declined' && $case->status!='Forwarded'){
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
        return View::make('components.secretary.approved-cases')->with(['cases'=>$this->getApprovedCases()]);
    }

    private function getApprovedCases(){
        $cases = DB::table('applications')
            ->join('courses','courses.crs_id','=','applications.course_id')
            ->join('instructors', 'instructors.reg_id','=', 'applications.instructor_id')
            ->join('students', 'students.reg_id', '=', 'applications.student_id')
            ->select('applications.*', 'students.first_name as st_fname', 'students.last_name as st_lname', 'students.reg_id as st_id','courses.name', 'courses.credit_hours', 'instructors.first_name', 'instructors.last_name', 'instructors.reg_id')
            ->where('applications.status','=','Approved')
            ->get();
        foreach($cases as $case){
            if (Case_document::where(['case_id'=>$case->case_id])->count() > 0){
                $case->files = Case_document::where(['case_id'=>$case->case_id])->get();
            }else{
                $case->files = Null;
            }
        }
        return $cases;
    }
}
