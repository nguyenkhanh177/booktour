<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đăng nhập | dirEngine</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
</head>

<body>

    <div class="login-card">
        <h2>Đăng Nhập</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <input type="text" name="username" placeholder="Tên đăng nhập" value="{{ old('username') }}" required />
                @error('username')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <div class="form-group">
                <input type="password" name="password" placeholder="Mật khẩu" required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" name="password_confirmation" placeholder="Xác nhận mật khẩu" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>
            <div class="form-group">
                <input type="text" name="name" placeholder="Tên" value="{{ old('name') }}" required />
                @error('name')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit">Đăng ký</button>

        </form>

        <a href="{{ route('client.home') }}" class="back-home">← Quay lại trang chủ</a>
    </div>

</body>

</html>