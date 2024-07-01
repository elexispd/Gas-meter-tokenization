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
        background: url({{ asset('dist/img/login_bg.jpg') }}) no-repeat center center;
        background-size: cover;
        flex: 1;
    }
    .login-box {
        width: 100%;
        max-width: 400px;
    }
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    .card-body {
        padding: 40px;
    }
    .login-card-body {
        background-color: #ffffff;
        border-top: 5px solid #28a745;
    }
    .login-card-body h2 {
        margin-bottom: 20px;
        font-size: 24px;
        font-weight: 700;
        color: #333;
    }
    .input-group-text {
        background-color: #f1f1f1;
        border-left: 0;
    }
    .form-control {
        border-right: 0;
        border-left: 1px solid #ced4da;
        box-shadow: none;
    }
    .btn-success {
        background-color: #28a745;
        border: none;
    }
    .btn-success:hover {
        background-color: #218838;
    }
    .alert {
        border-radius: 5px;
        margin-bottom: 20px;
    }
    .icheck-primary input[type="checkbox"] {
        margin-top: 0;
    }
    .icheck-primary label {
        margin-left: 5px;
    }
    @media (max-width: 767.98px) {
        .login-container {
            flex-direction: column;
        }
        .login-left {
            flex: none;
            width: 100%;
            box-shadow: none;
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
        <div class="login-right"></div>
    </div>

    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
