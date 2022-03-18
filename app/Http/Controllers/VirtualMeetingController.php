<?php


namespace App\Http\Controllers;
use View;
use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;


include(app_path() . '/zoomapi/config.php');
include(app_path() . '/zoomapi/api.php');

class VirtualMeetingController extends Controller
{

    // API KEY: xniFcQsFRmilBwLubdgC5w
    // API SECRET: qqkzScZlZ2y12LNg1BYeS4O8FPRUBzFxaj6V
    // Varification TOKEN: zwejTduTRrSJ66fWTcaixA

    public function scheduleMeeting(Request $request){
        // echo '<pre>';
        // print_r($request->case);
        // echo '<pre> <br>';
        // echo '<pre> <br>';
        // echo 'Next <br>';
        // print_r($request->approvals);
        // die();
        return View::make('components.secretary.schedule-meeting')->with(['case'=>$request->case]);
    }

    public function getMeetings(Request $request){
        if(Auth::user()->hasRole('secretary'))
            return View::make('components.secretary.meetings')->with(['meetings'=>$this->getAllMeetings()]);
        else if(Auth::user()->hasRole('jury'))
            return View::make('components.jury.meetings')->with(['meetings'=>$this->getAllMeetings()]);
        else if(Auth::user()->hasRole('student'))
            return View::make('components.student.meetings')->with(['meetings'=>$this->getStudentMeetings()]);
    }

    public function getStudentMeetings(){
        $meetings = DB::table('meetings')
            ->join('applications','applications.case_id','=','meetings.case_id')
            ->select('meetings.*', 'applications.type')
            ->where('applications.student_id','=',Auth::user()->reg_id)
            ->get();
        // foreach($cases as $case){
        //     $case->files = $this->getCaseFiles($case);
        //     $case->approvals = $this->getApprovals($case);
        //     $case->adc_remarks = $this->getRemarks($case);
        // }
         return $meetings;
    }

    public function getAllMeetings(){
        $meetings = DB::table('meetings')
            ->join('applications','applications.case_id','=','meetings.case_id')
            ->select('meetings.*', 'applications.type')
            ->get();
        // foreach($cases as $case){
        //     $case->files = $this->getCaseFiles($case);
        //     $case->approvals = $this->getApprovals($case);
        //     $case->adc_remarks = $this->getRemarks($case);
        // }
         return $meetings;
    }

    public function generateMeeting(Request $request){
        // echo($request->case_id);
        // echo($request->topic);
        // echo($request->start_time);
        // echo($request->duration);
        // die();
        // echo date("Y-m-d h:i:s A", strtotime($request->start_time));
        // die();

        $arr['topic']=$request->topic;
        $arr['start_date']=date("Y-m-d H:i:s", strtotime($request->start_time));
        $arr['duration']=$request->duration;
        $arr['password']=substr(md5(uniqid(mt_rand(), true)), 0, 8);;
        $arr['type']='2';
        $result=createMeeting($arr);
        if(isset($result->id)){
            // Creating meeting Model Instance
            $meeting = new Meeting;
            $meeting->meeting_id = $result->id;
            $meeting->topic = $result->topic;
            $meeting->status = $result->status;
            //$meeting->start_url = $result->start_url;
            $meeting->join_url = $result->join_url;
            $meeting->password = $result->password;
            $meeting->start_time = date("Y-m-d H:i:s", strtotime($result->start_time)-(7*60*60));
            $meeting->duration = $result->duration;
            $meeting->created_at = $result->created_at;
            $meeting->case_id = $request->case_id;

            $meeting->save();

            return json_encode(
                (object)[
                    "join_url"=>$result->join_url,
                    "meeting_id"=>$result->id,
                    "password"=>$result->password,
                    "start_time"=>$result->start_time,
                    "duration"=>$result->duration,
                    "topic"=>$result->topic,
                    "status"=>$result->status
                ]
            );
            // echo "Join URL: <a href='".$result->join_url."'>".$result->join_url."</a><br/>";
            // echo "Password: ".$result->password."<br/>";
            // echo "Start Time: ".$result->start_time."<br/>";
            // echo "Duration: ".$result->duration."<br/>";
        }else{
            echo '<pre>';
            print_r($result);
            die();
        }
    }
}
