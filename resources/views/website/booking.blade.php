@extends('website.layouts.master')

@push('css')
    <style>
        a.timing.booked {
            background-color: hsl(0, 100%, 50%);
            color: white;
            pointer-events: none;
        }

        a.timing {
            display: block;
            padding: 10px;
            background-color: #3498db;
            color: white;
            text-align: center;
            border-radius: 5px;
            margin: 5px 0;
            text-decoration: none;
        }

        a.timing:hover {
            background-color: #2980b9;
        }

        a.timing.selected {
            background-color: #2ecc71;
            color: white;
        }
    </style>
@endpush

@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="booking-doc-info">
                                <a href="{{ route('doctor_profile', $doctor->id) }}" class="booking-doc-img">
                                    <img src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'no_image.png' }}"
                                        alt="User Image">
                                </a>
                                <div class="booking-info">
                                    <h4><a href="{{ route('doctor_profile', $doctor->id) }}">Dr.
                                            {{ $doctor->name ?? 'N/A' }}</a></h4>
                                    <div class="rating">
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star filled"></i>
                                        <i class="fas fa-star"></i>
                                        <span class="d-inline-block average-rating">35</span>
                                    </div>
                                    <p class="text-muted mb-0"><i class="fas fa-map-marker-alt"></i>
                                        {{ $doctor->profile->address ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-4 col-md-6">
                            <h4 class="mb-1">{{ now()->format('d F Y') }}</h4>
                            <p class="text-muted">{{ now()->format('l') }}</p>
                        </div>
                        <div class="col-12 col-sm-8 col-md-6 text-sm-end">
                            <div class="bookingrange btn btn-white btn-sm mb-3">
                                <i class="far fa-calendar-alt me-2"></i>
                                <span></span>
                                <i class="fas fa-chevron-down ms-2"></i>
                            </div>
                        </div>
                    </div>

                    <div class="card booking-schedule schedule-widget">
                        <div class="schedule-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="day-slot">
                                        <ul>
                                            <li class="left-arrow">
                                                <a href="#">
                                                    <i class="fa fa-chevron-left"></i>
                                                </a>
                                            </li>

                                            @foreach ($days as $day)
                                                <li>
                                                    <span>{{ \Carbon\Carbon::parse($day)->format('D') }}</span>
                                                    <span
                                                        class="slot-date">{{ now()->startOfWeek()->addDays(array_search($day, $days))->format('d M') }}
                                                        <small class="slot-year">{{ now()->year }}</small></span>
                                                </li>
                                            @endforeach

                                            <li class="right-arrow">
                                                <a href="#">
                                                    <i class="fa fa-chevron-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="schedule-cont">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- Inside your Blade view where time slots are displayed -->
                                    <div class="time-slot">
                                        <ul class="clearfix">
                                            @foreach ($days as $day)
                                                <li>
                                                    @foreach ($time_slots as $time)
                                                        @php
                                                            // Check if this time slot is booked
                                                            $appointment = collect($bookedAppointments)->firstWhere(
                                                                function ($appt) use ($day, $time) {
                                                                    return isset($appt['day'], $appt['time']) &&
                                                                        $appt['day'] == $day &&
                                                                        $appt['time'] == $time;
                                                                },
                                                            );

                                                            $isBooked = $appointment !== null;
                                                            $status = $isBooked
                                                                ? $appointment['status'] ?? 'available'
                                                                : 'available';
                                                            $appointmentId = $isBooked
                                                                ? $appointment['appointment_id'] ?? ''
                                                                : '';
                                                        @endphp

                                                        <a class="timing 
                                                        @if ($isBooked) booked @else available @endif 
                                                        @if ($status == 'Accept') bg-info text-white 
                                                        @elseif ($status == 'Reject') bg-danger text-white 
                                                        @elseif ($status == 'Pending') bg-primary text-white 
                                                        @elseif ($status == 'Paid') bg-success text-white 
                                                        @else @endif"
                                                            href="#" data-day="{{ $day }}"
                                                            data-time="{{ $time }}"
                                                            data-doctor-id="{{ $doctor->id }}"
                                                            data-appointment-id="{{ $appointmentId }}"
                                                            data-date="{{ now()->startOfWeek()->addDays(array_search($day, $days))->format('Y-m-d') }}"
                                                            onclick="checkAuth(event, '{{ $day }}', '{{ $time }}')">
                                                            <span>{{ $time ?? 'N/A' }}</span>

                                                            @if ($isBooked)
                                                                <span class="status">{{ ucfirst($status) }}</span>
                                                            @endif
                                                        </a>
                                                    @endforeach

                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- @php
                        // Get all accepted appointments
                        $acceptedAppointments = collect($bookedAppointments)->where('status', 'Accept');
                    @endphp

                    @if ($acceptedAppointments->isNotEmpty())
                        <div class="submit-section proceed-btn text-end">
                            @foreach ($acceptedAppointments as $acceptedAppointment)
                                @php
                                    $appointmentId = $acceptedAppointment['appointment_id'] ?? null; // Use 'appointment_id' instead of 'id'
                                @endphp

                                @if ($appointmentId)
                                    <a href="{{ route('checkout', ['amount' => $doctor->profile->fee ?? 0, 'appointment_id' => $appointmentId]) }}"
                                        class="btn btn-success submit-btn">Proceed to Pay</a>
                                @else
                                    <span class="text-danger">Appointment ID not found.</span>
                                @endif
                            @endforeach
                        </div>
                    @endif --}}


                </div>

            </div>
        </div>
    </div>
@endsection
@push('js')
    <script>
        function checkAuth(event, day, time) {
            var isAuthenticated =
                @json(auth()->check());
            if (!isAuthenticated) {
                event.preventDefault();
                window.location.href =
                    "{{ route('login') }}";
            }
        }
    </script>

    <script>
        $('.timing').on('click', function(e) {
            e.preventDefault();

            var $this = $(this);

            var doctorId = $this.data('doctor-id'); // Assuming you've added 'data-doctor-id' to the <a> tag
            var appointmentDate = $this.data('date'); // Assuming you've added 'data-date' to the <a> tag
            var appointmentTime = $this.data('time');

            console.log('Doctor ID:', doctorId);
            console.log('Appointment Date:', appointmentDate);
            console.log('Appointment Time:', appointmentTime);

            if (!doctorId || !appointmentDate || !appointmentTime) {
                alert("Missing data attributes!");
                return;
            }

            var confirmation = confirm('Are you sure you want to book this appointment?');

            if (!confirmation) {
                return;
            }

            $.ajax({
                url: '/book-appointment',
                method: 'POST',
                data: {
                    doctor_id: doctorId,
                    appointment_date: appointmentDate,
                    appointment_time: appointmentTime,
                    _token: $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    if (response.success) {
                        alert('Appointment booked successfully!');
                    } else {
                        alert(response.message);
                    }
                },
                error: function(xhr, status, error) {
                    console.log(xhr.responseText);
                    alert('There was an error booking your appointment.');
                }
            });
        });
    </script>
@endpush
