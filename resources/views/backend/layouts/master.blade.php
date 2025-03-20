<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:22:31 GMT -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Doccure - Bootstrap Admin HTML Template</title>

    <link rel="shortcut icon" href="{{ asset('backend/img/favicon.png') }}">

    <link rel="stylesheet" href="{{ asset('backend/css/bootstrap.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/fontawesome/css/all.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/css/feather.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/select2/css/select2.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/owl-carousel/owl.carousel.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/plugins/daterangepicker/daterangepicker.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/plugins/datatables/datatables.min.css') }}">

    <link rel="stylesheet" href="{{ asset('backend/css/style.css') }}">


    @stack('css')
    <style>
        .custom-popup {
            background-color: rgb(10, 3, 39) !important;
            /* Set background color to black */
            color: white !important;
            /* Set text color to white */
        }

        .custom-title {
            color: white !important;
            /* Title color */
        }

        .custom-content {
            color: white !important;
            /* Content color */
        }

        .custom-confirm-button {
            background-color: green !important;
            /* Customize confirm button color */
            color: white !important;
            /* Confirm button text color */
        }

        .custom-cancel-button {
            background-color: red !important;
            /* Customize cancel button color */
            color: white !important;
            /* Cancel button text color */
        }

        .error {
            color: red !important;
        }
    </style>
</head>

