@extends('backend.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row">
            <div class="col-md-9">
                <ul class="list-links mb-4">
                    <li class="active">
                        <a href="active-blog.html">Active Blog</a>
                    </li>
                    <li><a href="pending-blog.html">Pending Blog</a></li>
                </ul>
            </div>
            <div class="col-md-3 text-md-end">
                <a href="{{ route('blog_add') }}" class="btn btn-primary btn-blog mb-3">Add Blog</a>
            </div>
        </div>
        <div class="row">
            @foreach ($blogs as $blog)
                <div class="col-md-6 col-xl-4 col-sm-12 d-flex">

                    <div class="blog grid-blog flex-fill">

                        <div class="blog-image">
                            <a href="{{ route('blog_details', $blog->id) }}"><img class="img-fluid"
                                    src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                    alt="Post Image" style="height: 150px" /></a>
                            <div class="fav-btn">
                                <img src="{{ asset('backend/img/icon/eye-icon.png') }}" alt="icon" /> 22
                            </div>
                        </div>
                        <div class="blog-content">
                            <ul class="entry-meta meta-item">
                                <li>
                                    <div class="post-author">
                                        <a href="profile.html">
                                            <img src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                alt="Post Author" />
                                            <span>
                                                <span class="post-title">{{ $blog->doctorblogs->name ?? 'N/A' }}</span>
                                                <span class="post-date"><i class="far fa-clock"></i>
                                                    {{ $blog->created_at->format(env('GLOBALE_DATE_FORMAT')) }}</span>
                                            </span>
                                        </a>
                                    </div>
                                </li>
                            </ul>
                            <h3 class="blog-title">
                                <a href="{{ route('blog_details', $blog->id) }}">{{ $blog->title ?? 'N/A' }}</a>
                            </h3>
                            <p>{{ Str::limit($blog->description, 100, '...') }}</p>
                        </div>
                        <div class="row">
                            <div class="col">
                                <a href="{{ route('blog_edit', $blog->id) }}" class="text-success"><i
                                        class="feather-edit-3 me-1"></i>
                                    Edit</a>
                                <a href="#">
                                    <form action="{{ route('blog_destroy', $blog->id) }}" method="POST"
                                        style="display:inline;" id="delete-form-{{ $blog->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm text-danger"
                                            onclick="confirmDelete({{ $blog->id }})">
                                            <i class="feather-trash-2 me-1"></i> Delete
                                        </button>
                                    </form>
                                </a>
                            </div>
                            <div class="col text-end">
                                <label class="toggle-switch justify-content-end" for="status{{ $blog->id }}">
                                    <input type="checkbox" class="toggle-switch-input" id="status{{ $blog->id }}"
                                        data-id="{{ $blog->id }}" @if ($blog->status == 1) checked @endif>
                                    <span class="toggle-switch-label">
                                        <span class="toggle-switch-indicator"></span>
                                    </span><br>
                                    <span class="status-label">
                                        @if ($blog->status == 1)
                                            Active
                                        @else
                                            Inactive
                                        @endif
                                    </span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>


        <div class="row">
            <div class="col-md-12">
                <div class="pagination-tab mt-md-5 d-flex justify-content-center">
                    <ul class="pagination mb-0">
                        {{-- Previous page link --}}
                        @if ($blogs->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link"><i class="feather-chevron-left mr-2"></i>Previous</span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}">
                                    <i class="feather-chevron-left mr-2"></i>Previous
                                </a>
                            </li>
                        @endif

                        {{-- Loop through pages and display them dynamically --}}
                        @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                            @if ($page == $blogs->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $page }} <span
                                            class="sr-only">(current)</span></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach

                        {{-- Next page link --}}
                        @if ($blogs->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}">
                                    Next <i class="feather-chevron-right ml-2"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">Next <i class="feather-chevron-right ml-2"></i></span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>




    </div>
@endsection
@push('js')
    <script>
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
                    url: '{{ route('update.blogstatus') }}',
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
