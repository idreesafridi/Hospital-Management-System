@extends('backend.layouts.master')

@push('css')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.css" rel="stylesheet">
    <style>
        .bootstrap-tagsinput {
            width: 100% !important;

        }

        .tag {
            color: rgb(255, 255, 255) !important;
            background-color: rgb(61, 60, 60) !important;
            padding: 5px;
            margin-left: 10px;
        }
    </style>
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <form id="blogForm" class="form-horizontal" action="{{ route('blog_store') }}" method="POST"
                enctype="multipart/form-data">
                @csrf
                <div class="col-md-12">
                    <h5 class="mb-3">Add Blog</h5>
                    <div class="row">
                        <div class="col-md-9">
                            <div class="form-group form-focus">
                                <input type="text" name="blogtitle" class="form-control floating" required />
                                <label class="focus-label">Blog Title <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <select name="category_id" type="text" id="category_id" class="form-control select"
                                    required>
                                    <option value="">Select a Category</option>
                                    @foreach ($categories as $category)
                                        @if ($category->status == 1)
                                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <label class="control-label">Tag<span class="text-danger">*</span></label>
                                <input class="form-control bg-grey floating tag bootstrap-tagsinput" data-role="tagsinput"
                                    name="tags" id="tags" type="text" placeholder="Enter Tag" required>
                            </div>
                            <div class="form-group form-focus">
                                <textarea rows="4" name="blogcontent" class="form-control bg-grey floating" required></textarea>
                                <label class="focus-label">Blog Content <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <label class="control-label">Attachment <span class="text-danger">*</span></label>
                                    <div>
                                        <input class="form-control" name="file[]" id="file" type="file" required>
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
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control select" id="status" name="status" required>
                                    <option selected value="1">Active</option>
                                    <option value="0">Inactive</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary save-btn">
                                Save
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#description').summernote({
                placeholder: 'Enter your Description',
                tabsize: 2,
                height: 150
            });

            var fileInputIndex = 1;
            $('#add-file-button').click(function() {
                var newFileInput = `
                    <div class="form-group row" id="file-input-${fileInputIndex}">
                        <div class="col-md-11">
                            <input class="form-control" name="file[]" type="file" requ>
                        </div>
                        <div class="col-md-1">
                            <button type="button" class="btn btn-sm btn-danger remove-file-button" data-index="${fileInputIndex}" style="display: block;padding:5px">
                                <i class="fa fa-minus"></i>
                            </button>
                        </div>
                    </div>`;
                $(this).closest('.form-group').after(newFileInput);
                fileInputIndex++;
            });

            $(document).on('click', '.remove-file-button', function() {
                var index = $(this).data('index');
                $('#file-input-' + index).remove();
            });

            $('#blogForm').validate({
                rules: {
                    category_id: {
                        required: true,
                    },
                    blogtitle: {
                        required: true,
                        minlength: 3,
                    },
                    tags: {
                        required: true,
                        minlength: 3,
                    },
                    blogcontent: {
                        required: true,
                        minlength: 10,
                    },
                    'file[]': {
                        required: true,
                        extension: "jpg|jpeg|png|pdf|docx",
                        filesize: 2048,
                    },
                    status: {
                        required: true,
                    },
                },
                messages: {
                    category_id: {
                        required: "Please select a category",
                    },
                    blogtitle: {
                        required: "Please enter a title",
                        minlength: "Title must be at least 3 characters",
                    },
                    tags: {
                        required: "Please enter a Tag",
                        minlength: "Tag must be at least 3 characters",
                    },
                    blogcontent: {
                        required: "Please provide a description",
                        minlength: "Description must be at least 10 characters long",
                    },
                    'file[]': {
                        required: "Please upload at least one file",
                        extension: "Only jpg, jpeg, png, pdf, docx files are allowed",
                        filesize: "File size should not exceed 2MB",
                    },
                    status: {
                        required: "Please select the status",
                    },
                },
                submitHandler: function(form) {
                    form.submit();
                }
            });

            $.validator.addMethod("filesize", function(value, element, param) {
                var file = element.files[0];
                if (file) {
                    var fileSizeInKB = file.size / 1024;
                    return fileSizeInKB <= param;
                }
                return true;
            }, "File size must be less than 2MB.");


        });
    </script>
@endpush
