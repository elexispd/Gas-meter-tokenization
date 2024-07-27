@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Edit News</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <form action="{{ route('news.update', $news->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Specifies that this is a PUT request -->

                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $news->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control" required>{{ old('content', $news->content) }}</textarea>
                        <script>
                            CKEDITOR.replace('content');
                        </script>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="thumbnail">Thumbnail</label>
                        <input type="file" class="form-control" id="thumbnail" name="thumbnail" accept="image/*">
                        @error('thumbnail')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror

                        @if($news->thumbnail)
                            <div class="mt-2">
                                <img id="thumbnail-preview" src="{{ asset('storage/' . $news->thumbnail) }}" alt="Current Thumbnail" style="max-width: 200px; height: auto;">
                            </div>
                        @else
                            <img id="thumbnail-preview" src="#" alt="Image Preview" style="display:none; margin-top: 10px; max-width: 200px; height: auto;">
                        @endif
                    </div>

                    <button class="btn btn-success my-3" type="submit">Update</button>
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
                if (this.files && this.files[0]) {
                    reader.readAsDataURL(this.files[0]);
                } else {
                    $('#thumbnail-preview').hide();
                }
            });
        });
    </script>

@endsection


