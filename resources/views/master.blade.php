<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MyShop</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f4f4;
        }
        .navbar {
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            transition: background-color 0.3s ease;
        }
        .navbar.scrolled {
            background-color: #f8f9fa;
        }
        .navbar-brand img {
            height: 40px;
            transition: transform 0.3s;
        }
        .navbar-brand img:hover {
            transform: scale(1.1);
        }
        .nav-link {
            font-weight: 500;
            margin: 0 10px;
        }
        .nav-link:hover {
            color: #28a745;
        }
        .search-box {
            width: 300px;
        }
        footer {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        .footer-content {
            max-width: 1200px;
            margin: 0 auto;
        }
        .social-links {
            margin-top: 10px;
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .social-links a {
            margin: 0 15px;
        }
        .social-links img {
            width: 30px;
            transition: transform 0.2s;
        }
        .social-links img:hover {
            transform: scale(1.1);
        }
        .profile-sidebar {
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            padding: 20px;
            margin-top: 20px;
        }
        .profile-sidebar h4 {
            margin-bottom: 15px;
        }
        .profile-sidebar p {
            margin: 5px 0;
        }
        .profile-sidebar .btn {
            margin-right: 10px;
        }
        @media (max-width: 600px) {
            footer {
                padding: 15px;
            }
            .social-links a {
                margin: 0 5px;
            }
        }
    </style>
</head>

<body>
    <?php 
    use App\Http\Controllers\ProductController;
    $total = 0;
    if(Session::has('user')) {
        $total = ProductController::cartItem(); 
        $user = Session::get('user');
    }
    ?>

    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
                <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ8C8OqLN8b07nWYOvyJqKH_gBz1khrb024OQ&s" alt="Ecart Logo">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/"><i class="fa fa-home" style="font-size:36px"></i></a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/myorders">Orders</a>
                    </li>
                    <li class="nav-item" style="margin-left: 250px;">
                        <form action="/search" class="d-none d-lg-flex">
                            <input class="form-control me-2 search-box" name="query" autocomplete="off" type="search" placeholder="Search" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit"><i class="fa fa-search"></i></button>
                        </form>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/cartlist">
                            <i class="fa fa-shopping-cart" style="font-size:24px">{{$total}}</i>
                        </a>
                    </li>
                    @if(Session::has('user'))
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                {{ $user['name'] }}
                            </a>
                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="#" data-bs-toggle="collapse" data-bs-target="#profileSidebar">Profile</a></li>
                                <li><a class="dropdown-item" href="/myorders">My Orders</a></li>
                                @if($user['role'] == 'admin')
                                    <li><a class="dropdown-item" href="/product/dashboard">Admin Dashboard</a></li>
                                    <li><a class="dropdown-item" href="/product/manage-users">Manage Users</a></li>
                                @endif
                                <li><a class="dropdown-item" href="/logout">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="/login"><i class="fa fa-user" style="font-size:24px"></i></a>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    <!-- Profile Sidebar -->
    <div class="collapse" id="profileSidebar">
        <div class="profile-sidebar p-3 bg-light">
            <h4>Your Profile</h4>
            @if(Session::has('user'))
                <p><strong>Name:</strong> {{ $user['name'] }}</p>
                <p><strong>Email:</strong> {{ $user['email'] }}</p>
                <p><strong>Role:</strong> {{ $user['role'] == 'admin' ? 'Admin' : 'User' }}</p>
            @else
                <p>No user information available. Please log in.</p>
            @endif
            <a href="/edit-profile" class="btn btn-primary">Edit Profile</a>
            <a href="/myorders" class="btn btn-secondary">View Orders</a>
        </div>
    </div>

    @yield('content')

    <footer>
        <div class="footer-content">
            <p>&copy; 2024 MyShop. All rights reserved.</p>
            <div class="social-links">
                <a href="https://www.facebook.com/yourprofile" target="_blank" aria-label="Facebook">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/c/cd/Facebook_logo_%28square%29.png" alt="Facebook Icon">
                </a>
                <a href="https://wa.me/yourphonenumber" target="_blank" aria-label="WhatsApp">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/6/6b/WhatsApp.svg/2044px-WhatsApp.svg.png" alt="WhatsApp Icon">
                </a>
                <!-- Add more social icons as needed -->
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script>
        // Change navbar background on scroll
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('
