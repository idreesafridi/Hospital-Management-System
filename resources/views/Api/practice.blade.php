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
        <div class="search-container">
            <h1 style="text-align: center;">Instagram</h1>
            <form id="queryForm" action="{{ route('search.results') }}" method="GET">
                <input type="text" id="query" name="query" class="search-input" placeholder="Search..." required>
                <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>
    &nbsp;
    <hr> &nbsp;
    <div class="container">
        <div class="search-container">
            <h1 style="text-align: center;">Youtube</h1>
            <form id="queryForm" action="{{ route('search.youtube') }}" method="GET">
                <input type="text" id="query" name="query" class="search-input" placeholder="Search..." required>
                <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>
    &nbsp;
    <hr> &nbsp;
    <div class="container">
        <div class="search-container">
            <h1 style="text-align: center;">Stream</h1>
            <form id="queryForm" action="{{ route('search.stream') }}" method="GET">
                {{-- <input type="text" id="query" name="query" class="search-input" placeholder="Search..." required> --}}
                <button type="submit" class="search-button"><i class="fas fa-search"></i> Search</button>
            </form>
        </div>
    </div>
@endsection

@push('js')
    <script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.3/dist/jquery.validate.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#queryForm').validate({
                rules: {
                    query: {
                        required: true,
                    },

                },
                messages: {
                    query: {
                        required: "Please Enter a query",
                    },

                },

                submitHandler: function(form) {
                    form.submit();
                }
            });
        });
    </script>
@endpush
