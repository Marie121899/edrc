@extends('layouts.organization')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Feedback Form</h1>
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
            <form method="POST" action="{{ route('organization.feedback.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
               
                <div class="form-group">
                    <label for="satisfaction">Satisfaction</label>
                    <select class="form-control" id="satisfaction" name="satisfaction" required>
                        <option value="">Select Satisfaction</option>
                        <option value="good">Good</option>
                        <option value="bad">Bad</option>
                        <option value="excellent">Excellent</option>
                        <option value="worst">Worst</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="type">Type of Service</label>
                    <select class="form-control" id="type" name="type" required>
                        <option value="">Select Service</option>
                        <option value="passport_application">Passport Application</option>
                        <option value="tax_filing">Tax Filing</option>
                        <option value="visa_application">Visa Application</option>
                        <option value="license_application">License Application</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="subject">Subject</label>
                    <input type="text" class="form-control" id="subject" name="subject">
                </div>
                <div class="form-group">
                    <label for="message">Message</label>
                    <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Submit Feedback</button>
              </div>
            </form>
        </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection