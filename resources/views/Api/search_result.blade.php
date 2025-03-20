@extends('Api.layouts.master')
@push('css')
    <style>
        .search-container {
            text-align: center;
        }

        .search-input {
            width: 400px;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 24px;
            outline: none;
        }

        .search-button {
            padding: 10px 20px;
            font-size: 16px;
            border: none;
            border-radius: 24px;
            background-color: #4285f4;
            color: white;
            cursor: pointer;
            margin-left: 10px;
        }

        .search-button:hover {
            background-color: #357ae8;
        }
    </style>
@endpush

@section('content')
    <div class="container">
        <h1>Search Results</h1>

        @if (isset($results['data']))
            <p>Total Users Found: {{ $results['data']['count'] }}</p>

            <div class="row" id="user-list">
                @if (count($results['data']['items']) > 0)
                    @foreach ($results['data']['items'] as $user)
                        <div class="col-md-12 col-lg-8 col-xl-9">
                            <div class="card user-item">
                                <div class="card-body">
                                    <div class="user-widget">
                                        <div class="user-info-left">

                                            <div class="user-img">
                                                <a href="user-profile.html">
                                                    <img src="{{ !empty($user['profile_pic_url']) ? $user['profile_pic_url'] : asset('images/default.png') }}"
                                                        class="img-fluid" alt="{{ $user['username'] }}"
                                                        onerror="this.onerror=null; this.src='{{ asset('images/default.png') }}';" />
                                                </a>
                                            </div>

                                            <div class="user-info-cont">
                                                <a href="user-profile.html">{{ $user['id'] }}</a>
                                                <h4 class="user-name">
                                                    <a href="user-profile.html">{{ $user['username'] }}</a>
                                                </h4>
                                                <p class="user-fullname">{{ $user['full_name'] ?? 'N/A' }}</p>
                                            </div>
                                        </div>
                                        <form action="{{ route('api_user_search', $user['id']) }}">
                                            <button type="submit" class="search-button"><i class="fas fa-user"></i>User
                                                Detail</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                @else
                    <p>No results found for your search query.</p>
                @endif
            </div>
        @else
            <p>No results found for your search query.</p>
        @endif
    </div>
@endsection

@push('js')
@endpush
