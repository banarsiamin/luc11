<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Company Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
            height: 100vh;
            display: flex;
            align-items: center;
            padding-top: 40px;
            padding-bottom: 40px;
        }
        .form-signup {
            max-width: 400px;
            padding: 15px;
            margin: auto;
        }
        .card {
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
    </style>
</head>
<body>
    <main class="form-signup w-100">
        <div class="card">
            <div class="card-body p-4 p-sm-5">
                <h1 class="h3 mb-3 fw-normal text-center">Register Account</h1>
                
                @if(session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
                @endif
                
                <form method="POST" action="/register">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Full Name" required>
                        <label for="name">Full Name</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="email" name="email" placeholder="name@example.com" required>
                        <label for="email">Email address</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                        <label for="password">Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password" required>
                        <label for="password_confirmation">Confirm Password</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="role" name="role">
                            <option value="user">User</option>
                            <option value="manager">Manager</option>
                            <option value="admin">Admin</option>
                        </select>
                        <label for="role">Role</label>
                    </div>
                    
                    <button class="w-100 btn btn-lg btn-primary mb-3" type="submit">Register</button>
                    <p class="text-center">Already have an account? <a href="/login">Login</a></p>
                </form>
            </div>
        </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 