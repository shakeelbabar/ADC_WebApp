<?php $page = 'adc-declined-cases' ?>
@extends('layouts.secretary')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Declined Cases by ADC</h1>
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


        <!-- Fixed Table row -->
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Generate Meetings for Cases</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body table-responsive p-0">
                <table class="table table-hover text-nowrap">
                  <thead>
                    <tr>
                      <th style="width:10px;">#</th>
                      <th>Application ID</th>
                      <th>Type</th>
                      <th>Date</th>
                      <!-- <th>Status</th> -->
                      <th>Jury1</th>
                      <th>Jury2</th>
                      <th>Jury3</th>
                      <th>Final Status</th>
                      <!-- <th>Remarks</th> -->
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $c=0 ?>
                    @foreach($cases as $case)
                    <tr>
                      <td >{{++$c}}</td>
                        <td class="text-left">{{$case->case_id}}</td>
                        <td>{{$case->type}}</td>
                        <td>{{date('d M, Y', strtotime($case->created_at))}}</td> 
                        <!-- <td><span class="tag tag-success">{{$case->approvals->final_status}}</span></td> -->
                        <!-- <td>{{$case->remarks}}</td> -->
                        <td id="jury1-approval" class="text-<?php if($case->approvals->jury1=='Pending') echo 'warning'; elseif($case->approvals->jury1=='Approved') echo 'info'; else echo 'danger';?>">
                          <i class="fa fa-<?php if($case->approvals->jury1=='Pending') echo 'spinner'; elseif($case->approvals->jury1=='Approved') echo 'check'; else echo 'times';?> mr-2"></i>
                            {{$case->approvals->jury1}}
                        </td>
                        <td id="jury2-approval" class="text-<?php if($case->approvals->jury2=='Pending') echo 'warning'; elseif($case->approvals->jury2=='Approved') echo 'info'; else echo 'danger';?>">
                          <i class="fa fa-<?php if($case->approvals->jury2=='Pending') echo 'spinner'; elseif($case->approvals->jury2=='Approved') echo 'check'; else echo 'times';?> mr-2"></i>
                            {{$case->approvals->jury2}}
                        </td>
                        <td id="jury3-approval" class="text-<?php if($case->approvals->jury3=='Pending') echo 'warning'; elseif($case->approvals->jury3=='Approved') echo 'info'; else echo 'danger';?>">
                            <i class="fa fa-<?php if($case->approvals->jury3=='Pending') echo 'spinner'; elseif($case->approvals->jury3=='Approved') echo 'check'; else echo 'times';?> mr-2"></i>
                            {{$case->approvals->jury3}}
                          </td>
                          <!-- <td id="instructor-approval" class="text-<?php if($case->approvals->instructor=='Pending') echo 'warning'; elseif($case->approvals->instructor=='Approved') echo 'info'; else echo 'danger';?>">
                            <i class="fa fa-<?php if($case->approvals->instructor=='Pending') echo 'spinner'; elseif($case->approvals->instructor=='Approved') echo 'check'; else echo 'times';?> mr-2"></i>
                            {{$case->approvals->instructor}}
                          </td> -->
                          <td id="final_status" class="text-<?php if($case->approvals->final_status=='Pending') echo 'warning'; elseif($case->approvals->final_status=='Approved') echo 'success'; else echo 'danger';?>">
                            <i class="fa fa-<?php if($case->approvals->final_status=='Pending') echo 'spinner'; elseif($case->approvals->final_status=='Approved') echo 'check'; else echo 'times';?> fa-lg mr-2"></i>
                            {{$case->approvals->final_status}}
                          </td>
                          <!-- <pre> -->
                            <?php $case = array_merge((array)$case, $case->approvals->toArray());?>
                          <!-- </pre> -->
                        <!-- <td class="text-right">
                            <a href="{{route('meetings', ['case'=>$case])}}" type="button" class="btn bg-gradient-info btn-sm mr-2" style="width: 130px" >Schedule Meeting</a>
                        </td> -->
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