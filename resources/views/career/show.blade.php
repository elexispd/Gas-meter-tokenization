
@extends('layouts.portal.main')



@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- News Title -->
                <h1 class="mb-3">{{ $career->title }}</h1>

                <!-- News Content -->
                <div class="news-content">
                    {!! $career->content !!}
                </div>

                <!-- Back Button -->
                <div class="mt-4">
                    <a href="{{ route('career.index') }}" class="btn btn-primary">Back to News List</a>
                </div>
            </div>
        </div>

@endsection
