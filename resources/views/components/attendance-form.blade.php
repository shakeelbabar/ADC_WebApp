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


      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Withdrawal Case Submission</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Credit Hours</th>
                <th style="width: 10px">Presents</th>
                <th style="width: 10px">Absents</th>
                <th style="width: 10px"></th>
              </tr>
            </thead>
            <tbody>
            <?php $c = 0 ?>
                @foreach ($courses as $course)
                  @if($course->absents > 7)
                <tr>
                  <td>{{++$c}}</td>
                  <td>{{$course->name}}</td>
                  <td>{{$course->first_name.' '.$course->last_name}}</td>
                  <td>{{$course->credit_hours}}</td>
                  <td>{{$course->presents}}</td>
                  <td>{{$course->absents}}</td>
                  <td><a href="{{ route('confirm_attendance_case', ['data'=>$course]) }}" class="btn bg-gradient-warning btn-sm {{ $course->registered==true?'disabled':'' }} mr-2 ml-2" style="width: 100px">Submit Case</a></td>
                </tr>
                @endif
              @endforeach
            </tbody>
          </table>
        </div>
        <!-- /.card-body -->
        <div class="card-footer clearfix">
          <ul class="pagination pagination-sm m-0 float-right">
            <li class="page-item"><a class="page-link" href="#">«</a></li>
            <li class="page-item"><a class="page-link" href="#">1</a></li>
            <li class="page-item"><a class="page-link" href="#">2</a></li>
            <li class="page-item"><a class="page-link" href="#">3</a></li>
            <li class="page-item"><a class="page-link" href="#">»</a></li>
          </ul>
        </div>
      </div>



      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection