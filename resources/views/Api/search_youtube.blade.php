@extends('Api.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="container">
        <h1>YouTube Video Results</h1>

        @foreach ($results as $category)
            @if (isset($category['type']) && $category['type'] == 'video_listing')
                <h2>{{ $category['title'] }}</h2>
                <div class="row">
                    @foreach ($category['data'] as $video)
                        <div class="col-md-4">
                            <div class="card">
                                <img src="{{ $video['thumbnail'][0]['url'] }}" class="card-img-top" alt="Video Thumbnail">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $video['title'] }}</h5>
                                    <p class="card-text">Views: {{ $video['viewCount'] }}</p>
                                    <p class="card-text">Published: {{ $video['publishedTimeText'] }}</p>
                                    <a href="https://www.youtube.com/watch?v={{ $video['videoId'] }}"
                                        class="btn btn-primary" target="_blank">Watch Video</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        @endforeach

    </div>
@endsection
@push('js')
@endpush
