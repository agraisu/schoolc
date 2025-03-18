<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Forgot Password</title>
    @include('allcss')
    @include('alljs')
    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
            <div class="card-header text-center">
                <a href="" class="h1"><b>Forgot Password</b></a>
            </div>
            <div class="card-body">
                @include('_message')
                <form action="" method="post">
                    {{ csrf_field() }}
                    <div class="input-group mb-3">
                        <input type="email" required name="email" class="form-control" placeholder="Email">
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-envelope"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-4">
                            <button type="submit" class="btn btn-primary btn-block">Forgot</button>
                        </div>
                    </div>
                </form>
                <!-- /.social-auth-links -->

                <p class="mb-1">
                    <br>
                    <a href="">Login</a>
                </p>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->
    <script src="../../dist/js/adminlte.min.js"></script>
</body>

</html>
