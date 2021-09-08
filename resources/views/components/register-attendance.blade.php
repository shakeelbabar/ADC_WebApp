<?php $page = 'attendance' ?>
@extends('layouts.student')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

        <!-- Row Quick Form -->
        <!--
        <div class="row">
          <div class="col">
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Withdrawal Case Registration</h3>
              </div>
              <form>
                <div class="card-body">

                  <div class="form-group">
                    <label>Select Course</label>
                    <select class="form-control">
                      <option>option 1</option>
                      <option>option 2</option>
                      <option>option 3</option>
                      <option>option 4</option>
                      <option>option 5</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div>
                  <div class="form-group">
                    <label for="exampleInputFile">File input</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                      </div>
                    </div>
                  </div>
                  <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                  </div>
                </div>

                <div class="card-footer">
                  <button type="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
          </div>
        </div> 
        -->
        <!-- /. row Quick Form -->

        <div class="row">
          <div class="col">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title" style="font-size: 22px">
                  <i class="fas fa-check-square mr-1"></i>
                  Cofirm Case Submission
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="{{ route('submit_attendance_case') }}" method="POST" enctype="multipart/form-data">
                  @csrf
                  <dl class="row" style="font-size: 17px">
                    <dt class="col-sm-4">Case</dt>
                    <dd class="col-sm-8">Attendance</dd>
                    <dt class="col-sm-4">Course ID</dt>
                    <dd class="col-sm-8">{{$course_id}}</dd>
                    <input type="hidden" name="course_id" id="course_id" value="{{$course_id}}">
                    <dt class="col-sm-4">Course Name</dt>
                    <dd class="col-sm-8">{{$course_name}}</dd>
                    <input type="hidden" name="course_name" id="course_name" value="{{$course_name}}">
                    <dt class="col-sm-4">Instructor</dt>
                    <dd class="col-sm-8">{{$instructor_name}}</dd>
                    <input type="hidden" name="instructor_name" id="instructor_name" value="{{$instructor_name}}">
                    <dt class="col-sm-4">Credit Hours</dt>
                    <dd class="col-sm-8">{{$credit_hours}}</dd>
                    <input type="hidden" name="credit_hours" id="credit_hours" value="{{$credit_hours}}">
                    <dt class="col-sm-4">Attendance Presents Counts</dt>
                    <dd class="col-sm-8">{{$presents}}</dd>
                    <input type="hidden" name="presents" id="presents" value="{{$presents}}">
                    <dt class="col-sm-4">Attendancec Absents Counts</dt>
                    <dd class="col-sm-8">{{$absents}}</dd>
                    <input type="hidden" name="absents" id="absents" value="{{$absents}}">
                    <dt class="col-sm-4">Date</dt>
                    <dd class="col-sm-8">{{date('d M, Y')}}</dd>
                    <dt class="col-sm-4">Reason</dt>
                    <dd class="col-sm-8">
                      <input type="text" class="form-control" name="reason" id="reason">
                      @if($errors->any())
                        {{ implode('', $errors->all(':message')) }}
                      @endif
                    </dd>
                    <input type="hidden" name="date" id="date" value="{{date('d M, Y')}}">
                    <input type="hidden" name="student_name" id="student_name" value="{{Auth::user()->name}}">
                    <input type="hidden" name="student_id" id="student_id" value="{{Auth::user()->reg_id}}">
                  </dl>
                  <div class="row mt-3">
                    <div class="col-lg-7 mb-3">
                      <!-- <div class="form-group"> -->
                        <!-- <label for="exampleInputFile">File input</label> -->
                        <!-- <div class="input-group"> -->
                          <div class="custom-file">
                            <input type="file" name="doc[]" class="custom-file-input" id="uploaded_files" multiple>
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                        <!-- </div> -->
                      <!-- </div> -->
                    </div>
                    <div class="col-lg-2 mb-3">
                      <a href="{{url()->previous()}}" class="btn btn-block bg-gradient-warning " ><i class="fa fa-arrow-left mr-1"></i> Back</a>
                    </div>
                      <div class="col-lg-3 mb-3">
                      <input type="submit" name="submit" value="{{$absents>7?'Confirm Submission':'Confirm Withdrawal'}}" class="btn bg-gradient-info btn-block">
                    </div>
                  </div>
                </form>
                <div class="row">
                  <div class="col">
                    <strong><div id="nof"></div></strong>
                    <div id="selected-files"></div>
                  </div>
                </div>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- ./col -->
        </div>


      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection