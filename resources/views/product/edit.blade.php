<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product - Admin Panel</title>
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
            width: 250px;
            background-color: #343a40;
            padding-top: 20px;
            transition: left 0.3s;
            z-index: 1000;
        }

        .sidebar.show {
            left: 0;
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
            padding: 20px;
            transition: margin-left 0.3s;
        }

        .content.with-sidebar {
            margin-left: 250px;
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
            height: auto;
        }

        .btn {
            margin: 2px;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                height: 100vh;
                width: 250px;
                left: -250px;
            }

            .sidebar.show {
                left: 0;
            }

            .content {
                margin-left: 0;
            }

            .header {
                left: 0;
                right: 0;
            }

            #sidebarToggle {
                left: 15px;
                top: 15px;
                z-index: 1001;
            }
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar" style="margin-top: 110px">
        <h3 class="text-white text-center">Admin Panel</h3>
     <a href="/category/dashboard" class="{{ request()->is('category/dashboard') ? 'active' : '' }}">Category List</a>
        <a href="/category/create" class="{{ request()->is('category/create') ? 'active' : '' }}">Category Create</a>
         <a href="/product/dashboard" class="{{ request()->is('product/dashboard') ? 'active' : '' }}">Product List</a>
        <a href="/product/create" class="{{ request()->is('product/create') ? 'active' : '' }}">Product Create</a>
        <a href="/" class="{{ request()->is('logout') ? 'active' : '' }}">Home</a>
        <a href="/logout" class="{{ request()->is('logout') ? 'active' : '' }}">Logout</a>
    </div>

    <!-- Sidebar Toggle Button -->
    <button class="btn btn-primary" id="sidebarToggle" aria-expanded="false" aria-controls="sidebar"
        style="position: fixed; z-index: 1001; top: 15px; left: 15px;">
        <i class="fa fa-bars" style="font-size:36px"></i>
    </button>

    <!-- Header -->
    <div class="header">
        <h1 style="margin-left: 100px">Edit Product</h1>
        <p style="margin-left: 100px">Welcome, {{ Session::get('user.name') }}!</p>
    </div>

    <!-- Main Content (Product Edit Form) -->
    <div class="content" id="content" style="padding-top: 130px;">
        <div class="container">
            <h2 class="mb-4">Update Product Information</h2>

            <!-- Display Errors -->
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger">{{ $error }}</div>
            @endforeach

            <!-- Product Edit Form -->
            <form action="{{ route('product.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Product Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $product->name) }}" placeholder="Enter Product Name" required>
                </div>

                <!-- Category -->
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="electronics" {{ $product->category == 'electronics' ? 'selected' : '' }}>Electronics</option>
                        <option value="clothing" {{ $product->category == 'clothing' ? 'selected' : '' }}>Clothing</option>
                        <option value="books" {{ $product->category == 'books' ? 'selected' : '' }}>Books</option>
                    </select>
                </div>

                <!-- Image Upload -->
                <div class="mb-3">
                    <label for="gallery" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="gallery" name="gallery" accept="image/*">
                    <img id="imagePreview" class="img-thumbnail mt-2" src="{{ asset('storage/' . $product->gallery) }}" alt="{{ $product->name }}" style="display:block;" />
                </div>

                <!-- Price -->
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" id="price" name="price" value="{{ old('price', $product->price) }}" placeholder="Enter Product Price" required>
                </div>

                <!-- Description -->
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required>{{ old('description', $product->description) }}</textarea>
                </div>

                <!-- Update Button -->
                <button type="submit" class="btn btn-primary">Update Product</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
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

        // Image Preview Logic
        document.getElementById('gallery').addEventListener('change', function (event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function (e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
            };
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>
