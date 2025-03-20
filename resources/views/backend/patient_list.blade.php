@extends('backend.layouts.master')
@push('css')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Total Patients <span class="ms-1">{{ $patients->count() }}</span></div>
                    <div class="SortBy">
                        <div class="selectBoxes order-by">
                            <p class="mb-0"><img src="{{ asset('backend/img/icon/sort.png') }}" class="me-2"
                                    alt="icon"> Order
                                by
                            </p>
                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                        </div>
                        <div id="checkBox">
                            <form action="https://doccure-html.dreamguystech.com/template/admin/patient-list.html">
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
                                <h5 class="card-title">Patients</h5>
                            </div>
                            <div class="col-auto custom-list d-flex">
                                <div class="form-custom me-2">
                                    <div id="tableSearch" class="dataTables_wrapper"></div>
                                </div>
                                <div class="multipleSelection">
                                    <div class="selectBox">
                                        <p class="mb-0"><i class="feather-filter me-1"></i> Filter </p>
                                        <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBoxes">
                                        <form
                                            action="https://doccure-html.dreamguystech.com/template/admin/patient-list.html">
                                            <p class="lab-title">By Account status</p>
                                            <div class="selectBox-cont">
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="acc" checked>
                                                    <span class="checkmark"></span> Enabled
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="acc">
                                                    <span class="checkmark"></span> Disabled
                                                </label>
                                                <p class="lab-title">By Blood Type</p>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> AB+
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> O-
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> B-
                                                </label>
                                                <label class="custom_check w-100">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> A+
                                                </label>
                                                <label class="custom_check w-100 mb-4">
                                                    <input type="checkbox" name="year">
                                                    <span class="checkmark"></span> B+
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
                                        <th>Patient</th>
                                        <th>Last Visit</th>
                                        <th>Account Status</th>
                                        <th>Account Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($patients as $patient)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" data-bs-target="#patientlist"
                                                        data-bs-toggle="modal"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $patient->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="#" data-bs-target="#patientlist"
                                                        data-bs-toggle="modal"><span
                                                            class="user-name">{{ $patient->name ?? 'N/A' }}</span>
                                                        <span class="text-muted">Male, 40 Years Old</span></a>
                                                </h2>
                                            </td>
                                            <td><span
                                                    class="user-name">{{ $patient->created_at->format(env('GLOBALE_DATE_FORMAT')) ?? 'N/A' }}
                                                </span></td>

                                            <td>
                                                <label class="toggle-switch" for="status1">
                                                    <input type="checkbox" class="toggle-switch-input" id="status1">
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td>
                                                <a class="edit-pro" href="{{ route('patient_view', $patient->id) }}"><i
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
@endsection

@push('js')
@endpush
