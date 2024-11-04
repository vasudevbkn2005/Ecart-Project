<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
            top: 0;
            left: -250px; /* Start hidden off-screen */
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            transition: left 0.3s; /* Smooth transition */
        }

        .sidebar.show {
            left: 0; /* Slide in */
        }

        .sidebar a {
            color: #fff;
            padding: 15px;
            text-decoration: none;
            display: block;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #495057;
        }

        .content {
            margin-left: 0; /* No margin when sidebar is hidden */
            padding: 20px;
            transition: margin-left 0.3s; /* Smooth transition */
        }

        .content.with-sidebar {
            margin-left: 250px; /* Margin for content when sidebar is visible */
        }

        .header {
            background-color: #007bff;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
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

        @media (max-width: 768px) {
            .sidebar {
                position: relative;
                height: auto;
                width: 100%;
            }

            .content {
                margin-left: 0;
            }

            .header {
                left: 0;
                right: 0;
            }
        }

        .img-thumbnail {
            max-width: 100px; /* Set max width for images */
            height: auto;
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar" style="margin-top: 120px">
        <h3 class="text-white text-center">Admin Panel</h3>
        <a href="/product/dashboard" class="{{ request()->is('product/dashboard') ? 'active' : '' }}">Product List</a>
        <a href="/product/create" class="{{ request()->is('product/create') ? 'active' : '' }}">Product Create</a>
        <a href="/product/reports" class="{{ request()->is('product/reports') ? 'active' : '' }}">Reports</a>
        <a href="/logout" class="{{ request()->is('logout') ? 'active' : '' }}">Logout</a>
    </div>

    <button class="btn btn-primary"  id="sidebarToggle" style="position: fixed; z-index: 1001; top: 15px; left: 1300px;">
        <i class="fa fa-bars" style="font-size:36px"></i>
    </button>

    <div class="header">
        <h1>Product List</h1>
        <p>Welcome, {{ Session::get('user.name') }}!</p> <!-- Display the admin's name -->
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
        <div class="container">
            <h2 class="mb-4">Products</h2>
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>Image</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Description</th>
                            <th>Edit</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ asset('storage/' . $item->gallery) }}" class="img-thumbnail" alt="{{ $item->name }}">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="/product/edit/{{ $item->id }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="/product/delete/{{ $item->id }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Your Company</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleButton = document.getElementById('sidebarToggle');

        toggleButton.addEventListener('click', () => {
            sidebar.classList.toggle('show');
            content.classList.toggle('with-sidebar');
        });
    </script>
</body>

</html>
