@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Raise Complaint</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Complaint</li>
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
                            <h3 class="card-title">Talk To Us</h3>
                        </div>
{{-- method="post" action="{{ route('purchase.store') }}" --}}
                        <form id="complaintForm" method="POST">
                            @csrf
                            @include('includes.alert')

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="state">Subject </label>
                                    <input type="text" class="form-control"  name="subject" id="subject" autocomplete="false">

                                    @error('subject')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="state">Description:</label>
                                    <textarea name="description" class="form-control" id="" cols="30" rows="10" placeholder="write your complaint here..."></textarea>
                                    @error('description')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>

                            </div>
                        </form>
                    </div>



                </div>


            </div>

            <div class="col-md-6">
            </div>





        </div>

    </div>

</section>

</div>




<script src="https://js.paystack.co/v1/inline.js"></script>
<script>
    $(function () {
        $('#complaintForm').validate({
            rules: {
                subject: {
                    required: true,
                },
                description: {
                    required: true,
                },
            },
            messages: {
                subject: {
                    required: "Please enter subject matter",
                },
                description: {
                    required: "Please enter a description",
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
            },
            submitHandler: function (form) {
                // If validation passes, trigger Paystack
                // payWithPaystack();
                submitFormData();
                return false; // Prevent default form submission
            }
        });



    });
</script>




@endsection
