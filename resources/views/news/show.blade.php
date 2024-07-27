
@extends('layouts.portal.main')



@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <!-- News Title -->
                <h1 class="mb-3">{{ $news->title }}</h1>

                <!-- News Thumbnail -->
                @if($news->thumbnail)
                    <div class="thumbnail mb-3">
                        <img src="{{ asset('storage/' . $news->thumbnail) }}" alt="Thumbnail" class="img-fluid">
                    </div>
                @endif

                <!-- News Content -->
                <div class="news-content">
                    {!! $news->content !!}
                </div>

                <!-- Back Button -->
                <div class="mt-4">
                    <a href="{{ route('news.index') }}" class="btn btn-primary">Back to News List</a>
                </div>
            </div>
        </div>

@endsection
