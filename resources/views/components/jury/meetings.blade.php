<?php $page = 'meetings' ?>
@extends('layouts.jury')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Activities</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <!-- <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li> -->
            </ol>
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

        <!-- Expandable Table Row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">All Meetings</h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Case ID</th>
                      <th>Type</th>
                      <th>Meeting Date</th>
                      <th>Meeting Status</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c=0 ?>
                      <?php foreach($meetings as $meeting) { ?>
                        <tr data-widget="expandable-table" aria-expanded="false">
                          <td>{{++$c}}</td>
                          <td>{{$meeting->case_id}}</td>
                          <td>{{$meeting->type}}</td>
                          <td>{{$meeting->start_time}}</td>
                          <td>{{$meeting->status}}</td>
                          <!-- <td class="text-center">
                            <a type="button" class="btn bg-gradient-success btn-sm  ml-2"  onclick="">Forward to ADC</a>
                            <a type="button" class="btn bg-gradient-danger btn-sm  ml-2"  onclick="">View Details</a>
                          </td> -->
                        </tr>
                        <tr class="expandable-body d-none">
                          <td colspan="6">

                            <div class="row">
                              <div class="col mt-2">
                                <h3>Case Details</h3>
                              </div>
                            </div>
                            <div class="row">
                              <!-- ./col -->
                              <div class="col">
                                <dl class="row">
                                  <dt class="col-sm-4">Meeting ID</dt>
                                  <dd class="col-sm-8">{{$meeting->meeting_id}}</dd>
                                  <dt class="col-sm-4">Password</dt>
                                  <dd class="col-sm-8">{{$meeting->password}}</dd>
                                  <dt class="col-sm-4">Join Link</dt>
                                  <dd class="col-sm-8"><a href="{{$meeting->join_url}}">{{$meeting->join_url}}</a></dd>
                                  <dt class="col-sm-4">Meeting Duration</dt>
                                  <dd class="col-sm-8">{{$meeting->duration}}</dd>
                                  <dt class="col-sm-4">Meeting Topic</dt>
                                  <dd class="col-sm-8">{{$meeting->topic}}</dd>
                                </dl>
                              </div>
                              <!-- ./col -->
                            </div>



                            <div class="row">
                              <div class="col text-right">
                                <a href="{{$meeting->join_url}}" class="btn bg-gradient-info btn-sm mr-2" style="width: 150px" onclick="" target="_blank"><i class="fa fa-video mr-2"></i>Join Meeting</a>
                              </div>
                            </div>

                          </td>
                        </tr>
                      <?php } ?>
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Expandable Table Row end -->
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /. Main content -->
@endsection