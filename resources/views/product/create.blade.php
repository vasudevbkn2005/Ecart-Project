<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Product Create</title>
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
    </style>
</head>

<body>
    <div class="sidebar">
        <h3 class="text-white text-center">Admin Panel</h3>
        <a href="/product/dashboard">Product List</a>
        <a href="/product/create">Product Create</a>
        <a href="/product/reports">Reports</a>
        <a href="/logout">Logout</a>
    </div>

    <div class="header">
        <h1>Create Product</h1>
        <p>Welcome, {{ Session::get('user.name') }}!</p> <!-- Display the admin's name -->
    </div>

    <div class="content" style="padding-top: 130px;">
        <div class="container">
            <h2 class="mb-4">Add a New Product</h2>
            @foreach ($errors->all() as $er)
                <h4 class="alert alert-danger">{{ $er }}</h4>
            @endforeach
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Product Name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                        <!-- Add more categories -->
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gallery" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="gallery" name="gallery" accept="image/*" required>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Product Price" id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <input type="text" class="form-control" placeholder="Enter Description" id="description" name="description" required>
                </div>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
        </div>
    </div>

    <div class="footer">
        <p>&copy; 2024 Your Company</p>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
