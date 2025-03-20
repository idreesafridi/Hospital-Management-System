<html>

<body>
    <h2>Welcome to {{ env('APP_NAME') ?? 'HMS' }}!</h2>

    <p>You have been successfully registered as a new user. Here are your login credentials:</p>

    <table>
        <tr>
            <td><strong>Email:</strong></td>
            <td>{{ $email }}</td>
        </tr>
        <tr>
            <td><strong>Password:</strong></td>
            <td>{{ $password }}</td>
        </tr>
    </table>

    <p>Please log in to your account and change your password as soon as possible.</p>

    <p><a href="{{ url('/login') }}">Login Now</a></p>

    <p>Thanks,</p>
    <p>The {{ env('APP_NAME') ?? 'HMS' }}Team</p>
</body>

</html>
