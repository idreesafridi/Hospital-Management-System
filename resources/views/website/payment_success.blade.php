@extends('website.layouts.master')
@push('css')
@endpush
@section('content')
    <h1>Payment Successful!</h1>
    <p>Thank you for your payment. Your appointment has been confirmed.</p>
    <p>Payment ID: {{ $session->id }}</p>
    <p>Amount Paid: ${{ number_format($session->amount_received / 100, 2) }}</p>

    <h3>Invoice Details</h3>
    <p>Invoice ID: {{ $invoice->id }}</p>
    <p>Status: {{ $invoice->status }}</p>
    <p>Amount Due: ${{ number_format($invoice->amount_due / 100, 2) }}</p>
    <p>You will receive an invoice email shortly.</p>




    <div class="content success-page-cont">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <div class="col-lg-6">

                    <div class="card success-card">
                        <div class="card-body">
                            <div class="success-cont">
                                <i class="fas fa-check"></i>
                                <h3>Appointment booked Successfully!</h3>
                                <p>Appointment booked with <strong>Dr. Darren Elder</strong><br> on <strong>12 Nov 2019
                                        5:00PM to 6:00PM</strong></p>
                                <a href="invoice-view.html" class="btn btn-primary view-inv-btn">View Invoice</a>
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
