<?php

namespace App\Http\Controllers;

use View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\Models\Registration;
use App\Models\Course;
use App\Models\Instructor;
use App\Models\Application;
use App\Models\Case_document;
use App\Providers\RouteServiceProvider;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class CaseRegistrationController extends Controller
{
    public function newCase(){
        return View::make('components.add-application')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function withdrawalCase(){
        return View::make('components.withdraw-form')->with(['courses'=>$this->getRegisteredCourses('Withdrawal')]);
    }

    public function withdrawalCaseAjax(){
        return View::make('components.withdraw-form-ajax')->with(['users'=>$this->getRegisteredCourses()]);
    }

    public function attendanceCase(){
        return View::make('components.attendance-form')->with(['courses'=>$this->getRegisteredCourses('Attendance')]);
    }

    public function makeupExamCase(){
        return View::make('components.makeupexam-form')->with(['courses'=>$this->getRegisteredCourses('Makeup Exam')]);
    }

    public function confirmWithdrawalCase(Request $request){
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

    public function confirmAttendanceCase(Request $request){
        $data = array(
            'course_name'=>$request->data['name'],
            'course_id'=>$request->data['crs_id'],
            'instructor_name'=>$request->data['first_name'].' '.$request->data['last_name'],
            'credit_hours'=>$request->data['credit_hours'],
            'presents'=>$request->data['presents'],
            'absents'=>$request->data['absents']
        );
        return View::make('components.register-attendance')->with($data);
    }

    public function confirmMakeupExamCase(Request $request){
        $data = array(
            'course_name'=>$request->data['name'],
            'course_id'=>$request->data['crs_id'],
            'instructor_name'=>$request->data['first_name'].' '.$request->data['last_name'],
            'credit_hours'=>$request->data['credit_hours'],
            'presents'=>$request->data['presents'],
            'absents'=>$request->data['absents'],
            'term'=>$request->data['term']
        );
        return View::make('components.register-makeupexam')->with($data);
    }

    public function submitWithdrawalCase(Request $request){
        $request->validate([
            'course_id'=>'required|string',
            'course_name'=>'required|string',
            'instructor_name'=>'required|string',
            'credit_hours'=>'required|string',
            'presents'=>'required|string',
            'absents'=>'required|string',
            'date'=>'required|string',
            'reason'=>'required|string',
            'student_name'=>'required|string',
            'student_id'=>'required|string',
            'file'=>'mimes:jpg,png'
        ]);
        // echo '<pre>';
        // print_r($request->file('doc')).'<br>';
        // // echo('File Name: '.$request->file('doc')[0]->getClientOriginalName()).'<br>';
        // // echo('Extension: '.$request->file('doc')[0]->extension()).'<br>';
        // // echo('MimeType: '.$request->file('doc')[0]->getMimeType()).'<br>';
        // // echo('Temp Name: '.$request->file('doc')[0]->getFileName()).'<br>';
        // // echo('Temp Path: '.$request->file('doc')[0]->getPathName()).'<br>';
        // echo sizeof($request->file('doc'));
        // die();
        $type = 'Withdrawal';
        $case_id = $this->caseId($type);
        $name=explode(' ',$request->instructor_name,2);
        $ins = Instructor::where(['first_name'=>$name[0], 'last_name'=>$name[1]])->first();;

        // Uploads attached files (if any);
        if($request->file('doc') && sizeof($request->file('doc'))>0){
            foreach($request->file('doc') as $file){
                /**
                 * Store File with Unique ID as filename
                 * Returns file path with generated Name
                 */
                $path = Storage::disk('public')->putFile('cases/'.$case_id, $file);
                
                // Create New Case_document Model Object
                $doc = new Case_document;
                $doc->case_id = $case_id;
                $doc->file = $path;
    
                // Save document Object;
                $doc->save();
            }
        }        
        // Create Application Model Object
        $case = new Application;
        $case->case_id = $case_id;
        $case->type = $type;
        $case->student_id = $request->student_id;
        $case->course_id = $request->course_id;
        $case->instructor_id = $ins->reg_id;
        $case->reason = $request->reason;
        $case->status = 'Pending';
        $case->remarks = 'Submitted to ADC Secretary for Remarks';
        // Save Object into Database Model
        $case->save();


        // Redirecting to Dashbaord
        return redirect()->intended(RouteServiceProvider::HOME);
    }

    public function submitAttendanceCase(Request $request){
        $request->validate([
            'course_id'=>'required|string',
            'course_name'=>'required|string',
            'instructor_name'=>'required|string',
            'credit_hours'=>'required|string',
            'presents'=>'required|string',
            'absents'=>'required|string',
            'date'=>'required|string',
            'reason'=>'required|string',
            'student_name'=>'required|string',
            'student_id'=>'required|string',
            'file'=>'mimes:jpg,png'
        ]);
        // echo '<pre>';
        // // print_r($request->file('doc')).'<br>';
        // // echo('File Name: '.$request->file('doc')[0]->getClientOriginalName()).'<br>';
        // // echo('Extension: '.$request->file('doc')[0]->extension()).'<br>';
        // // echo('MimeType: '.$request->file('doc')[0]->getMimeType()).'<br>';
        // // echo('Temp Name: '.$request->file('doc')[0]->getFileName()).'<br>';
        // // echo('Temp Path: '.$request->file('doc')[0]->getPathName()).'<br>';
        // echo sizeof($request->file('doc'));
        // die();
        $type = 'Attendance';
        $case_id = $this->caseId($type);
        $name=explode(' ',$request->instructor_name,2);
        $ins = Instructor::where(['first_name'=>$name[0], 'last_name'=>$name[1]])->first();;

        // Create Application Model Object
        $case = new Application;
        $case->case_id = $case_id;
        $case->type = $type;
        $case->student_id = $request->student_id;
        $case->course_id = $request->course_id;
        $case->instructor_id = $ins->reg_id;
        $case->reason = $request->reason;
        $case->status = 'Pending';
        $case->remarks = 'Submitted to ADC Secretary for Remarks';
        // Save Object into Database Model
        $case->save();

        // Uploads attached files (if any);
        if($request->file('doc') && sizeof($request->file('doc'))>0){
            foreach($request->file('doc') as $file){
                /**
                 * Store File with Unique ID as filename
                 * Returns file path with generated Name
                 */
                $path = Storage::disk('public')->putFile('cases/'.$case_id, $file);
                
                // Create New Case_document Model Object
                $doc = new Case_document;
                $doc->case_id = $case_id;
                $doc->file = $path;
    
                // Save document Object;
                $doc->save();
            }
        }

        // Redirecting to Dashbaord
        return redirect()->intended(RouteServiceProvider::HOME);

    }

    public function submitMakeupExamCase(Request $request){
        $request->validate([
            'course_id'=>'required|string',
            'course_name'=>'required|string',
            'instructor_name'=>'required|string',
            'credit_hours'=>'required|string',
            'term'=>'required|string',
            'presents'=>'required|string',
            'absents'=>'required|string',
            'date'=>'required|string',
            'reason'=>'required|string',
            'student_name'=>'required|string',
            'student_id'=>'required|string',
            'file'=>'mimes:jpg,png'
        ]);
        // echo '<pre>';
        // print_r($request->file('doc')).'<br>';
        // // echo('File Name: '.$request->file('doc')[0]->getClientOriginalName()).'<br>';
        // // echo('Extension: '.$request->file('doc')[0]->extension()).'<br>';
        // // echo('MimeType: '.$request->file('doc')[0]->getMimeType()).'<br>';
        // // echo('Temp Name: '.$request->file('doc')[0]->getFileName()).'<br>';
        // // echo('Temp Path: '.$request->file('doc')[0]->getPathName()).'<br>';
        // echo sizeof($request->file('doc'));
        // die();
        $type = 'Makeup Exam';
        $case_id = $this->caseId($type);
        $name=explode(' ',$request->instructor_name,2);
        $ins = Instructor::where(['first_name'=>$name[0], 'last_name'=>$name[1]])->first();;

        // Uploads attached files (if any);
        if($request->file('doc') && sizeof($request->file('doc'))>0){
            foreach($request->file('doc') as $file){
                /**
                 * Store File with Unique ID as filename
                 * Returns file path with generated Name
                 */
                $path = Storage::disk('public')->putFile('cases/'.$case_id, $file);
                
                // Create New Case_document Model Object
                $doc = new Case_document;
                $doc->case_id = $case_id;
                $doc->file = $path;
    
                // Save document Object;
                $doc->save();
            }
        }        
        // Create Application Model Object
        $case = new Application;
        $case->case_id = $case_id;
        $case->type = $type;
        $case->student_id = $request->student_id;
        $case->course_id = $request->course_id;
        $case->instructor_id = $ins->reg_id;
        $case->reason = $request->reason;
        $case->status = 'Pending';
        $case->remarks = 'Submitted to ADC Secretary for Remarks';
        // Save Object into Database Model
        $case->save();


        // Redirecting to Dashbaord
        return redirect()->intended(RouteServiceProvider::HOME);
    }


    public static function getRegisteredCourses($type){
        $courses = DB::table('registrations')
            ->join('courses', 'courses.crs_id', '=', 'registrations.course_id')
            ->join('instructors', 'instructors.reg_id', '=', 'registrations.instructor_id')
            ->join('attendance_records', 'attendance_records.course_id', '=', 'registrations.course_id')
            ->select('courses.crs_id', 'courses.name', 'registrations.term' , 'instructors.first_name', 'instructors.last_name', 'courses.credit_hours', 'attendance_records.presents', 'attendance_records.absents')
            ->where('registrations.student_id','=',Auth::user()->reg_id)
            ->where('attendance_records.student_id', '=', Auth::user()->reg_id)
            ->get();

        // echo '<pre>';
        // print_r($users[1]->crs_id);
        // die();
        foreach($courses as $course){
            $rs = Application::where(['student_id'=>Auth::user()->reg_id,'course_id'=>$course->crs_id, 'type'=>$type])->first();
            if($rs){
                $course->registered = true;
            }else{
                $course->registered = false;
            }
        }
        return $courses;
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

    private function caseId($type, $length = 7) {
        $id=strtoupper(substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length));
        if($type=='Withdrawal')
            return 'WTH00'.$id;
        elseif($type=='Attendance')
            return 'ATT00'.$id;
        elseif($type=='Makeup Exam')
            return 'MKP00'.$id;
    }

    public function requestCancel(Request $request){
        try{
            $case = Application::where(['case_id'=>$request->case_id])->firstOrFail();
            if($case->status!='Withdrawn' && $case->status!='Declined'){
                $case->status = 'Withdrawn';
                $case->save();
                echo 'true';
            }else{
                echo $case->case_status;
            }
        }catch(ModelNotFoundException $e){
            echo 'false';
        }
    }

    public function downloadFile(Request $request){
        if(Storage::disk('public')->exists($request->file)){
            $path = Storage::disk('public')->path($request->file);
            $content = file_get_contents($path);
            // return response($content)->withHeaders([
            //     'Content-Type' => mime_content_type($path)
            // ]);
            return response()->download($path);
        }
    }
}
