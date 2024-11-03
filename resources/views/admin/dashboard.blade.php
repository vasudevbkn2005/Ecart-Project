<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: 0;
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
        }

        .sidebar a {
            color: #fff;
            padding: 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover {
            background-color: #495057;
        }

        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 250px;
            right: 0;
            z-index: 1000;
        }

        .footer {
            background-color: #343a40;
            color: #fff;
            text-align: center;
            padding: 20px;
            position: relative;
            bottom: 0;
            width: 100%;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-white text-center">Admin Panel</h3>
        <a href="/admin/dashboard" active>Product List</a>
        <a href="/productcreate">Product Create</a>
        <a href="/admin/reports">Reports</a>
        <a href="/logout">Logout</a>
    </div>

    <div class="header">
        <h1>Product List</h1>
        <p>Welcome, {{ Session::get('user.name') }}!</p> <!-- Display the admin's name -->
    </div>

    <div class="content" style="padding-top: 130px;">
       
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
