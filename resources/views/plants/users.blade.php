
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Plant Users</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                            <h3 class="card-title">List of Plant Users</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Full Name</th>
                                        <th>Meter Number</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $user->first_name }} {{ $user->last_name }}</td>
                                            <td>{{ $user->meter_number }}</td>
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
        var plant_id = $(this).data("value");
        cuteAlert({
            type: "question",
            title: "Confirm Delete",
            message: "Are You sure you want to delete this plant?",
            confirmText: "Ok",
            cancelText: "Cancel"
            }).then((e)=>{
            if ( e == ("confirm")){
                $.ajax({
                    url: '{{ route("plant.destroy") }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        plant_id: plant_id
                    },
                    success: function(response) {
                        cuteAlert({
                            type: "success",
                            title: "Plant Deleted",
                            message: "Plant was successfully deleted",
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
</div>




@endsection
