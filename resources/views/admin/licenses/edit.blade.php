@extends('layouts.admin')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Update Business Form</h1>
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
              <h3 class="card-title">Update Business</h3>
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
            <form method="POST" action="{{ route('admin.licenses.update', $license->id) }}">
                @csrf
                @method('PUT')
                <div class="card-body">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" id="status" class="form-control">
                            <option value="active" {{ $license->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="expired" {{ $license->status === 'expired' ? 'selected' : '' }}>Expired</option>
                            <option value="cancel" {{ $license->status === 'cancel' ? 'selected' : '' }}>Cancel</option>
                            <option value="pending_renewal" {{ $license->status === 'pending_renewal' ? 'selected' : '' }}>Pending Renewal</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection