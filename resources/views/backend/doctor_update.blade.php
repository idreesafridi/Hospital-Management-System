@extends('backend.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="content container-fluid content-wrap">
        <form action="{{ route('doctor_update', $doctor->id) }}" id="patientform" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-8">
                    <div class="setting-info profile-info">
                        <h4>Personal Information</h4>
                        <label class="avatar profile-cover-avatar" for="avatar_upload">
                            <img class="avatar-img"
                                src="{{ asset('backend') }}/{{ auth()->user()->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                alt="Profile Image">
                            <input type="file" id="avatar_upload" name="profile_image">
                            <span class="avatar-edit">
                                <i class="feather-edit"></i>
                            </span>
                        </label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="first_name" id="first_name" class="form-control floating"
                                        value="{{ $doctor->first_name ?? 'N/A' }}">
                                    <label class="focus-label">First Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="last_name" id="last_name" class="form-control floating"
                                        value="{{ $doctor->last_name ?? 'N/A' }}">
                                    <label class="focus-label">Last Name</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="phone_number" id="phone_number"
                                        class="form-control floating" value="{{ $doctor->profile->phone_number ?? 'N/A' }}">
                                    <label class="focus-label">Phone Number</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="date" name="date_of_birth" id="date_of_birth"
                                        class="form-control floating"
                                        value="{{ $doctor->profile->date_of_birth ? \Carbon\Carbon::parse($doctor->profile->date_of_birth)->format('Y-m-d') : '' }}"
                                        max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}">
                                    <label class="focus-label">Date of Birth</label>
                                </div>

                            </div>
                            <div class="col-md-6">
                                <div class="form-group form-focus">
                                    <input type="text" name="address" id="address" class="form-control floating"
                                        value="{{ $doctor->profile->address ?? 'N/A' }}">
                                    <label class="focus-label">Address</label>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <textarea class="form-control" placeholder="About me" name="about" id="about" rows="4">{{ $doctor->profile->about }}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="mt-0" />
                    <h5 class="mb-1">Education Detail</h5>
                    <p class="mb-3">
                    </p>
                    <div class="row">
                        @foreach ($doctor->education as $education)
                            <div class="education-fields">
                                <div class="row education-record">
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <!-- Hidden input for existing education ID -->
                                            <input type="hidden" name="education_id[]" value="{{ $education->id }}" />
                                            <input type="text" name="university[]" class="form-control floating"
                                                value="{{ $education->university ?? 'N/A' }}" />
                                            <label class="focus-label">University Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" name="degree[]" class="form-control floating"
                                                value="{{ $education->degree ?? 'N/A' }}" />
                                            <label class="focus-label">Degree</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="date" name="start_date[]" class="form-control floating"
                                                value="{{ $education->start_date ?? 'N/A' }}" />
                                            <label class="focus-label">Start Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="date" name="end_date[]" class="form-control floating"
                                                value="{{ $education->end_date ?? 'N/A' }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                            <label class="focus-label">End Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger remove-education">Remove
                                            Education</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="button" id="add-education" class="btn btn-primary">Add Education</button>

                    </div>
                    <br>
                    <hr class="mt-0" />
                    <h5 class="mb-1">Work Detail</h5>
                    <p class="mb-3"></p>
                    <div class="row">
                        @foreach ($doctor->work as $works)
                            <div class="work-fields">
                                <div class="row education-record">
                                    <input type="hidden" name="work_id[]" value="{{ $works->id }}" />
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="text" name="hospital[]" class="form-control floating"
                                                value="{{ $works->hospital ?? 'N/A' }}" />
                                            <label class="focus-label">Hospital Name</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="date" name="start_date[]" class="form-control floating"
                                                value="{{ $works->start_date ?? 'N/A' }}" />
                                            <label class="focus-label">Start Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group form-focus">
                                            <input type="date" name="end_date[]" class="form-control floating"
                                                value="{{ $works->end_date ?? 'N/A' }}"
                                                max="{{ \Carbon\Carbon::now()->format('Y-m-d') }}" />
                                            <label class="focus-label">End Date</label>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <button type="button" class="btn btn-danger remove-work">Remove
                                            Education</button>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <button type="button" id="add-work" class="btn btn-primary">Add Work</button>

                    </div>
                    <br>
                    <hr class="mt-0" />
                    <h5 class="mb-1">Shift Detail</h5>
                    <p class="mb-3">
                    </p>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="number" name="fee" class="form-control floating"
                                    value="{{ $doctor->profile->fee ?? 'N/A' }}" />
                                <label class="focus-label">Fee</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="time" name="start_time" class="form-control floating"
                                    value="{{ $doctor->profile->start_time ?? 'N/A' }}" />
                                <label class="focus-label">Start Time</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="time" name="end_time" class="form-control floating"
                                    value="{{ $doctor->profile->start_time ?? 'N/A' }}" />
                                <label class="focus-label">End Time</label>
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="mt-0" />
                <div class="form-group row">
                    <div class="col-md-11">
                        <label class="control-label">Attachment</label>
                        <div>
                            <input class="form-control" name="file[]" id="file" type="file" multiple>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <label class="control-label"><br></label>
                        <button type="button" class="btn btn-sm btn-info" id="add-file-button"
                            style="display: block;padding:5px">
                            <i class="fa fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="row mt-auto">
                <div class="col-md-12">
                    <div class="submit-sec">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                        <a href="{{ route('doctor_view', $doctor->id) }}" class="btn btn-secondary">Cancel</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
    {{-- add new education  --}}
    <script>
        var educationIndex =
            {{ count($doctor->education) }};
        $('#add-education').click(function() {
            var newEducationField = `
                <div class="education-fields">
                    <div class="row education-record">
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="hidden" name="education_id[]" value="" /> <!-- New education, no ID -->
                                <input type="text" name="university[]" class="form-control floating" />
                                <label class="focus-label">University Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="text" name="degree[]" class="form-control floating" />
                                <label class="focus-label">Degree</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="date" name="start_date[]" class="form-control floating" />
                                <label class="focus-label">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="date" name="end_date[]" class="form-control floating" />
                                <label class="focus-label">End Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger remove-education">Remove Education</button>
                        </div>
                    </div>
                </div>`;
            $(this).before(newEducationField);
            educationIndex++;
        });
        // Remove education field
        $(document).on('click', '.remove-education', function() {
            $(this).closest('.education-fields').remove();
        });
    </script>

    {{-- add new work  --}}
    <script>
        var educationIndex = {{ count($doctor->work) }};
        $('#add-work').click(function() {
            var newEducationField = `
                <div class="work-fields">
                    <div class="row education-record">
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="hidden" name="work_id[]" value="" /> <!-- New work experience, no ID -->
                                <input type="text" name="hospital[]" class="form-control floating" />
                                <label class="focus-label">Hospital Name</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="date" name="start_date[]" class="form-control floating" />
                                <label class="focus-label">Start Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group form-focus">
                                <input type="date" name="end_date[]" class="form-control floating" />
                                <label class="focus-label">End Date</label>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button type="button" class="btn btn-danger remove-work">Remove Education</button>
                        </div>
                    </div>
                </div>`;
            $(this).before(newEducationField);
            educationIndex++;
        });
        // Remove work field
        $(document).on('click', '.remove-work', function() {
            $(this).closest('.work-fields').remove();
        });
    </script>



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
                        // digits: true, // Ensure only digits are entered
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
