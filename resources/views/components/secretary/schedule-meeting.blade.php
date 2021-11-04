<?php $page = 'schedule-meeting' ?>
@extends('layouts.secretary')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Schedule a Meeting</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol> -->
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- New Application Button Row -->
        <!-- <div class="row mb-5 mt-0">
          <div class="col-lg-4">
            <a href="{{ route('withdrawal_case') }}" type="button" class="btn btn-lg btn-block bg-gradient-info"><i class="fas fa-plus mr-2"></i>Withdraw Course</a>
          </div>
            More info 
            53%
            Bounce Rate

            More info 
            44
            User Registrations

            More info 
            65
            Unique Visitors

            More info 
          <div class="col-lg-4">
            <a href="{{ route('attendance_case') }}" type="button" class="btn btn-lg btn-block bg-gradient-warning"><i class="fas fa-plus mr-2"></i>Submit Attendance Case</a>
          </div>
           <div class="col-lg-4">
            <a href="{{ route('makeupexam_case') }}" type="button" class="btn btn-lg btn-block bg-gradient-danger"><i class="fas fa-plus mr-2"></i>Appy for Makeup Exam</a>
          </div>
        </div> -->
        <!-- /.row -->
        <div class="row">
          <div class="col">
            <div class="card card-info">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px">
                  <i class="fas fa-check-square mr-1"></i>
                  Schedule a Virtual Meeting 
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('submit_withdrawal_case') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <div class="row">
                      <div class="col-6">
                        <dl class="row" style="font-size: 17px">
                          <dt class="col-sm-6">Case ID</dt>
                          <dd class="col-sm-6">{{$case['case_id']}}</dd>
                          <dt class="col-sm-6">Category</dt>
                          <dd class="col-sm-6">{{$case['type']}}</dd>
                          <dt class="col-sm-6">Student Name</dt>
                          <dd class="col-sm-6">{{$case['st_fname'].' '.$case['st_lname']}}</dd>
                          <!-- <input type="hidden" name="course_id" id="course_id" value="{{$case['case_id']}}"> -->
                          <dt class="col-sm-6">Course</dt>
                          <dd class="col-sm-6">{{$case['name']}}</dd>
                          <!-- <input type="hidden" name="course_name" id="course_name" value="{{$case['name']}}"> -->
                          <dt class="col-sm-6">Instructor</dt>
                          <dd class="col-sm-6">{{$case['first_name'].' '.$case['last_name']}}</dd>
                          <!-- <input type="hidden" name="instructor_name" id="instructor_name" value="{{$case['first_name'].' '.$case['last_name']}}"> -->
                          <dt class="col-sm-6">Credit Hours</dt>
                          <dd class="col-sm-6">{{$case['credit_hours']}}</dd>
                          <!-- <input type="hidden" name="credit_hours" id="credit_hours" value="{{$case['credit_hours']}}"> -->
                          <dt class="col-sm-6">Status</dt>
                          <dd class="col-sm-6">{{$case['final_status']}}
                            <!-- <input type="text" class="form-control" name="reason" id="reason"> -->
                          </dd>
                          <!-- <input type="hidden" name="date" id="date" value="{{date('d M, Y')}}">
                          <input type="hidden" name="student_name" id="student_name" value="{{Auth::user()->name}}">
                          <input type="hidden" name="student_id" id="student_id" value="{{Auth::user()->reg_id}}"> -->
                        </dl>
                      </div>
                      <div class="col-6">
                        <h3 class="mb-3">Meeting Details</h3>
                        <!-- Date and time -->
                        <div class="form-group">
                        <label>Date and time of Meeting</label>
                            <div class="input-group date" id="reservationdatetime" data-target-input="nearest">
                                <input type="text" class="form-control datetimepicker-input" data-target="#reservationdatetime">
                                <div class="input-group-append" data-target="#reservationdatetime" data-toggle="datetimepicker">
                                    <div class="input-group-text"><i class="far fa-calendar-alt"></i></div>
                                </div>
                            </div>
                        </div>
                        <!-- /.form group -->
                        <!-- Date and time range -->
                        <div class="form-group">
                        <label>Meeting Minutes Duration</label>
                          <div class="row">
                            <div class="col-5">
                              <div class="input-group date" id="timepickerfrom" data-target-input="nearest">
                                <input type="number" min=1 max=120 class="form-control" data-target="#timepickerfrom">
                                <div class="input-group-append" data-target="#timepickerfrom" data-toggle="datetimepicker">
                                  <div class="input-group-text left"><i class="far fa-clock"></i></div>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                        <!-- /.form group -->
                      </div>
                  </div>
                  
                  <div class="row mt-5">
                    <div class="col-lg-7 mb-0">
                      <!-- <div class="form-group"> -->
                        <!-- <label for="exampleInputFile">File input</label> -->
                        <!-- <div class="input-group"> -->
                          <!-- <div class="custom-file">
                            <input type="file" name="doc[]" class="custom-file-input" id="uploaded_files" multiple>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div> -->
                        <!-- </div> -->
                      <!-- </div> -->
                    </div>
                    <div class="col-lg-2 mb-0">
                      <a href="{{url()->previous()}}" class="btn btn-block bg-gradient-warning " ><i class="fa fa-arrow-left mr-1"></i> Back</a>
                    </div>
                      <div class="col-lg-3 mb-0">
                      <input type="button" name="link-btn" value="Generate Meeting Link" class="btn bg-gradient-info btn-block" onclick="generateLink('{{$case['case_id']}}')">;
                    </div>
                  </div>
                </form>
                <!-- Seperator Line -->
                <hr>
                <!-- / Seperator Line -->
                <div class="row">
                  <div class="col">
                    <strong><div id="nof"><h3>Generated Schedule</h3></div></strong>
                    <div> Invitation Link: <strong><a href="#" id="meeting-link">LINK URL</a></strong></div>
                    <div id="meeting-id">Meeting ID: <strong>189 90898 989</strong></div>
                    <div id="meeting-pass">Meeting Password: <strong>*******</strong></div>
                    <div id="meeting-time">Date & Time: <strong>{{date('F d, Y h:i:s A', time())}}</strong></div>
                    <div id="selected-files">Invitation Link <strong>LINK URL</strong></div>
                    <hr>
                    <!-- <strong><div id="nof"><h3>Meeting Parcip</h3></div></strong> -->
                    <div id="meeting-link">Invitation Link: <strong>LINK URL</strong></div>
                    <div id="meeting-id">Meeting ID: <strong>189 90898 989</strong></div>
                    <div id="meeting-pass">Meeting Password: <strong>*******</strong></div>
                    <div id="meeting-time">Date & Time: <strong>{{date('d F, Y h:i:s A', time())}}</strong></div>
                    <div id="selected-files">Invitation Link <strong>LINK URL</strong></div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /. Main content -->
@endsection