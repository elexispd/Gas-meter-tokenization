@extends('layouts.portal.main')

@section('content')

<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">User Profile</li>
                    </ol>
                </div>
            </div>
        </div>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-6 mx-auto">

                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{ asset('dist/img/avatar.jpg') }}" alt="User profile picture">
                            </div>
                            <h3 class="profile-username text-center">{{ $user->first_name }} {{ $user->last_name }}</h3>
                            <ul class="list-group list-group-unbordered mb-3">
                                <li class="list-group-item">
                                    <b>Date Registered</b> <a class="float-right">{{ $user->created_at->diffForHumans() }}</a>
                                </li>
                                @if ($user->meter_number)
                                <li class="list-group-item">
                                    <b>Meter Number</b> <a class="float-right">{{ $user->meter_number }}</a>
                                </li>
                                @endif
                                <li class="list-group-item">
                                    <b>Email</b> <a class="float-right">{{ $user->email }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Phone Number</b> <a class="float-right">{{ $user->phone_number }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Address</b> <a class="float-right">{{ $user->address }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>State</b> <a class="float-right">{{ $user->state }}</a>
                                </li>
                                <li class="list-group-item">
                                    <b>Country</b> <a class="float-right">{{ $user->country }}</a>
                                </li>

                                @if ($user->is_tenant)
                                    <li class="list-group-item">
                                        <b>Number Of Plants</b> <a class="float-right">{{ $plant_count }}</a>
                                    </li>
                                    <li class="list-group-item">
                                        <b>Number Of End-Users</b> <a class="float-right">{{ $endUsersCount }}</a>
                                    </li>
                                @endif

                            </ul>
                            @if ($user->is_tenant)

                                <a href="{{ route('user.tenant.plants', $user->id) }}" class="btn btn-primary btn-block">View Plants</a>
                                <a href="{{ route('user.tenant.consumers', $user->id) }}" class="btn btn-primary btn-block">View Consumers</a>
                            @endif

                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

</div>


@endsection
