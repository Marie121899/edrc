@extends('layouts.admin')

@section('section')

<section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-2">
          <h1>Other Taxes</h1>
        </div>
        <div class="col-sm-10">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <div class="btn-group">
                  <a href="{{ route('admin.taxes.income') }}" class="btn btn-sm btn-primary mx-2">Income Tax</a>
                  <a href="{{ route('admin.taxes.property') }}" class="btn btn-sm btn-danger mx-2">Property Tax</a>
                  <a href="{{ route('admin.taxes.sales') }}" class="btn btn-sm btn-warning mx-2">Sales Tax</a>
                  <a href="{{ route('admin.taxes.business') }}" class="btn btn-sm btn-success mx-2">Business Tax</a>
                  <a href="{{ route('admin.taxes.excise') }}" class="btn btn-sm btn-secondary mx-2">Excise Duty</a>
                  <a href="{{ route('admin.taxes.vat') }}" class="btn btn-sm btn-info mx-2">Value Added Tax</a>
                  <a href="{{ route('admin.taxes.estate') }}" class="btn btn-sm btn-primary mx-2">Estate Tax</a>
                  <a href="{{ route('admin.taxes.gift') }}" class="btn btn-sm btn-success mx-2">Gift Tax</a>
                  <a href="{{ route('admin.taxes.import') }}" class="btn btn-sm btn-secondary mx-2">Import Duty</a>
                  <a href="{{ route('admin.taxes.fuel') }}" class="btn btn-sm btn-info mx-2">Fuel Levy</a>
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
              <h3 class="card-title"> Other Taxes </h3>
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
                @forelse ($taxes  as $tax)
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
                              <a href="{{ route('admin.taxes.edit', $tax->id) }}" class="btn btn-primary">Edit</a>
                              <form action="{{ route('admin.taxes.destroy', $tax->id) }}" method="POST" class="d-inline">
                                  @csrf
                                  @method('DELETE')
                                  <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this tax?')">Delete</button>
                              </form>
                            </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7">No tax records found.</td>
                </tr>
                @endforelse
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