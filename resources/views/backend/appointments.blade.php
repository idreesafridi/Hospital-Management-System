@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-validation/1.19.5/jquery.validate.min.css">
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col">
                    <ul class="list-links">
                        <li class="active">
                            @if (auth()->user()->role === 'Patient')
                                <a href="#" data-bs-toggle="modal" data-bs-target="#addModal">Book Appointments
                                    <span></span></a>
                        </li>
                        {{-- <li>
                            <a href="past-appointments.html">Past Appointments <span>(98)</span></a>
                        </li> --}}
                        @endif
                    </ul>
                </div>
                <div class="col-auto">
                    <div class="bookingrange btn btn-white btn-sm">
                        <div class="cal-ico">
                            <i class="feather-calendar mr-1"></i>
                            <span>Select Date</span>
                        </div>
                        <div class="ico">
                            <i class="fas fa-chevron-left"></i>
                            <i class="fas fa-chevron-right"></i>
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
                                <h5 class="card-title">Appointments</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <form
                                    action="https://doccure-html.dreamguystech.com/template/admin/upcoming-appointments.html">
                                    <div class="multipleSelection">
                                        <div class="selectBox">
                                            <p class="mb-0">
                                                <i class="feather-filter me-1"></i> Filter
                                            </p>
                                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                        </div>
                                        <div id="checkBoxes">
                                            <div class="form-custom">
                                                <input type="text" class="form-control bg-grey"
                                                    placeholder="Search by Patient" />
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <div class="form-custom">
                                                <input type="text" class="form-control bg-grey"
                                                    placeholder="Search by Doctor" />
                                                <i class="fas fa-search"></i>
                                            </div>
                                            <p class="lab-title">Consultation Type</p>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year" />
                                                <span class="checkmark"></span> Video Call
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year" />
                                                <span class="checkmark"></span> Audio Call
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year" />
                                                <span class="checkmark"></span> Chat
                                            </label>
                                            <button type="submit" class="btn w-100 btn-primary">
                                                Apply
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="datatable table table-borderless hover-table" id="data-tables">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Patient</th>
                                        <th>Doctor</th>
                                        <th>Disease</th>
                                        <th>Appointment</th>
                                        <th>Date & Time</th>
                                        @if (auth()->user()->role === 'Patient')
                                            <th>Invoices</th>
                                        @endif
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.html"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $appointment->patient->profile->profile_image ?? 'No_image.png' }}"
                                                            alt="User Image" /></a>
                                                    <a href="profile.html"><span
                                                            class="user-name">{{ $appointment->patient->name ?? 'N/A' }}</span>
                                                        <span class="text-muted">Male, 40 Years Old</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos" href="profile.html"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $appointment->doctor->profile->profile_image ?? 'No_image.png' }}"
                                                            alt="User Image" /></a>
                                                    <a href="profile.html" class="user-name"><span class="text-muted">
                                                            {{ $appointment->doctor->name ?? 'N/A' }}</span>
                                                        <span class="tab-subtext">Gyanoclogist</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <span class="disease-name">{{ $appointment->disease ?? 'N/A' }}</span>
                                            </td>
                                            <td class="status">
                                                @if (auth()->user()->role === 'Doctor')
                                                    <a href="#" data-bs-toggle="modal" data-bs-target="#statusModal"
                                                        class="d-block text-primary mt-2"
                                                        data-appointment-id="{{ $appointment->id }}"
                                                        data-status="{{ $appointment->status ?? 'N/A' }}">
                                                        <span class="d-flex align-items-center">
                                                            {{ $appointment->status ?? 'N/A' }}
                                                        </span>
                                                    </a>
                                                @endif
                                                @if (auth()->user()->role === 'Patient' || auth()->user()->role === 'Admin')
                                                    @if ($appointment->status === 'Accept')
                                                        <a href="{{ route('checkout', ['amount' => $appointment->doctor->profile->fee ?? 0, 'appointment_id' => $appointment->id]) }}"
                                                            class=" d-block text-success mt-2">
                                                            <span class="d-flex align-items-center">Proceed to
                                                                Pay</span></a>
                                                    @else
                                                        <a class="d-block text-primary mt-2">
                                                            <span class="d-flex align-items-center">
                                                                {{ $appointment->status ?? 'N/A' }}
                                                            </span>
                                                        </a>
                                                    @endif
                                                @endif
                                            </td>
                                            <td>
                                                <span class="user-name">{{ $appointment->appointment_date ?? 'N/A' }}
                                                </span><span
                                                    class="d-block">{{ $appointment->appointment_time ?? 'N/A' }}</span>
                                            </td>
                                            @if (auth()->user()->role === 'Patient')
                                                <td>
                                                    {{-- @dd($appointment->invoice->invoice_url); --}}
                                                    @if ($appointment->status === 'Paid')
                                                        <a class="eye-pro"
                                                            href="{{ $appointment->invoice->invoice_url ?? 'N/A' }}"><i
                                                                class="feather-eye"></i>Invoice</a>
                                                    @endif
                                                </td>
                                            @endif
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
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- appointment model --}}

    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Booking Appointment</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('bookappointment_store') }}" id="AppointmentForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="text" hidden name="patient_id" value="{{ auth()->user()->id }}">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <label for="doctor" class="form-label">Doctor Name<span
                                        class="text-danger">*</span></label>
                                <select id="doctor_id" name="doctor_id" class="form-control floating" required>
                                    <option selected>Select Doctor</option>
                                    @foreach ($doctors as $doctor)
                                        @if ($doctor->status == 1)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <label class="focus-label">Disease<span class="text-danger">*</span></label>
                                <input type="text" name="disease" id="disease" class="form-control floating"
                                    required>

                            </div>
                            <div class="form-group form-focus">
                                <select name="Appointmenttime" id="Appointmenttime" class="form-control floating"
                                    required>
                                    <option value="" disabled selected>Select Time</option>
                                    <!-- Time options from 9:00 AM to 7:00 PM -->
                                    <option value="09:00">09:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="12:00">12:00 PM</option>
                                    <option value="01:00">01:00 PM</option>
                                    <option value="02:00">02:00 PM</option>

                                </select>
                                <label class="focus-label">Appointment Time<span class="text-danger">*</span></label>
                            </div>

                            <div class="form-group form-focus">
                                <input type="date" name="Appointmentdate" id="Appointmentdate"
                                    class="form-control floating" required>
                                <label class="focus-label">Appointment Date<span class="text-danger">*</span></label>
                            </div>
                            <input type="text" hidden name="status" value="Pending">
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary btn-save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    {{-- appointment status  --}}

    <div class="modal fade contentmodal" id="statusModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Update Appointment Status</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close">
                        <i class="feather-x-circle"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="" id="appointmentForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <label for="status" class="form-label">Status</label>
                                <select id="status" name="status" class="form-control floating" required>
                                    <option selected value="Accept">Accept</option>
                                    <option value="Reject">Reject</option>
                                </select>
                            </div>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary btn-save">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.21.0/jquery.validate.min.js"
        referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#AppointmentForm').validate({
                rules: {
                    doctor_id: {
                        required: true,
                    },
                    disease: {
                        required: true,
                    },
                    Appointmenttime: {
                        required: true,
                        time: true,
                    }
                    Appointmentdate: {
                        required: true,
                        date: true,
                    },
                },
                messages: {
                    doctor_id: {
                        required: "Please select a doctor",
                    },
                    disease: {
                        required: "Please enter your disease name",
                    },
                    Appointmenttime: {
                        required: "Please enter a time for the appointment",
                        // If you need to restrict to a specific time format (like HH:mm), you can use a regex here.
                    },
                    Appointmentdate: {
                        required: "Please enter the appointment date",
                        date: "Please enter a valid date",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

        });
    </script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {

            var statusModal = document.getElementById('statusModal');
            statusModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget;
                var appointmentId = button.getAttribute(
                    'data-appointment-id');
                var form = document.getElementById('appointmentForm');
                form.action = "{{ url('/appointments/status/') }}/" +
                    appointmentId;
            });
        });
    </script>

    <script>
        document.getElementById('Appointmentdate').setAttribute('min', new Date().toISOString().split('T')[0]);
    </script>
@endpush
