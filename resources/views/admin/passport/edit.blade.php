@extends('layouts.admin')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Passport Form</h1>
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
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Update Passport</h3>
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
            <form method="POST" action="{{ route('admin.passports.update', $passport) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
              <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" class="form-control">
                      <option value="cancelled" {{ $passport->status == 'cancelled' ? 'selected' : '' }}>Canceled</option>
                      <option value="inreview" {{ $passport->status == 'inreview' ? 'selected' : '' }}>In Review</option>
                      <option value="completed" {{ $passport->status == 'completed' ? 'selected' : '' }}>Completed</option>
                      <option value="processing" {{ $passport->status == 'processing' ? 'selected' : '' }}>Processing</option>
                  </select>
              </div>
  
              <button type="submit" class="btn btn-primary">Update Status</button>
              </div>
          </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection