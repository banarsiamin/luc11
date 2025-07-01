<!DOCTYPE html>
<html>
<head>
    <title>Edit Company</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Edit Company</h1>
        
        <div class="card">
            <div class="card-body">
                <form id="editCompanyForm" method="POST" action="/companies/{{ $id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $id }}">
                    
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
                    
                    <div class="d-flex gap-2">
                        <button type="submit" class="btn btn-primary">Update Company</button>
                        <a href="/company/list" class="btn btn-secondary">Back to List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
    <script>
        // Fetch company data when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchCompanyData();
        });
        
        // Function to fetch company data
        function fetchCompanyData() {
            fetch('/companies/{{ $id }}')
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.json();
                })
                .then(company => {
                    // Populate form fields with company data
                    document.getElementById('name').value = company.name;
                    document.getElementById('email').value = company.email;
                    document.getElementById('address').value = company.address || '';
                    document.getElementById('website').value = company.website || '';
                })
                .catch(error => {
                    alert('Error loading company data: ' + error.message);
                });
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 