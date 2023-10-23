@extends('layouts.citizen')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Passport</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;" href="{{ url('citizen/passport/create')}}">Apply</a></button></li>
            </ol>
        </div><!-- /.col -->
      </div>
    </div><!-- /.container-fluid -->
</section>
@if(session('message'))
<div class="alert alert-success alert-dismissible fade show">{{ session('message') }}</div>
@endif
@if(session('error'))
<div class="alert alert-danger alert-dismissible fade show">{{ session('error') }}</div>
@endif
  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
         
          <!-- /.card -->

          <div class="card">
            <div class="card-header">
              <h3 class="card-title">Passport History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    
                    <th>Names</th>
                    <th>Status</th>
                    <th>Biometrics Date</th>
                </tr>
                </thead>
                @foreach ($passportApplications as $pp)
                <tbody>
                <tr>
                    <td>{{ $pp->citizen->user->name }} {{ $pp->citizen->lname }} {{ $pp->citizen->surname }}</td>
                    <td>
                      @php
                      $statusClass = '';
                      $statusText = '';
                      switch ($pp->status) {
                          case 'inreview':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'In Review';
                              break;
                          case 'processing':
                              $statusClass = 'badge badge-warning';
                              $statusText = 'Processing';
                              break;
                          case 'cancelled':
                              $statusClass = 'badge badge-danger';
                              $statusText = 'Canceled';
                              break;
                          case 'completed':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Completed';
                              break;
                      }
                      @endphp
                      <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>{{ $pp->date_to_submit_biometrics }}</td>
                </tr>
                @endforeach
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection