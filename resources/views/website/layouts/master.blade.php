<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/index-fifteen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:18:19 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Doccure</title>

    <link type="image/x-icon" href="{{ asset('website/img/favicon.png') }}" rel="icon">

    <link rel="stylesheet" href="{{ asset('website/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('website/plugins/daterangepicker/daterangepicker.css') }}">


    <link rel="stylesheet" href="{{ asset('website/css/feather.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/owl.carousel.min.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/aos.css') }}">

    <link rel="stylesheet" href="{{ asset('website/css/style.css') }}">
    <style>
        .error {
            color: red;
        }
    </style>
    @stack('css')
</head>

<body class="home-fifteen">

    <div class="main-wrapper">

        <header class="header">
            <div class="container">
                <div class="nav-bg-fifteen">
                    <nav class="navbar navbar-expand-lg header-nav nav-transparent">
                        <div class="navbar-header">
                            <a id="mobile_btn" href="javascript:void(0);"> <span class="bar-icon">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </span>
                            </a>
                            <a href="{{ route('website_index') }}" class="navbar-brand logo">
                                <img src="{{ asset('website/img/logo-2.png') }}" class="img-fluid" alt="Logo">
                            </a>
                        </div>
                        <div class="main-menu-wrapper">
                            <div class="menu-header">
                                <a href="{{ route('website_index') }}" class="menu-logo">
                                    <img src="{{ asset('website/assets/img/logo-2.png') }}" class="img-fluid"
                                        alt="Logo">
                                </a>
                                <a id="menu_close" class="menu-close" href="javascript:void(0);"> <i
                                        class="fas fa-times"></i>
                                </a>
                            </div>
                            <ul class="main-nav black-font">
                                <li class="has-submenu menu-effect active"> <a href="{{ route('website_index') }}">Home
                                    </a>

                                </li>
                                <li class="has-submenu menu-effect"><a href="{{ route('doctorlist') }}">Doctors</a>
                                </li>
                                <li class="has-submenu menu-effect"><a href="#">Pages <i
                                            class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">

                                        <li><a href="{{ route('about') }}">About Us</a></li>
                                        <li><a href="{{ route('contact') }}">Contact Us</a></li>
                                    </ul>
                                </li>
                                <li class="has-submenu menu-effect"><a href="#">Blog <i
                                            class="fas fa-chevron-down"></i></a>
                                    <ul class="submenu">

                                        <li><a href="{{ route('bloglist') }}">Blog Grid</a>
                                        </li>
                                        {{-- <li><a href="{{ route('blogdetail') }}">Blog Details</a>
                                        </li> --}}
                                    </ul>
                                </li>
                                <li class="has-submenu menu-effect"><a href="{{ route('api_search') }}">ApiSearch</a>
                                </li>

                                <li class="login-link"> <a href="login.html">Login / Signup</a>
                                </li>
                            </ul>
                        </div>
                        <ul class="nav header-navbar-rht">
                            @if (auth()->check())
                                <li class="nav-item">
                                    <a class="nav-link btn-five btn-fifteen"
                                        href="{{ route('backend_dashboard') }}">Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                                        @csrf
                                        <button type="submit"
                                            class="nav-link btn-five-light btn-fifteen-light">Logout</button>
                                    </form>
                                </li>
                            @else
                                <li class="nav-item">
                                    <a class="nav-link btn-five btn-fifteen" href="{{ route('login') }}">Sign In</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link btn-five-light btn-fifteen-light"
                                        href="{{ route('register') }}">Sign Up</a>
                                </li>
                            @endif
                        </ul>

                    </nav>
                </div>
            </div>
        </header>

        <div class="content">
            <div class="container-fluid">
                <div class="row">

                    @yield('content')

                </div>
            </div>
        </div>



        <section class="home-fifteen-footer">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3 col-md-6">
                        <div class="home-fifteen-footer-block">
                            <div class="foot-title">
                                <a href="#"><img src="assets/img/logo-2.png" alt=""></a>
                            </div>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                ut labore et dolore magna aliqua.</p>
                            <div class="foot-social-icons">
                                <a href="#" class="me-3"><i class="feather-facebook"></i></a>
                                <a href="#" class="me-3"><i class="feather-instagram"></i></a>
                                <a href="#" class="me-3"><i class="feather-linkedin"></i></a>
                                <a href="#"><i class="feather-twitter"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="home-fifteen-footer-block">
                            <div class="foot-title">
                                <h6>For Patients</h6>
                            </div>
                            <div class="foot-list">
                                <ul>
                                    <li><a href="search.html">Search for Doctors</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="register.html">Register</a></li>
                                    <li><a href="booking.html">Booking</a></li>
                                    <li><a href="patient-dashboard.html">Patient Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="home-fifteen-footer-block">
                            <div class="foot-title">
                                <h6>For Doctors</h6>
                            </div>
                            <div class="foot-list">
                                <ul>
                                    <li><a href="appointments.html">Appointments</a></li>
                                    <li><a href="chat.html">Chat</a></li>
                                    <li><a href="login.html">Login</a></li>
                                    <li><a href="doctor-register.html">Register</a></li>
                                    <li><a href="doctor-dashboard.html">Doctor Dashboard</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-md-6">
                        <div class="home-fifteen-footer-block">
                            <div class="foot-title">
                                <h6>For Doctors</h6>
                            </div>
                            <div class="foot-list-address">
                                <p>3556 Beech Street, San Francisco, California, CA 94108.</p>
                                <p> +1 315 369 5943</p>
                                <p><a href="https://doccure-html.dreamguystech.com/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        data-cfemail="fc98939f9f898e99bc99849d918c9099d29f9391">[email&#160;protected]</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="foot-line">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="foot-copy-rights">
                            <p class="mb-0">© 2022 Doccure. All rights reserved.</p>
                            <div class="foot-terms-policy">
                                <a href="term-condition.html">Terms and Conditions</a><span> | </span>
                                <a href="privacy-policy.html">Policy</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>

    <script data-cfasync="false" src="../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="{{ asset('website/js/jquery-3.6.0.min.js') }}"></script>

    <script src="{{ asset('website/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('website/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
    <script src="{{ asset('website/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>


    <script src="{{ asset('website/js/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('website/js/slick.js') }}"></script>
    <script src="{{ asset('website/js/moment.min.js') }}"></script>
    <script src="{{ asset('website/plugins/daterangepicker/daterangepicker.js') }}"></script>
    <script src="{{ asset('website/js/bootstrap-datetimepicker.min.js') }}"></script>

    <script src="{{ asset('website//plugins/fancybox/jquery.fancybox.min.js') }}"></script>

    <script src="{{ asset('website/js/feather.min.js') }}"></script>

    <script src="{{ asset('website/js/aos.js') }}"></script>

    <script src="{{ asset('website/js/isotope.pkgd.min.js') }}"></script>

    <script src="{{ asset('website/js/script.js') }}"></script>

    @stack('js')
</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/index-fifteen.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:18:41 GMT -->

</html>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    @if (Session::has('msg'))
        Swal.fire({
            icon: "{{ Session::get('type') }}",
            title: "{{ Session::get('title') }}",
            text: "{{ Session::get('msg') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>
