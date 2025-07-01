<!DOCTYPE html>
<html>
<head>
    <title>Company</title>
</head>
<body>
    <h1>Register Company</h1>
    <form method="POST" action="/api/companies">
        @csrf
        <label for="name">Company Name:</label>
        <input type="text" id="name" name="name" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address"><br>
        <label for="website">Website:</label>
        <input type="text" id="website" name="website"><br>
        <button type="submit">Register Company</button>
    </form>
</body>
</html> 