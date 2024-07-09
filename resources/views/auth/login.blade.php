<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>ENTAK ENERGY | Log in</title>

<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
<link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
<link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
<link rel="stylesheet" href="{{ asset('dist/css/bootstrap.min.css') }}">

<style>
    body {
        overflow: hidden;
        font-family: 'Source Sans Pro', sans-serif;
        background-color: #f4f6f9;
    }
    .login-container {
        display: flex;
        height: 100vh;
    }
    .login-left {
        background-color: white;
        padding: 30px;
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }
    .login-right {
        flex: 1;
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        background-color: #f4f6f9;
    }
    .carousel-inner {
        height: 100%;
    }
    .carousel-item {
        height: 100%;
        opacity: 0;
        transition: opacity 1s ease-in-out;
    }
    .carousel-item.active {
        opacity: 1;
    }
    .carousel-item img {
        object-fit: cover;
        height: 100%;
        width: 100%;
    }
    .carousel-control-prev,
    .carousel-control-next {
        display: none; /* Hide carousel controls */
    }
    .carousel-indicators {
        bottom: 20px;
    }
    .carousel-indicators li {
        background-color: black;
    }
    .carousel-indicators .active {
        background-color: #28a745;
    }

    @media (max-width: 768px) {
        .login-container {
            flex-direction: column;
        }
        .login-right {
            display: none;
        }
    }
</style>
</head>
<body>
    <div class="login-container">
        <div class="login-left">
            <div class="login-box">
                <div class="text-center">
                    <img src="{{ asset('dist/img/entak_logo.png') }}" alt="Entak_logo" style="width: 150px;">
                </div>
                <div class="card mb-5">
                    <div class="card-body login-card-body">
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif
                        @if ($errors->any())
                            <div class="alert alert-danger text-center">
                                Invalid username or password
                            </div>
                        @endif
                        <h2 class="login-box-msg mb-0">Sign In</h2>
                        <p class="text-muted" style="font-style: italic">Welcome back. Please sign in to continue</p>
                        <form action="{{ route('login') }}" method="post">
                            @csrf
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" name="identifier" placeholder="Enter Username" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-user"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" name="password" class="form-control" placeholder="Password" required>
                                <div class="input-group-append">
                                    <div class="input-group-text">
                                        <span class="fas fa-lock"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-8">
                                    <div class="icheck-primary">
                                        <input type="checkbox" id="remember" name="remember">
                                        <label for="remember">Remember Me</label>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" class="btn btn-success btn-block">Sign In</button>
                                </div>
                            </div>
                        </form>
                        <p class="mb-1">
                            <a class="text-success" href="{{ route('password.request') }}">I forgot my password</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-right">
            <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block w-100" src="{{ asset('dist/img/slide1.png') }}" alt="First slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('dist/img/slide2.png') }}" alt="Second slide">
                    </div>
                    <div class="carousel-item">
                        <img class="d-block w-100" src="{{ asset('dist/img/slide3.png') }}" alt="Third slide">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            // Initialize Carousel
            $('#carouselExampleIndicators').carousel({
                interval: 3000, // Change slide every 3 seconds
                pause: 'hover', // Pause on hover
                wrap: true // Wrap slides
            });
        });
    </script>
</body>
</html>