<body>

    <div class="main-wrapper">

        <div class="header">

            <div class="header-left">
                <a href="{{ route('backend_dashboard') }}" class="logo">
                    <img src="{{ asset('backend/img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('backend_dashboard') }}" class="logo logo-small">
                    <img src="{{ asset('backend/img/logo-small.png') }}" alt="Logo" width="30" height="30">
                </a>
                <a href="javascript:void(0);" id="toggle_btn">
                    <i class="feather-chevrons-left"></i>
                </a>
            </div>


            <div class="top-nav-search">
                <div class="main">
                    <form class="search" method="post"
                        action="https://doccure-html.dreamguystech.com/template/admin/index.html">
                        <div class="s-icon"><i class="fas fa-search"></i></div>
                        <input type="text" class="form-control" placeholder="Start typing your Search..." />
                        <ul class="results">
                            <li>
                                <h6><i class="feather-calendar me-1"></i> Appointments</h6>
                                <p>No matched Appointment found. <a href="upcoming-appointments.html"><span>View
                                            all</span></a></p>
                            </li>
                            <li>
                                <h6><i class="feather-calendar me-1"></i> Specialities</h6>
                                <p>No matched Appointment found. <a href="specialities.html"><span>View all</span></a>
                                </p>
                            </li>
                            <li>
                                <h6><i class="feather-user me-1"></i> Doctors</h6>
                                <p>No matched Appointment found. <a href="doctor-list.html"><span>View all</span></a>
                                </p>
                            </li>
                            <li>
                                <h6><i class="feather-users me-1"></i> Patients</h6>
                                <p>No matched Appointment found. <a href="patient-list.html"><span>View all</span></a>
                                </p>
                            </li>
                        </ul>
                    </form>
                </div>
            </div>


            <a class="mobile_btn" id="mobile_btn">
                <i class="fas fa-bars"></i>
            </a>


            <ul class="nav nav-tabs user-menu">

                <li class="nav-item">
                    <a href="#" id="dark-mode-toggle" class="dark-mode-toggle">
                        <i class="feather-sun light-mode"></i><i class="feather-moon dark-mode"></i>
                    </a>
                </li>


                <li class="nav-item dropdown noti-nav">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <i class="feather-bell"></i> <span class="badge"></span>
                        {{ auth()->user()->unreadNotifications()->count() }}
                    </a>
                    <div class="dropdown-menu notifications">
                        <div class="topnav-dropdown-header">
                            <span class="notification-title">Notifications</span>
                            <a href="javascript:void(0)" class="clear-noti"><i class="feather-more-vertical"></i></a>
                        </div>
                        <div class="noti-content">

                            <ul class="notification-list" id="notification-list">
                                @if (auth()->check() && auth()->user()->role == 'Doctor')
                                    <!-- Ensure user is logged in and is a Doctor -->
                                    @forelse(auth()->user()->notifications->whereNull('read_at') as $notification)
                                        <li class="notification-message {{ $notification->read_at ? 'read' : 'unread' }}"
                                            data-id="{{ $notification->id }}">
                                            <div class="timeline-panel">
                                                <div class="media me-2">
                                                    <img alt="image" width="50"
                                                        src="{{ asset('images/avatar/1.jpg') }}">
                                                </div>
                                                <div class="media-body">
                                                    <h6 class="mb-1">
                                                        <a href="javascript:void(0);" class="mark-as-read"
                                                            data-id="{{ $notification->id }}">
                                                            {{-- <img src="{{ asset('backend') . '/' . ($notification->data['patient_image'] ?? 'blog_attachments/no_image.png') }}"
                                                                alt="Patient Image" class="avatar-img rounded-circle"
                                                                style="width: 50px;"> --}}
                                                            {{ $notification->data['message'] ?? 'No message available' }}
                                                        </a>


                                                    </h6>
                                                    <small
                                                        class="d-block">{{ $notification->created_at->diffForHumans() }}</small>
                                                </div>
                                            </div>
                                        </li>
                                    @empty
                                        <li>No notifications yet!</li>
                                    @endforelse
                                @else
                                    <li>No notifications available!</li>
                                @endif
                            </ul>



                        </div>
                    </div>
                </li>


                <li class="nav-item dropdown main-drop">
                    <a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
                        <span class="user-img">
                            <img
                                src="{{ asset('backend') }}/{{ auth()->user()->profile->profile_image ?? 'blog_attachments/no_image.png' }}">
                            <span class="status online"></span>
                        </span>
                    </a>
                    <div class="dropdown-menu">
                        <div class="user-header">
                            <div class="avatar avatar-sm">
                                <img src="{{ asset('backend') }}/{{ auth()->user()->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                    alt="User Image" class="avatar-img rounded-circle" style="width: 50px;">
                            </div>
                            <div class="user-text">
                                <h6>{{ auth()->user()->name }}</h6>
                                <p class="text-muted mb-0">{{ auth()->user()->role }}</p>
                            </div>
                        </div>
                        @if (auth()->user()->role === 'Patient')
                            <a class="dropdown-item" href="{{ route('patient_view', auth()->user()->id) }}"><i
                                    class="feather-user me-1"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('patient_edit', auth()->user()->id) }}"><i
                                    class="feather-edit me-1"></i> Edit
                                Profile</a>
                        @endif
                        @if (auth()->user()->role === 'Admin')
                            <a class="dropdown-item" href="{{ route('admin_view', auth()->user()->id) }}"><i
                                    class="feather-user me-1"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('admin_edit', auth()->user()->id) }}"><i
                                    class="feather-edit me-1"></i> Edit
                                Profile</a>
                        @endif
                        @if (auth()->user()->role === 'Doctor')
                            <a class="dropdown-item" href="{{ route('doctor_view', auth()->user()->id) }}"><i
                                    class="feather-user me-1"></i> My Profile</a>
                            <a class="dropdown-item" href="{{ route('doctor_edit', auth()->user()->id) }}"><i
                                    class="feather-edit me-1"></i> Edit
                                Profile</a>
                        @endif
                        <a class="dropdown-item" href="account-settings.html"><i class="feather-sliders me-1"></i>
                            Account Settings</a>
                        <hr class="my-0 ms-2 me-2">
                        <form action="{{ route('logout') }}" method="POST">
                            @csrf
                            <button class="dropdown-item"><i class="feather-log-out me-1"></i> Logout</button>
                        </form>

                    </div>
                </li>

            </ul>

        </div>


        {{-- <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul class="active">
                        <li class="menu-title"><span>Main</span></li>
                        <li>
                            <a href="{{ route('backend_dashboard') }}"><i class="feather-grid"></i>
                                <span>Dashboard</span></a>
                        </li>
                        <li>
                            <a href="{{ route('speciality') }}"><i class="feather-package"></i>
                                <span>Specialities</span></a>
                        </li>
                        <li>
                            <a href="{{ route('doctor') }}"><i class="feather-user-plus"></i>
                                <span>Doctors</span></a>
                        </li>
                        <li>
                            <a href="{{ route('patient') }}"><i class="feather-users"></i>
                                <span>Patients</span></a>
                        </li>
                        <li>
                            <a href="upcoming-appointments.html"><i class="feather-calendar"></i>
                                <span>Appointments</span></a>
                        </li>


                        <li>
                            <a href="ratings.html"><i class="feather-star"></i> <span>Reviews</span></a>
                        </li>
                        <li>
                            <a href="transaction.html"><i class="feather-credit-card"></i>
                                <span>Transactions</span></a>
                        </li>

                        <li class="menu-title">
                            <span>Blog</span>
                        </li>
                       
                        <li><a href="{{route('category')}}"><i class="feather-shopping-cart"></i> <span>Categories</span></a></li>
                           
                        <li class="submenu">
                            <a href="#"><i class="feather-grid"></i> <span> Blog</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="active-blog.html">Blogs</a></li>
                                <li><a href="blog-details.html">Blog Details</a></li>
                                <li><a href="add-blog.html">Add Blog</a></li>
                                <li><a href="edit-blog.html">Edit Blog</a></li>
                            </ul>
                        </li>

                    </ul>
                </div>
            </div>
        </div> --}}
        <div class="sidebar" id="sidebar">
            <div class="sidebar-inner slimscroll">
                <div id="sidebar-menu" class="sidebar-menu">
                    <ul class="active">
                        <li class="menu-title"><span>Main</span></li>
                        <li class="{{ request()->routeIs('backend_dashboard') ? 'active' : '' }}">
                            <a href="{{ route('backend_dashboard') }}"><i class="feather-grid"></i>
                                <span>Dashboard</span></a>
                        </li>
                        @if (auth()->user()->role === 'Admin')
                            <li class="{{ request()->routeIs('speciality') ? 'active' : '' }}">
                                <a href="{{ route('speciality') }}"><i class="feather-package"></i>
                                    <span>Specialities</span></a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'Admin')
                            <li class="{{ request()->routeIs('doctor') ? 'active' : '' }}">
                                <a href="{{ route('doctor') }}"><i class="feather-user-plus"></i>
                                    <span>Doctors</span></a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'Patient')
                            <li class="{{ request()->routeIs('patient_doctor') ? 'active' : '' }}">
                                <a href="{{ route('patient_doctor') }}"><i class="feather-user-plus"></i>
                                    <span>Doctors</span></a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'Admin')
                            <li class="{{ request()->routeIs('patient') ? 'active' : '' }}">
                                <a href="{{ route('patient') }}"><i class="feather-users"></i>
                                    <span>Patients</span></a>
                            </li>
                        @endif
                        @if (auth()->user()->role === 'Doctor')
                            <li class="{{ request()->routeIs('doctor_patient') ? 'active' : '' }}">
                                <a href="{{ route('doctor_patient') }}"><i class="feather-users"></i>
                                    <span>Patients</span></a>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('appointment') ? 'active' : '' }}">
                            <a href="{{ route('appointment') }}"><i class="feather-calendar"></i>
                                <span>Appointments</span></a>
                        </li>
                        <li class="{{ request()->routeIs('rating') ? 'active' : '' }}">
                            <a href="{{ route('rating') }}"><i class="feather-star"></i> <span>Reviews</span></a>
                        </li>

                        {{-- @if (auth()->user()->role === 'Patient')
                            <li><a href="{{ route('blog_list') }}"
                                    class="{{ request()->routeIs('blog_list') ? 'active' : '' }}"><i
                                        class="feather-grid"></i><span>Blogs</span></a>
                            </li>
                        @endif --}}
                        @if (auth()->user()->role === 'Admin' || auth()->user()->role === 'Doctor')
                            <li class="menu-title">
                                <span>Blog</span>
                            </li>

                            <li class="{{ request()->routeIs('category') ? 'active' : '' }}">
                                <a href="{{ route('category') }}"><i class="feather-shopping-cart"></i>
                                    <span>Categories</span></a>
                            </li>

                            <li
                                class="submenu {{ request()->routeIs('active-blog', 'blog-details', 'add-blog', 'edit-blog') ? 'active' : '' }}">
                                <a href="#"><i class="feather-grid"></i> <span> Blog</span> <span
                                        class="menu-arrow"></span></a>
                                <ul>
                                    <li><a href="{{ route('blog_list') }}"
                                            class="{{ request()->routeIs('blog_list') ? 'active' : '' }}">Blogs</a>
                                    </li>
                                    {{-- <li><a href="{{ route('blog_details') }}"
                                            class="{{ request()->routeIs('blog_details') ? 'active' : '' }}">Blog
                                            Details</a></li> --}}
                                    <li><a href="{{ route('blog_add') }}"
                                            class="{{ request()->routeIs('blog_add') ? 'active' : '' }}">Add Blog</a>
                                    </li>
                                    {{-- <li><a href="{{ route('blog_edit') }}"
                                            class="{{ request()->routeIs('blog_edit') ? 'active' : '' }}">Edit
                                            Blog</a>
                                    </li> --}}
                                </ul>
                            </li>
                        @endif
                        <li class="{{ request()->routeIs('website_index') ? 'active' : '' }}">
                            <a href="{{ route('website_index') }}"><i class="feather-credit-card"></i>
                                <span>website</span></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="page-wrapper">


            @yield('content')



        </div>
    </div>




