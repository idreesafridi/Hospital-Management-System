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

                                <form method="POST" action="{{ route('password.email') }}" id="reset-form">
                                    @csrf

                                    <!-- Email Address -->
                                    <div>
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email"
                                            name="email" :value="old('email')" required autofocus />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <x-primary-button>
                                            {{ __('Email Password Reset Link') }}
                                        </x-primary-button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>




    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        referrerpolicy="no-referrer"></script>
    <script>
        $(document).ready(function() {
            $("#reset-form").validate({
                rules: {
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    email: {
                        required: "Please enter your email address",
                        email: "Please enter a valid email address"
                    },
                }
            });
        });
    </script>


</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/login.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:20:40 GMT -->

</html>
