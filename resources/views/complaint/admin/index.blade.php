
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>complaint Record</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">complaints</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <!-- Custom Content -->
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">List of complaints</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>User</th>
                                        <th>Subject</th>
                                        <th>Date</th>
                                        @can('admins', auth()->user())
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>

                                        @foreach ($complaints as $complaint)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td> <!-- Use $loop->iteration to get the iteration count -->
                                                <td>
                                                    @if ($complaint->user != null)
                                                         {{ $complaint->user->first_name }} {{ $complaint->user->last_name }}
                                                    @else
                                                        -
                                                    @endif

                                                </td>
                                                <td>{{ $complaint->subject }}</td>
                                                <td>{{ $complaint->created_at }}</td>
                                                <td>
                                                    <i class="fa fa-eye text-primary" data-toggle="modal" data-id="{{ $complaint->id }}" data-target="#viewModal" style="cursor: pointer;"></i>
                                                </td>
                                            </tr>

                                        @endforeach

                                </tbody>

                            </table>
                        </div>
                    </div>
                    <!-- /.Custom Content -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

    {{--complaint Info Modal --}}
    <!-- Modal -->
    <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel">Order Details</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="modalContent">
                        <!-- Modal body content will be dynamically loaded here -->
                        Loading...
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(function () {
            $("#example1").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
            });
        });
    </script>

    <script>
        $(document).ready(function(){
            $('#viewModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget); // Button that triggered the modal
                var complaint_Id = button.data('id'); // Extract info from data-* attributes
                var modal = $(this);
                modal.find('.modal-title').text('Complaint Detail');
                modal.find('#modalContent').html('<div class="text-center">Loading...</div>');

                $.ajax({
                    url: '{{ route('complaint.show', ':id') }}'.replace(':id', complaint_Id),
                    method: 'GET',
                    data: { complaint_id: complaint_Id },
                    success: function(response) {
                        var complaint = response;
                        var body = `
                            <div style="font-size: 4em; padding: 20px; background-color: #f8f9fa; border-radius: 5px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); font-size: 16px;">
                                <p><strong>User:</strong>  ${complaint.user.first_name} ${complaint.user.last_name}</p>
                                <p><strong>Subject:</strong>  ${complaint.subject}</p>
                                <p><strong>Description:</strong>  ${complaint.description}</p>
                                <p><strong>Date Created:</strong> ${complaint.created_at}</p>
                            </div>
                        `;

                        modal.find('#modalContent').html(body);
                    },
                    error: function(xhr, status, error) {
                        modal.find('#modalContent').html('Failed to fetch compaint. Status: ' + status + ', Error: ' + error);
                    }
                });

            });
        });
    </script>


</div>




@endsection
