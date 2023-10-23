@extends('layouts.admin')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Visa Form</h1>
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
              <h3 class="card-title">Update Visa</h3>
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
            <form method="POST" action="{{ route('admin.visas.update', $visa) }}">
              @csrf
              @method('PUT')
              <div class="card-body">
              <div class="form-group">
                  <label for="status">Status</label>
                  <select id="status" name="status" class="form-control">
                      <option value="canceled" {{ $visa->status == 'canceled' ? 'selected' : '' }}>Canceled</option>
                      <option value="approved" {{ $visa->status == 'approved' ? 'selected' : '' }}>Completed</option>
                      <option value="processing" {{ $visa->status == 'processing' ? 'selected' : '' }}>Processing</option>
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