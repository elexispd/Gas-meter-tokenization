
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Tenants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                        <li class="breadcrumb-item active">Tenants</li>
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
                            <h3 class="card-title">List of Tenants</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Date Joined</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serialNumber = 1; @endphp
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }} </td>
                                            <td>{{  $user->created_at->diffForHumans() }}</td>

                                            <td>
                                                <a href="{{ route('tenant.show', $user->id) }}" class="text-info"><i class="fa fa-eye"></i></a>
                                                @can('show', auth()->user())
                                                <a href="{{ route('user.tenant.edit', [$user->id]) }}" class="text-primary"><i class="fa fa-edit"></i></a>
                                                <span class="text-danger delete-btn"  data-value="{{ $user->id }}"><i class="fa fa-trash"></i></span>
                                                @endcan
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Date Joined</th>
                                        <th>Action</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- /.Custom Content -->
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

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
        $(".delete-btn").click(function(){
            var user_id = $(this).data("value");
            cuteAlert({
                type: "question",
                title: "Confirm Delete",
                message: "Are You sure you want to delete this user?",
                confirmText: "Ok",
                cancelText: "Cancel"
                }).then((e)=>{
                if ( e == ("confirm")){
                    $.ajax({
                        url: '{{ route("profile.destroy") }}',
                        method: 'POST',
                        data: {
                            _token: '{{ csrf_token() }}',
                            user_id: user_id
                        },
                        success: function(response) {
                            cuteAlert({
                                type: "success",
                                title: "User Deleted",
                                message: "User was successfully deleted",
                                buttonText: "Ok"
                            }).then(() => {
                                window.location.reload();
                            })
                        },
                        error: function(xhr, status, error) {
                            cuteAlert({
                                type: "error",
                                title: "Something went wrong",
                                message: error,
                                buttonText: "Ok"
                            })
                        }
                    });
                } else {
                    cuteAlert({
                        type: "info",
                        title: "Cancelled",
                        message: "You aborted this operation",
                        buttonText: "Ok"
                    })
                }
            })
        })
    </script>
</div>s




@endsection
