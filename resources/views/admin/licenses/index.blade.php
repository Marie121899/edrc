@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Licenses</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"></li>
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
              <h3 class="card-title">Licenses</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>License Number</th>
                        <th>Expiration Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($licenses as $license)
                        <tr>
                            <td>{{ $license->license_number }}</td>
                            <td>{{ $license->expiration_date }}</td>
                            <td>
                              @php
                            $statusClass = '';
                            $statusText = '';
                            switch ($license->status) {
                                case 'active':
                                    $statusClass = 'badge badge-success';
                                    $statusText = 'Active';
                                    break;
                                case 'pending_renewal':
                                    $statusClass = 'badge badge-warning';
                                    $statusText = 'Pending';
                                    break;
                                case 'expired':
                                    $statusClass = 'badge badge-danger';
                                    $statusText = 'Expired';
                                    break;
                                    case 'cancel':
                                    $statusClass = 'badge badge-secondary';
                                    $statusText = 'Canceled';
                                    break;
                            }
                            @endphp
                            <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>
                              <a href="{{ route('admin.licenses.edit', $license) }}" class="btn btn-primary">Edit</a>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection