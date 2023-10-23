@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>All Organizations</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;"href="{{ url('admin/organization/add')}}">Add Organization</a></button></li>
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
              <h3 class="card-title">All Organizations</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>First Name</th>
                    <th>Completed Registration?</th>
                    <th>Email</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @foreach ($organizations as $organization)
                <tbody>
                <tr>
                    <td>{{ $organization->id }}</td>
                    <td>{{ $organization->name }}</td>
                    <td>
                      <span class="badge badge-{{ $organization->status === 'yes' ? 'success' : 'warning' }} badge-md">
                          {{ $organization->status }}
                      </span>
                    </td>
                    <td>{{ $organization->email ?? 'N/A' }}</td>
                  <td>
                    <div class="row">
                      <div class="col-md-4">
                         <a href="{{ url('admin/organization/'.$organization->id.'/edit') }}" class="btn btn-md btn-info"><i class="fa-solid fa-pen-to-square"></i></a>
                      </div>
                      <div class="col-md-4">
                        <a href="{{ url('admin/organization/'.$organization->id.'/delete') }}" onclick="return confirm('Are you sure you want to DELETE Organization?')" class="btn btn-md btn-danger"><i class="fa-solid fa-trash-can"></i></a>
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
        <!-- /.col -->
      </div>
      <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
  </section>

@endsection