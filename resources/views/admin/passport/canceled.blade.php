@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Passport Status Canceled</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <div class="btn-group">
                    <a href="{{ route('admin.passports.inreview') }}" class="btn btn-sm btn-primary mx-2">In Review</a>
                    <a href="{{ route('admin.passports.cancelled') }}" class="btn btn-sm btn-danger mx-2">Cancelled</a>
                    <a href="{{ route('admin.passports.processing') }}" class="btn btn-sm btn-warning mx-2">Processing</a>
                    <a href="{{ route('admin.passports.completed') }}" class="btn btn-sm btn-success mx-2">Completed</a>
                  </div>
            </li>
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
              <h3 class="card-title">Passport Status Canceled</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Names</th>
                    <th>Status</th>
                    <th>Biometrics Date</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach ($passports as $pp)
                <tbody>
                <tr>
                    <td>{{ $pp->citizen->idnumber }}</td>
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
                    <td><a href="{{ route('admin.passports.edit', $pp) }}" class="btn btn-primary">Edit</a></td>
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