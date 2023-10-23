@extends('layouts.citizen')

@section('section')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Visa Application Form</h1>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

<section class="content">
    <div class="container-fluid">
      <div class="row">
        <!-- left column -->
        <div class="col-md-10">
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
            <form method="POST" action="{{ route('citizen.visa.store') }}" enctype="multipart/form-data">
                @csrf
              <div class="card-body">
                <div class="form-group row">
                    <label for="type_of_visa" class="col-md-4 col-form-label text-md-right">Type of Visa</label>
                    <div class="col-md-6">
                        <select id="type_of_visa" class="form-control @error('type_of_visa') is-invalid @enderror" name="type_of_visa" required>
                            <option value="">Visa Type</option>
                            <option value="tourist">Tourist</option>
                            <option value="work">Work</option>
                            <option value="student">Student</option>
                            <option value="other">Other</option>
                        </select>
                        @error('type_of_visa')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="visa_category" class="col-md-4 col-form-label text-md-right">Visa Category</label>
                    <div class="col-md-6">
                        <select id="visa_category" class="form-control @error('visa_category') is-invalid @enderror" name="visa_category" required>
                            <option value="">Visa Category</option>
                            <option value="short-term">Short-Term</option>
                            <option value="long-term">Long-Term</option>
                            <option value="other">Other</option>
                        </select>
                        @error('visa_category')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="visa_start_date" class="col-md-4 col-form-label text-md-right">Visa Start Date</label>
                    <div class="col-md-6">
                        <input id="visa_start_date" type="date" class="form-control @error('visa_start_date') is-invalid @enderror" name="visa_start_date" required>
                        @error('visa_start_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="visa_end_date" class="col-md-4 col-form-label text-md-right">Visa End Date</label>
                    <div class="col-md-6">
                        <input id="visa_end_date" type="date" class="form-control @error('visa_end_date') is-invalid @enderror" name="visa_end_date" required>
                        @error('visa_end_date')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="purpose_of_travel" class="col-md-4 col-form-label text-md-right">Purpose of Travel</label>
                    <div class="col-md-6">
                        <input id="purpose_of_travel" type="text" class="form-control @error('purpose_of_travel') is-invalid @enderror" name="purpose_of_travel" required>
                        @error('purpose_of_travel')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="travel_itinerary" class="col-md-4 col-form-label text-md-right">Travel Itinerary</label>
                    <div class="col-md-6">
                        <textarea id="travel_itinerary" class="form-control @error('travel_itinerary') is-invalid @enderror" name="travel_itinerary" rows="4"></textarea>
                        @error('travel_itinerary')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="sponsor_information" class="col-md-4 col-form-label text-md-right">Sponsor Information</label>
                    <div class="col-md-6">
                        <textarea id="sponsor_information" class="form-control @error('sponsor_information') is-invalid @enderror" name="sponsor_information" rows="4"></textarea>
                        @error('sponsor_information')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row">
                    <label for="target_country" class="col-md-4 col-form-label text-md-right">Target Country</label>
                    <div class="col-md-6">
                        <input id="target_country" type="text" class="form-control @error('target_country') is-invalid @enderror" name="target_country">
                        @error('target_country')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group row mb-0">
                    <div class="col-md-6 offset-md-4">
                        <button type="submit" class="btn btn-primary">
                            Submit Visa Application
                        </button>
                    </div>
                </div>
              </div>
            </form>
              </div>



        </div>
    </div>
    <!-- /.row -->
  </div><!-- /.container-fluid -->
</section>
@endsection