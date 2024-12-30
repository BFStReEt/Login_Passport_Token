<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Register</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>

<body>
    <div class="register-container">
        <h1>Admin Register</h1>
        <form action="{{ route('admin-register') }}" method="POST">
            @csrf
            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div>
                <label for="display_name">Display Name</label>
                <input type="text" id="display_name" name="display_name" required>
            </div>
            <button type="submit">Register</button>
        </form>
    </div>
</body>

</html>