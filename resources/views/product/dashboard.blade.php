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
            left: -250px;
            /* Start hidden off-screen */
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            transition: left 0.3s;
            /* Smooth transition */
            z-index: 1000;
            /* Ensure it sits above other content */
        }

        .sidebar.show {
            left: 0;
            /* Slide in */
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
            margin-left: 0;
            /* No margin when sidebar is hidden */
            padding: 20px;
            transition: margin-left 0.3s;
            /* Smooth transition */
        }

        .content.with-sidebar {
            margin-left: 250px;
            /* Margin for content when sidebar is visible */
        }

        .header {
            background-color: #343a40;
            color: #fff;
            padding: 15px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 999;
            /* Ensure header is above sidebar */
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

        .img-thumbnail {
            max-width: 100px;
            /* Set max width for images */
            height: auto;
        }

        /* Ensure buttons are visible */
        .btn {
            margin: 2px;
            /* Margin for better spacing */
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100vh;
                width: 250px;
                left: -250px;
                /* Start hidden off-screen */
            }

            .sidebar.show {
                left: 0;
                /* Slide in */
            }

            .content {
                margin-left: 0;
                /* No margin when sidebar is hidden */
            }

            .header {
                left: 0;
                right: 0;
            }

            #sidebarToggle {
                left: 15px;
                /* Position the button on the left */
                top: 15px;
                /* Position the button at the top */
                z-index: 1001;
                /* Ensure the toggle button is above other elements */
            }
        }
    </style>
</head>

<body>
    <div class="sidebar" id="sidebar" style="margin-top: 110px">
        <h3 class="text-white text-center">Admin Panel</h3>
        <a href="/product/dashboard" class="{{ request()->is('product/dashboard') ? 'active' : '' }}">Product List</a>
        <a href="/product/create" class="{{ request()->is('product/create') ? 'active' : '' }}">Product Create</a>
        <a href="/" class="{{ request()->is('logout') ? 'active' : '' }}">Home</a>
        <a href="/logout" class="{{ request()->is('logout') ? 'active' : '' }}">Logout</a>
    </div>

    <button class="btn btn-primary" id="sidebarToggle" aria-expanded="false" aria-controls="sidebar"
        style="position: fixed; z-index: 1001; top: 15px; left: 15px;">
        <i class="fa fa-bars" style="font-size:36px"></i>
    </button>

    <div class="header">
        <h1 style="margin-left: 100px">Product List</h1>
        <p style="margin-left: 100px">Welcome, {{ Session::get('user.name') }}!</p>
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
                                    <img src="{{ asset('storage/' . $item->gallery) ?: asset('path/to/placeholder-image.jpg') }}"
                                        class="img-thumbnail" alt="{{ $item->name }}">
                                </td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->category }}</td>
                                <td>₹{{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->description }}</td>
                                <td>
                                    <a href="/product/edit/{{ $item->id }}" class="btn btn-warning btn-sm">Edit</a>
                                </td>
                                <td>
                                    <form action="{{ route('product.destroy', $item->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE') <!-- Use DELETE method -->
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Are you sure you want to delete this product?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const sidebar = document.getElementById('sidebar');
        const content = document.getElementById('content');
        const toggleButton = document.getElementById('sidebarToggle');

        toggleButton.addEventListener('click', () => {
            const isOpen = sidebar.classList.toggle('show');
            content.classList.toggle('with-sidebar');
            toggleButton.setAttribute('aria-expanded', isOpen);
        });
    </script>
</body>

</html>
