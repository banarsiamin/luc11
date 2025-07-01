<!DOCTYPE html>
<html>
<head>
    <title>Company List</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            padding: 20px;
        }
        .actions {
            white-space: nowrap;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="mb-4">Company List</h1>
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        @if(session('error'))
        <div class="alert alert-danger alert-dismissible fade show mb-4" role="alert">
            {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        
        <div class="mb-3">
            <a href="/company/add" class="btn btn-primary">Add Company</a>
            <a href="/dashboard" class="btn btn-secondary">Back to Dashboard</a>
        </div>
        
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Website</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody id="companiesTable">
                            <tr>
                                <td colspan="6" class="text-center">Loading companies...</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // Fetch companies when the page loads
        document.addEventListener('DOMContentLoaded', function() {
            fetchCompanies();
        });
        
        // Function to fetch companies from the API
        function fetchCompanies() {
            fetch('/companies', {
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
                .then(data => {
                    console.log('Companies fetched:', data);
                    displayCompanies(data);
                })
                .catch(error => {
                    console.error('Error fetching companies:', error);
                    document.getElementById('companiesTable').innerHTML = `
                        <tr>
                            <td colspan="6" class="text-center text-danger">
                                Error loading companies: ${error.message}
                            </td>
                        </tr>
                    `;
                });
        }
        
        // Function to display companies in the table
        function displayCompanies(companies) {
            const tableBody = document.getElementById('companiesTable');
            
            if (companies.length === 0) {
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="6" class="text-center">No companies found</td>
                    </tr>
                `;
                return;
            }
            
            let html = '';
            companies.forEach(company => {
                html += `
                    <tr>
                        <td>${company.id}</td>
                        <td>${company.name}</td>
                        <td>${company.email}</td>
                        <td>${company.address || '-'}</td>
                        <td>${company.website ? `<a href="${company.website}" target="_blank">${company.website}</a>` : '-'}</td>
                        <td class="actions">
                            <a href="/company/${company.id}/edit" class="btn btn-sm btn-primary">Edit</a>
                            <button onclick="deleteCompany(${company.id})" class="btn btn-sm btn-danger">Delete</button>
                        </td>
                    </tr>
                `;
            });
            
            tableBody.innerHTML = html;
        }
        
        // Function to delete a company
        function deleteCompany(id) {
            if (confirm('Are you sure you want to delete this company?')) {
                // Get the CSRF token
                const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
                
                fetch(`/companies/${id}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': token,
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok');
                    }
                    return response.text(); // The response might be empty
                })
                .then(() => {
                    // Refresh the list after successful delete
                    fetchCompanies();
                    // Show success message
                    const alertDiv = document.createElement('div');
                    alertDiv.className = 'alert alert-success alert-dismissible fade show mb-4';
                    alertDiv.setAttribute('role', 'alert');
                    alertDiv.innerHTML = `
                        Company deleted successfully.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    `;
                    const container = document.querySelector('.container');
                    container.insertBefore(alertDiv, container.querySelector('.mb-3'));
                })
                .catch(error => {
                    alert('Error deleting company: ' + error.message);
                });
            }
        }
    </script>
    
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html> 