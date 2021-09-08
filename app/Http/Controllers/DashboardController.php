<?php

namespace App\Http\Controllers;
use View;
use App\Models\Registration;
use App\Models\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()){
            $data = array(
                'username'=>Auth::user()->name,
                'user_id'=>Auth::user()->reg_id,
                'email'=>Auth::user()->email,
                'cases'=>$this->getApplications()
            );
            // echo '<pre>';
            // // // print_r($data['cases']);
            // foreach($data['cases'] as $case){
            //     echo $case->case_id;
            // }
            // die();
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

    private function getApplications(){
        return Application::where(['student_id'=>Auth::user()->reg_id])->get();
        // return $rs;
    }
}
