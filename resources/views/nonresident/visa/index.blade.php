@extends('layouts.nonresident')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Visa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;" href="{{ url('nonresident/visa/create')}}">Apply</a></button></li>
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
              <h3 class="card-title">Visa History</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>Type of Visa</th>
                    <th>Visa Category</th>
                    <th>Status</th>
                    <th>Purpose</th>
                </tr>
                </thead>
                @if (!empty($visas))
                @foreach ($visas as $pp)
                <tbody>
                <tr>
                    <td>
                        @switch($pp->type_of_visa)
                        @case('tourist')
                            Tourist
                            @break
                        @case('work')
                            Work
                            @break
                        @case('student')
                            Student
                            @break
                        @case('other')
                            Other
                            @break
                        @default
                            Unknown Type
                        @endswitch
                    </td>
                    <td>
                        @switch($pp->visa_category)
                        @case('short-term')
                            Short Term
                            @break
                        @case('long-term')
                            Long Term
                            @break
                        @case('other')
                            Other
                            @break
                        @default
                            Unknown Type
                        @endswitch
                    </td>
                    <td>
                      @php
                      $statusClass = '';
                      $statusText = '';
                      switch ($pp->status) {
                          case 'approved':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Approved';
                              break;
                          case 'processing':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Processing';
                              break;
                          case 'canceled':
                              $statusClass = 'badge badge-danger';
                              $statusText = 'Canceled';
                              break;
                      }
                      @endphp
                      <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                    <td>{{ $pp->purpose_of_travel }}</td>
                </tr>
                @endforeach
                @else
              {{-- Handle the case where there are no visa applications --}}
              <p>No visa applications found.</p>
          @endif
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