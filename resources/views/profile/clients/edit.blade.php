
@extends('layouts.portal.main')

@section('content')
   <div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Registration</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Registration</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="mb-3">
                        <span class="badge badge-info p-3">N/B: Default password is the meter number <i class="fa fa-exclamation-circle"></i></span>
                    </div>

                    @include('includes.alert')


                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit User</h3>
                        </div>

                        <form id="quickForm" method="POST" action="{{ route('user.update', [$user->id]) }}">
                            @method('PUT')
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="first_name">First Name</label>
                                    <input type="text" name="first_name" class="form-control" id="first_name" value="{{ $user->first_name }}" placeholder="Enter first name">
                                    @error('first_name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="form-group">
                                    <label for="last_name">Last Name</label>
                                    <input type="text" name="last_name" value="{{ $user->last_name }}" class="form-control" id="last_name" placeholder="Enter last name">
                                    @error('last_name')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email address</label>
                                    <input type="email" name="email" value="{{ $user->email }}" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                                    @error('email')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="">Select Country</option>
                                        <option value="Nigeria" {{ $user->country == 'Nigeria' ? 'selected' : '' }} >Nigeria</option>
                                        <option value="Cameroon" {{ $user->country == 'Cameroon' ? 'selected' : '' }} >Cameroon</option>
                                        <option value="Ghana" {{ $user->country == 'Ghana' ? 'selected' : '' }} >Ghana</option>
                                    </select>
                                    @error('country')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">State</label>
                                    <select class="form-control" name="state" id="state">
                                        <option value="{{ $user->state }}">{{ $user->state }}</option>
                                    </select>
                                    @error('state')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="meter_number">Meter Number</label>
                                    <input type="text" name="meter_number" value="{{ $user->meter_number }}" class="form-control" id="meter_number" placeholder="Enter meter number">
                                    @error('meter_number')
                                        <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>



                                <div class="form-group">
                                    <label for="tenant">Plant</label>
                                    <select class="form-control" name="plant">
                                        <option>Select Plant</option>
                                        @foreach ($plants as $plant)
                                            <option value="{{ $plant->id }}" {{ $user->plants->contains($plant->id) ? 'selected' : '' }}>
                                                {{ $plant->address }}, {{ $plant->state }}, {{ $plant->country }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('plant')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>




                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">update</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
</div>



<script>
  // Define states for Nigeria
  const nigeriaStates = ["Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"];

  // Define states for Cameroon
  const cameroonStates = ["Adamaoua", "Centre", "East", "Far North", "Littoral", "North", "Northwest", "South", "Southwest", "West"];

  // Define states for Ghana
  const ghanaStates = ["Ashanti", "Brong-Ahafo", "Central", "Eastern", "Greater Accra", "Northern", "Upper East", "Upper West", "Volta", "Western"];

  // Function to populate states based on selected country
  function populateStates(countryCode) {
      const stateSelect = document.getElementById("state");
      stateSelect.innerHTML = "<option value=''>Select State</option>";

      if (countryCode !== "") {
          // Populate states based on selected country
          let states;
          switch (countryCode) {
              case "Nigeria":
                  states = nigeriaStates;
                  break;
              case "Cameroon":
                  states = cameroonStates;
                  break;
              case "Ghana":
                  states = ghanaStates;
                  break;
              default:
                  states = [];
          }
          states.forEach(state => {
              const option = document.createElement("option");
              option.value = state;
              option.textContent = state;
              stateSelect.appendChild(option);
          });
      }
  }

  // Event listener for country selection
  document.getElementById("country").addEventListener("change", function() {
      const countryCode = this.value;
      if (countryCode !== "") {
          populateStates(countryCode);
      }
  });
</script>
@endsection




