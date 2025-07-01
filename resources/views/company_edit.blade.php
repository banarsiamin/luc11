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
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        
        <div class="card">
            <div class="card-body">
                <form id="editCompanyForm" method="POST" action="/companies/{{ $id }}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{ $id }}">
                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Company Name:</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="email" class="form-label">Email:</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="address" class="form-label">Address:</label>
                        <input type="text" class="form-control @error('address') is-invalid @enderror" id="address" name="address">
                        @error('address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="mb-3">
                        <label for="website" class="form-label">Website:</label>
                        <input type="text" class="form-control @error('website') is-invalid @enderror" id="website" name="website">
                        @error('website')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
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
            // If company data is already passed from the controller, use it
            @if(isset($company))
                populateFormFields({
                    name: "{{ $company->name }}",
                    email: "{{ $company->email }}",
                    address: "{{ $company->address ?? '' }}",
                    website: "{{ $company->website ?? '' }}"
                });
            @else
                // Otherwise, fetch it from the API
                fetchCompanyData();
            @endif
        });
        
        // Populate form fields with company data
        function populateFormFields(company) {
            document.getElementById('name').value = company.name;
            document.getElementById('email').value = company.email;
            document.getElementById('address').value = company.address || '';
            document.getElementById('website').value = company.website || '';
        }
        
        // Function to fetch company data
        function fetchCompanyData() {
            fetch('/companies/{{ $id }}', {
                headers: {
                    'Accept': 'application/json'
                }
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(company => {
                // Populate form fields with company data
                populateFormFields(company);
            })
            .catch(error => {
                console.error('Error loading company data:', error);
                alert('Error loading company data: ' + error.message);
            });
        }
    </script>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 