
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Pricing</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Pricing</li>
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
                        @if (auth()->user()->is_super_admin)
                            <div class="card-header">
                                <h3 class="card-title">List of Pricing</h3>
                            </div>
                            <div class="card-body">
                                    <table id="example1" class="table table-bordered table-striped">
                                        <thead>
                                            <tr>
                                                <th>S/N</th>
                                                <th>Country</th>
                                                <th>Price</th>
                                                <th>Status</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                    <tbody>
                                        @foreach ($prices as $price)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $price->country }} </td>
                                                <td>{{ $price->price}}  </td>
                                                <td>
                                                    @if ($price->status)
                                                        <span class="badge bg-success">Active</span>
                                                    @else
                                                    <span class="badge bg-danger">Old</span>
                                                    @endif
                                                </td>
                                                <td>{{  $price->created_at->diffForHumans() }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>S/N</th>
                                            <th>Country</th>
                                            <th>Price</th>
                                            <th>Status</th>
                                            <th>Date</th>
                                        </tr>
                                    </tfoot>
                                </table>


                            </div>
                         @else
                         <div class="card-body">

                            <div class="col-lg-12 text-center">
                                 <img src="{{ asset('dist/img/plant.png') }}" alt="plant" srcset="" style="" >
                                 <h5 class="mt-3">Dear Esteem Customer, Our current price for 1m<sup>3</sup> of LPG is

                                    @if ($prices && count($prices) > 0)
                                        @foreach ($prices as $price)
                                            <div class="price-block">

                                                <strong>
                                                    @if ($price->country == "Nigeria")
                                                        NGN
                                                    @elseif ($price->country == "Cameroon")
                                                        XAF
                                                    @else
                                                        GHN
                                                    @endif
                                                    {{ $price->price }}
                                                </strong>
                                            </div>
                                            <br> <!-- Optional: Add a line break between each price -->
                                        @endforeach
                                    @endif



                                </h5>
                            </div>
                         </div>
                        @endif
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


</div>s




@endsection
