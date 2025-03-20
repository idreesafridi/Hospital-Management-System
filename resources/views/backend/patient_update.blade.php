@extends('backend.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="content container-fluid content-wrap">
        <form action="{{ route('patient_update', $patient->id) }}" id="patientform" method="POST"
            enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="setting-info profile-info">
                        <h4>Personal Information</h4>
                        <label class="avatar profile-cover-avatar" for="avatar_upload">
                            <img class="avatar-img"
                                src="{{ asset('backend') }}/{{ $patient->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                alt="Profile Image">
                            <input type="file" id="avatar_upload" name="file">
                            <span class="avatar-edit">
                                <i class="feather-edit"></i>
                            </span>
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="first_name" id="first_name" class="form-control floating"
                                        value="{{ $patient->first_name ?? 'N/A' }}">
                                    <label class="focus-label">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="last_name" id="last_name" class="form-control floating"
                                        value="{{ $patient->last_name ?? 'N/A' }}">
                                    <label class="focus-label">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="form-control floating"
                                        value="{{ $patient->profile->phone_number ?? 'N/A' }}">
                                    <label class="focus-label">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        class="form-control floating"
                                        value="{{ $patient->profile->date_of_birth ? \Carbon\Carbon::parse($patient->profile->date_of_birth)->format('Y-m-d') : '' }}"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <label class="focus-label">Date of Birth</label>
                                </div>

                            </div>

                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="address" id="address" class="form-control floating"
                                        value="{{ $patient->profile->address ?? 'N/A' }}">
                                    <label class="focus-label">Address</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="About me" name="about" id="about" rows="4">{{ $patient->profile->about }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-auto">
                <div class="col-md-12">
                    <div class="submit-sec">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('patient_view', $patient->id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#patientform').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    phone_number: {
                        required: true,
                        digits: true, // Ensure only digits are entered
                        minlength: 10, // Minimum length for phone number
                    },
                    date_of_birth: {
                        required: true,
                        date: true, // Ensure it's a valid date
                    },
                    address: {
                        required: true,
                    },
                    about: {
                        required: true,
                        minlength: 10, // Minimum length for the about section
                    },
                    file: {
                        required: false, // Change to true if you want to require file upload
                    },
                },
                messages: {
                    first_name: {
                        required: "Please enter your first name",
                    },
                    last_name: {
                        required: "Please enter your last name",
                    },
                    phone_number: {
                        required: "Please enter your phone number",
                        digits: "Please enter only digits",
                        minlength: "Phone number must be at least 10 digits",
                    },
                    date_of_birth: {
                        required: "Please enter your date of birth",
                        date: "Please enter a valid date",
                    },
                    address: {
                        required: "Please enter your address",
                    },
                    about: {
                        required: "Please tell us about yourself",
                        minlength: "About me must be at least 10 characters",
                    },
                    file: {
                        required: "Please upload a file", // Uncomment if you want to require file upload
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
