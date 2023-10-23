@extends('layouts.citizen')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Feedbacks</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;" href="{{ url('citizen/feedback/create')}}">New Feedback</a></button></li>
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
              <h3 class="card-title">Feedback History</h3>
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