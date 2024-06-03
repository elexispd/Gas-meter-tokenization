
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
                                        <th>Quantity</th>
                                        <th>Amount</th>
                                        @can('admins', auth()->user())
                                        <th>Currency</th>
                                        <th>Channel</th>
                                        @endcan
                                        <th>Status</th>
                                        <th>Date</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @php
                                        $countryTotals = []; // Initialize an array to store totals for each country
                                    @endphp
                                    @if(isset($payment)) <!-- Check if $payment variable is set -->

                                        <tr>
                                            <td>1</td> <!-- Assuming it's just one payment -->
                                            <td>{{ $payment->user->first_name }} {{ $payment->user->last_name }}</td>
                                            <td>{{ $payment->quantity }}</td>
                                            <td>{{ number_format($payment->response['data']['amount'], 2) }}</td>
                                            <td>{{ $payment->response["data"]["currency"] }}</td>
                                            <td class="text-capitalize">{{ $payment->response["data"]["channel"] }}</td>
                                            <td>
                                                @if ($payment->status == 0)
                                                    <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span>
                                                @elseif ($payment->status == 1)
                                                    <span class="badge bg-success text-capitalize">{{ $payment->response["data"]["status"] }}</span>

                                                @else
                                                    <span class="badge bg-warning">{{ $payment->response["data"]["status"] }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $payment->created_at }}</td>
                                        </tr>
                                    @elseif(isset($payments)) <!-- Check if $payments variable is set -->

                                        @foreach ($payments as $payment)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration to get the iteration count -->
                                                <td>{{ $payment->user->first_name }} {{ $payment->user->last_name }}</td>
                                                <td>{{ $payment->quantity }}</td>
                                                <td>{{ number_format($payment->amount , 2)}}</td>
                                                @can('admins', auth()->user())

                                                    <td>{{ $payment->response["data"]["currency"] }}</td>
                                                    <td>{{ $payment->response["data"]["channel"] }}</td>
                                                @endcan

                                                <td>
                                                    @if ($payment->status == 0)
                                                        {{-- <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span> --}}
                                                        <span class="badge bg-warning text-capitalize">{{ $payment->response["data"]["status"] }}</span>
                                                    @elseif ($payment->status == 1)
                                                        <span class="badge bg-success"> {{ $payment->response["data"]["status"] }}</span>
                                                    @else
                                                        <span class="badge bg-info">{{ $payment->response["data"]["status"] }}</span>
                                                    @endif
                                                </td>
                                                <td>{{ $payment->created_at }}</td>
                                            </tr>
                                            @php
                                                // Calculate totals for each country
                                                $country = $payment->user->plants->first()->country;
                                                if (!isset($countryTotals[$country])) {
                                                    $countryTotals[$country] = ['quantity' => 0, 'total' => 0];
                                                }
                                                $countryTotals[$country]['quantity'] += $payment->quantity;
                                                $countryTotals[$country]['total'] += $payment->amount;
                                            @endphp
                                        @endforeach
                                    @endif


                                </tbody>
                                <tfoot>
                                    @foreach ($countryTotals as $country => $totals)
                                        <tr>
                                            <th>Total </th>
                                            <th>{{ $country }}</th>
                                            <th>{{ $totals['quantity'] }}</th>
                                            <th></th>
                                            @can('admins', auth()->user())
                                                <th></th>
                                                <th></th>
                                            @endcan
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


</div>




@endsection
