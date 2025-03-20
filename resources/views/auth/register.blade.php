<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:20:40 GMT -->

<head>
    <meta charset="utf-8">
    <title>Doccure</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">

    <link href="assets/img/favicon.png" rel="icon">

    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    <style>
        .error {
            color: red;
        }
    </style>
</head>

<body class="account-page">

    <div class="main-wrapper">


        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8 offset-md-2">

                        <div class="account-content">
                            <div class="row align-items-center justify-content-center">
                                <div class="col-md-7 col-lg-6 login-left">
                                    <img src="{{ asset('website/img/login-banner.png') }}" class="img-fluid"
                                        alt="Doccure Register">
                                </div>
                                <div class="col-md-12 col-lg-6 login-right">
                                    <div class="login-header">
                                        <h3>Patient Register <a href="doctor-register.html">Are you a Doctor?</a></h3>
                                    </div>

                                    <form action="{{ route('register_store') }}" id="registerForm" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <input type="text" hidden name="role" value="Patient">
                                        <div class="form-group form-focus">
                                            <input type="text" name="first_name" id="first_name"
                                                class="form-control floating">
                                            <label class="focus-label">First Name</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="text" name="last_name" id="last_name"
                                                class="form-control floating">
                                            <label class="focus-label">Last Name</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="email" name="email" id="email"
                                                class="form-control floating">
                                            <label class="focus-label">Email Address</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="file" name="file" id="file"
                                                class="form-control floating">
                                            <label class="focus-label">Profile Image</label>
                                        </div>
                                        <div class="form-group form-focus">
                                            <input type="password" name="password" id="password"
                                                class="form-control floating">
                                            <label class="focus-label">Password</label>
                                        </div>
                                        <div class="text-end">
                                            <a class="forgot-link" href="{{ route('login') }}">Already have an
                                                account?</a>
                                        </div>
                                        <button class="btn btn-primary w-100 btn-lg login-btn"
                                            type="submit">Signup</button>
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
                                    </form>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>


    </div>


    <script src="{{ asset('website/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('website/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('website/js/feather.min.js') }}"></script>

    <script src="{{ asset('website/js/script.js') }}"></script>
</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:20:40 GMT -->

</html>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
<script>
    $('#registerForm').validate({
        rules: {
            first_name: {
                required: true,
            },
            last_name: {
                required: true,
            },
            email: {
                required: true,
                minlength: 3,
            },
            password: {
                required: true,
                minlength: 8,
            }
        },
        messages: {
            first_name: {
                required: "Please enteer a name",
            },
            last_name: {
                required: "Please enteer a name",
            },
            email: {
                required: "Please enter a email",
                minlength: "Title must be at least @ characters",
            },
            password: {
                required: "Please enter password",
                minlength: 8,
            },
        },
        submitHandler: function(form) {
            form.submit();
        }
    });
</script>
