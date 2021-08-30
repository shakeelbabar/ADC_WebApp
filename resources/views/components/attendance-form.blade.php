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
        
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Attendance Case Submission</h3>
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
              <?php $c=0; foreach ($users as $user){ if($user->absents>7){ ?>
              <tr>
                <td><?php echo ++$c ?></td>
                <td><?php echo $user->name ?></td>
                <td><?php echo $user->first_name.' '.$user->last_name ?></td>
                <td><?php echo $user->credit_hours?></td>
                <td><?php echo $user->presents?></td>
                <td><?php echo $user->absents?></td>
                <td><button class="btn bg-gradient-<?php echo $user->absents>7?'warning':'primary'?> btn-sm mr-2 ml-2" style="width: 100px"><?php echo $user->absents>7?'Submit Case':'Withdraw' ?></button></td>
              </tr>
              <?php }} ?>
            </tbody>
          </table>
        </div>
        <p class="card-description ml-4"><strong>Note:</strong> Attendance exceeding 7 of any registered course will be submitted for further proceedings.</p>
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