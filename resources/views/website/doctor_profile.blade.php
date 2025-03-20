@extends('website.layouts.master')
@push('css')
@endpush

@section('content')
    <div class="content">
        <div class="container">

            <div class="card">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <img src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'No_image.png' }}"
                                    class="img-fluid" alt="User Image">
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">Dr. {{ $doctor->name ?? 'N/A' }}</h4>
                                <p class="doc-speciality">{{ $doctor->profile->speciality->name ?? 'N/A' }}</p>
                                <p class="doc-department"><img src="assets/img/specialities/specialities-05.png"
                                        class="img-fluid" alt="Speciality">Dentist</p>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span class="d-inline-block average-rating">(35)</span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location"><i class="fas fa-map-marker-alt"></i>
                                        {{ $doctor->profile->address ?? 'N/A' }} - <a href="javascript:void(0);">Get
                                            Directions</a>
                                    </p>

                                    <ul class="clinic-gallery">
                                        @foreach ($doctor->doctorfiles as $doctorfile)
                                            <li>
                                                <a href="assets/img/features/feature-01.jpg" data-fancybox="gallery">
                                                    <img src="{{ asset('backend') }}/{{ $doctorfile->file ?? 'no_image.png' }}"
                                                        alt="Feature">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>

                                </div>
                                <div class="clinic-services">
                                    <span>Dental Fillings</span>
                                    <span>Teeth Whitneing</span>
                                </div>
                            </div>
                        </div>
                        <div class="doc-info-right">
                            <div class="clini-infos">
                                <ul>
                                    <li><i class="far fa-thumbs-up"></i> 99%</li>
                                    <li><i class="far fa-comment"></i> 35 Feedback</li>
                                    <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->profile->address ?? 'N/A' }} </li>
                                    <li><i class="far fa-money-bill-alt"></i> {{ $doctor->profile->fee ?? 'N/A' }} </li>
                                </ul>
                            </div>
                            <div class="doctor-action">
                                <a href="javascript:void(0)" class="btn btn-white fav-btn">
                                    <i class="far fa-bookmark"></i>
                                </a>
                                <a href="chat.html" class="btn btn-white msg-btn">
                                    <i class="far fa-comment-alt"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal"
                                    data-bs-target="#voice_call">
                                    <i class="fas fa-phone"></i>
                                </a>
                                <a href="javascript:void(0)" class="btn btn-white call-btn" data-bs-toggle="modal"
                                    data-bs-target="#video_call">
                                    <i class="fas fa-video"></i>
                                </a>
                            </div>
                            <div class="clinic-booking">
                                <a class="apt-btn" href="{{ route('doctor_booking', $doctor->id) }}">Book Appointment</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="card">
                <div class="card-body pt-0">

                    <nav class="user-tabs mb-4">
                        <ul class="nav nav-tabs nav-tabs-bottom nav-justified">
                            <li class="nav-item">
                                <a class="nav-link active" href="#doc_overview" data-bs-toggle="tab">Overview</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_locations" data-bs-toggle="tab">Locations</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_reviews" data-bs-toggle="tab">Reviews</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#doc_business_hours" data-bs-toggle="tab">Business Hours</a>
                            </li>
                        </ul>
                    </nav>


                    <div class="tab-content pt-0">

                        <div role="tabpanel" id="doc_overview" class="tab-pane fade show active">
                            <div class="row">
                                <div class="col-md-12 col-lg-9">

                                    <div class="widget about-widget">
                                        <h4 class="widget-title">About Me</h4>
                                        <p>{{ $doctor->profile->about ?? 'N/A' }}</p>
                                    </div>


                                    <div class="widget education-widget">
                                        <h4 class="widget-title">Education</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach ($doctor->education as $educations)
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">

                                                                <a href="#/"
                                                                    class="name">{{ $educations->university ?? 'N/A' }}</a>
                                                                <div>{{ $educations->degree ?? 'N/A' }}</div>
                                                                <span class="time">{{ $educations->start_date ?? 'N/A' }}
                                                                    -
                                                                    {{ $educations->end_date ?? 'N/A' }}</span>

                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="widget experience-widget">
                                        <h4 class="widget-title">Work & Experience</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                @foreach ($doctor->work as $works)
                                                    <li>
                                                        <div class="experience-user">
                                                            <div class="before-circle"></div>
                                                        </div>
                                                        <div class="experience-content">
                                                            <div class="timeline-content">
                                                                <a href="#/"
                                                                    class="name">{{ $works->hospital ?? 'N/A' }}</a>
                                                                <span class="time">{{ $works->start_date ?? 'N/A' }} -
                                                                    {{ $works->end_date ?? 'N/A' }}</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="widget awards-widget">
                                        <h4 class="widget-title">Awards</h4>
                                        <div class="experience-box">
                                            <ul class="experience-list">
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">July 2019</p>
                                                            <h4 class="exp-title">Humanitarian Award</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Proin a ipsum tellus. Interdum et malesuada fames ac ante
                                                                ipsum primis in faucibus.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">March 2011</p>
                                                            <h4 class="exp-title">Certificate for International Volunteer
                                                                Service</h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Proin a ipsum tellus. Interdum et malesuada fames ac ante
                                                                ipsum primis in faucibus.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="experience-user">
                                                        <div class="before-circle"></div>
                                                    </div>
                                                    <div class="experience-content">
                                                        <div class="timeline-content">
                                                            <p class="exp-year">May 2008</p>
                                                            <h4 class="exp-title">The Dental Professional of The Year Award
                                                            </h4>
                                                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit.
                                                                Proin a ipsum tellus. Interdum et malesuada fames ac ante
                                                                ipsum primis in faucibus.</p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>


                                    <div class="service-list">
                                        <h4>Services</h4>
                                        <ul class="clearfix">
                                            <li>Tooth cleaning </li>
                                            <li>Root Canal Therapy</li>
                                            <li>Implants</li>
                                            <li>Composite Bonding</li>
                                            <li>Fissure Sealants</li>
                                            <li>Surgical Extractions</li>
                                        </ul>
                                    </div>


                                    <div class="service-list">
                                        <h4>Specializations</h4>
                                        <ul class="clearfix">
                                            <li>Children Care</li>
                                            <li>Dental Care</li>
                                            <li>Oral and Maxillofacial Surgery </li>
                                            <li>Orthodontist</li>
                                            <li>Periodontist</li>
                                            <li>Prosthodontics</li>
                                        </ul>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <div role="tabpanel" id="doc_locations" class="tab-pane fade">

                            <div class="location-list">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="clinic-content">
                                            <h4 class="clinic-name"><a href="#">Smile Cute Dental Care Center</a>
                                            </h4>
                                            <p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <div class="clinic-details mb-0">
                                                <h5 class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> 2286
                                                    Sundown Lane, Austin, Texas 78749, USA <br><a
                                                        href="javascript:void(0);">Get Directions</a></h5>
                                                <ul>
                                                    <li>
                                                        <a href="assets/img/features/feature-01.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-01.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-02.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-02.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-03.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-03.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-04.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-04.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="clinic-timing">
                                            <div>
                                                <p class="timings-days">
                                                    <span> Mon - Sat </span>
                                                </p>
                                                <p class="timings-times">
                                                    <span>10:00 AM - 2:00 PM</span>
                                                    <span>4:00 PM - 9:00 PM</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="timings-days">
                                                    <span>Sun</span>
                                                </p>
                                                <p class="timings-times">
                                                    <span>10:00 AM - 2:00 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="consult-price">
                                            $250
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="location-list">
                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="clinic-content">
                                            <h4 class="clinic-name"><a href="#">The Family Dentistry Clinic</a></h4>
                                            <p class="doc-speciality">MDS - Periodontology and Oral Implantology, BDS</p>
                                            <div class="rating">
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star filled"></i>
                                                <i class="fas fa-star"></i>
                                                <span class="d-inline-block average-rating">(4)</span>
                                            </div>
                                            <div class="clinic-details mb-0">
                                                <p class="clinic-direction"> <i class="fas fa-map-marker-alt"></i> 2883
                                                    University Street, Seattle, Texas Washington, 98155 <br><a
                                                        href="javascript:void(0);">Get Directions</a></p>
                                                <ul>
                                                    <li>
                                                        <a href="assets/img/features/feature-01.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-01.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-02.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-02.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-03.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-03.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a href="assets/img/features/feature-04.jpg"
                                                            data-fancybox="gallery2">
                                                            <img src="assets/img/features/feature-04.jpg"
                                                                alt="Feature Image">
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="col-md-4">
                                        <div class="clinic-timing">
                                            <div>
                                                <p class="timings-days">
                                                    <span> Tue - Fri </span>
                                                </p>
                                                <p class="timings-times">
                                                    <span>11:00 AM - 1:00 PM</span>
                                                    <span>6:00 PM - 11:00 PM</span>
                                                </p>
                                            </div>
                                            <div>
                                                <p class="timings-days">
                                                    <span>Sat - Sun</span>
                                                </p>
                                                <p class="timings-times">
                                                    <span>8:00 AM - 10:00 AM</span>
                                                    <span>3:00 PM - 7:00 PM</span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-2">
                                        <div class="consult-price">
                                            $350
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>


                        <div role="tabpanel" id="doc_reviews" class="tab-pane fade">

                            <div class="widget review-listing">
                                <ul class="comments-list">
                                    @foreach ($reviews->where('status', 1) as $review)
                                        <li>
                                            <div class="comment">
                                                <img class="avatar avatar-sm rounded-circle" alt="User Image"
                                                    src="{{ asset('backend') }}/{{ $review->patient->profile->profile_image ?? 'No_image.png' }}">
                                                <div class="comment-body">
                                                    <div class="meta-data">
                                                        <span
                                                            class="comment-author">{{ $review->patient->name ?? 'N/A' }}</span>
                                                        <span class="comment-date">Reviewed 2 Days ago</span>
                                                        <div class="review-count rating">
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star filled"></i>
                                                            <i class="fas fa-star"></i>
                                                        </div>
                                                    </div>
                                                    <p class="recommended"><i class="far fa-thumbs-up"></i>
                                                        {{ $review->title ?? 'N/A' }}</p>
                                                    <p class="comment-content">
                                                        {{ $review->review ?? 'N/A' }}
                                                    </p>
                                                    <div class="comment-reply">
                                                        <a class="comment-btn" href="#">
                                                            <i class="fas fa-reply"></i> Reply
                                                        </a>
                                                        <p class="recommend-btn">
                                                            <span>Recommend?</span>
                                                            <a href="#" class="like-btn">
                                                                <i class="far fa-thumbs-up"></i> Yes
                                                            </a>
                                                            <a href="#" class="dislike-btn">
                                                                <i class="far fa-thumbs-down"></i> No
                                                            </a>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach

                                </ul>


                                <div class="all-feedback text-center">
                                    <div id="feedback-container">
                                        <!-- Feedback items will be displayed here dynamically -->
                                    </div>

                                    <a href="#" class="btn btn-primary btn-sm" id="show-all-feedback">
                                        Show all feedback <strong>(167)</strong>
                                    </a>

                                    <div id="pagination" class="pagination">
                                        <!-- Pagination controls will be added dynamically -->
                                    </div>
                                </div>



                            </div>


                            <div class="write-review">
                                <h4>Write a review for <strong>Dr. Darren Elder</strong></h4>

                                <form action="{{ route('rating_store') }}" method="POST" id="rating">
                                    @csrf
                                    <input type="text" hidden name="doctor_id" value="{{ $doctor->id }}">
                                    <div class="form-group">
                                        <label>Review</label>
                                        <div class="star-rating">
                                            <input id="star-5" type="radio" name="rating" value="star-5">
                                            <label for="star-5" title="5 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-4" type="radio" name="rating" value="star-4">
                                            <label for="star-4" title="4 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-3" type="radio" name="rating" value="star-3">
                                            <label for="star-3" title="3 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-2" type="radio" name="rating" value="star-2">
                                            <label for="star-2" title="2 stars">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                            <input id="star-1" type="radio" name="rating" value="star-1">
                                            <label for="star-1" title="1 star">
                                                <i class="active fa fa-star"></i>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label>Title of your review</label>
                                        <input class="form-control" type="text" name="title" id="title"
                                            placeholder="If you could say it in one sentence, what would you say?">
                                    </div>
                                    <div class="form-group">
                                        <label>Your review</label>
                                        <textarea id="review_desc" name="review" maxlength="100" class="form-control"></textarea>
                                        <div class="d-flex justify-content-between mt-3"><small class="text-muted"><span
                                                    id="chars">100</span> characters remaining</small></div>
                                    </div>
                                    <hr>
                                    <div class="form-group">
                                        <div class="terms-accept">
                                            <div class="custom-checkbox">
                                                <input type="checkbox" name="term" id="terms_accept">
                                                <label for="terms_accept">I have read and accept <a href="#">Terms
                                                        &amp; Conditions</a></label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="submit-section">
                                        <button type="submit" class="btn btn-primary submit-btn">Add Review</button>
                                    </div>
                                </form>

                            </div>

                        </div>


                        <div role="tabpanel" id="doc_business_hours" class="tab-pane fade">
                            <div class="row">
                                <div class="col-md-6 offset-md-3">

                                    <div class="widget business-widget">
                                        <div class="widget-content">


                                            <div class="listing-hours">
                                                <div class="listing-day current">
                                                    <div class="day">Today <span>{{ date('l, F j, Y') }}</span></div>
                                                    <div class="time-items">
                                                        <span class="open-status"><span
                                                                class="badge bg-success-light">Open Now</span></span>
                                                        <span class="time">{{ $doctor->profile->start_time }} AM -
                                                            {{ $doctor->profile->end_time }} PM</span>
                                                    </div>
                                                </div>
                                                <div class="schedule">
                                                    @foreach ($days as $day)
                                                        <div class="listing-day">
                                                            <div class="day">{{ $day }}</div>
                                                            <div class="time-items">
                                                                <span class="time">{{ $doctor->profile->start_time }} AM
                                                                    -
                                                                    {{ $doctor->profile->end_time }} PM</span>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
@push('js')
@endpush
