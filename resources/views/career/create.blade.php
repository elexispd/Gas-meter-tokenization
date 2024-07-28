
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Publish Vacancy</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <form action="{{ route('career.store') }}" method="POST" >
                    @csrf
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div>
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control" required>{{ old('content') }}</textarea>
                        <script>
                            CKEDITOR.replace('content');
                        </script>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <button class="btn btn-success my-3" type="submit">Publish</button>
                </form>

            </div>
        </section>
    </div>


@endsection
