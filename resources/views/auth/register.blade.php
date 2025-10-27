<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
      box-shadow: 0 8px 16px rgba(0,0,0,0.15);
    }
    .logo {
      font-size: 2rem;
      font-weight: bold;
      color: #56ab2f;
    }
    .btn-success {
      background-color: #56ab2f;
      border: none;
    }
    .btn-success:hover {
      background-color: #4b9229;
    }
  </style>
</head>
<body class="d-flex align-items-center justify-content-center vh-100">
  <div class="card p-4" style="width: 420px;">
    <div class="text-center mb-3">
      <div class="logo">💊 Al-Egzakhana</div>
      <h5 class="text-muted mt-2">Create a new account</h5>
    </div>
    <form method="POST" action="{{ route('register') }}">
      @csrf
      <div class="mb-3">
        <label class="form-label">Full Name</label>
        <input type="text" name="name" class="form-control" placeholder="Enter your full name" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Email</label>
        <input type="email" name="email" class="form-control" placeholder="Enter your email" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Password</label>
        <input type="password" name="password" class="form-control" placeholder="Create a password" required>
      </div>
      <div class="mb-3">
        <label class="form-label">Confirm Password</label>
        <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm your password" required>
      </div>
      <button type="submit" class="btn btn-success w-100">Register</button>
    </form>
    <div class="text-center mt-3">
      <small>Already have an account? <a href="{{ route('login') }}">Login</a></small>
    </div>
  </div>
</body>
</html>
