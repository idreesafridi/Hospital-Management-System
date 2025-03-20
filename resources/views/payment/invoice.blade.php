<!-- resources/views/invoice/view.blade.php -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Invoice - {{ $appointment->id }}</title>

    <style>
        /* Style the page for printing */
        @media print {
            body {
                font-family: Arial, sans-serif;
                background-color: #fff;
            }

            .no-print {
                display: none;
            }

            h1 {
                text-align: center;
                font-size: 24px;
            }

            p {
                font-size: 16px;
            }

            a {
                display: none;
            }
        }
    </style>
</head>

<body>
    <h1>Invoice Details</h1>
    <p><strong>Patient Name:</strong> {{ $appointment->patient->name }}</p>
    <p><strong>Doctor Name:</strong> {{ $appointment->doctor->name }}</p>
    <p><strong>Dease:</strong> {{ $appointment->disease }}</p>
    <p><strong>Appointment Date:</strong> {{ $appointment->appointment_date }}</p>
    <p><strong>Appointment Time:</strong> {{ $appointment->appointment_time }}</p>
    <p><strong>Amount:</strong> ${{ $appointment->amount }}</p>
    <p><strong>Status:</strong> {{ $appointment->status }}</p>
    <p><strong>Created At:</strong> {{ $appointment->created_at }}</p>
    <p><strong>Updated At:</strong> {{ $appointment->updated_at }}</p>

    @if ($appointment->deleted_at)
        <p><strong>Deleted At:</strong> {{ $appointment->deleted_at }}</p>
    @endif

    <button class="no-print" onclick="window.print()">Print Invoice</button>

    <br><br>
    <a href="{{ route('appointment') }}">Back to Appointments</a>


</body>

</html>
<script>
    window.onload = function() {
        window.print();
    };
</script>
