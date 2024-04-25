@extends('layouts.portal.main')

@section('content')

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            @can('admins', auth()->user())


            <div class="row">
                <div class="col-lg-3 col-6">

                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $sales_count }}</h3>
                            <p>Sales</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer"></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">
                    <div class="small-box bg-success">
                        <div class="inner">
                            <h3>{{ $tenant_count }}<sup style="font-size: 20px"></sup></h3>
                            <p>Tenants</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-stats-bars"></i>
                        </div>
                        <a href="#" class="small-box-footer"></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-warning">
                        <div class="inner">
                            <h3>{{ $user_count }}</h3>
                            <p>User Registrations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer"></a>
                    </div>
                </div>

                <div class="col-lg-3 col-6">

                    <div class="small-box bg-danger">
                        <div class="inner">
                            <h3>{{ $plant_count }}</h3>
                            <p>Plants</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-pie-graph"></i>
                        </div>
                        <a href="#" class="small-box-footer"></a>
                    </div>
                </div>

            </div>


            <div class="row">

                <section class="col-lg-7 connectedSortable">

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">
                                <i class="fas fa-chart-pie mr-1"></i>
                                Sales For @php echo date('F') @endphp
                            </h3>
                            <div class="card-tools">

                            </div>
                        </div>
                        <div class="card-body">
                            <div class="tab-content p-0">

                                <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                    <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                </div>
                                <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;">
                                    <canvas id="sales-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>


                </section>


                <section class="col-lg-5 connectedSortable">
                    <div class="card bg-gradient-success">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="far fa-calendar-alt"></i>
                                Calendar
                            </h3>

                            <div class="card-tools">

                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                        <i class="fas fa-bars"></i>
                                    </button>
                                    <div class="dropdown-menu" role="menu">
                                        <a href="#" class="dropdown-item">Add new event</a>
                                        <a href="#" class="dropdown-item">Clear events</a>
                                        <div class="dropdown-divider"></div>
                                        <a href="#" class="dropdown-item">View calendar</a>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>

                        </div>

                        <div class="card-body pt-0">

                            <div id="calendar" style="width: 100%"></div>
                        </div>

                    </div>
                    <div class="card d-none bg-gradient-primary">
                        <div class="card-header border-0">
                            <h3 class="card-title">
                                <i class="fas fa-map-marker-alt mr-1"></i>
                                Visitors
                            </h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-primary btn-sm daterange" title="Date range">
                                    <i class="far fa-calendar-alt"></i>
                                </button>
                                <button type="button" class="btn btn-primary btn-sm" data-card-widget="collapse" title="Collapse">
                                    <i class="fas fa-minus"></i>
                                </button>
                            </div>

                        </div>
                        <div class="card-body">
                            <div id="world-map" style="height: 250px; width: 100%;"></div>
                        </div>

                        <div class="card-footer bg-transparent">
                            <div class="row">
                                <div class="col-4 text-center">
                                    <div id="sparkline-1"></div>
                                    <div class="text-white">Visitors</div>
                                </div>

                                <div class="col-4 text-center">
                                    <div id="sparkline-2"></div>
                                    <div class="text-white">Online</div>
                                </div>

                                <div class="col-4 text-center">
                                    <div id="sparkline-3"></div>
                                    <div class="text-white">Sales</div>
                                </div>

                            </div>

                        </div>
                    </div>

                </section>

            </div>
            @endcan

            {{-- @can("users",  auth()->user())
                <div class="text-center" style="display: flex; justify-content: center; align-items: center; height: 50vh;">
                    <img src="{{ asset('dist/img/logo_entak.jpg') }}" alt="entak logo" style="width: 200px;">
                </div>
            @endcan --}}



            <div class="row">
                @if(auth()->user()->is_tenant)

                    @foreach ($plants as $plant)
                        <section class="col-lg-6 connectedSortable">

                            <div class="card">
                                <div class="card-header">
                                    <h4>
                                        <strong> <a href="{{ route('user.tenant.plant.users', $plant->id) }}"> {{ $plant->address }} {{ $plant->state }}, {{ $plant->country }} </a></strong>
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <a href="{{ route('user.tenant.plant.users', $plant->id) }}"> <img src="{{ asset('dist/img/plant.png') }}" alt="plant" srcset="" style="width: 100%;"> </a>
                                </div>
                            </div>


                        </section>
                    @endforeach

                @endif

            </div>


            <div class="row">
                @if(auth()->user()->meter_number != null)

                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <strong> <a href="{{ route('purchase.add') }}"> Pay For Gas </a></strong>
                                </h4>
                            </div>
                            <div class="card-body">
                                <a href="{{ route('purchase.add') }}"> <img src="{{ asset('dist/img/meter.jpg') }}" alt="metre" srcset="" style="width: 100%;"> </a>
                            </div>
                        </div>
                    </section>

                    <section class="col-lg-6 connectedSortable">
                        <div class="card">
                            <div class="card-header">
                                <h4>
                                    <strong> <a href=""> Purshase History </a></strong>
                                </h4>
                            </div>
                            <div class="card-body">
                                <a href=""> <img src="{{ asset('dist/img/doc.jpg') }}" alt="doc" srcset="" style="width: 100%;"> </a>
                            </div>
                        </div>
                    </section>


                @endif

            </div>





        </div>
    </section>

</div>

@endsection
