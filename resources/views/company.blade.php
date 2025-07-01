<!DOCTYPE html>
<html>
<head>
    <title>Company Management</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Company Management</h1>
        
        <div class="row mb-4">
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        Register New Company
                    </div>
                    <div class="card-body">
                        <form method="POST" action="/companies">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="name" class="form-label">Company Name:</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="email" class="form-label">Email:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="address" class="form-label">Address:</label>
                                <input type="text" class="form-control" id="address" name="address">
                            </div>
                            
                            <div class="mb-3">
                                <label for="website" class="form-label">Website:</label>
                                <input type="text" class="form-control" id="website" name="website">
                            </div>
                            
                            <button type="submit" class="btn btn-primary">Register Company</button>
                        </form>
                    </div>
                </div>
            </div>
            
            <div class="col-md-6">
                <div class="card h-100">
                    <div class="card-header">
                        Quick Links
                    </div>
                    <div class="card-body">
                        <div class="d-grid gap-3">
                            <a href="/company/list" class="btn btn-outline-primary">View All Companies</a>
                            <a href="/company/add" class="btn btn-outline-success">Add New Company</a>
                            <a href="/dashboard" class="btn btn-outline-secondary">Back to Dashboard</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 