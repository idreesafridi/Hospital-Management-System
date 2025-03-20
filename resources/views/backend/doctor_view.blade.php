@extends('backend.layouts.master')

@push('js')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="row">
            <div class="col-md-8 col-lg-8 col-xl-6">
                <div class="profile-info">
                    <h4>My Profile</h4>
                    <div class="profile-list">
                        <div class="profile-detail">
                            <label class="avatar profile-cover-avatar">
                                <img class="avatar-img"
                                    src="{{ asset('backend') }}/{{ auth()->user()->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                    alt="Profile Image">
                            </label>
                            <div class="pro-name">
                                <p>{{ $doctor->email ?? 'N/A' }}</p>
                                <h4>{{ $doctor->name ?? 'N/A' }}</h4>
                            </div>
                            @if (auth()->user()->role === 'Doctor')
                                <a href="{{ route('doctor_edit', $doctor->id) }}" class="edit-pro"><i
                                        class="feather-edit"></i>
                                    Edit</a>

                                <a href="#">
                                    <form action="{{ route('doctor_destroy', $doctor->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $doctor->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm text-danger"
                                            onclick="confirmDelete({{ $doctor->id }})">
                                            <i class="feather-trash"></i> Delete
                                        </button>
                                    </form>
                                </a>
                            @endif
                        </div>
                        <div class="row">
                            <!-- Personal Information Section -->
                            <div class="col-md-12 mb-3">
                                <h6 class="pro-title">Personal Information</h6>
                                <h5>About</h5>
                                <p>{{ $doctor->profile->about ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h5>Email Address</h5>
                                <p>
                                    <a href="https://doccure-html.dreamguystech.com/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        data-cfemail="670d080f14080914060a12020b5557555427000a060e0b4904080a">
                                        {{ $doctor->email ?? 'N/A' }}
                                    </a>
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h5>Date of Birth</h5>
                                <p>
                                    {{ $doctor->profile->date_of_birth ? \Carbon\Carbon::parse($doctor->profile->date_of_birth)->format('Y-m-d') : 'N/A' }}
                                </p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h5>Phone Number</h5>
                                <p>{{ $doctor->profile->phone_number ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-6 mb-3">
                                <h5>Address</h5>
                                <p>{{ $doctor->profile->address ?? 'N/A' }}</p>
                            </div>

                            <!-- Education Section -->
                            <div class="col-md-12 mb-3">
                                <h6 class="pro-title">Education Detail</h6>
                            </div>

                            @foreach ($doctor->education as $educations)
                                <div class="col-md-6 mb-3">
                                    <h5>University Name</h5>
                                    <p>{{ $educations->university ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Degree</h5>
                                    <p>{{ $educations->degree ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>Start Date</h5>
                                    <p>{{ $educations->start_date ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <h5>End Date</h5>
                                    <p>{{ $educations->end_date ?? 'N/A' }}</p>
                                </div>
                            @endforeach

                            <!-- Work Experience Section -->
                            <div class="col-md-12 mb-3">
                                <h6 class="pro-title">Work Experience</h6>
                            </div>

                            @foreach ($doctor->work as $works)
                                <div class="col-md-4 mb-3">
                                    <h5>Hospital Name</h5>
                                    <p>{{ $works->hospital ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h5>Start Date</h5>
                                    <p>{{ $works->start_date ?? 'N/A' }}</p>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <h5>End Date</h5>
                                    <p>{{ $works->end_date ?? 'N/A' }}</p>
                                </div>
                            @endforeach

                            <!-- Fee & Shift Time Section -->
                            <div class="col-md-12 mb-3">
                                <h6 class="pro-title">Fee & Shift Time</h6>
                            </div>

                            <div class="col-md-4 mb-3">
                                <h5>Fees</h5>
                                <p>{{ $doctor->profile->fee ?? 'N/A' }}</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <h5>Start Time</h5>
                                <p>{{ $doctor->profile->start_time ?? 'N/A' }} AM</p>
                            </div>

                            <div class="col-md-4 mb-3">
                                <h5>End Time</h5>
                                <p>{{ $doctor->profile->end_time ?? 'N/A' }} PM</p>
                            </div>

                            <!-- Doctor Attachments Section -->
                            <div class="col-md-12 mb-3">
                                <h6 class="pro-title">Doctor Attachments</h6>
                            </div>

                            @foreach ($doctor->doctorfiles as $doctorfile)
                                <div class="col-md-3 mb-3">
                                    <ul class="social-icon">
                                        <li>
                                            <img class="avatar profile-cover-avatar rounded-circle"
                                                src="{{ asset('backend') }}/{{ $doctorfile->file ?? 'no_image.png' }}"
                                                alt="Profile Image">
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        </div>

                    </div>
                    <div class="profile-list">
                        <div class="row">

                            <div class="col-md-6">
                                <h5>Social Links</h5>
                                <ul class="social-icon">
                                    <li>
                                        <a href="#"><i class="feather-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="feather-facebook"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="feather-linkedin"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="feather-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="feather-youtube"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
