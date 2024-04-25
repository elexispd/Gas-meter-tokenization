@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Purchase Gas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Buy Gas</li>
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
                            <h3 class="card-title">Buy Gas</h3>
                        </div>
{{-- method="post" action="{{ route('purchase.store') }}" --}}
                        <form id="paymentForm" >
                            @csrf
                            @include('includes.alert')
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="state">Quantity (m<sup>3</sup>)</label>
                                    <input type="number" class="form-control" name="quantity" id="quantity" autocomplete="false">

                                    @error('quantity')
                                    <span class="text-danger"> {{ $message }}</span>
                                    @enderror
                                    <input type="number" name="amount" id="amount" hidden>
                                </div>

                                <div class="form-group" id="price_display" style="display: none;">
                                    <label for="state">Price:</label>
                                    <span id="calculated_price"></span>
                                </div>


                                <button type="submit" class="btn btn-primary">Purchase</button>

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
        $('#paymentForm').validate({
            rules: {
                quantity: {
                    required: true,
                },
            },
            messages: {
                quantity: {
                    required: "Please enter quantity",
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

        $('#quantity').on('input', function() {
            var quantity = $(this).val();
            var gasPrice = {{ $price->price }}; // Assuming $price is passed from the controller

            var c = '{{ $price->country }}';



            if( c == "Nigeria") {
                var country = "NGN";
            } else if( c == "Cameroon" ) {
                var country = "XAF";
            } else {
                var country = "GHC";
            }

            if (quantity && !isNaN(quantity)) {
                var currentPrice = quantity * gasPrice;
                var formattedPrice = formatWithCommas(currentPrice.toFixed(2));
                $('#calculated_price').text(country + ' ' + formattedPrice);
                $('#amount').val(currentPrice);
                $('#price_display').show();
            } else {
                $('#calculated_price').empty();
                $('#price_display').hide();
            }
        });

        function formatWithCommas(amount) {
            return amount.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }


    });
</script>

<script>

    function fetchPaystackAPIKey() {
        return new Promise((resolve, reject) => {
            $.ajax({
                type: 'GET',
                url: '/paystack-api-key',
                success: function(response) {
                    resolve(response.paystack_api_key);
                },
                error: function(xhr, status, error) {
                    reject(error);
                }
            });
        });
    }

    async function payWithPaystack(ref_id, quantity) {
        try {
            const PAYSTACK_API_KEY = await fetchPaystackAPIKey(); // Wait for the API key to be fetched
            const PAYER_EMAIL = '{{ auth()->user()->email }}';

            let handler = PaystackPop.setup({
                key: PAYSTACK_API_KEY,
                email: PAYER_EMAIL,
                amount: document.getElementById("amount").value * 100,
                ref: ref_id,
                onClose: function(){

                    cuteAlert({
                        type: "info",
                        title: "Operation Cancelled!",
                        message: "Payment was cancelled",
                        buttonText: "Ok"
                    });

                },
                callback: function(response){

                    let message = 'Payment complete! Reference: ' + response.reference;
                    updatePayment(ref_id, 1);
                    cuteAlert({
                        type: "success",
                        title: "Payment complete",
                        message: "Your payment was successful. Check your email for your meter token",
                        buttonText: "Ok"
                    }).then(() => {
                        var meter_number = {{ auth()->user()->meter_number }}
                        $.ajax({
                            type: 'GET',
                            url: '{{ route("purchase.send_token") }}',
                            data: {'ref_id': ref_id, 'quantity': quantity, 'meter_number': meter_number  },
                            success: function(response) {
                                if(response.success == false) {
                                    cuteAlert({
                                        type: "error",
                                        title: "Error",
                                        message: response.message,
                                        buttonText: "Ok"
                                    });
                                }

                            },
                            error: function(xhr, status, error) {
                                cuteAlert({
                                    type: "error",
                                    title: "Operation Failed!",
                                    message: error,
                                    buttonText: "Ok"
                                })
                            }
                        });
                    });
                }
            });

            handler.openIframe();
        } catch (error) {
            console.error('Error fetching Paystack API key:', error);
            // Handle error if necessary
        }
    }

    function submitFormData() {
        $.ajax({
            type: 'POST',
            url: '{{ route("purchase.store") }}',
            data: $('#paymentForm').serialize(),
            success: function(response) {
                payWithPaystack(response.message, $('#quantity').val());
            },
            error: function(xhr, status, error) {
                cuteAlert({
                    type: "error",
                    title: "Operation Failed!",
                    message: "An error occurred while processing your request. Please try again later.",
                    buttonText: "Ok"
                })
            }
        });
    }


    function updatePayment(ref_id, status) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            type: 'POST',
            url: '{{ route("purchase.update") }}',
            data: {'ref_id': ref_id, 'status': status, '_token': token,},
            success: function(response) {

            },
            error: function(xhr, status, error) {

            }
        });
    }





</script>

<script>

</script>


@endsection
