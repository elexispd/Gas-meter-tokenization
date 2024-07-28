
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Search Payment</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>
                <div class="mt-5">
                    <h4 class="text-center display-5">Search By Meter Number</h4>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            <form action="{{ route('payment.result') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="search" name="meter_number" class="form-control form-control-lg" placeholder="Type Meter Number here..." autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="mt-5">
                    <h4 class="text-center display-5">Search By Order ID</h4>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">
                            <form action="{{ route('payment.result') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <input type="search" name="order_id" class="form-control form-control-lg" placeholder="Type Order ID here..." autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-lg btn-primary">
                                            <i class="fa fa-search"></i> Search
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="mt-5">
                    <h4 class="text-center display-5">Search By Range & Status</h4>
                </div>
                <form action="{{ route('payment.result') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-10 offset-md-1">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>From:</label>
                                        <input type="date" class="form-control" name="from" id="from">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>To:</label>
                                        <input type="date" class="form-control" name="to" id="to">
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Status</label>
                                        <select name="status" id="status" class="form-control" name="status">
                                            <option value=""></option>
                                            <option value="all">All</option>
                                            <option value="0">Initialized</option>
                                            <option value="1">Paid</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-6">
                                    <div class="form-group">
                                        <label>County</label>
                                        <select name="country" id="status" class="form-control" name="status">
                                            <option value=""></option>
                                            <option value="all">General</option>
                                            <option value="Nigeria">Nigeria</option>
                                            <option value="Ghana">Ghana</option>
                                            <option value="Cameroon">Cameroon</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-6 mx-auto">
                                <div class="form-group text-center">
                                    <button type="submit" class="btn btn-lg btn-primary">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

@endsection
