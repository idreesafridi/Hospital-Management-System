@extends('backend.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="content container-fluid">
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Specialities <span class="ms-1">{{ $specialities->count() }}</span></div>
                    <a href="#" data-bs-toggle="modal" data-bs-target="#addModal" class="btn btn-primary btn-add"><i
                            class="feather-plus-square me-1"></i> Add New</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header border-bottom-0">
                        <div class="row align-items-center">
                            <div class="col">
                                <h5 class="card-title">Specialities</h5>
                            </div>
                            <div class="col-auto d-flex flex-wrap">
                                <div class="form-custom me-2">
                                    <div id="tableSearch" class="dataTables_wrapper"></div>
                                </div>
                                <div class="SortBy">
                                    <div class="selectBoxes order-by">
                                        <p class="mb-0"><img src="{{ asset('backend/img/icon/sort.png') }}" class="me-2"
                                                alt="icon">
                                            Order by </p>
                                        <span class="down-icon"><i class="feather-chevron-down"></i></span>
                                    </div>
                                    <div id="checkBox">
                                        <form
                                            action="https://doccure-html.dreamguystech.com/template/admin/specialities.html">
                                            <p class="lab-title">Order By </p>
                                            <label class="custom_radio w-100">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> ID
                                            </label>
                                            <label class="custom_radio w-100 mb-4">
                                                <input type="radio" name="order">
                                                <span class="checkmark"></span> Date Modified
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
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="datatable table table-borderless hover-table" id="data-table">
                                <thead class="thead-light">
                                    <tr>
                                        <th>SID</th>
                                        <th>Speciality</th>
                                        <th>Status</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($specialities as $speciality)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="spl-img"><img
                                                            src="{{ asset('backend') }}/{{ $speciality->file ?? 'blog_attachments/no_image.png' }}"
                                                            class="img-fluid" alt="User Image"></a>
                                                    <a href="#"><span>{{ $speciality->name ?? 'N/A' }}</span></a>
                                                </h2>
                                            </td>
                                            <td>
                                                <label class="toggle-switch" for="status{{ $speciality->id }}">
                                                    <input type="checkbox" class="toggle-switch-input"
                                                        id="status{{ $speciality->id }}" data-id="{{ $speciality->id }}"
                                                        @if ($speciality->status == 1) checked @endif>
                                                    <span class="toggle-switch-label">
                                                        <span class="toggle-switch-indicator"></span>
                                                    </span>
                                                </label>
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit_speciality_modal"
                                                        class="edit_speciality_button text-black"
                                                        speciality_id="{{ $speciality->id }}"
                                                        speciality_name="{{ $speciality->name }}"
                                                        speciality_file="{{ $speciality->file }}"
                                                        speciality_status="{{ $speciality->status }}"><i
                                                            class="feather-edit-3 me-1"></i>Edit</a>



                                                    <a href="#">
                                                        <form action="{{ route('speciality_destroy', $speciality->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="delete-form-{{ $speciality->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm text-danger"
                                                                onclick="confirmDelete({{ $speciality->id }})">
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


    {{-- add new  --}}

    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add New Speciality</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('speciality_store') }}" id="Speciality-form" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <label for="parent_id" class="focus-label">Parent Speciality:</label>
                                <select class="form-control floating" name="parent_id" required>
                                    <option value="">Select Parent Speciality</option>
                                    @foreach ($specialities->where('parent_id', null) as $Speciality)
                                        <option value="{{ $Speciality->id }}">{{ $Speciality->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" name="name" class="form-control floating" required>
                                <label class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="change-photo-btn">
                                <div>
                                    <i class="feather-upload"></i>
                                    <p>Upload File</p>
                                </div>
                                <input type="file" class="upload" name="file" required />
                            </div>
                            <div class="form-group form-focus">
                                <label for="categoryStatus" class="form-label">Status</label>
                                <select name="status" class="form-control floating" required>
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
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


    {{-- edit  --}}

    <div class="modal fade contentmodal" id="edit_speciality_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Speciality</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('speciality_update') }}" id="editForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="speciality_id" id="edit_speciality_id">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" name="name" id="edit_speciality_name"
                                    class="form-control floating" required>
                                <label class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <label for="categoryStatus" class="form-label">Status</label>
                                <select id="edit_speciality_status" name="status" class="form-control floating"
                                    required>
                                    <option value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                    <p>Upload File</p>
                                </div>
                                <input type="file" name="file" class="upload" id="edit_speciality_file">
                            </div>
                            <p class="text-success">Successfully specialityimage.jpg uploaded <a href="#"
                                    class="text-danger"><i class="feather-x"></i></a></p>
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
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>

    <script>
        // Edit 
        $(document).on('click', '.edit_speciality_button', function() {
            var speciality_id = $(this).attr('speciality_id');
            var speciality_name = $(this).attr('speciality_name');
            var speciality_status = $(this).attr('speciality_status');
            var speciality_file = $(this).attr('speciality_file');
            $('#edit_speciality_id').val(speciality_id);
            $('#edit_speciality_name').val(speciality_name);
            $('#edit_speciality_status').val(speciality_status)
            $('#edit_speciality_file').val(speciality_file).change();

            $('#edit_speciality_modal').modal('show');
        });


        $(document).ready(function() {
            $('#Speciality-form').validate({
                rules: {
                    parent_id: {
                        required: true,
                    },
                    name: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    file: {
                        required: true,
                        extension: "jpg|jpeg|png|gif", // Validates image file types
                        filesize: 1048576, // Maximum file size in bytes (1 MB)
                    }
                },
                messages: {
                    parent_id: {
                        required: "Please Select Parent Speciality",
                    },
                    name: {
                        required: "Please Enter a Name",
                    },
                    status: {
                        required: "Please Select Status",
                    },
                    file: {
                        required: "Please upload a file",
                        extension: "Please upload an image (jpg, jpeg, png, gif)",
                        filesize: "File size should not exceed 1 MB"
                    }
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#editForm').validate({
                rules: {
                    edit_speciality_name: {
                        required: true,
                    },
                    edit_speciality_status: {
                        required: true,
                    },
                    edit_speciality_file: {
                        required: true,
                        // Uncomment below if you want to validate the file input
                        // minlength: 3,
                    },
                },
                messages: {
                    edit_speciality_name: {
                        required: "Please Enter a Name",
                    },
                    edit_speciality_status: {
                        required: "Please Select Status",
                    },
                    edit_speciality_file: {
                        required: "Please upload a file",
                    },
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
                var status = $(this).prop('checked') ? 1 :
                    0;
                var recordId = $(this).data('id');
                $.ajax({
                    url: '{{ route('update.specialitystatus') }}',
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
