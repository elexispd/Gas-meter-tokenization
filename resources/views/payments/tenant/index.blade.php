
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Search Payment</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <form action="{{ route('payment.tenant.result') }}" method="post">
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
