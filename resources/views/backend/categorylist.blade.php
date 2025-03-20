@extends('backend.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="content container-fluid">

        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-md-12 d-flex justify-content-end">
                    <div class="doc-badge me-3">Specialities <span class="ms-1">{{ $categories->count() }}</span></div>
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
                                        <th>Category</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>#{{ $loop->iteration + 0 }}</td>
                                            <td>
                                                <h2 class="table-avatar">
                                                    <a href="#" class="spl-img"><img
                                                            src="{{ asset('backend') }}/{{ $category->file ?? 'blog_attachments/no_image.png' }}"
                                                            class="img-fluid" alt="User Image"></a>
                                                    <a href="#"><span>{{ $category->name ?? 'N/A' }}</span></a>
                                                </h2>
                                            </td>
                                            <td class="text-end">
                                                <div class="actions">
                                                    <a href="#" data-bs-toggle="modal"
                                                        data-bs-target="#edit_category_modal"
                                                        class="edit_category_button text-black"
                                                        category_id="{{ $category->id }}"
                                                        category_name="{{ $category->name }}"
                                                        category_status="{{ $category->status }}"
                                                        category_file="{{ $category->file }}"><i
                                                            class="feather-edit-3 me-1"></i>Edit</a>


                                                    <a href="#">
                                                        <form action="{{ route('category_destroy', $category->id) }}"
                                                            method="POST" style="display:inline;"
                                                            id="delete-form-{{ $category->id }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-sm text-danger"
                                                                onclick="confirmDelete({{ $category->id }})">
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


    {{-- add category model  --}}

    <div class="modal fade contentmodal" id="addModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Category</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category_store') }}" id="CategoryForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <label for="parent_id" class="focus-label">Parent Category:</label>
                                <select class="form-control floating" name="parent_category_id" required>
                                    <option value="">Select Parent Category</option>
                                    @foreach ($categories->where('parent_id', null) as $Category)
                                        <option value="{{ $Category->id }}">{{ $Category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <input type="text" name="name" id="name" class="form-control floating">
                                <label class="focus-label">Name<span class="text-danger">*</span></label>
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
                                <input type="file" class="upload" name="file" id="file">
                            </div>
                            <p class="text-success">Successfully specialityimage.jpg uploaded <a href="#"
                                    class="text-danger"><i class="feather-x"></i></a></p>
                            <div class="submit-section">
                                <button type="submit" class="btn btn-primary btn-save">Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


    {{-- edit model  --}}

    <div class="modal fade contentmodal" id="edit_category_modal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content doctor-profile">
                <div class="modal-header">
                    <h3 class="mb-0">Add Speciality</h3>
                    <button type="button" class="close-btn" data-bs-dismiss="modal" aria-label="Close"><i
                            class="feather-x-circle"></i></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('category_update') }}" id="EditForm" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="category_id" id="edit_category_id">
                        <div class="add-wrap">
                            <div class="form-group form-focus">
                                <input type="text" name="name" id="edit_category_name"
                                    class="form-control floating" required>
                                <label class="focus-label">Speciality Name<span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <label for="categoryStatus" class="form-label">Status</label>
                                <select id="edit_category_status" name="status" class="form-control floating" required>
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <div class="change-photo-btn">
                                <div><i class="feather-upload"></i>
                                    <p>Upload File</p>
                                </div>
                                <input type="file" name="file" id="edit_category_file" required>
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
        $(document).on('click', '.edit_category_button', function() {
            var category_id = $(this).attr('category_id');
            var category_name = $(this).attr('category_name');
            var category_status = $(this).attr('category_status');
            var category_file = $(this).attr('category_file');
            $('#edit_category_id').val(category_id);
            $('#edit_category_name').val(category_name);
            $('#edit_category_status').val(category_status)
            $('#edit_category_file').val(category_file).change();;

            $('#edit_category_modal').modal('show');
        });

        $(document).ready(function() {
            $('#CategoryForm').validate({
                rules: {
                    name: {
                        required: true,
                    },
                    status: {
                        required: true,
                    },
                    file: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 5000000,
                    },
                },
                messages: {
                    name: {
                        required: "Please Enter a Name",
                    },
                    status: {
                        required: "Please Select Status",
                    },
                    file: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png, gif)",
                        filesize: "File size should not exceed 5MB",
                    },
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });

            $('#EditForm').validate({
                rules: {
                    edit_category_name: {
                        required: true,
                    },
                    edit_category_status: {
                        required: true,
                    },
                    edit_category_file: {
                        required: true,
                        extension: "jpg|jpeg|png|gif",
                        filesize: 5000000,
                    },
                },
                messages: {
                    edit_category_name: {
                        required: "Please Enter a Name",
                    },
                    edit_category_status: {
                        required: "Please Select Status",
                    },
                    edit_category_file: {
                        required: "Please upload an image",
                        extension: "Please upload a valid image (jpg, jpeg, png, gif)",
                        filesize: "File size should not exceed 5MB",
                    },
                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
