{{-- resources/views/website/doctor_items.blade.php --}}
@foreach ($doctors as $doctor)
    <div class="card doctor-item">
        <div class="card-body">
            <div class="doctor-widget">
                <div class="doc-info-left">
                    <div class="doctor-img">
                        <a href="{{ route('doctor_profile', $doctor->id) }}">
                            <img src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'no_image.png' }}"
                                class="img-fluid" alt="User  Image" />
                        </a>
                    </div>
                    <div class="doc-info-cont">
                        <h4 class="doc-name">
                            <a href="{{ route('doctor_profile', $doctor->id) }}">Dr. {{ $doctor->name ?? 'N/A' }}</a>
                        </h4>
                        <h5 class="doc-department">
                            <img src="{{ asset('backend') }}/{{ $doctor->profile->Speciality->file ?? 'no_image.png' }}"
                                class="img-fluid" alt="Speciality" />{{ $doctor->profile->Speciality->name ?? 'N/A' }}
                        </h5>
                        <div class="rating">
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star filled"></i>
                            <i class="fas fa-star"></i>
                            <span class="d-inline-block average-rating">(17)</span>
                        </div>
                        <div class="clinic-details">
                            <p class="doc-location">
                                <i class="fas fa-map-marker-alt"></i> {{ $doctor->profile->address ?? 'N/A' }}
                            </p>
                            <ul class="clinic-gallery">
                                @foreach ($doctor->doctorfiles as $doctorfile)
                                    <li>
                                        <a href="{{ asset('backend') }}/{{ $doctorfile->file ?? 'no_image.png' }}"
                                            data-fancybox="gallery">
                                            <img src="{{ asset('backend') }}/{{ $doctorfile->file ?? 'no_image.png' }}"
                                                alt="Feature">
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clinic-services">
                            <span>Dental Fillings</span>
                            <span> Whitening</span>
                        </div>
                    </div>
                </div>
                <div class="doc-info-right">
                    <div class="clini-infos">
                        <ul>
                            <li><i class="far fa-thumbs-up"></i> 98%</li>
                            <li><i class="far fa-comment"></i> 17 Feedback</li>
                            <li><i class="fas fa-map-marker-alt"></i> {{ $doctor->profile->address ?? 'N/A' }}</li>
                            <li>
                                <i class="far fa-money-bill-alt"></i> {{ $doctor->profile->fee ?? 'N/A' }}
                                <i class="fas fa-info-circle" data-bs-toggle="tooltip" title="Lorem Ipsum"></i>
                            </li>
                        </ul>
                    </div>
                    <div class="clinic-booking">
                        <a class="view-pro-btn" href="{{ route('doctor_profile', $doctor->id) }}">View Profile</a>
                        <a class="apt-btn" href="{{ route('doctor_booking', $doctor->id) }}">Book Appointment</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
