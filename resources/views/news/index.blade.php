
@extends('layouts.portal.main')

@section('content')

    <div class="content-wrapper">
        <section class="content">
            <div class="container-fluid">
                <h3 class="display-5 pt-3">News</h3>

                <div class="text-center">
                    @include('includes.alert')
                </div>

                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S/N</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($news as $newsItem)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $newsItem->thumbnail) }}" alt="Thumbnail" style="width: 100px; height: auto;">
                                </td>
                                <td>{{ $newsItem->title }}</td>
                                <td>
                                    <a href="{{ route('news.show', $newsItem->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('news.edit', $newsItem->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('news.destroy', $newsItem->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this news item?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $news->links() }}
                </div>

            </div>
        </section>
    </div>

@endsection
