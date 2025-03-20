@extends('backend.layouts.master')
@push('css')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">

            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Doctors <span class="ms-1">{{ $doctors->count() }}</span></div>
                    @if (auth()->user()->role === 'Admin')
                        <div class="doc-badge me-3"> <a href="#" data-bs-toggle="modal" data-bs-target="#addModal"
                                class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add Doctor</a>
                        </div>
                    @endif
                    <div class="SortBy">
                        <div class="selectBoxes order-by">
                            <p class="mb-0"><img src="{{ asset('backend/img/icon/sort.png') }}" class="me-2"
                                    alt="icon"> Order
                                by
                            </p>
                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                        </div>
                        <div id="checkBox">
                            <form action="https://doccure-html.dreamguystech.com/template/admin/doctor-list.html">
                                <p class="lab-title">Specialities</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Number of Appointment
                                </label>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Total Income
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="year">
                                    <span class="checkmark"></span> Ratings
                                </label>
                                <p class="lab-title">Sort By</p>
                                <label class="custom_radio w-100">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Ascending
                                </label>
                                <label class="custom_radio w-100 mb-4">
                                    <input type="radio" name="sort">
                                    <span class="checkmark"></span> Descending
                                </label>
                                <button type="submit" class="btn w-100 btn-primary">Apply</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Doctors</h5>
                            </div>
                            <div class="col-auto d-flex flex-wrap">
                                <div class="form-custom me-2">
                                    <div id="tableSearch" class="dataTables_wrapper"></div>
                                </div>
                                <div class="multipleSelection">
                                    <div class="selectBox">
                                        <p class="mb-0 me-2"><i class="feather-filter me-1"></i> Filter By Speciality
                                        </p>
                                        <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form
                                            action="https://doccure-html.dreamguystech.com/template/admin/doctor-list.html">
                                            <p class="lab-title">Specialities</p>
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year" checked>
                                                    <span class="checkmark"></span> Urology
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Neurology
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Orthopedic
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Cardiologist
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Dentist
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Gynacologist
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Pediatrist
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> Orthopedic
                                                </label>
                                            </div>
                                            <button type="submit" class="btn w-100 btn-primary">Apply</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="datatable table table-borderless hover-table" id="data-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Doctor</th>
                                        <th>Specialities</th>
                                        <th>Member Since</th>
                                        <th>Number of Appointments</th>
                                        <th>Total FEE</th>
                                        @if (auth()->user()->role === 'Admin')
                                            <th>Account Status</th>
                                        @endif
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos" href="#" data-bs-target="#doctorlist"
                                                        data-bs-toggle="modal"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="#" data-bs-target="#doctorlist" data-bs-toggle="modal"
                                                        class="user-name">{{ $doctor->name ?? 'N/A' }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $doctor->profile->speciality->name ?? 'N/A' }}</td>
                                            <td><span
                                                    class="user-name">{{ $doctor->created_at->format(env('GLOBALE_DATE_FORMAT')) ?? 'N/A' }}
                                                </span></td>
                                            <td>{{ $appointmentsCount ?? 'N/A' }}</td>
                                            <td>{{ $doctor->profile->fee ?? 'N/A' }}</td>
                                            @if (auth()->user()->role === 'Admin')
                                                <td>
                                                    <label class="toggle-switch" for="status{{ $doctor->id }}">
                                                        <input type="checkbox" class="toggle-switch-input"
                                                            id="status{{ $doctor->id }}" data-id="{{ $doctor->id }}"
                                                            @if ($doctor->status == 1) checked @endif>
                                                        <span class="toggle-switch-label">
                                                            <span class="toggle-switch-indicator"></span>
                                                        </span>
                                                    </label>
                                                </td>
                                            @endif


                                            <td>
                                                <a class="edit-pro" href="{{ route('doctor_view', $doctor->id) }}"><i
                                                        class="feather-eye"></i> View</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div id="tablepagination" class="dataTables_wrapper"></div>
            </div>
        </div>

    </div>



    {{-- model create doctor  --}}
    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add New Doctor</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('doctor_store') }}" id="addForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="role" value="Doctor">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <label for="categoryStatus" class="form-label">Speciality</label>
                                <select id="speciality_id" name="speciality_id" class="form-control floating" required>
                                    <option selected>Select Speciality</option>
                                    @foreach ($specialities as $speciality)
                                        @if ($speciality->status == 1)
                                            <option value="{{ $speciality->id }}">{{ $speciality->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" name="first_name" id="first_name" class="form-control floating">
                                <label class="focus-label">First Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" name="last_name" id="last_name" class="form-control floating">
                                <label class="focus-label">Last Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="email" name="email" id="email" class="form-control floating">
                                <label class="focus-label">Email<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <input type="password" name="password" id="password" class="form-control floating"
                                    required>
                                <label class="focus-label">Password<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <label for="categoryStatus" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control floating" required>
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                    <p>Upload File</p>
                                </div>
                                <input type="file" name="file" class="upload" id="file">
                            </div>
                            <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#addForm').validate({
                rules: {
                    first_name: {
                        required: true,
                    },
                    last_name: {
                        required: true,
                    },
                    email: {
                        required: true,
                        minlength: 3,
                    },
                    password: {
                        required: true,
                        maxlenght: 8;
                    },
                    status: {
                        required: true,
                    }

                },
                messages: {
                    first_name: {
                        required: "Please enter a First Name",
                    },
                    last_name: {
                        required: "Please enter a Last Name",
                    },
                    email: {
                        required: "Please enter a email",
                        minlength: "Title must be at least @ characters",
                    },
                    password: {
                        required: "Please enter a Password",
                    },
                    status: {
                        required: "Please Select Status",
                    }
                    // file: {
                    //     required: "Please enter a Parent Name",
                    // },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
    <script>
        // Set up the CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.toggle-switch-input').change(function() {
                var status = $(this).prop('checked') ? 1 : 0;
                var recordId = $(this).data('id');

                // console.log('Changing status for doctor ID:', recordId, 'to', status);

                $.ajax({
                    url: '{{ route('update.status') }}',
                    type: 'PUT',
                    data: {
                        id: recordId,
                        status: status,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        // console.log('Status updated successfully:', response);
                    },
                    error: function(xhr, status, error) {
                        // console.log('Error:', error);
                        // console.log('Response:', xhr.responseText); 
                    }
                });
            });
        });
    </script>
@endpush
