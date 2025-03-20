@extends('website.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="col-md-12 col-lg-4 col-xl-3 theiaStickySidebar">
        <div class="card search-filter">
            <div class="card-header">
                <h4 class="card-title mb-0">Search Filter</h4>
                @if (request()->has('search_date') || request()->has('select_specialist'))
                    <a href="{{ route('doctorlist') }}" class="btn btn-secondary"><i class="fas fa-sync-alt"></i>
                        Reload</a>
                @endif

            </div>
            <div class="card-body">
                <form action="{{ route('search.results') }}" method="GET" id="search-form">

                    <div class="filter-widget">
                        <div class="cal-icon">
                            <input type="text" name="search_date" id="search_date" class="form-control datetimepicker"
                                placeholder="Select Date" />
                        </div>
                    </div>

                    <div class="filter-widget">
                        <h4>Select Specialist</h4>
                        @foreach ($specialities as $speciality)
                            <div>
                                <label class="custom_check">
                                    <input type="checkbox" name="select_specialist[]" value="{{ $speciality->id }}" />
                                    <span class="checkmark"></span> {{ $speciality->name ?? 'N/A' }}
                                </label>
                            </div>
                        @endforeach
                    </div>
                    <div class="btn-search">
                        <button type="submit" class="btn w-100">Search</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-lg-8 col-xl-9" id="doctor-list">
        @foreach ($doctors as $doctor)
            <div class="card doctor-item">
                <div class="card-body">
                    <div class="doctor-widget">
                        <div class="doc-info-left">
                            <div class="doctor-img">
                                <a href="{{ route('doctor_profile', $doctor->id) }}">
                                    <img src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'no_image.png' }}"
                                        class="img-fluid" alt="User Image" />
                                </a>
                            </div>
                            <div class="doc-info-cont">
                                <h4 class="doc-name">
                                    <a href="{{ route('doctor_profile', $doctor->id) }}">Dr.
                                        {{ $doctor->name ?? 'N/A' }}</a>
                                </h4>
                                <p class="doc-speciality">
                                    {{-- MDS - Periodontology and Oral Implantology, BDS --}}
                                </p>
                                <h5 class="doc-department">
                                    <img src="{{ asset('backend') }}/{{ $doctor->profile->Speciality->file ?? 'no_image.png' }}"
                                        class="img-fluid"
                                        alt="Speciality" />{{ $doctor->profile->Speciality->name ?? 'N/A' }}
                                </h5>
                                <div class="rating">
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star filled"></i>
                                    <i class="fas fa-star"></i>
                                    <span
                                        class="d-inline-block average-rating">({{ $doctor->reviewdoctor->count() }})</span>
                                </div>
                                <div class="clinic-details">
                                    <p class="doc-location">
                                        <i class="fas fa-map-marker-alt"></i> {{ $doctor->profile->address ?? 'N/A' }}
                                    </p>
                                    <ul class="clinic-gallery">
                                        @foreach ($doctor->doctorfiles as $doctorfile)
                                            <li>
                                                <a href="" data-fancybox="gallery">
                                                    <img src="{{ asset('backend') }}/{{ $doctorfile->file ?? 'no_image.png' }}"
                                                        alt="Feature">
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
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

        @if ($doctors->hasMorePages())
            <!-- The Load More button -->
            <div class="load-more text-center">
                <button class="btn btn-primary btn-sm" id="load-more-btn"
                    data-next-url="{{ $doctors->nextPageUrl() }}">Load More</button>
            </div>
        @endif
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#load-more-btn').on('click', function() {
                var nextUrl = $(this).data('next-url');

                $.ajax({
                    url: nextUrl,
                    type: 'GET',
                    beforeSend: function() {
                        $('#load-more-btn').prop('disabled', true).text('Loading...');
                    },
                    success: function(response) {
                        $('#doctor-list').append(response.doctors);

                        if (response.has_more) {
                            $('#load-more-btn').data('next-url', response.next_url).prop(
                                'disabled', false).text('Load More');
                        } else {
                            $('#load-more-btn')
                                .hide(); // Hide the button if there are no more doctors
                        }
                    },
                    error: function() {
                        alert('Error loading more doctors.');
                        $('#load-more-btn').prop('disabled', false).text('Load More');
                    }
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('.datetimepicker').datetimepicker({
                format: 'YYYY-MM-DD HH:mm:ss', // Set the desired format
                showClear: true, // Optionally allow clearing the date
                useCurrent: false // Disable setting current date by default
            });
        });
    </script>
@endpush
