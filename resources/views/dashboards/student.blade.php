<?php $page = 'dashboard' ?>
@extends('layouts.student')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Overview of Cases' Status</h1>
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
        <!-- Small boxes (Stat box) -->
        <div class="row">

        <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>{{$data['approved']}}</h3>

                <p><strong>Approved/Active</strong></p>
                <span>1 Withdrawal</span><br>
                <span>1 Attendance</span><br>
                <span>0 MakeUp Paper</span>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <!--
          <div class="col-lg-3 col-6">
            small box  // comment this     
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Completed</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          ./col // comment this
          -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>{{$data['pending']+$data['forwarded']}}</h3>

                <p><strong>Pending/Forwarded</strong></p>
                <span>{{$data['pending']}} Pending</span><br>
                <span>{{$data['forwarded']}} Forwarded</span><br>
                <span>0 MakeUp Paper</span>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>{{$data['withdrawn']}}</h3>

                <p><strong>Withdrawn/Cancelled</strong></p>
                <span>1 Withdrawal</span><br>
                <span>1 Attendance</span><br>
                <span>0 MakeUp Paper</span>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->


          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>{{$data['declined']}}</h3>

                <p><strong>Declined</strong></p>
                <span>1 Withdrawal</span><br>
                <span>1 Attendance</span><br>
                <span>0 MakeUp Paper</span>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

        <!-- New Application Button Row -->
        <!-- <div class="row mb-5 mt-0">
          <div class="col-lg-4">
            <a href="{{ route('withdrawal_case') }}" type="button" class="btn btn-lg btn-block bg-gradient-info"><i class="fas fa-plus mr-2"></i>Withdraw Course</a>
          </div>
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
                <h3 class="card-title">Recent Applications</h3>
              </div>
              <!-- ./card-header -->
              <div class="card-body">
                <table class="table table-bordered table-hover">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Case ID</th>
                      <th>Type</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c=0 ?>
                      @foreach($data['cases'] as $case)
                      <tr data-widget="expandable-table" aria-expanded="false">
                        <td>{{++$c}}</td>
                        <td>{{$case->case_id}}</td>
                        <td>{{$case->type}}</td>
                        <td>{{$case->status}}</td>
                      </tr>
                      <tr class="expandable-body d-none">
                        <td colspan="4">

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
                              <a type="button" class="btn bg-gradient-danger btn-sm mr-2 ml-2" style="width: 150px" onclick="cancelRequest('{{$case->case_id}}')">Request Cancellation</a>
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

        
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /. Main content -->
@endsection