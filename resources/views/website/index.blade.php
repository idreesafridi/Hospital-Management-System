@extends('website.layouts.master')
@push('css')
    <style>
        .gallery-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        #grid-container {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            /* Four columns */
            gap: 16px;
            /* Adjust the gap between items */
        }
    </style>
@endpush

@section('content')
    <section class="home-section-fifteen">
        <div class="container">
            <div class="row ">
                <div class="col-lg-6">
                    <div class="home-fifteen-banner aos" data-aos="fade-up">
                        <img src="{{ asset('website/img/home-15-banner-2.png') }}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <form id="doctorSearchForm" action="{{ route('search.doctor') }}" method="GET">
                        @csrf
                        <div class="title-block aos" data-aos="fade-up" data-aos-delay="100">
                            <h2>Search Doctor,</h2>
                            <h2>Make an Appointment</h2>
                            <p>Discover the best doctors, clinic & hospital the city nearest to you.</p>
                        </div>
                        <div class="locations-search aos" data-aos="fade-up" data-aos-delay="300">
                            <div class="row">
                                <div class="col-lg-4 col-md-4">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon2"><i
                                                class="feather-map-pin"></i></span>
                                        <input type="text" class="form-control placeholder-css"
                                            placeholder="Search location" aria-label="Recipient's username"
                                            aria-describedby="basic-addon2">
                                    </div>
                                    <p>Based on your Location</p>
                                </div>
                                <div class="col-lg-8 col-md-8">
                                    <div class="input-group mb-2">
                                        <span class="input-group-text" id="basic-addon3"><i
                                                class="feather-search"></i></span>
                                        <input type="text" name="doctor_name" class="form-control placeholder-css"
                                            placeholder="Search Doctors, Clinics, Hospitals, Diseases Etc"
                                            aria-label="Recipient's username" aria-describedby="basic-addon3">
                                    </div>
                                    <p>Ex : Dental or Sugar Check up etc</p>
                                </div>
                            </div>
                        </div>
                        <div class="make-appointment-btn aos" data-aos="fade-up" data-aos-delay="500">
                            <a href="javascript:void(0);" class="btn " id="makeAppointmentBtn">Make Appointment
                                <i class="feather-arrow-right ms-1"></i></a>
                        </div>
                    </form>
                </div>


            </div>
        </div>
    </section>


    <section class="home-fifteen-looking-section">
        <div class="container">
            <div class="row aos" data-aos="fade-up">
                <div class="col-lg-12">
                    <div class="home-fifteen-section-title text-center">
                        <h2>Clinic and <span>Specialities</span></h2>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="looking-for-container aos" data-aos="fade-up" data-aos-delay="200">
                        <div class="looking-for-box">
                            <div class="look-for-box-icon">
                                <img src="{{ asset('website/img/icons/set-bed.svg') }}" class="img-fluid" alt="">
                            </div>
                            <h5>Visit a Doctor</h5>
                            <p>We hire the best specialists to deliver top-notch diagnostic services for you.</p>
                            <a href="{{ route('doctorlist') }}">Book Now<i class="feather-arrow-right ms-1"></i></a>
                            <div class="looking-box-count">
                                <h2>01</h2>
                            </div>
                        </div>
                        <div class="background-hover-motion">
                            <img src="{{ asset('website/img/rotate-bg.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="looking-for-container aos" data-aos="fade-up" data-aos-delay="400">
                        <div class="looking-for-box">
                            <div class="look-for-box-icon">
                                <img src="{{ asset('website/img/icons/tablet-blue.svg') }}" class="img-fluid"
                                    alt="">
                            </div>
                            <h5>Find a Pharmacy</h5>
                            <p>We provide the a wide range of medical services, so every person could have the opportunity.
                            </p>
                            <a href="booking.html">Book Now<i class="feather-arrow-right ms-1"></i></a>
                            <div class="looking-box-count">
                                <h2>02</h2>
                            </div>
                        </div>
                        <div class="background-hover-motion">
                            <img src="{{ asset('website/img/rotate-bg.png') }}" alt="">
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="looking-for-container aos" data-aos="fade-up" data-aos-delay="600">
                        <div class="looking-for-box">
                            <div class="look-for-box-icon">
                                <img src="{{ asset('website/img/icons/test-tubes.svg') }}" class="img-fluid" alt="">
                            </div>
                            <h5>Find a Lab</h5>
                            <p>We use the first-class medical equipment for timely diagnostics of various diseases.</p>
                            <a href="booking.html">Book Now<i class="feather-arrow-right ms-1"></i></a>
                            <div class="looking-box-count">
                                <h2>03</h2>
                            </div>
                        </div>
                        <div class="background-hover-motion">
                            <img src="{{ asset('website/assets/img/rotate-bg.png') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="gallery-tab-section aos" data-aos="fade-up">
        <div class="water-mark-icons">
            <img src="{{ asset('website/img/poour-doctor-watermark-2.png') }}" alt="">
            <img src="{{ asset('website/img/our-doctor-watermark.png') }}" alt="">
            <img src="{{ asset('website/img/rotate-bg.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-fifteen-section-title text-center">
                        <h2>Clinic and <span>Specialities</span></h2>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="button-group filters-button-group">
                        <button class="button is-checked" data-filter="*">All</button>
                        @foreach ($specialities->where('parent_id', null) as $speciality)
                            <button class="button"
                                data-filter=".{{ strtolower($speciality->id) }}">{{ $speciality->name }}</button>
                        @endforeach
                    </div>
                </div>
                <div id="grid-container" class="transitions-enabled fluid masonry js-masonry grid"
                    style="position: relative; height: 557.969px;">
                    @foreach ($specialities->where('parent_id', null) as $speciality)
                        @foreach ($speciality->children as $child)
                            <article class="{{ strtolower($speciality->id) }} sea over-box">
                                <img src="{{ asset('backend/' . ($child->file ?? 'no_image.png')) }}"
                                    class="img-responsive gallery-img" />
                                <div class="gallery-after">
                                    <div class="gallery-after-content">
                                        <div class="gallery-hover-text">
                                            <h6>{{ $child->name ?? 'N/A' }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </article>
                        @endforeach
                    @endforeach
                </div>
            </div>
        </div>
    </section>


    <section class="home-fifteen-why-us">
        <div class="water-mark-icons">
            <img src="{{ asset('website/img/why-us-water-mark.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12 aos" data-aos="fade-up">
                            <div class="home-fifteen-section-title">
                                <h2>Why <span>Choose Us</span></h2>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="why-us-paragraph aos" data-aos="fade-up" data-aos-delay="200">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua. Quis ipsum ultrices gravida. Risus commodo viverra
                                    maecenas accumsan facilisis.</p>
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt
                                    ut labore et dolore magna aliqua.</p>
                            </div>
                            <div class="why-us-points aos" data-aos="fade-up" data-aos-delay="400">
                                <ul>
                                    <li>We provide high-quality services for the whole family.</li>
                                    <li>Risus commodo viverra maecenas</li>
                                    <li>Your health is our top priority</li>
                                    <li>Affordable medical, dental and women's health care.</li>
                                    <li>Quis ipsum suspendisse ultrices gravida.</li>
                                    <li>We provide high-quality services for the whole family.</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 aos" data-aos="fade-up" data-aos-delay="500">
                    <div class="why-us-container-img">
                        <img src="{{ asset('website/img/why-us-pics.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="home-fifteen-book-doctor">
        <div class="water-mark-icons">
            <img src="{{ asset('website/img/poour-doctor-watermark-2.png') }}" alt="">
            <img src="{{ asset('website/img/our-doctor-watermark.png') }}" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="home-fifteen-section-title text-center">
                        <h2>Book <span>Our Doctor</span></h2>
                        <p class="mb-0">It is a long established fact that a reader will be distracted by the readable
                            content of a page when looking at its layout.</p>
                    </div>
                </div>

                <div class="book-doctor-container">

                    <div class="row">
                        <div class="col-lg-12 aos" data-aos="fade-up">
                            <div class="doctor-sliders owl-carousel owl-theme">
                                @foreach ($doctors as $doctor)
                                    <div class="profile-widget">

                                        <div class="doc-img">
                                            <a href="doctor-profile.html">
                                                <img class="img-fluid gallery-img" alt="User Image"
                                                    src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'blog_attachments/no_image.png' }}">
                                            </a>
                                            <a href="javascript:void(0)" class="fav-btn"> <i class="far fa-bookmark"></i>
                                            </a>
                                        </div>
                                        <div class="pro-content">


                                            <h3 class="title">
                                                <a href="doctor-profile.html">{{ $doctor->name ?? 'N/A' }}</a>
                                                <i class="fas fa-check-circle verified"></i>
                                            </h3>
                                            <p class="speciality">{{ $doctor->profile->speciality->name ?? 'N/A' }}</p>
                                            <div class="rating"> <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">4.9 ( 82 )</span>
                                            </div>
                                            <ul class="available-info">
                                                <li> <i class="feather-map-pin"></i>
                                                    {{ $doctor->profile->address ?? 'N/A' }}</li>
                                                <li> <i class="feather-calendar"></i> Available on Fri, 22 Mar</li>
                                                <li> <i class="feather-dollar-sign"></i>
                                                    {{ $doctor->profile->fee ?? 'N/A' }} <i class="fas fa-info-circle"
                                                        data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                                                </li>
                                            </ul>
                                            <div class="row row-sm">
                                                <div class="col-6"> <a href="{{ route('doctor_profile', $doctor->id) }}"
                                                        class="btn view-btn">View Profile</a>
                                                </div>
                                                <div class="col-6"> <a href="{{ route('doctor_booking', $doctor->id) }}"
                                                        class="btn book-btn">Book
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                </div>
                @if (count($doctors) > 4)
                    <div class="col-lg-12">
                        <div class="home-fifteen-view-btn aos" data-aos="fade-up">
                            <a href="{{ route('doctorlist') }}">View More <i class="feather-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>


    <section class="home-fifteen-features">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 aos" data-aos="fade-up">
                    <div class="home-fifteen-section-title text-center">
                        <h2>Availabe Features in<span> Our Clinic</span></h2>
                        <p>It is a long established fact that a reader will be distracted by the readable content of a page
                            when looking at its layout.</p>
                    </div>
                </div>
                <div class="feature-container-box">
                    <div class="row">
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="300">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-01.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">Operation</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="500">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-02.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">Medical</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="700">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-03.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">Patient Ward</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="900">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-05.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">Test Room</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="1100">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-06.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">ICU</h4>
                                </div>
                            </a>
                        </div>
                        <div class="col-lg-2 col-md-4 col-sm-6 aos" data-aos="fade-up" data-aos-delay="1300">
                            <a href="#">
                                <div class="features-container">
                                    <div class="our-features-img">
                                        <img src="assets/img/services/features-04.svg" class="img-fluid" alt="">
                                    </div>
                                    <h4 class="mb-0">Laboratory</h4>
                                </div>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="home-fifteen-view-btn aos" data-aos="fade-up" data-aos-delay="1300">
                        <a href="#">View More <i class="feather-arrow-right ms-1"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="newsletter-container">
        <div class="container">
            <div class="newsletter-box">
                <div class="row">
                    <div class="col-lg-8 col-md-12">
                        <div class="newsletter-content-box">
                            <h3 class=" aos" data-aos="fade-up">Grab Our Newsletter</h3>
                            <p class=" aos" data-aos="fade-up" data-aos-delay="300">To receive latest offers and
                                discounts from the shop.</p>
                            <form action="{{ route('newsletter') }}" method="POST" id="newsletter">
                                @csrf
                                <div class="newsletter-input-section aos" data-aos="fade-up" data-aos-delay="500">
                                    <input type="email" name="email" placeholder="Enter Your Email Address"> &nbsp;
                                    <button type="submit" class="btn btn-info btn-lg">Subscribe</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="newsletter-container-img text-end aos" data-aos="fade-up">
                            <img src="assets/img/newsletter-bg.png" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <section class="home-fifteen-blog-section">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 aos" data-aos="fade-up">
                    <div class="home-fifteen-section-title text-center">
                        <h2>Our <span>Blogs</span></h2>
                        <p class="mb-0">It is a long established fact that a reader will be distracted by the readable
                            content of a page when looking at its layout.</p>
                    </div>
                </div>
                <div class="blog-container-box">
                    <div class="row justify-content-center">
                        @foreach ($blogs as $blog)
                            <div class="col-lg-4 col-md-6 aos" data-aos="fade-up" data-aos-delay="200">
                                <div class="blog-inner-box">
                                    <a href="{{ route('blogdetail', $blog->id) }}">
                                        <div class="blog-img-box">
                                            <img src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                                class="img-fluid" alt="">
                                        </div>
                                    </a>
                                    <div class="blog-inner-content">
                                        <a
                                            href="{{ route('blogdetail', $blog->id) }}">{{ Str::limit($blog->title, 25, '...') }}</a>
                                        <div class="blog-profile-box d-flex align-items-center">
                                            <a href="{{ route('blogdetail', $blog->doctorblogs->id) }}">
                                                <div class="blog-avatar"><img
                                                        src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                        class="img-fluid rounded-circle " alt=""></div>
                                            </a>
                                            <a href="{{ route('blogdetail', $blog->doctorblogs->id) }}"
                                                class="mb-0 ms-3">Dr.
                                                {{ $blog->doctorblogs->name ?? 'N/A' }}</a>
                                        </div>
                                        <p class="mb-0"><i class="feather-clock me-2"></i>
                                            {{ $blog->created_at->format(env('GLOBALE_DATE_FORMAT')) ?? 'N/A' }}</p>
                                    </div>
                                    <div class="blog-category-btn">
                                        <a href="blog-details.html">General</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @if ($blogs->hasMorePages())
                    <div class="col-lg-12">
                        <div class="home-fifteen-view-btn aos" data-aos="fade-up" data-aos-delay="800">
                            <a href="{{ route('bloglist') }}">View More <i class="feather-arrow-right ms-1"></i></a>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </section>
@endsection
@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#newsletter').validate({
                rules: {
                    email: {
                        required: true,
                    },


                },
                messages: {
                    email: {
                        required: "Please enter a Email",
                    },

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $(".doctor-sliders").owlCarousel({
                loop: true,
                margin: 10,
                nav: true,
                responsive: {
                    0: {
                        items: 1
                    },
                    600: {
                        items: 2
                    },
                    1000: {
                        items: 3
                    }
                }
            });
        });
    </script>
@endpush
@push('js')
    <script>
        document.getElementById('makeAppointmentBtn').addEventListener('click', function() {
            document.getElementById('doctorSearchForm').submit();
        });
    </script>
@endpush
