@extends('layouts.reg')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h3><b>Complete Registration Form</b></h3>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">...You are almost there!</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
            <div class="col-md-2"></div>
          <!-- left column -->
          <div class="col-md-8">
            <!-- general form elements -->
            <div class="card card-secondary">
              <div class="card-header">
                <h3 class="card-title">Fill everything</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
             <form method="POST" action="{{ route('business.dashboard') }}" enctype="multipart/form-data">
                @csrf
                <div class="card-body">
                    <div class="row">
                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="businessnumber">{{ __('Business Registration Number') }}</label>
                                <input id="businessnumber" type="text" class="form-control" name="businessnumber" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label for="exampleInputFile">Upload Logo Image</label>
                            <div class="input-group">
                              <div class="custom-file">
                                <input type="file" name="profile" class="custom-file-input" required>
                                <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                              </div>
                              <div class="input-group-append">
                                <span class="input-group-text">Upload</span>
                              </div>
                            </div>
                          </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="businessname">{{ __('Business Name') }}</label>
                                <input id="businessname" type="text" class="form-control" name="businessname" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="phone">{{ __('Phone Number') }}</label>
                                <input id="phone" type="text" class="form-control" name="phone" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                      
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="dateofregistration">{{ __('Date of Business Registration') }}</label>
                                <input id="dateofregistration" type="date" class="form-control" name="dateofregistration" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="address">{{ __('Address') }}</label>
                                <input id="address" type="text" class="form-control" name="address" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="industry">{{ __('Industry Category') }}</label>
                                <input id="industry" type="text" class="form-control" name="industry" required>
                            </div>
                        </div>
                    </div>
                    <!-- Add more form fields for the remaining citizen attributes -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-info">Submit</button>
                    </div>
                </div>
            </form>
               
            </div>
            <!-- /.card -->

          </div>
          <div class="col-md-2"></div>
          <!--/.col (left) -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>

@endsection
