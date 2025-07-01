<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Company Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <style>
        body {
            min-height: 100vh;
        }
        .sidebar {
            min-height: calc(100vh - 56px);
            box-shadow: inset -1px 0 0 rgba(0, 0, 0, .1);
        }
        .sidebar .nav-link {
            color: #333;
            padding: .75rem 1rem;
        }
        .sidebar .nav-link.active {
            color: #0d6efd;
            font-weight: bold;
        }
        .sidebar .nav-link:hover {
            background-color: rgba(0, 0, 0, .05);
        }
        .sidebar-heading {
            font-size: .75rem;
            text-transform: uppercase;
            padding: 1rem;
            font-weight: bold;
            color: #6c757d;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Company Management</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                            {{ Auth::user()->name ?? 'User' }}
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li>
                                <form method="POST" action="/logout" id="logout-form">
                                    @csrf
                                    <button type="submit" class="dropdown-item">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-3 col-lg-2 d-md-block sidebar bg-light collapse">
                <div class="position-sticky pt-3">
                    <div class="sidebar-heading">
                        Main
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/dashboard">
                                <i class="bi bi-speedometer2 me-2"></i>
                                Dashboard
                            </a>
                        </li>
                        @if(Auth::user() && Auth::user()->canManageCompanies())
                        <li class="nav-item">
                            <a class="nav-link" href="/company/list">
                                <i class="bi bi-building me-2"></i>
                                Companies
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/company/add">
                                <i class="bi bi-plus-circle me-2"></i>
                                Add Company
                            </a>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="sidebar-heading mt-4">
                        Account
                    </div>
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="#">
                                <i class="bi bi-person me-2"></i>
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#" onclick="document.getElementById('logout-form').submit(); return false;">
                                <i class="bi bi-box-arrow-right me-2"></i>
                                Logout
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2">Dashboard</h1>
                </div>
                
                <div class="row">
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title">User Role</h6>
                                        <h2 class="mb-0">{{ Auth::user()->role ?? 'User' }}</h2>
                                    </div>
                                    <div class="fs-1">
                                        <i class="bi bi-person-badge"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    @if(Auth::user() && Auth::user()->canManageCompanies())
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div>
                                        <h6 class="card-title">Companies</h6>
                                        <h2 class="mb-0">{{ App\Models\Company::count() }}</h2>
                                    </div>
                                    <div class="fs-1">
                                        <i class="bi bi-building"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="card mt-4">
                    <div class="card-header">
                        Welcome!
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Hello, {{ Auth::user()->name ?? 'User' }}!</h5>
                        <p class="card-text">Welcome to the Company Management System. This is your dashboard where you can access all the features available to you.</p>
                        
                        @if(Auth::user() && Auth::user()->canManageCompanies())
                        <p>As an {{ Auth::user()->role }}, you have access to company management features.</p>
                        <a href="/company/list" class="btn btn-primary">Manage Companies</a>
                        @else
                        <p>You are logged in as a regular user. You don't have access to company management features.</p>
                        @endif
                    </div>
                </div>
            </main>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 