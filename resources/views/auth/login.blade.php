<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:20:40 GMT -->

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link href="{{ asset('website/img/favicon.png') }}" rel="icon">

    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation/1.19.5/jquery.validate.min.css">

    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="account-page">

    {{-- <div class="main-wrapper"> --}}




    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-8 offset-md-2">

                    <div class="account-content">
                        <div class="row align-items-center justify-content-center">
                            <div class="col-md-7 col-lg-6 login-left">
                                <img src="{{ asset('website/img/login-banner.png') }}" class="img-fluid"
                                    alt="Doccure Login">
                            </div>
                            <div class="col-md-12 col-lg-6 login-right">
                                <div class="login-header">
                                    <h3>Login <span>Doccure</span></h3>
                                </div>
                                <form action="{{ route('login_store') }}" method="POST" id="signin-form"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="form-group form-focus">
                                        <input type="email" name="email" id="email"
                                            class="form-control floating" required>
                                        <label class="focus-label">Email</label>
                                    </div>
                                    <div class="form-group form-focus">
                                        <input type="password" name="password" class="form-control floating">
                                        <label class="focus-label">Password</label>
                                    </div>
                                    <div class="text-end">
                                        <a class="forgot-link" href="{{ route('password.request') }}">Forgot Password
                                            ?</a>
                                    </div>
                                    <button class="btn btn-primary w-100 btn-lg login-btn" type="submit">Login</button>
                                    <div class="login-or">
                                        <span class="or-line"></span>
                                        <span class="span-or">or</span>
                                    </div>
                                    <div class="row form-row social-login">
                                        <div class="col-6">
                                            <a href="#" class="btn btn-facebook w-100"><i
                                                    class="fab fa-facebook-f me-1"></i> Login</a>
                                        </div>
                                        <div class="col-6">
                                            <a href="#" class="btn btn-google w-100"><i
                                                    class="fab fa-google me-1"></i> Login</a>
                                        </div>
                                    </div>
                                    <div class="text-center dont-have">Don’t have an account? <a
                                            href="{{ route('register') }}">Register</a></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>





    {{-- </div> --}}


    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $("#signin-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                    password: {
                        required: true,
                        minlength: 6
                    }
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                    password: {
                        required: "Please enter your password",
                        minlength: "Your password must be at least 6 characters long"
                    }
                }
            });
        });
    </script>


</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:20:40 GMT -->

</html>
