@extends('layouts.business')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>My Taxes</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><button class="btn btn-info"><a  style="color: #fff;" href="{{ url('business/taxes/create')}}">File Returns</a></button></li>
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
              <h3 class="card-title"> Taxes </h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Tax Type</th>
                    <th>Amount</th>
                    <th>Due Date</th>
                    <th>Payment Status</th>
                    <th>Tax Year</th>
                    <th>Actions</th>
                </tr>
                </thead>
                @if ($taxes->count() > 0)
                @foreach ($taxes  as $tax)
                <tbody>
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                      @php
                      $statusClass = '';
                      $statusText = '';
                      switch ($tax->tax_type) {
                          case 'income':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Income Tax';
                              break;
                          case 'property':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Property Tax';
                              break;
                          case 'business':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Business Tax';
                              break;
                          case 'excise':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Excise Duty';
                              break;
                          case 'sales':
                              $statusClass = 'badge badge-primary';
                              $statusText = 'Sales Tax';
                              break;
                          case 'import':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Import Duty';
                              break;
                          case 'value_added':
                              $statusClass = 'badge badge-success';
                              $statusText = 'VAT';
                              break;
                          case 'fuel':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Fuel Levy';
                              break;
                          case 'estate':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Estate Tax';
                              break;
                          case 'gift':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Gift Tax';
                              break;
                          case 'other':
                              $statusClass = 'badge badge-success';
                              $statusText = 'Other';
                              break;
                      }
                      @endphp
                      <span class="{{ $statusClass }}">{{ $statusText }}</span>
                    </td>
                            <td>{{ $tax->amount }}</td>
                            <td>{{ $tax->due_date }}</td>
                            <td>
                              @php
                              $statusClass = '';
                              $statusText = '';
                              switch ($tax->payment_status) {
                                  case 'paid':
                                      $statusClass = 'badge badge-success';
                                      $statusText = 'Paid';
                                      break;
                                  case 'unpaid':
                                      $statusClass = 'badge badge-warning';
                                      $statusText = 'Pending';
                                      break;
                              }
                              @endphp
                              <span class="{{ $statusClass }}">{{ $statusText }}</span>
                            </td>
                            <td>{{ $tax->tax_year }}</td>
                            <td>
                                <a href="{{ route('business.taxes.show', $tax->id) }}" class="btn btn-primary">View</a>
                            </td>
                </tr>
                @endforeach
                @else
              <p>Your tax history is not found.</p>
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