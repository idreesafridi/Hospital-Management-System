@extends('website.layouts.master')
@push('css')
@endpush
@section('content')
    <div class="content cancel-page-cont">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card cancel-card">
                        <div class="card-body">
                            <div class="cancel-cont">
                                <i class="fas fa-times"></i>
                                <h3>Appointment Cancel!</h3>
                                <p>Appointment booked with <strong>Dr. Darren Elder</strong><br> on <strong>12 Nov 2019
                                        5:00PM to 6:00PM</strong></p>
                                <a href="invoice-view.html" class="btn btn-danger view-inv-btn">View Invoice</a>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
@endpush
