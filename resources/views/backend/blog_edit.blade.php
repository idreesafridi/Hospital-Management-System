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
            <div class="col-md-12">
                <h5 class="mb-3">Edit Blog</h5>
                <div class="row">
                    <div class="col-md-9">
                        <form id="blogForm" action="{{ route('blog_update', $blog->id) }}" method="POST"
                            enctype="multipart/form-data"> <!-- Add the form id -->
                            @csrf
                            @method('PUT')
                            <div class="form-group form-focus">
                                <input type="text" id="blogtitle" name="blogtitle" class="form-control floating"
                                    value="{{ $blog->title }}" />
                                <label class="focus-label">Blog Title <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group form-focus">
                                <label class="control-label">Category</label>
                                <select name="category_id" type="text" id="category_id" class="select">
                                    <option value="">Select a category</option>
                                    @foreach ($categories as $category)
                                        @if ($category->status == 1)
                                            <option value="{{ $category->id }}"
                                                @if ($category->id == $blog->category_id) selected @endif>
                                                {{ $category->name ?? 'N\A' }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group form-focus">
                                <label class="control-label">Tag<span class="text-danger">*</span></label>
                                <input class="form-control bootstrap-tagsinput" data-role="tagsinput"
                                    value="{{ $blog->blogtag->pluck('name')->implode(', ') }}" name="tags" type="text"
                                    placeholder="Enter tags">
                            </div>

                            <div class="form-group form-focus">
                                <textarea rows="4" id="blogcontent" name="blogcontent" class="form-control bg-grey floating">{{ $blog->description ?? 'N\A' }}</textarea>
                                <label class="focus-label">Blog Content <span class="text-danger">*</span></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label">Status</label>
                                <select class="form-control" id="status" name="status" class="select">
                                    <!-- Dynamically set the initial status -->
                                    <option value="1" @if ($blog->status == 1) selected @endif>Active</option>
                                    <option value="0" @if ($blog->status == 0) selected @endif>Inactive
                                    </option>
                                </select>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-11">
                                    <label class="control-label">Attachments</label>
                                    <div>
                                        @foreach ($blog->blogAttachments as $blogAttachment)
                                            <img src="{{ asset('backend') }}/{{ $blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                                style="height: 50px; width:50px">
                                        @endforeach
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
                            <button type="submit" class="btn btn-primary save-btn">Save Changes</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize the form validation
            $("#blogForm").validate({
                rules: {
                    blogtitle: {
                        required: true
                    },
                    category_id: {
                        required: true
                    },

                    blogcontent: {
                        required: true
                    },
                    'file[]': {
                        required: true
                    },

                },
                messages: {
                    blogtitle: {
                        required: "Please enter a blog title."
                    },
                    category_id: {
                        required: "Please select a category."
                    },

                    blogcontent: {
                        required: "Please enter the blog content."
                    },
                    'file[]': {
                        required: "Please upload a file."
                    },

                },
                submitHandler: function(form) {

                    form.submit();
                }
            });

            var fileInputIndex = 1;
            $('#add-file-button').click(function() {
                var newFileInput = `
                <div class="form-group row" id="file-input-${fileInputIndex}">
                    <div class="col-md-11">
                        <input class="form-control" name="file[]" type="file">
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
        });
    </script>
@endpush
