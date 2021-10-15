<?php

namespace App\Http\Controllers;
use View;
use Illuminate\Http\Request;

class VirtualMeetingController extends Controller
{
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
}
