@extends('backend.layouts.master')

@push('css')
@endpush

@section('content')
    <div class="content container-fluid">
        <div class="row justify-content-center">
            <div class="col-lg-10 col-xl-8">
                <div class="blog-view">
                    <div class="blog-single-post">
                        <a href="{{ route('blog_list') }}" class="back-btn"><i class="feather-chevron-left"></i> Back</a>
                        <div class="blog-image">
                            <a href="javascript:void(0);"><img alt=""
                                    src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                    class="img-fluid" /></a>
                        </div>
                        <h3 class="blog-title">
                            {{ $blog->title ?? 'N/A' }}
                        </h3>
                        <div class="blog-info">
                            <div class="post-list">
                                <ul>
                                    <li>
                                        <div class="post-author">
                                            <a href="profile.html"><img
                                                    src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                    alt="Post Author" />
                                                <span>by {{ $blog->doctorblogs->name ?? 'N/A' }} </span></a>
                                        </div>
                                    </li>
                                    <li><i class="feather-clock"></i> 40 Comments</li>
                                    <li>
                                        <i class="feather-message-square"></i> 40 Comments
                                    </li>
                                    <li>
                                        <i class="feather-grid"></i> Topical chemotherapy,
                                        Gynacologist
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog-content">
                            <p>
                                {{ $blog->description ?? 'N/A' }}
                            </p>

                        </div>
                    </div>

                    <div class="card author-widget clearfix">
                        <div class="card-header">
                            <h4 class="card-title">About Author</h4>
                        </div>
                        <div class="card-body">
                            <div class="about-author">
                                <div class="about-author-img">
                                    <div class="author-img-wrap">
                                        <a href="profile.html"><img class="img-fluid" alt=""
                                                src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}" /></a>
                                    </div>
                                </div>
                                <div class="author-details">
                                    <a href="profile.html" class="blog-author-name">Dr.
                                        {{ $blog->doctorblogs->name ?? 'N/A' }}
                                        <span>{{ $blog->doctorblogs->profile->speciality->name ?? 'N/A' }}</span></a>
                                    <p class="mb-0">
                                        {{ $blog->doctorblogs->profile->about ?? 'N/A' }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card blog-comments">
                        <div class="card-header">
                            <h4 class="card-title">Comments ({{ $blog->comments->count() ?? 0 }})</h4>
                        </div>
                        <div class="card-body pb-0">
                            <ul class="comments-list">
                                @foreach ($blog->comments as $comment)
                                    <li>
                                        <div class="comment">
                                            <div class="comment-author">
                                                <img class="avatar" alt=""
                                                    src="{{ asset('backend') }}/{{ $comment->patient->profile->profile_image ?? 'blog_attachments/no_image.png' }}" />
                                            </div>
                                            <div class="comment-block">
                                                <div class="comment-by">
                                                    <h5 class="blog-author-name">
                                                        {{ $comment->patient->name ?? 'N/A' }}
                                                        <span class="blog-date">
                                                            <i
                                                                class="feather-clock me-2"></i>{{ $comment->created_at->format(env('GLOBALE_DATE_FORMAT')) }}</span>
                                                    </h5>
                                                </div>
                                                <p>
                                                    {{ $comment->comment }}
                                                </p>

                                            </div>
                                        </div>
                                    </li>
                                @endforeach

                            </ul>
                        </div>
                    </div>
                    @if (auth()->user()->role === 'Patient')
                        <div class="card new-comment clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Leave Comment</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('comment') }}" method="POST" id="commentform">
                                    @csrf
                                    <input type="text" hidden name="blog_id" value="{{ $blog->id }}">

                                    <div class="form-group">
                                        <textarea rows="4" name="comment" class="form-control bg-grey" placeholder="Comments"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit">
                                            Submit
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    @endif

                    <div class="card blog-share clearfix">
                        <div class="card-header">
                            <h4 class="card-title">Share the post</h4>
                        </div>
                        <div class="card-body">
                            <ul class="social-share">
                                <li>
                                    <a href="#"><i class="feather-twitter"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="feather-facebook"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="feather-linkedin"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="feather-instagram"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="feather-youtube"></i></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#commentform').validate({
                rules: {
                    comment: {
                        required: true,
                    },


                },
                messages: {
                    comment: {
                        required: "Please enter a Comment",
                    },

                },
                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
