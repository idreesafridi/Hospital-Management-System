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
                                class="btn btn-primary btn-add"><i class="feather-plus-square me-1"></i> Add New</a>
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
                                        <th>Total FEE</th>
                                        <th>Action</th>

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
                                                            src="{{ asset('backend') }}/{{ $doctor->doctor->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="#" data-bs-target="#doctorlist" data-bs-toggle="modal"
                                                        class="user-name">{{ $doctor->doctor->name ?? 'N/A' }}</a>
                                                </h2>
                                            </td>
                                            <td>{{ $doctor->doctor->profile->speciality->name ?? 'N/A' }}</td>
                                            <td><span
                                                    class="user-name">{{ $doctor->doctor->created_at->format(env('GLOBALE_DATE_FORMAT')) ?? 'N/A' }}
                                                </span>
                                            </td>
                                            <td>{{ $doctor->doctor->profile->fee ?? 'N/A' }}</td>

                                            <td>
                                                <a class="edit-pro"
                                                    href="{{ route('doctor_view', $doctor->doctor->id) }}"><i
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
