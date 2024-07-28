@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">Edit News</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <form action="{{ route('career.update', $career->id) }}" method="POST" >
                    @csrf
                    @method('PUT') <!-- Specifies that this is a PUT request -->

                    <div>
                        <label for="title">Title</label>
                        <input type="text" id="title" class="form-control" name="title" value="{{ old('title', $career->title) }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="content">Content</label>
                        <textarea id="content" name="content" class="form-control" required>{{ old('content', $career->content) }}</textarea>
                        <script>
                            CKEDITOR.replace('content');
                        </script>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <div>
                        <label for="status">Status</label>
                        <select name="status" id="" class="form-control">
                            <option value="1" @if ($career->status == true)
                                selected
                            @endif  >Active</option>
                            <option value="0" @if ($career->status == false)
                                selected
                            @endif>Disable</option>
                        </select>
                        @error('content')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>


                    <button class="btn btn-success my-3" type="submit">Update</button>
                </form>

            </div>
        </section>
    </div>



@endsection


