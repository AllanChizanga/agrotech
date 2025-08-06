<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | Professional Portal</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .login-card {
            background: #fff;
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.2);
            padding: 3rem 2.5rem;
            max-width: 400px;
            width: 100%;
            margin: 2rem auto;
            position: relative;
        }

        .login-card .brand-logo {
            width: 60px;
            height: 60px;
            object-fit: contain;
            margin-bottom: 1.5rem;
            display: block;
            margin-left: auto;
            margin-right: auto;
        }

        .login-card h2 {
            font-weight: 700;
            color: #1e3c72;
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .form-label {
            font-weight: 500;
            color: #2a5298;
        }

        .form-control:focus {
            border-color: #1e3c72;
            box-shadow: 0 0 0 0.2rem rgba(30, 60, 114, 0.15);
        }

        .btn-primary {
            background: linear-gradient(90deg, #1e3c72 0%, #2a5298 100%);
            border: none;
            font-weight: 600;
            letter-spacing: 1px;
            transition: background 0.2s;
        }

        .btn-primary:hover {
            background: linear-gradient(90deg, #2a5298 0%, #1e3c72 100%);
        }

        .form-text {
            color: #6c757d;
        }

        .error-message {
            color: #e74c3c;
            font-size: 0.95rem;
            margin-top: 0.25rem;
        }

        .login-card .forgot-link {
            display: block;
            text-align: right;
            margin-top: 0.5rem;
            color: #2a5298;
            text-decoration: none;
            font-size: 0.95rem;
        }

        .login-card .forgot-link:hover {
            text-decoration: underline;
        }

        @media (max-width: 576px) {
            .login-card {
                padding: 2rem 1rem;
            }
        }
    </style>
</head>

<body>
    <div class="login-card">
        <img src="https://img.icons8.com/ios-filled/100/1e3c72/lock-2.png" alt="Logo" class="brand-logo">
        <h2>Sign In to Your Account</h2>
        <form action="{{ route('login') }}" method="POST" autocomplete="off">
            @csrf

            @if (session('error'))
                <div class="alert alert-danger text-center py-2 mb-3" role="alert">
                    {{ session('error') }}
                </div>
            @endif

            <div class="mb-3">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                    name="email" placeholder="Enter your email" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-2">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" id="password"
                    name="password" placeholder="Enter your password" required>
                @error('password')
                    <div class="error-message">{{ $message }}</div>
                @enderror
            </div>

            <a href="#" class="forgot-link">Forgot password?</a>

            <div class="d-grid mt-4">
                <button type="submit" class="btn btn-primary btn-lg">Login</button>
            </div>
        </form>
    </div>
</body>

</html>
