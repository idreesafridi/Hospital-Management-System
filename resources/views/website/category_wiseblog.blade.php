@extends('website.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">

                    <div class="row blog-grid-row">
                        @foreach ($blogs as $blog)
                            <div class="col-md-6 col-sm-12">

                                <div class="blog grid-blog">

                                    <div class="blog-image">
                                        <a href="{{ route('blogdetail', $blog->id) }}"><img class="img-fluid"
                                                src="{{ asset('backend') }}/{{ $blog->blogAttachment->file ?? 'blog_attachments/no_image.png' }}"
                                                alt="Post Image" style="height: 150px"></a>
                                    </div>
                                    <div class="blog-content">
                                        <ul class="entry-meta meta-item">
                                            <li>
                                                <div class="post-author">
                                                    <a href="{{ route('doctor_profile', $blog->doctorblogs->id) }}"><img
                                                            src="{{ asset('backend') }}/{{ $blog->doctorblogs->profile->profile_image ?? 'blog_attachments/no_image.png' }}"
                                                            alt="Post Author">
                                                        <span>Dr. {{ $blog->doctorblogs->name ?? 'N/A' }}</span></a>
                                                </div>
                                            </li>
                                            <li><i class="far fa-clock"></i>
                                                {{ $blog->created_at->format(env('GLOBALE_DATE_FORMAT')) }}</li>
                                        </ul>
                                        <h3 class="blog-title"><a
                                                href="{{ route('blogdetail', $blog->id) }}">{{ Str::limit($blog->title, 30, '...') }}</a>
                                        </h3>
                                        <p class="mb-0">{{ Str::limit($blog->description, 35, '...') }}</p>
                                    </div>

                                </div>

                            </div>
                        @endforeach
                    </div>

                    @if ($blogs->hasMorePages())
                        <div class="row">
                            <div class="col-md-12">
                                <div class="blog-pagination">
                                    <nav>
                                        <ul class="pagination justify-content-center">
                                            {{-- Previous Page Link --}}
                                            <li class="page-item {{ $blogs->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $blogs->previousPageUrl() }}" tabindex="-1">
                                                    <i class="fas fa-angle-double-left"></i>
                                                </a>
                                            </li>

                                            {{-- Pagination Links --}}
                                            @foreach ($blogs->getUrlRange(1, $blogs->lastPage()) as $page => $url)
                                                <li class="page-item {{ $blogs->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $blogs->currentPage() == $page ? '#' : $url }}">
                                                        {{ $page }}
                                                    </a>
                                                </li>
                                            @endforeach

                                            {{-- Next Page Link --}}
                                            <li class="page-item {{ $blogs->hasMorePages() ? '' : 'disabled' }}">
                                                <a class="page-link" href="{{ $blogs->nextPageUrl() }}">
                                                    <i class="fas fa-angle-double-right"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    @endif

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
                                    <li><a href="{{ route('category_wise', $category->id) }}">{{ $category->name }}<span>({{ $category->blogs->count() }})</span>
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
@endpush
