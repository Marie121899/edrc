@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Tax Feedbacks</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <div class="btn-group">
                  <a href="{{ route('admin.feedbacks.tax') }}" class="btn btn-sm btn-primary mx-2">Tax</a>
                  <a href="{{ route('admin.feedbacks.pp') }}" class="btn btn-sm btn-danger mx-2">Passport</a>
                  <a href="{{ route('admin.feedbacks.visa') }}" class="btn btn-sm btn-warning mx-2">Visa</a>
                  <a href="{{ route('admin.feedbacks.license') }}" class="btn btn-sm btn-success mx-2">License</a>
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
              <h3 class="card-title">Tax Feedbacks</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Service</th>
                    <th>Satisfaction</th>
                    <th>Message</th>
                    <th>Created at</th>
                </tr>
                </thead>
                @foreach ($feedbacks  as $feedback)
                <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @switch($feedback->type)
                      @case('passport_application')
                          Passport Application
                          @break
                      @case('tax_filing')
                          Tax Filing
                          @break
                      @case('visa_application')
                          Visa Application
                          @break
                      @case('license_application')
                          License Application
                          @break
                      @default
                          Unknown Type
                  @endswitch  
                    </td>
                    <td>
                        @if ($feedback->satisfaction === 'good')
                        <span style="color: green;">😊 Good</span>
                        @elseif ($feedback->satisfaction === 'excellent')
                            <span style="color: blue;">😄 Excellent</span>
                        @elseif ($feedback->satisfaction === 'bad')
                            <span style="color: red;">😞 Bad</span>
                        @elseif ($feedback->satisfaction === 'worst')
                            <span style="color: darkred;">😢 Worst</span>
                        @endif
                    </td>
                    <td>{{ $feedback->message }}</td>
                    <td>{{ $feedback->created_at->format('Y-m-d') }}</td>
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