@extends('Api.layouts.master')
@push('css')
    <style>
        .card {
            border: none;
            border-radius: 10px;
            overflow: hidden;
            background-color: #f8f9fa;
        }

        .card-img-top {
            border-bottom: 1px solid #ddd;
        }

        .card-body {
            padding: 15px;
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: 600;
        }

        .card-text {
            font-size: 1rem;
            margin-bottom: 10px;
        }

        .btn {
            width: 48%;
        }

        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #0056b3;
        }

        .btn-secondary {
            background-color: #6c757d;
            border-color: #6c757d;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            border-color: #545b62;
        }

        .text-muted {
            color: #6c757d !important;
        }
    </style>
@endpush

@section('content')
    <div class="container py-5">
        <h1 class="text-center mb-4">Live Sports Streams</h1>

        @if (count($streams) > 0)
            @foreach ($streams as $streamGroup)
                <h2 class="mb-4">{{ $streamGroup['sport_name'] }}</h2>
                <div class="row">
                    @foreach ($streamGroup['data'] as $stream)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="card shadow-sm">
                                <img src="https://via.placeholder.com/400x250" class="card-img-top" alt="Stream Thumbnail">
                                <div class="card-body">
                                    <h5 class="card-title">
                                        {{ $stream['team_one_name'] }}
                                        <span class="text-muted">vs</span>
                                        {{ isset($stream['team_two_name']) ? $stream['team_two_name'] : 'No second team available' }}
                                    </h5>
                                    <p class="card-text">
                                        <strong>Score:</strong>
                                        {{ isset($stream['score']) ? $stream['score'] : 'No score available' }}
                                    </p>
                                    <p class="card-text">
                                        <strong>Start Time:</strong>
                                        {{ isset($stream['start_time']) ? \Carbon\Carbon::parse($stream['start_time'])->format('Y-m-d H:i:s') : 'No start time available' }}
                                    </p>
                                    <div class="d-flex justify-content-between">
                                        <a href="{{ $stream['iframe_source'] }}" class="btn btn-primary btn-sm"
                                            target="_blank">Watch on Iframe</a>
                                        <a href="{{ $stream['m3u8_source'] }}" class="btn btn-secondary btn-sm"
                                            target="_blank">Watch Stream (M3U8)</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endforeach
        @else
            <p class="text-center">No streams available at the moment.</p>
        @endif
    </div>
@endsection
