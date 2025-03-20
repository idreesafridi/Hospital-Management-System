@extends('backend.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Total Ratings <span class="ms-1">{{ $reviewCount->count() }}</span></div>
                    <div class="SortBy">
                        <div class="selectBoxes order-by">
                            <p class="mb-0"><img src="{{ asset('backend/img/icon/sort.png') }}" class="me-2"
                                    alt="icon"> Order by </p>
                            <span class="down-icon"><i class="feather-chevron-down"></i></span>
                        </div>
                        <div id="checkBox">
                            <form action="https://doccure-html.dreamguystech.com/template/admin/ratings.html">
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
                    <div class="card-header border-bottom-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Ratings</h5>
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
                                        <form action="https://doccure-html.dreamguystech.com/template/admin/ratings.html">
                                            <p class="lab-title">Ratings</p>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year" checked>
                                                <span class="checkmark"></span> 5
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year">
                                                <span class="checkmark"></span> 4
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year">
                                                <span class="checkmark"></span> 3
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year">
                                                <span class="checkmark"></span> 2
                                            </label>
                                            <label class="custom_check w-100">
                                                <input type="checkbox" name="year">
                                                <span class="checkmark"></span> 1
                                            </label>
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
                                        <th>Doctor</th>
                                        <th>title</th>
                                        <th>Description</th>
                                        <th>Status</th>
                                        <th>Date</th>
                                        <th class="desc-info">Ratings</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($reviews as $review)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="profile.html"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $review->patient->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="profile.html"><span
                                                            class="user-name">{{ $review->patient->name ?? 'N/A' }}</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a class="avatar-pos" href="profile.html"><img class="avatar avatar-img"
                                                            src="{{ asset('backend') }}/{{ $review->doctor->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="User Image"></a>
                                                    <a href="profile.html" class="user-name"><span class="text-muted">Dr.
                                                            Rayan</span> <span
                                                            class="tab-subtext">{{ $review->doctor->name ?? 'N/A' }}</span></a>
                                                </h2>
                                            </td>
                                            <td class="desc-info">{{ $review->title ?? 'N/A' }}</td>
                                            <td class="desc-info">{{ $review->review ?? 'N/A' }}</td>

                                            <td> <label class="toggle-switch" for="status{{ $review->id }}">
                                                    <input type="checkbox" class="toggle-switch-input"
                                                        id="status{{ $review->id }}" data-id="{{ $review->id }}"
                                                        @if ($review->status == 1) checked @endif>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </td>

                                            <td><span
                                                    class="d-block">{{ $review->created_at->format(env('GLOBALE_DATE_FORMAT_WITH_MONTH_NAME')) }}</span>
                                            </td>
                                            <td>
                                                <div class="ratings">
                                                    <i class="far fa-star filled"></i>
                                                    <i class="far fa-star filled"></i>
                                                    <i class="far fa-star filled"></i>
                                                    <i class="far fa-star filled"></i>
                                                    <i class="far fa-star"></i>
                                                </div>
                                            </td>

                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="#">
                                                        <form action="{{ route('review_destroy', $review->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="delete-form-{{ $review->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm text-danger"
                                                                onclick="confirmDelete({{ $review->id }})">
                                                                <i class="feather-trash-2 me-1"></i> Delete
                                                            </button>
                                                        </form>
                                                    </a>
                                                </div>
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
    <script>
        // Set up the CSRF token for all AJAX requests
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(document).ready(function() {
            $('.toggle-switch-input').change(function() {
                var status = $(this).prop('checked') ? 1 :
                    0;
                var recordId = $(this).data('id');
                $.ajax({
                    url: '{{ route('update.reviewstatus') }}',
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
                        // console.log('Response:', xhr.responseText); // Log the error response
                    }
                });
            });
        });
    </script>
@endpush
