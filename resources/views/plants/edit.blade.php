
@extends('layouts.portal.main')

@section('content')
    <div class="content-wrapper">

<section class="content-header">
<div class="container-fluid">
<div class="row mb-2">
<div class="col-sm-6">
<h1>Edit Plant</h1>
</div>
<div class="col-sm-6">
<ol class="breadcrumb float-sm-right">
<li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
<li class="breadcrumb-item active">Edit Plant</li>
</ol>
</div>
</div>
</div>
</section>

<section class="content">
<div class="container-fluid">
<div class="row">

<div class="col-md-12">


<div class="card card-primary">
<div class="card-header">
<h3 class="card-title">Edit Plant</h3>
</div>



<form id="quickForm" method="post" action="{{ route('plant.update', [$plant->id]) }}">
    @method('PUT')
    @csrf
    @include('includes.alert')

<div class="card-body">
    <div class="form-group">
        <label for="country">Country</label>
        <select class="form-control" name="country" id="country">
            <option value="">Select Country</option>
            <option value="Nigeria"  {{ $plant->country == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
            <option value="Cameroon" {{ $plant->country == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
            <option value="Ghana" {{ $plant->country == 'Ghana' ? 'selected' : '' }}>Ghana</option>
        </select>
        @error('country')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>


    <div class="form-group">
        <label for="state">State</label>
        <select class="form-control" name="state" id="state">

        </select>
        @error('state')
            <span class="text-danger"> {{ $message }}</span>
        @enderror
    </div>


<div class="form-group">
<label for="address">Address</label>
<textarea name="address" id="address" class="form-control" cols="30" rows="10" placeholder="Enter location address...">{{ $plant->address }}</textarea>
    @error('address')
        <span class="text-danger"> {{ $message }}</span>
    @enderror
</div>



<div class="form-group">
<label for="tenant">Tenant</label>
<select class="form-control" name="tenant_id">
    <option></option>
    @foreach ($tenants as $tenant)
        <option value="{{ $tenant->id }}" {{ $tenant->id == $plant->tenant_id ? 'selected' : '' }}>
            {{ $tenant->first_name }} {{ $tenant->last_name }}
        </option>
    @endforeach



</select>
    @error('tenant')
        <span class="text-danger"> {{ $message }}</span>
    @enderror
</div>



</div>
</div>

<div class="card-footer">
<button type="submit" class="btn btn-primary">Update</button>
</div>
</form>
</div>

</div>

<div class="col-md-6">
</div>

</div>

</div>

<script>
$(function () {
  $.validator.setDefaults({
    submitHandler: function () {
      $("#quickForm").submit();
    }
  });
  $('#quickForm').validate({
    rules: {
      country: {
        required: true,
        minlength: 1,
      },
      state: {
        required: true
      },
      address: {
        required: true,
        minlength: 5
      },
      tenant: {
        required: true,
      },
    },
    messages: {
      country: {
        required: "Please enter a valid country",
        minlength: "Minimum of 2 characters required",
      },
      state: {
        required: "Please enter state"
      },
      tenant: {
        required: "Please enter tenant",
        minlength: "Minimum of 2 characters required",
      },
    },
    errorElement: 'span',
    errorPlacement: function (error, element) {
      error.addClass('invalid-feedback');
      element.closest('.form-group').append(error);
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass('is-invalid');
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).removeClass('is-invalid');
    }
  });
});
</script>


<script>
    // Define states for Nigeria
    const nigeriaStates = ["Abia", "Adamawa", "Akwa Ibom", "Anambra", "Bauchi", "Bayelsa", "Benue", "Borno", "Cross River", "Delta", "Ebonyi", "Edo", "Ekiti", "Enugu", "FCT", "Gombe", "Imo", "Jigawa", "Kaduna", "Kano", "Katsina", "Kebbi", "Kogi", "Kwara", "Lagos", "Nasarawa", "Niger", "Ogun", "Ondo", "Osun", "Oyo", "Plateau", "Rivers", "Sokoto", "Taraba", "Yobe", "Zamfara"];

    // Define states for Cameroon
    const cameroonStates = ["Adamaoua", "Centre", "East", "Far North", "Littoral", "North", "Northwest", "South", "Southwest", "West"];

    // Define states for Ghana
    const ghanaStates = ["Ashanti", "Brong-Ahafo", "Central", "Eastern", "Greater Accra", "Northern", "Upper East", "Upper West", "Volta", "Western"];

    let selectedState = "{{ old('state') }}";
    // Function to populate states based on selected country
  // Function to populate states based on selected country
    function populateStates(countryCode) {
        const stateSelect = document.getElementById("state");
        stateSelect.innerHTML = "<option value='{{ $plant->state }}'>{{ $plant->state }}</option>";

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

    // Call the function when the document is ready
    document.addEventListener("DOMContentLoaded", function() {
        // Retrieve the selected country code
        const countryCode = document.getElementById("country").value;
        // Populate states based on the selected country
        populateStates(countryCode);
    });

</script>

@endsection

