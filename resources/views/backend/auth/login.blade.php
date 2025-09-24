<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CoreDesk Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('assets/backend/css/custom.css') }}" />
</head>

<body>

    <div class="login-area">


        <div class="login-card">
            <!-- logo -->
            <div class="d-flex justify-content-center mb-4">
                <a href="/" class="text-center">
                    <img src="{{ url('assets/backend/img/kaiadmin/logo_dark.svg') }}" alt="CoreDesk Logo" class="login-logo" style="width: 200px;">
                </a>
            </div>
            <h3 class="mb-5">Welcome to CoreDesk</h3>
            <form method="POST" action="/login">
                <!-- Email -->
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                </div>
                <!-- Password -->
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                </div>
                <!-- Remember me -->
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="remember" name="remember">
                    <label class="form-check-label" for="remember">Remember me</label>
                </div>
                <!-- Submit -->
                <button type="submit" class="btn btn-login w-100">Login</button>
            </form>

            <div class="extra-links">
                <p><a href="/forgot-password">Forgot Password?</a></p>
                <p>Don’t have an account? <a href="/register">Register</a></p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>