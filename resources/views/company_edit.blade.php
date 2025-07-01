<!DOCTYPE html>
<html>
<head>
    <title>Edit Company</title>
</head>
<body>
    <h1>Edit Company</h1>
    <form method="POST" action="/api/companies/{{ $id }}">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $id }}">
        <label for="name">Company Name:</label>
        <input type="text" id="name" name="name" value="" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="" required><br>
        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value=""><br>
        <label for="website">Website:</label>
        <input type="text" id="website" name="website" value=""><br>
        <button type="submit">Update Company</button>
    </form>
    <a href="/company/list">Back to List</a>
</body>
</html> 