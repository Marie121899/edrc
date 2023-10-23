@extends('layouts.citizen')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Passport Application Form</h1>
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
            <form method="POST" action="{{ route('citizen.passport.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group">
                  <label for="applicant_id_copy">National ID Number</label>
                  <input id="applicant_id_copy" type="text" class="form-control" name="applicant_id_copy" required>
              </div>
              <div class="form-group">
                <label for="exampleInputFile">Upload Passport size Image</label>
                <div class="input-group">
                  <div class="custom-file">
                    <input type="file" name="passport_size_photos" class="custom-file-input" required>
                    <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                  </div>
                  <div class="input-group-append">
                    <span class="input-group-text">Upload</span>
                  </div>
                </div>
              </div>
                  <div class="form-group">
                    <label for="applicant_birthcertificate">{{ __('Upload Your Birth Certificate Number') }}</label>
                    <input id="applicant_birthcertificate" type="text" class="form-control" name="applicant_birthcertificate" required>
                </div>
                <div class="form-group">
                  <label for="mother_birthcertificate">Mother's Birth Certificate Number</label>
                  <input id="mother_birthcertificate" type="text" class="form-control" name="mother_birthcertificate" required>
              </div>
              <div class="form-group">
                <label for="father_birthcertificate">Father's Birth Certificate Number</label>
                <input id="father_birthcertificate" type="text" class="form-control" name="father_birthcertificate" required>
              </div>
                    <div class="form-group">
                        <label for="date_to_submit_biometrics">{{ __('Select Date to submit Biometrics') }}</label>
                        <input id="date_to_submit_biometrics" type="date" class="form-control" name="date_to_submit_biometrics" required>
                    </div>
                <button type="submit" class="btn btn-info">Submit</button>
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection