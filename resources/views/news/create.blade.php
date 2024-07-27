
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Upload News</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <form action="{{ route('news.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ old('excerpt') }}" required>
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
                    <div>
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*" required>
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        <img id="thumbnail-preview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 100px;">
                    </div>
                    <button class="btn btn-success my-3" type="submit">Upload</button>
                </form>

            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#thumbnail').change(function(e) {
                let reader = new FileReader();
                reader.onload = function(e) {
                    $('#thumbnail-preview').attr('src', e.target.result).show();
                }
                reader.readAsDataURL(this.files[0]);
            });
        });
    </script>

@endsection
