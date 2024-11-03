@extends('master')

@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            transition: margin 0.3s;
        }

        .sidebar.collapsed {
            margin-left: -250px; /* Collapse the sidebar */
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
            transition: margin-left 0.3s;
        }

        .content.collapsed {
            margin-left: 0; /* Adjust content area when sidebar is collapsed */
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

        .header h1 {
            margin: 0;
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

        .card {
            margin-bottom: 20px;
        }
    </style>
</head>

<body>
    <button class="btn btn-primary" id="toggleSidebar" style="position: fixed; top: 20px; left: 20px;">Toggle Sidebar</button>

    <div class="sidebar" id="sidebar">
        <h3 class="text-white text-center">Admin Panel</h3>
        <a href="/admin/dashboard">Dashboard</a>
        <a href="/admin/manage-users">Manage Users</a>
        <a href="/admin/reports">Reports</a>
        <a href="/logout">Logout</a>
    </div>

    <div class="header" id="header">
        <h1>Admin Dashboard</h1>
        <p>Welcome, {{ Session::get('user.name') }}!</p>
    </div>

    <div class="content" id="content" style="padding-top: 80px;"> <!-- Adjust padding for header -->
        <div class="row">
            <div class="col-md-4">
                <div class="card text-white bg-primary">
                    <div class="card-body">
                        <h5 class="card-title">Total Users</h5>
                        {{-- <p class="card-text">You have {{ $totalUsers }} users registered.</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-success">
                    <div class="card-body">
                        <h5 class="card-title">Total Sales</h5>
                        {{-- <p class="card-text">Total sales made: ${{ $totalSales }}</p> --}}
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card text-white bg-warning">
                    <div class="card-body">
                        <h5 class="card-title">Pending Orders</h5>
                        {{-- <p class="card-text">You have {{ $pendingOrders }} pending orders.</p> --}}
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        Recent Activity
                    </div>
                    <div class="card-body">
                        <p>No recent activities.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 MyShop. All rights reserved.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const toggleSidebar = document.getElementById('toggleSidebar');
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');

        toggleSidebar.addEventListener('click', function() {
            sidebar.classList.toggle('collapsed');
            content.classList.toggle('collapsed');
        });
    </script>
</body>

</html>
@endsection
