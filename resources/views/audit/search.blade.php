
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Generate Log</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>
                <div class="mt-5">
                    <h4 class="text-center display-5">Search By Type Of Activity</h4>
                    <div class="row">
                        <div class="col-md-8 offset-md-2">

                            <form action="{{ route('audit.result') }}" method="post">
                                @csrf
                                <div class="input-group">
                                    <select name="activity" id="status" class="form-control" >
                                        <option value=""></option>
                                        <option value="all">All</option>
                                        <option value="plant">Plant</option>
                                        <option value="user">User</option>
                                        <option value="purchase">Purchase</option>
                                    </select>
                                </div>
                                <div class="input-group-append mt-2">
                                    <button type="submit" class="btn btn-lg mx-auto text-center btn-primary">
                                        <i class="fa fa-search"></i> Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>


                <div class="mt-5">
                    <h4 class="text-center display-5"> Search By Range </h4>
                </div>
                <form action="{{ route('audit.result') }}" method="post">
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

                                {{-- <div class="col-6">
                                    <div class="form-group">
                                        <label>Activity</label>
                                        <select name="param" id="status" class="form-control" >
                                            <option value=""></option>
                                            <option value="all">All</option>
                                            <option value="plant">Plant</option>
                                            <option value="user">User</option>
                                            <option value="purchase">Purchase</option>
                                        </select>
                                    </div>
                                </div> --}}
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
