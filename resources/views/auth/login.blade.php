<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {

            background: url("{{ asset('assets/img/walpaper.png') }}") no-repeat center center fixed;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
        }



        .card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.753);
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
            color: #56ab2f;
        }

        .btn-primary {
            background-color: #56ab2f;
            border: none;
        }

        .btn-primary:hover {
            background-color: #4b9229;
        }
    </style>
</head>

<body class="d-flex align-items-center justify-content-center vh-100">
    <div class="card p-4" style="width: 400px;">
        <div class="text-center mb-3">
            <div class="logo">💊 Al-Egzakhana</div>
            <h5 class="text-muted mt-2">Login to your account</h5>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            @if ($errors->has('login_error'))
                <div class="alert alert-danger">
                    {{ $errors->first('login_error') }}
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Password</label>
                <input type="password" name="password" class="form-control" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Login</button>
        </form>
        <div class="text-center mt-3">
            <small>Don't have an account? <a href="{{ route('register') }}">Register</a></small>
        </div>
    </div>
</body>

</html>
