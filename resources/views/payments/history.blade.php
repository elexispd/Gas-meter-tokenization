
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Payments</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Custom Content -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of payments</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Consumer</th>
                                        <th>Order ID</th>
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        @can('admins', auth()->user())
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $countryTotals = []; // Initialize an array to store totals for each country
                                    @endphp
                                    @if(isset($payment)) <!-- Check if $payment variable is set -->

                                        <tr>
                                            <td>1</td> <!-- Assuming it's just one payment -->
                                            <td>
                                                @if ($payment->user != null)
                                                     {{ $payment->user->first_name }} {{ $payment->user->last_name }}
                                                @else
                                                    -
                                                @endif

                                            </td>
                                            <td>{{ $payment->order_id }}</td>
                                            <td>{{ $payment->quantity }}</td>
                                            <td>{{ number_format($payment->amount , 2)}}</td>
                                            {{-- <td>{{ number_format($payment->response['data']['amount'], 2) }}</td> --}}
                                            {{-- <td>{{ $payment->response["data"]["currency"] }}</td>
                                            <td class="text-capitalize">{{ $payment->response["data"]["channel"] }}</td>
                                            <td>
                                                @if ($payment->status == 0)
                                                    <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span>
                                                @elseif ($payment->status == 1)
                                                    <span class="badge bg-success text-capitalize">{{ $payment->response["data"]["status"] }}</span>

                                                @else
                                                    <span class="badge bg-warning">{{ $payment->response["data"]["status"] }}</span>
                                                @endif
                                            </td> --}}
                                            <td>{{ $payment->created_at }}</td>
                                            <td>
                                                <i class="fa fa-eye text-primary paymentDetailBtn" data-order="{{ $payment->order_id }}" data-toggle="modal" data-target="#viewModal" style="cursor: pointer;"></i>
                                            </td>
                                        </tr>
                                    @elseif(isset($payments)) <!-- Check if $payments variable is set -->

                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration to get the iteration count -->
                                                <td>
                                                    @if ($payment->user != null)
                                                         {{ $payment->user->first_name }} {{ $payment->user->last_name }}
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td>{{ $payment->order_id }}</td>
                                                <td>{{ $payment->quantity }}</td>
                                                <td>{{ number_format($payment->amount , 2)}}</td>
                                                {{-- @can('admins', auth()->user())

                                                    <td>{{ $payment->response["data"]["currency"] }}</td>
                                                    <td>{{ $payment->response["data"]["channel"] }}</td>
                                                @endcan --}}

                                                {{-- <td>
                                                    @if ($payment->status == 0)
                                                        {{-- <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span> --}}
                                                        {{-- <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span>
                                                    @elseif ($payment->status == 1)
                                                        <span class="badge bg-success"> {{ $payment->response["data"]["status"] }}</span>
                                                    @else
                                                        <span class="badge bg-info">{{ $payment->response["data"]["status"] }}</span>
                                                    @endif --}}
                                                {{-- </td>  --}}
                                                <td>{{ $payment->created_at }}</td>
                                                <td>
                                                    <i class="fa fa-eye text-primary" data-toggle="modal" data-order="{{ $payment->order_id }}" data-target="#viewModal" style="cursor: pointer;"></i>
                                                </td>
                                            </tr>
                                            @php
                                                // Calculate totals for each country
                                                if ($payment->user != null) {
                                                    if($payment->user->country != null) {
                                                        $country = $payment->user->plants->first()->country;
                                                        if (!isset($countryTotals[$country])) {
                                                            $countryTotals[$country] = ['quantity' => 0, 'total' => 0];
                                                        }
                                                        $countryTotals[$country]['quantity'] += $payment->quantity;
                                                        $countryTotals[$country]['total'] += $payment->amount;
                                                    }

                                                }

                                            @endphp
                                        @endforeach
                                    @endif


                                </tbody>
                                <tfoot>
                                    @foreach ($countryTotals as $country => $totals)
                                        <tr>
                                            <th>Total </th>
                                            <th>{{ $country }}</th>
                                            <th></th>
                                            <th>{{ $totals['quantity'] }}</th>
                                            <th></th>
                                            <th></th>
                                            <th>{{ number_format($totals['total'], 2) }}</th>
                                        </tr>
                                    @endforeach
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.Custom Content -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    {{--Payment Info Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">
                        <!-- Modal body content will be dynamically loaded here -->
                        Loading...
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#viewModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var orderId = button.data('order'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-title').text('Order Details for ' + orderId);
                modal.find('#modalContent').html('<div class="text-center">Loading...</div>');

                $.ajax({
                    url: '{{ route('payment.get_order_details') }}',
                    method: 'GET',
                    data: { order_id: orderId },
                    success: function(response) {
                        var orderDetails = response.data;
                        var body = `
                            <div style="font-size: 4em; padding: 20px; background-color: #f8f9fa; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); font-size: 16px;">
                                <p style="text-transform: capitalize;"><strong>Status:</strong>  ${orderDetails.status}</p>
                                <p><strong>Message:</strong>  ${orderDetails.gateway_response}</p>
                                <p><strong>Channel:</strong>  ${orderDetails.channel}</p>
                                <p><strong>Currency:</strong> ${orderDetails.currency}</p>
                                <p><strong>Payment Time:</strong> ${orderDetails.paid_at}</p>
                                <p><strong>Bank:</strong>  ${orderDetails.authorization.bank}</p>
                            </div>
                        `;

                        modal.find('#modalContent').html(body);
                    },
                    error: function(xhr, status, error) {
                        modal.find('#modalContent').html('Failed to fetch order details. Status: ' + status + ', Error: ' + error);
                    }
                });

            });
        });
    </script>


</div>




@endsection
