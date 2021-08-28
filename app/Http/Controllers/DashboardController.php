<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;

class DashboardController extends Controller
{
    public function index(){
        if(Auth::user()->hasRole('admin')){
            return view('dashboards.admin');
        }elseif(Auth::user()->hasRole('student')){
            return view('dashboards.student');
        }elseif(Auth::user()->hasRole('instructor')){
            return view('dashboards.instructor');
        }elseif(Auth::user()->hasRole('jury')){
            return view('dashboards.jury');
        }elseif(Auth::user()->hasRole('secretary')){
            return view('dashboards.secretary');
        }
    }

    public function registerations(){
        $result = Registration::all();
        foreach ($result as $i){
            echo('(\''.$i->student_id.'\', \''.$i->course_id.'\', \'84\', \'5\',  \''.$i->created_at.'\', \''.$i->updated_at.'\'),');
            echo('<br>');
        }
        die();
    }

    public function newCase(){
        return view('components.add_application');
    }
}
