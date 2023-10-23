@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Passport Status Approved</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <div class="btn-group">
                  <a href="{{ route('admin.visas.processing') }}" class="btn btn-sm btn-primary mx-2">Processing</a>
                  <a href="{{ route('admin.visas.canceled') }}" class="btn btn-sm btn-danger mx-2">Canceled</a>
                  <a href="{{ route('admin.visas.approved') }}" class="btn btn-sm btn-success mx-2">Approved</a>
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
              <h3 class="card-title">Passport Status Approved</h3>
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
                @foreach ($visas as $pp)
                <tbody>
                <tr>
                    <td>{{ $pp->nonresident->passportnumber }}</td>
                    <td>{{ $pp->nonresident->user->name }} {{ $pp->nonresident->lname }} {{ $pp->nonresident->surname }}</td>
                    <td>
                      @php
                        $statusClass = '';
                        $statusText = '';
                        switch ($pp->status) {
                            case 'processing':
                                $statusClass = 'badge badge-primary';
                                $statusText = 'Processing';
                                break;
                            case 'canceled':
                                $statusClass = 'badge badge-danger';
                                $statusText = 'Canceled';
                                break;
                            case 'approved':
                                $statusClass = 'badge badge-success';
                                $statusText = 'Approved';
                                break;
                        }
                        @endphp
                        <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>{{ $pp->purpose_of_travel }}</td>
                    <td><a href="{{ route('admin.visas.edit', $pp) }}" class="btn btn-primary">Edit</a></td>
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