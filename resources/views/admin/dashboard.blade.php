<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>

<body>
    <h1>Welcome to Admin Dashboard!</h1>
    <p>Chúc mừng bạn đã đăng nhập thành công.</p>
    <form action="{{ route('admin.logout') }}" method="POST">
        @csrf
        <button type="submit">Logoutssss</button>
    </form>
</body>

</html>