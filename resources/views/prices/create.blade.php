@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add New Price</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Price</li>
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
                            <h3 class="card-title">Add Price</h3>
                        </div>

                        <form id="quickForm" method="post" action="{{ route('price.store') }}">
                            @csrf
                            @include('includes.alert')
                            <div class="card-body">
                                {{-- <div class="form-group">
                                    <label for="country">Country</label>
                                    <select class="form-control" name="country" id="country">
                                        <option value="">Select Country</option>
                                        <option value="Nigeria" {{ old('country') == 'Nigeria' ? 'selected' : '' }}>Nigeria</option>
                                        <option value="Cameroon" {{ old('country') == 'Cameroon' ? 'selected' : '' }}>Cameroon</option>
                                        <option value="Ghana" {{ old('country') == 'Ghana' ? 'selected' : '' }}>Ghana</option>
                                    </select>
                                    @error('country')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="form-group">
                                    <label for="state">1 (m<sup>3</sup>)</label>
                                </div>
                                <div class="form-group">
                                    <label for="state">Country</label>
                                    <select name="country" id="country" class="form-control">
                                        <option value="">Select Country</option>
                                        <option value="Nigeria" {{ old('country') == 'Nigeria' ?'selected' : '' }}>Nigeria</option>
                                        <option value="Cameroon" {{ old('country') == 'Cameroon' ?'selected' : '' }}>Cameroon</option>
                                        <option value="Ghana" {{ old('country') == 'Ghana' ?'selected' : '' }}>Ghana</option>
                                    </select>
                                    @error('country')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="state">Price</label>
                                    <input type="number" class="form-control" name="price" id="">
                                    @error('price')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    <input type="hidden" name="quantity" value="1">
                                </div>



                            </div>
                    </div>

                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Create</button>
                    </div>
                    </form>
                </div>

            </div>

            <div class="col-md-6">
            </div>

        </div>

    </div>

</section>

</div>


<script>
    $(function () {

      $('#quickForm').validate({
        rules: {
          country: {
            required: true,
          },
          price: {
            required: true,
          },


        },
        messages: {
          price: {
            required: "Please enter a price",
          },
          country: {
            required: "Please select country",
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

@endsection
