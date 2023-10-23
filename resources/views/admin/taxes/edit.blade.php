@extends('layouts.admin')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Tax Form</h1>
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
              <h3 class="card-title">Make Application</h3>
            </div>
            @if ($errors->any())
            <div class="alert alert-warning">
              @foreach ($errors->all() as $error)
                  <div>{{ $error }}</div>
              @endforeach
            </div>

            @endif
            <!-- /.card-header -->
            <!-- form start -->
            <form method="POST" action="{{ route('admin.taxes.update', $tax->id) }}" enctype="multipart/form-data">
              @csrf
              @method('PUT')
              <div class="card-body">
               
                <div class="form-group">
                  <label for="tax_type">Tax Type:</label>
                  <select name="tax_type" id="tax_type" class="form-control">
                      <option value="income" {{ old('tax_type', $tax->tax_type) === 'income' ? 'selected' : '' }}>Income Tax</option>
                      <option value="property" {{ old('tax_type', $tax->tax_type) === 'property' ? 'selected' : '' }}>Property Tax</option>
                      <option value="business" {{ old('tax_type', $tax->tax_type) === 'business' ? 'selected' : '' }}>Business Tax</option>
                      <option value="sales" {{ old('tax_type', $tax->tax_type) === 'sales' ? 'selected' : '' }}>Sales Tax</option>
                      <option value="excise" {{ old('tax_type', $tax->tax_type) === 'excise' ? 'selected' : '' }}>Excise Duty</option>
                      <option value="value_added" {{ old('tax_type', $tax->tax_type) === 'value_added' ? 'selected' : '' }}>Value Added Tax</option>
                      <option value="estate" {{ old('tax_type', $tax->tax_type) === 'estate' ? 'selected' : '' }}>Estate Tax</option>
                      <option value="gift" {{ old('tax_type', $tax->tax_type) === 'gift' ? 'selected' : '' }}>Gift Tax</option>
                      <option value="import" {{ old('tax_type', $tax->tax_type) === 'import' ? 'selected' : '' }}>Import Duty</option>
                      <option value="fuel" {{ old('tax_type', $tax->tax_type) === 'fuel' ? 'selected' : '' }}>Fuel Levy</option>
                      <option value="other" {{ old('tax_type', $tax->tax_type) === 'other' ? 'selected' : '' }}>Other Tax</option>
                  </select>
              </div>
              
              <div class="form-group">
                  <label for="amount">Amount:</label>
                  <input type="text" name="amount" id="amount" class="form-control" value="{{ old('amount', $tax->amount) }}">
              </div>
              <div class="form-group">
                  <label for="due_date">Due Date:</label>
                  <input type="date" name="due_date" id="due_date" class="form-control" value="{{ old('due_date', $tax->due_date) }}">
              </div>
              <div class="form-group">
                  <label for="payment_status">Payment Status:</label>
                  <select name="payment_status" id="payment_status" class="form-control">
                      <option value="unpaid" {{ old('payment_status', $tax->payment_status) === 'unpaid' ? 'selected' : '' }}>Unpaid</option>
                      <option value="paid" {{ old('payment_status', $tax->payment_status) === 'paid' ? 'selected' : '' }}>Paid</option>
                  </select>
              </div>
              <div class="form-group">
                  <label for="tax_year">Tax Year:</label>
                  <input type="text" name="tax_year" id="tax_year" class="form-control" value="{{ old('tax_year', $tax->tax_year) }}">
              </div>
           
                <button type="submit" class="btn btn-primary">Submit</button>
              </div>
            </form>
        </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection