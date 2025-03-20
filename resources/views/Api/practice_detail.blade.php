@extends('Api.layouts.master')

@section('content')
    <div class="container">
        <h1>User Details</h1>

        <div class="card">
            <div class="card-body">
                <div class="user-widget">
                    <div class="user-info-left">
                        <div class="user-img">
                            <a href="user-profile.html">
                                <img src="{{ $user->profile_picture ?? asset('path/to/default/image.png') }}"
                                    class="img-fluid" alt="{{ $user->username }}" />
                            </a>
                        </div>
                        <div class="user-info-cont">
                            <h4 class="user-name">
                                <a href="user-profile.html">{{ $user->username }}</a>
                            </h4>
                            <p class="user-fullname">{{ $user->full_name ?? 'N/A' }}</p>
                            <p class="user-bio">{{ $user->bio ?? 'No bio available' }}</p>
                            <p>Followers: {{ $user->followers_count }}</p>
                            <p>Following: {{ $user->following_count }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
