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
                                <p>@ Johnson223</p>
                                <h4>{{ $admin->name }}</h4>
                            </div>
                            <a href="{{ route('admin_edit', $admin->id) }}" class="edit-pro"><i class="feather-edit"></i>
                                Edit</a>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <h6 class="pro-title">Personal Information</h6>
                                <p>{{ $admin->profile->about }}</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Date of Birth</h5>
                                <p>{{ $admin->profile->date_of_birth ? \Carbon\Carbon::parse($admin->profile->date_of_birth)->format('Y-m-d') : '' }}
                                </p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Gender</h5>
                                <p>Male</p>
                            </div>
                            <div class="col-md-4 mb-3">
                                <h5>Age</h5>
                                <p>46</p>
                            </div>
                            <div class="col-md-12">
                                <h6 class="pro-title">Address & Location</h6>
                            </div>
                            <div class="col-md-4">
                                <h5>Address</h5>
                                <p>{{ $admin->profile->address }}</p>
                            </div>
                            <div class="col-md-4">
                                <h5>Country</h5>
                                <p>United States</p>
                            </div>
                            <div class="col-md-4">
                                <h5>State</h5>
                                <p>Florida</p>
                            </div>
                        </div>
                    </div>
                    <div class="profile-list">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="pro-title d-flex justify-content-between">
                                    <h6>Account Information</h6>
                                    <a href="{{ route('admin_edit', $admin->id) }}" class="edit-pro"><i
                                            class="feather-edit"></i> Edit</a>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>Email Address</h5>
                                <p><a href="https://doccure-html.dreamguystech.com/cdn-cgi/l/email-protection"
                                        class="__cf_email__"
                                        data-cfemail="670d080f14080914060a12020b5557555427000a060e0b4904080a">{{ $admin->email }}</a>
                                </p>
                            </div>
                            <div class="col-md-6 mb-3">
                                <h5>Phone Number</h5>
                                <p>{{ $admin->profile->phone_number }}</p>
                            </div>
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