</body>

<!-- Mirrored from doccure-html.dreamguystech.com/template/admin/blank-page.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 02 Dec 2022 22:22:31 GMT -->

</html>

<script src="{{ asset('backend/js/jquery-3.6.0.min.js') }}"></script>
{{-- <script src="{{ asset('backend/js/form-validation.js') }}"></script> --}}
<script src="{{ asset('backend/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('backend/js/feather.min.js') }}"></script>
<script src="{{ asset('backend/plugins/select2/js/select2.min.js') }}"></script>
<script src="{{ asset('backend/plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/datatables/datatables.min.js') }}"></script>
<script src="{{ asset('backend/plugins/owl-carousel/owl.carousel.min.js') }}"></script>
<script src="{{ asset('backendassets/plugins/apexchart/apexcharts.min.js') }}"></script>
<script src="{{ asset('backendassets/plugins/apexchart/chart-data.js') }}"></script>
<script src="{{ asset('backend/js/moment.min.js') }}"></script>
<script src="{{ asset('backend/plugins/daterangepicker/daterangepicker.js') }}"></script>
<script src="{{ asset('backend/js/script.js') }}"></script>
@stack('js')

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
<script>
    function confirmDelete($id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Yes, delete it!',
            cancelButtonText: 'Cancel',
            customClass: {
                popup: 'custom-popup',
                title: 'custom-title',
                content: 'custom-content',
                confirmButton: 'custom-confirm-button',
                cancelButton: 'custom-cancel-button'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + $id).submit();
            }
        });
    }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle click on a notification
        document.querySelectorAll('.mark-as-read').forEach(function(element) {
            element.addEventListener('click', function(e) {
                e.preventDefault();
                let notificationId = e.target.dataset.id;

                // Send an Ajax request to mark the notification as read
                fetch(`/notifications/${notificationId}/read`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector(
                                'meta[name="csrf-token"]').content // CSRF token
                        },
                        body: JSON.stringify({
                            notification_id: notificationId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.status === 'success') {
                            // Change the UI to reflect that the notification has been read
                            e.target.closest('li').classList.remove('unread');
                            e.target.closest('li').classList.add('read');
                        }
                    })
                    .catch(error => {
                        console.error('Error marking notification as read:', error);
                    });
            });
        });
    });
</script>
