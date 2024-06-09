
@extends('layouts.portal.main')

@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Plants</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Plants</li>
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
                            <h3 class="card-title">List of Plants</h3>
                        </div>
                        <div class="card-body">
                            <table id="example1" class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Tenant</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        @can('show', auth()->user())
                                        <th>Action</th>
                                        @endcan
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $serialNumber = 1; @endphp
                                    @foreach ($plants as $plant)
                                        <tr>
                                            <td>{{ $serialNumber++ }}</td>
                                            <td>{{ $plant->tenant->first_name }} {{ $plant->tenant->last_name }}</td>
                                            <td>{{ $plant->country }}</td>
                                            <td>{{ $plant->state }}</td>
                                            <td>{{ $plant->address }}</td>
                                            @can('show', auth()->user())
                                            <td>
                                                <a href="{{ route('plant.edit', [$plant->id]) }}" class="text-primary"  ><i class="fa fa-edit"></i></a>
                                                <a href="{{ route('plant.meters', [$plant->id]) }}" class="text-primary"><i class="fa fa-eye"></i></a>
                                                <span class="text-danger delete-btn"  data-value="{{ $plant->id }}"><i class="fa fa-trash"></i></span>
                                            </td>
                                            @endcan
                                        </tr>
                                    @endforeach

                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>S/N</th>
                                        <th>Tenant</th>
                                        <th>Country</th>
                                        <th>State</th>
                                        <th>Address</th>
                                        @can('show', auth()->user())
                                        <th>Action</th>
                                        @endcan
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
