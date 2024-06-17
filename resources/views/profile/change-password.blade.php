@extends('layouts.portal.main')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
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
                            <h3 class="card-title">Change Password</h3>
                        </div>

                        <form id="quickForm" method="POST" action="{{ route('password.change') }}" >
                            @include('includes.alert')
                            @csrf
                            <div class="card-body">
                                @error('password')
                                    <span class="text-danger"> {{ $message }}</span>
                                @enderror
                                <div class="form-group">
                                    <label for="password">New Password</label>
                                    <input type="text" name="password" class="form-control" id="password" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="confirm_password">Confirm Password</label>
                                    <input type="text" name="password_confirmation" class="form-control" id="password_confirmation">
                                </div>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Change</button>
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
          password: {
            required: true,
          },
          password_confirmation: {
            required: true,
          },

        },
        messages: {
          password: {
            required: "This Field is required"
          },
          password_confirmation: {
            required: "This Field is required",
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

