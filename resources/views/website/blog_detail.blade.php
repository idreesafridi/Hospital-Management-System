@extends('website.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <div class="blog-view">
                        <div class="blog blog-single-post">
                            <div class="blog-image">
                                <a href="javascript:void(0);"><img alt=""
                                        src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                        class="img-fluid"></a>
                            </div>
                            <h3 class="blog-title">{{ $blog->title ?? 'N/A' }}</h3>
                            <div class="blog-info clearfix">
                                <div class="post-left">
                                    <ul>
                                        <li>
                                            <div class="post-author">
                                                <a href="{{ route('doctor_profile', $blog->doctorblogs->id) }}"><img
                                                        src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                        alt="Post Author">
                                                    <span>Dr. {{ $blog->doctorblogs->name ?? 'N/A' }}</span></a>
                                            </div>
                                        </li>
                                        <li><i
                                                class="far fa-calendar"></i>{{ $blog->created_at->format(env('GLOBALE_DATE_FORMAT')) }}
                                        </li>
                                        <li><i class="far fa-comments"></i>12 Comments</li>
                                        <li><i class="fa fa-tags"></i>Health Tips</li>
                                    </ul>
                                </div>
                            </div>
                            <div class="blog-content">
                                <p>{{ $blog->description ?? 'N/A' }}</p>

                            </div>
                        </div>
                        <div class="card blog-share clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Share the post</h4>
                            </div>
                            <div class="card-body">
                                <ul class="social-share">
                                    <li><a href="#" title="Facebook"><i class="fab fa-facebook"></i></a></li>
                                    <li><a href="#" title="Twitter"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#" title="Linkedin"><i class="fab fa-linkedin"></i></a></li>
                                    <li><a href="#" title="Google Plus"><i class="fab fa-google-plus"></i></a></li>
                                    <li><a href="#" title="Youtube"><i class="fab fa-youtube"></i></a></li>
                                </ul>
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
                                            <a href="{{ route('doctor_profile', $blog->doctorblogs->id) }}"><img
                                                    class="img-fluid rounded-circle" alt=""
                                                    src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"></a>
                                        </div>
                                    </div>
                                    <div class="author-details">
                                        <a href="{{ route('doctor_profile', $blog->doctorblogs->id) }}"
                                            class="blog-author-name">Dr.
                                            {{ $blog->doctorblogs->name ?? 'N/A' }}</a>
                                        <p class="mb-0">{{ $blog->doctorblogs->profile->about ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card blog-comments clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Comments ({{ $blog->comments->count() ?? 0 }})</h4>
                            </div>
                            <div class="card-body pb-0">
                                <ul class="comments-list">
                                    <li>
                                        @foreach ($blog->comments as $comment)
                                            <div class="comment">
                                                <div class="comment-author">
                                                    <img class="avatar" alt=""
                                                        src="{{ asset('backend') }}/{{ $comment->patient->profile->profile_image ?? 'blog_attachments/no_image.png' }}">
                                                </div>
                                                <div class="comment-block">
                                                    <span class="comment-by">
                                                        <span
                                                            class="blog-author-name">{{ $comment->patient->name ?? 'N/A' }}</span>
                                                    </span>
                                                    <p>{{ $comment->comment ?? 'N/A' }}</p>
                                                    <p class="blog-date">
                                                        {{ $comment->created_at->format(env('GLOBALE_DATE_FORMAT')) }}</p>

                                                </div>
                                            </div>
                                        @endforeach

                                    </li>

                                </ul>
                            </div>
                        </div>
                        <div class="card new-comment clearfix">
                            <div class="card-header">
                                <h4 class="card-title">Leave Comment</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('comment') }}" method="POST" id="commentform">
                                    @csrf
                                    <input type="text" hidden name="blog_id" value="{{ $blog->id }}">
                                    {{-- <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <label>Your Email Address <span class="text-danger">*</span></label>
                                        <input type="email" name="email" class="form-control">
                                    </div> --}}
                                    <div class="form-group">
                                        <label>Comments</label>
                                        <textarea rows="4" name="comment" class="form-control"></textarea>
                                    </div>
                                    <div class="submit-section">
                                        <button class="btn btn-primary submit-btn" type="submit">Submit</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-12 sidebar-right theiaStickySidebar">

                    <div class="card search-widget">
                        <div class="card-body">
                            <form class="search-form">
                                <div class="input-group">
                                    <input type="text" placeholder="Search..." class="form-control">
                                    <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i></button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <div class="card post-widget">
                        <div class="card-header">
                            <h4 class="card-title">Latest Posts</h4>
                        </div>
                        <div class="card-body">
                            <ul class="latest-posts">
                                @foreach ($latestblogs as $blog)
                                    <li>
                                        <div class="post-thumb">
                                            <a href="{{ route('blogdetail', $blog->id) }}">
                                                <img class="img-fluid"src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                                    alt="">
                                            </a>
                                        </div>
                                        <div class="post-info">
                                            <h4>
                                                <a href="{{ route('blogdetail', $blog->id) }}">{{ $blog->title }}</a>
                                            </h4>
                                            <p>{{ $blog->created_at->format(env('GLOBALE_DATE_FORMAT')) }}</p>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="card category-widget">
                        <div class="card-header">
                            <h4 class="card-title">Blog Categories</h4>
                        </div>
                        <div class="card-body">
                            <ul class="categories">
                                @foreach ($categories as $category)
                                    <li><a href="{{ route('category_wise', $category->id) }}">{{ $category->name }}<span>(10)</span>
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>


                    <div class="card tags-widget">
                        <div class="card-header">
                            <h4 class="card-title">Tags</h4>
                        </div>
                        <div class="card-body">
                            <ul class="tags">
                                @foreach ($tags as $tag)
                                    <li><a href="{{ route('blog_tagdetails', $tag->id) }}"
                                            class="tag">{{ $tag->name ?? 'N/A' }}</a></li>
                                @endforeach
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
