@extends('backend.layouts.master')

@push('css')
    <link rel="stylesheet" href="{{ asset('backend/plugins/owl-carousel/owl.carousel.min.css') }}">
@endpush
@section('content')
    <div class="content container-fluid pb-0">
        <h4 class="mb-3">Overview</h4>
        <div class="row">
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-primary">
                                <i class="feather-user-plus"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Doctors</h5>
                                <div class="dash-counts">
                                    <p>{{ $doctors->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="trade-level mb-0"><span class="text-danger me-1"><i
                                    class="fas fa-caret-down me-1"></i>1.15%</span> last week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-blue">
                                <i class="feather-users"></i>
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Patients</h5>
                                <div class="dash-counts">
                                    <p>{{ $patients->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="trade-level mb-0"><span class="text-success me-1"><i
                                    class="fas fa-caret-up me-1"></i>4.5%</span> last week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-warning">
                                <img src="{{ asset('backend/img/icon/calendar.png') }}" alt="User Image">
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Appointment</h5>
                                <div class="dash-counts">
                                    <p>{{ $appointment->count() }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="trade-level mb-0"><span class="text-success me-1"><i
                                    class="fas fa-caret-up me-1"></i>9.65%</span> last week</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dash-widget-header">
                            <span class="dash-widget-icon bg-danger">
                                <img src="{{ asset('backend/img/icon/chart.png') }}" alt="User Image">
                            </span>
                            <div class="dash-count">
                                <h5 class="dash-title">Revenue</h5>
                                <div class="dash-counts">
                                    <p>{{ $totalAmount ?? 'N/A' }}</p>
                                </div>
                            </div>
                        </div>
                        <p class="trade-level mb-0"><span class="text-danger me-1"><i
                                    class="fas fa-caret-up me-1"></i>40.5%</span> last week</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">

            <div class="col-xl-7 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Appointments</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <select class="select">
                                    <option>2022</option>
                                    <option>2022</option>
                                </select>
                                <div class="ms-2">
                                    <select class="select">
                                        <option>Select Type</option>
                                        <option>Video</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="sales_chart"></div>
                    </div>
                </div>
            </div>


            <div class="col-xl-5 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Income Report</h5>
                            </div>
                            <div class="col-auto d-flex">
                                <select class="select">
                                    <option>Monthly</option>
                                    <option>Weekly</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="text-end w-100">
                            <div class="income-rev">Total Revenue : <span>{{ $totalamount ?? 'N/A' }}</span></div>
                        </div>
                        <div id="income-report"></div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="section-heading">
                    <h5 class="mb-0">Today’s Appointment <span class="num-circle">12</span></h5>
                </div>
            </div>
            <div class="col-md-6 text-end">
                <div class="owl-nav slide-nav-3 text-end nav-control"></div>
            </div>
            <div class="col-md-12">
                <hr class="mt-0">

            </div>
        </div>

        <div class="row">


            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Popular by Speciality </h5>
                            </div>
                            <div class="col-auto">
                                <select class="select">
                                    <option>This Week</option>
                                    <option>This Month</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table table-borderless">
                                <tbody>
                                    @foreach ($specialities as $specaility)
                                        <tr class="speciality-item">
                                            <td class="spl-name">
                                                <div class="spl-box">
                                                    <img src="{{ asset('backend') }}/{{ $specaility->file ?? 'blog_attachments/no_image.png' }}"
                                                        style="height: 40px" alt="User Image">
                                                </div>
                                                <div class="spl-count">
                                                    <h6>{{ $specaility->name }}</h6>
                                                    <p>Patients : 400</p>
                                                </div>
                                            </td>
                                            <td class="con-revenue">
                                                <p class="text-muted">Revenue</p>
                                                <h6>$6000K</h6>
                                            </td>

                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="row">
                    <div class="col-md-6 pe-md-0">
                        <div class="card cons-card mb-3">
                            <h6>Consultaion Today</h6>
                            <div id="income-month"></div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card pat-card mb-1">
                            <div class="card-body">
                                <p>New Patients</p>
                                <h3>45</h3>
                                <p class="trade-level mb-0"><span class="text-danger me-1"><i
                                            class="fas fa-caret-down me-1"></i>1.15%</span> last week</p>
                            </div>
                        </div>
                        <div class="card pat-card mb-3">
                            <div class="card-body">
                                <p>Old Patients</p>
                                <h3>45</h3>
                                <p class="trade-level mb-0"><span class="text-success me-1"><i
                                            class="fas fa-caret-up me-1"></i>9.5%</span> last week</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="card-title">Appointment Status</h5>
                                    </div>
                                    <div class="col-auto">
                                        <select class="select">
                                            <option>This Week</option>
                                            <option>This Month</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div id="status_chart"></div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="app-status">
                                            <p>Completed Appointment</p>
                                            <h6 class="text-primary">{{ $paidCount }}</h6>
                                            <p>Cancelled Appointment</p>
                                            <h6>{{ $rejectedCount }}</h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="col-lg-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Top Doctors</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table doc-table">
                                <tbody>
                                    @foreach ($doctors as $doctor)
                                        <tr>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos avatar-online" href="profile.html"><img
                                                            class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $doctor->profile->profile_image ?? 'no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="#" class="user-name"><span class="text-muted">Dr.
                                                            {{ $doctor->name ?? 'N\A' }}</span> <span
                                                            class="tab-subtext">{{ $doctor->profile->speciality->name ?? 'N\A' }}</span></a>
                                                </h2>
                                            </td>
                                            <td><span class="table-rating"><i class="fas fa-star me-2"></i> 4.5</span>
                                            </td>
                                            <td class="text-right"><span class="text-muted">200 Patients</span></td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">

            <div class="col-xl-4 col-md-6">
                <div class="card recent-card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col">
                                <h5 class="card-title">Recent Prescriptions</h5>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive recent-tab">
                            <table class="table table-borderless">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="pres-list">
                                                <div class="pres-head">
                                                    <h6>Abacavir</h6>
                                                    <p>#8995447</p>
                                                </div>
                                                <div class="pres-body">
                                                    <div>
                                                        <p>Prescribed By </p>
                                                        <h6>Dr. Cullin Drew</h6>
                                                    </div>
                                                    <div>
                                                        <p>Prescribed For</p>
                                                        <h6>Amanda</h6>
                                                    </div>
                                                    <div>
                                                        <p>Type </p>
                                                        <h6 class="text-muted">One time</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="pres-list">
                                                <div class="pres-head">
                                                    <h6>Calcium</h6>
                                                    <p>#8799488</p>
                                                </div>
                                                <div class="pres-body">
                                                    <div>
                                                        <p>Prescribed By </p>
                                                        <h6>Dr. Mark Briffa</h6>
                                                    </div>
                                                    <div>
                                                        <p>Prescribed For</p>
                                                        <h6>Theiry</h6>
                                                    </div>
                                                    <div>
                                                        <p>Type </p>
                                                        <h6 class="text-muted">One time</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="pres-list mb-0">
                                                <div class="pres-head">
                                                    <h6>Abacavir</h6>
                                                    <p>#8995447</p>
                                                </div>
                                                <div class="pres-body">
                                                    <div>
                                                        <p>Prescribed By </p>
                                                        <h6>Dr. Linda</h6>
                                                    </div>
                                                    <div>
                                                        <p>Prescribed For</p>
                                                        <h6>Hendry</h6>
                                                    </div>
                                                    <div>
                                                        <p>Type </p>
                                                        <h6 class="text-muted">One time</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                <tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4 col-md-6">
                <div class="card">
                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Top Countries</h5>
                            </div>
                            <div class="col-auto">
                                <select class="select">
                                    <option>Patients</option>
                                    <option>Doctors</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="country-item">
                            <div class="con-name">
                                <div class="flag-box">
                                    <img class="rounded-circle" src="assets/img/flags/flag-01.png" alt="User Image">
                                </div>
                                <div class="flag-name">
                                    <p class="user-name"><span>United States</span> <span class="d-block text-muted">800
                                            Patients</span></p>
                                </div>
                            </div>
                            <div class="con-revenue">
                                <p class="text-muted">Revenue</p>
                                <h6>$6000K</h6>
                            </div>
                        </div>
                        <div class="country-item">
                            <div class="con-name">
                                <div class="flag-box">
                                    <img class="rounded-circle" src="assets/img/flags/flag-02.png" alt="User Image">
                                </div>
                                <div class="flag-name">
                                    <p class="user-name"><span>United Kingdom</span> <span class="d-block text-muted">450
                                            Patients</span></p>
                                </div>
                            </div>
                            <div class="con-revenue">
                                <p class="text-muted">Revenue</p>
                                <h6>$4000K</h6>
                            </div>
                        </div>
                        <div class="country-item">
                            <div class="con-name">
                                <div class="flag-box">
                                    <img class="rounded-circle" src="assets/img/flags/flag-03.png" alt="User Image">
                                </div>
                                <div class="flag-name">
                                    <p class="user-name"><span>UAE</span> <span class="d-block text-muted">300
                                            Patients</span></p>
                                </div>
                            </div>
                            <div class="con-revenue">
                                <p class="text-muted">Revenue</p>
                                <h6>$3000K</h6>
                            </div>
                        </div>
                        <div class="country-item">
                            <div class="con-name">
                                <div class="flag-box">
                                    <img class="rounded-circle" src="assets/img/flags/flag-04.png" alt="User Image">
                                </div>
                                <div class="flag-name">
                                    <p class="user-name"><span>India</span> <span class="d-block text-muted">300
                                            Patients</span></p>
                                </div>
                            </div>
                            <div class="con-revenue">
                                <p class="text-muted">Revenue</p>
                                <h6>$3000K</h6>
                            </div>
                        </div>
                        <div class="country-item">
                            <div class="con-name">
                                <div class="flag-box">
                                    <img class="rounded-circle" src="assets/img/flags/flag-05.png" alt="User Image">
                                </div>
                                <div class="flag-name">
                                    <p class="user-name"><span>UAE</span> <span class="d-block text-muted">300
                                            Patients</span></p>
                                </div>
                            </div>
                            <div class="con-revenue">
                                <p class="text-muted">Revenue</p>
                                <h6>$3000K</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col-xl-4">
                <div class="row">
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="ratings.html">
                                <i class="feather-star"></i>
                                <h6>Doctor Ratings</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="transaction.html">
                                <i class="feather-credit-card"></i>
                                <h6>Transactions</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="settings.html">
                                <i class="feather-sliders"></i>
                                <h6>Settings</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="upcoming-appointments.html">
                                <i class="feather-calendar"></i>
                                <h6>Appointments</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="specialities.html">
                                <i class="feather-package"></i>
                                <h6>Specialities</h6>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 d-flex">
                        <div class="spl-items flex-fill">
                            <a href="patient-list.html">
                                <i class="feather-users"></i>
                                <h6>Patients</h6>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('js')
    <script src="{{ asset('backend/plugins/owl-carousel/owl.carousel.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/apexchart/apexcharts.min.js') }}"></script>

    <script src="{{ asset('backend/plugins/apexchart/chart-data.js') }}"></script>


    <script>
        if ($('#status_chart').length > 0) {
            var pieCtx = document.getElementById("status_chart"),
                pieConfig = {
                    colors: ['#0CE0FF', '#1B5A90'],
                    series: [{{ $paidCount }}, {{ $rejectedCount }}],
                    plotOptions: {
                        pie: {
                            donut: {
                                size: '60%',
                                labels: {
                                    show: true,
                                    total: {
                                        show: false,
                                    },
                                },
                            },
                        },
                    },
                    stroke: {
                        lineCap: "round",
                    },
                    chart: {
                        fontFamily: 'Poppins, sans-serif',
                        height: 194,
                        type: 'donut',
                    },
                    labels: ['Completed', 'Cancelled'],
                    legend: {
                        show: true,
                        position: 'bottom',
                        horizontalAlign: 'left',
                    },
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }]
                };
            var pieChart = new ApexCharts(pieCtx, pieConfig);
            pieChart.render();
        }
    </script>
    <script>
        if ($('#sales_chart').length > 0) {
            var columnCtx = document.getElementById("sales_chart"),
                columnConfig = {
                    colors: ['#0CE0FF', '#1B5A90', '#DFE5FC'],
                    series: [{
                        name: "Accepted",
                        type: "column",
                        data: {!! json_encode($acceptedCounts) !!} // Use the data from Laravel
                    }, {
                        name: "Rejected",
                        type: "column",
                        data: {!! json_encode($rejectedCounts) !!} // Use the data from Laravel
                    }, {
                        name: "Paid",
                        type: "column",
                        data: {!! json_encode($paidCounts) !!} // Use the data from Laravel
                    }],
                    chart: {
                        type: 'bar',
                        fontFamily: 'Poppins, sans-serif',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: '60%',
                        },
                    },
                    dataLabels: {
                        enabled: false
                    },
                    grid: {
                        show: false,
                    },
                    legend: {
                        position: 'top',
                        horizontalAlign: 'right',
                    },
                    stroke: {
                        show: true,
                        width: 2,
                        colors: ['transparent']
                    },
                    xaxis: {
                        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
                    },
                    yaxis: {
                        labels: {
                            formatter: function(val) {
                                return val + "k"
                            }
                        },
                        axisBorder: {
                            show: true,
                        },
                    },
                    fill: {
                        opacity: 1
                    },
                    tooltip: {
                        y: {
                            formatter: function(val) {
                                return val + "k"
                            }
                        }
                    }
                };
            var columnChart = new ApexCharts(columnCtx, columnConfig);
            columnChart.render();
        }
    </script>
@endpush
