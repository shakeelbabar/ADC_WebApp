<?php $page = 'approved-cases' ?>
@extends('layouts.secretary')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Approved Cases</h1>
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
                <h3 class="card-title">Approved Cases</h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Case ID</th>
                      <th>Type</th>
                      <th>Student Name</th>
                      <th>Course</th>
                      <th>Status</th>
                      <!-- <th></th> -->
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c=0 ?>
                      @foreach($cases as $case)
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{++$c}}</td>
                        <td>{{$case->case_id}}</td>
                        <td>{{$case->type}}</td>
                        <td>{{$case->st_fname.' '.$case->st_lname}}</td>
                        <td>{{$case->name}}</td>
                        <td>{{$case->status}}</td>
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
                                <dt class="col-sm-4">Case ID</dt>
                                <dd class="col-sm-8">{{$case->case_id}}</dd>
                                <dt class="col-sm-4">Case Type</dt>
                                <dd class="col-sm-8">{{$case->type}}</dd>
                                <dt class="col-sm-4">Submission Date</dt>
                                <dd class="col-sm-8">{{date('d M, Y h:i:s', strtotime($case->created_at))}}</dd>
                                <dt class="col-sm-4">Course</dt>
                                <dd class="col-sm-8">{{$case->name}}</dd>
                                <dt class="col-sm-4">Instructor Name</dt>
                                <dd class="col-sm-8">{{$case->first_name.' '.$case->last_name}}</dd>
                                <dt class="col-sm-4">Reason</dt>
                                <dd class="col-sm-8">{{$case->reason}}</dd>
                                <dt class="col-sm-4">Remarks</dt>
                                <dd class="col-sm-8">{{$case->remarks}}</dd>
                                @if ($case->files != Null)
                                <dt class="col-sm-4">Documents Attached</dt>
                                  <dd class="col-sm-8">
                                    <div class="row">
                                      @foreach ($case->files as $file)
                                      <div class="col-sm-3 mt-2">
                                        <div class="position-relative border border-secondary container-img" style="height: 100px; overflow: hidden;">
                                          <img src="{{asset(Storage::url($file->file))}}" alt="Photo 1" class="img-fluid image-doc" onclick="alert('hello')">
                                          <div class="middle-doc">
                                            <a type="button" class="btn btn-secondary btn-sm down-btn" onclick="downloadFile('{{$file->file}}')"><i class="fa fa-download"></i></a>
                                            <a type="button" class="btn btn-danger btn-sm down-btn"><i class="fa fa-trash-alt"></i></a>
                                          </div>
                                        </div>
                                      </div>
                                      @endforeach
                                    </div>
                                  </dd>
                                @endif
                              </dl>
                            </div>
                            <!-- ./col -->
                          </div>

                          <div class="row">
                            <div class="col text-right">
                              <a type="button" class="btn bg-gradient-danger btn-sm mr-2 ml-2" style="width: 150px" onclick="declineCase('{{$case->case_id}}')">Decline</a>
                              <a type="button" class="btn bg-gradient-info btn-sm mr-2" style="width: 150px" onclick="forwardToADC('{{$case->case_id}}')">Forward to ADC</a>
                            </div>
                          </div>
                          <div class="row">
                            <div class="col" id="response-{{$case->case_id}}" style="display: none;">
                              <div class="alert alert-dismissible" style="height: 50px;">
                              <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                              <p class="message"><i class="icon fas fa-times"></i></p>
                              </div>
                            </div>
                          </div>
                        </td>
                      </tr>
                      @endforeach

                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- Expandable Table Row end -->


        <!-- Fixed Table row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Applications</h3>

                <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                    <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                    <div class="input-group-append">
                      <button type="submit" class="btn btn-default">
                        <i class="fas fa-search"></i>
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Application ID</th>
                      <th>Type</th>
                      <th>Date</th>
                      <th>Status</th>
                      <th>Remarks</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c=0 ?>
                    @foreach($cases as $case)
                      <tr>
                        <td>{{++$c}}</td>
                        <td>{{$case->case_id}}</td>
                        <td>{{$case->type}}</td>
                        <td>{{date('d M, Y', strtotime($case->created_at))}}</td>
                        <td><span class="tag tag-success">{{$case->status}}</span></td>
                        <td>{{$case->remarks}}</td>
                        <td>
                            <a href="{{route('meetings', ['case'=>$case])}}" type="button" class="btn bg-gradient-info btn-sm" style="width: 130px" onclick="forwardToADC('{{$case->case_id}}')">Schedule Meeting</a>
                        </td>
                      </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
        <!-- /. Fixed Table row end -->        
      
        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /. Main content -->
@endsection