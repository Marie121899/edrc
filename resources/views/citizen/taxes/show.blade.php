@extends('layouts.citizen')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tax Details</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-6">
          <!-- general form elements -->
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">Income Tax Details </h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-warning">
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>

            @endif
              <div class="card-body">
                <table class="table">
                    <tbody>
                        <tr>
                            <th>Tax Type:</th>
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
                              <span class="{{ $statusClass }}">{{ $statusText }}</span></td>  
                            </td>
                        </tr>
                        <tr>
                            <th>Amount:</th>
                            <td>{{ $tax->amount }}</td>
                        </tr>
                        <tr>
                            <th>Due Date:</th>
                            <td>{{ $tax->due_date }}</td>
                        </tr>
                        <tr>
                            <th>Payment Status:</th>
                            <td>{{ $tax->payment_status }}</td>
                        </tr>
                        <tr>
                            <th>Tax Year:</th>
                            <td>{{ $tax->tax_year }}</td>
                        </tr>
                        <tr>
                            <th>Description:</th>
                            <td>{{ $tax->description }}</td>
                        </tr>
                    </tbody>
                </table>
        
                <a href="{{ route('citizen.taxes.index') }}" class="btn btn-primary">Back</a>
              </div>
        </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection