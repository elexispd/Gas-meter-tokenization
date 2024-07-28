
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
                            <th>Title</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($careers as $career)
                            <tr>
                                <td>{{ $loop->iteration }}</td>

                                <td>{{ $career->title }}</td>
                                <td>
                                    @if ($career->status == true)
                                       <span class="badge badge-success">Active</span>
                                    @else
                                        <span class="badge badge-danger">Expired </span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('career.show', $career->id) }}" class="btn btn-info btn-sm">View</a>
                                    <a href="{{ route('career.edit', $career->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                    <form action="{{ route('career.destroy', $career->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this vacancy?');">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <!-- Pagination Links -->
                <div class="d-flex justify-content-center">
                    {{ $careers->links() }}
                </div>

            </div>
        </section>
    </div>

@endsection
