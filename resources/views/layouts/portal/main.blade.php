<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ENTAK ENERGY | Dashboard</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min2167.css?v=3.2.0') }}">
    <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">

    <link rel="stylesheet" href="{{ asset('plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">


    <link rel="stylesheet" href="{{ asset('dist/cutealert/style.css') }}">
    <link rel="stylesheet" href="{{ asset('dist/css/style.css') }}">

    <style>
        .content-wrapper {
            padding: 20px;
        }

        .news-content img {
            max-width: 100%;
            height: auto;
            object-fit: cover;
        }

        .thumbnail img {
            width: 100%;
            max-width: 500px; /* Standard blog image width */
            height: 400px; /* Standard blog image height */
            object-fit: cover; /* Crop the image to fit the box */
        }

        .news-content {
            margin-top: 20px;
        }
        @media (max-width: 768px) {
            .thumbnail img {
                max-width: 100%;
                height: auto;
            }
        }

    </style>

    @include('includes.scripts')
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">
        <div class="preloader flex-column justify-content-center align-items-center">
            <img class="animation__shake" src="{{ asset('dist/img/entak_logo.png') }}" alt="AdminLTELogo" height="60" width="60">
        </div>

        @include('includes.nav')

        @include('includes.aside')

        @yield('content')

        @include('includes.footer')




    </body>


</html>
