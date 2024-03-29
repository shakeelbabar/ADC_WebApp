<?php $page = 'makeupexam' ?>
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
        
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Apply for the Makeup Paper Examination</h3>
        </div>
        <!-- /.card-header -->
        <div class="card-body">
          <table class="table table-bordered text-nowrap">
            <thead>
              <tr>
                <th style="width: 10px">#</th>
                <th>Course Name</th>
                <th>Instructor</th>
                <th>Semester</th>
                <th>Credit Hours</th>
                <th style="width: 10px">Presents</th>
                <th style="width: 10px">Absents</th>
                <th style="width: 10px"></th>
              </tr>
            </thead>
            <tbody>
            <?php $c = 0 ?>
              @foreach ($courses as $course)
              <tr>
                <td>{{++$c}}</td>
                <td>{{$course->name}}</td>
                <td>{{$course->first_name.' '.$course->last_name}}</td>
                <td>{{$course->term}}</td>
                <td>{{$course->credit_hours}}</td>
                <td>{{$course->presents}}</td>
                <td>{{$course->absents}}</td>
                <td><a href="{{ route('confirm_makeupexam_case', ['data'=>$course]) }}" class="btn bg-gradient-success btn-sm mr-2 ml-2 {{ $course->registered==true?'disabled':'' }}" style="width: 100px">Apply</button></td>
              </tr>
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