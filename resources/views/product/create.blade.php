<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - Create Product</title>
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

        .sidebar h3 {
            color: #fff;
            text-align: center;
            margin-bottom: 20px;
        }

        .sidebar a {
            color: #fff;
            padding: 15px;
            text-decoration: none;
            display: block;
            transition: background-color 0.3s;
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
    <div class="sidebar" id="sidebar" style="margin-top: 110px">
        <h3>Admin Panel</h3>
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
        <h1 style="margin-left: 100px">Product Create</h1>
        <p style="margin-left: 100px">Welcome, {{ Session::get('user.name') }}!</p>
    </div>

    <div class="content" id="content" style="padding-top: 130px;">
        <div class="container">
            <h2 class="mb-4">Add a New Product</h2>
            @foreach ($errors->all() as $er)
                <h4 class="alert alert-danger">{{ $er }}</h4>
            @endforeach
            <form action="{{ route('product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Product Name</label>
                    <input type="text" class="form-control" id="name" placeholder="Enter Product Name"
                        name="name" required>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-control" id="category" name="category" required>
                        <option value="">Select a category</option>
                        <option value="electronics">Electronics</option>
                        <option value="clothing">Clothing</option>
                        <option value="books">Books</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="gallery" class="form-label">Image Upload</label>
                    <input type="file" class="form-control" id="gallery" name="gallery" accept="image/*" required>
                    <img id="imagePreview" class="img-thumbnail mt-2" style="display:none;" />
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Price</label>
                    <input type="number" step="0.01" class="form-control" placeholder="Enter Product Price"
                        id="price" name="price" required>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Create Product</button>
            </form>
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
            const isOpen = sidebar.classList.toggle('show');
            content.classList.toggle('with-sidebar');
            toggleButton.setAttribute('aria-expanded', isOpen);
        });

        document.getElementById('gallery').addEventListener('change', function(event) {
            const file = event.target.files[0];
            const reader = new FileReader();
            reader.onload = function(e) {
                const imagePreview = document.getElementById('imagePreview');
                imagePreview.src = e.target.result;
                imagePreview.style.display = 'block';
            }
            reader.readAsDataURL(file);
        });
    </script>
</body>

</html>
