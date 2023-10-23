@extends('layouts.citizen')

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
            <form method="POST" action="{{ route('citizen.taxes.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
               
                <div class="form-group">
                  <label for="tax_type">Tax Type:</label>
                  <select name="tax_type" id="tax_type" class="form-control" required>
                    <option value="">Select Tax</option>>
                      <option value="income">Income Tax</option>>
                  </select>
              </div>
  
              <div class="form-group">
                  <label for="amount">Amount:</label>
                  <input type="number" name="amount" id="amount" class="form-control" required>
              </div>
  
              <div class="form-group">
                  <label for="due_date">Due Date:</label>
                  <input type="date" name="due_date" id="due_date" class="form-control" required>
              </div>

              <div class="form-group">
                  <label for="tax_year">Tax Year:</label>
                  <input type="number" name="tax_year" id="tax_year" class="form-control" required>
              </div>
  
              <div class="form-group">
                  <label for="description">Description:</label>
                  <textarea name="description" id="description" class="form-control"></textarea>
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