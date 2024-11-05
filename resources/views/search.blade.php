@extends('master')
@section('content')

<div class="custom-product">
    <form class="d-flex d-md-none mb-3" action="/search" method="GET">
    <input type="text" class="form-control" name="query" placeholder="Search products..." required>
    <button class="btn btn-success" type="submit">Search</button>
</form>
    <div class="row">
        <!-- Filter Sidebar (Only visible on medium and larger screens) -->
        <div class="col-md-3 col-sm-12 filter-sidebar" id="filterSidebar">
            <h5>Filter</h5>
            
            <!-- Category Filter -->
            <div class="mb-3">
                <h6>Categories</h6>
                <select class="form-control" name="category">
                    <option value="">All Categories</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="home">Home</option>
                    <!-- Add more categories as needed -->
                </select>
            </div>

            <!-- Price Filter -->
            <div class="mb-3">
                <h6>Price Range</h6>
                <select class="form-control" name="price">
                    <option value="">Any Price</option>
                    <option value="0-50">$0 - $50</option>
                    <option value="50-100">$50 - $100</option>
                    <option value="100-200">$100 - $200</option>
                    <option value="200-500">$200 - $500</option>
                    <option value="500+">$500+</option>
                </select>
            </div>

            <!-- Brand Filter -->
            <div class="mb-3">
                <h6>Brands</h6>
                <select class="form-control" name="brand">
                    <option value="">Any Brand</option>
                    <option value="nike">Nike</option>
                    <option value="apple">Apple</option>
                    <option value="samsung">Samsung</option>
                    <!-- Add more brands as needed -->
                </select>
            </div>

            <!-- Submit Filter Button -->
            <button class="btn btn-primary btn-block">Apply Filters</button>
        </div>

        <!-- Product Listings -->
        <div class="col-md-9 col-sm-12">
            <div class="trending-wrapper">
                <h1>Search Results</h1>
                <div class="row">
                    @foreach ($products as $item)
                        <div class="col-lg-4 col-md-6 col-sm-12 mb-4">
                            <div class="search-item border rounded p-3">
                                <a href="detail/{{$item['id']}}" class="text-decoration-none">
                                    <img class="trending-img img-fluid" src="{{ asset('storage/' . $item['gallery']) }}" alt="{{$item['name']}}" height="200px">
                                    <div class="text-center mt-2">
                                        <h3 class="text-black">{{$item['name']}}</h3>
                                        <h3 class="text-black">${{$item['price']}}</h3>
                                        <h5 class="text-muted">{{$item['description']}}</h5>
                                    </div>
                                </a>
                            </div>  
                        </div>  
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

<style>
    .custom-product {
        padding: 20px;
    }

    .filter-sidebar {
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .search-item {
        transition: transform 0.2s;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
    }

    .search-item:hover {
        transform: scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .trending-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        border-radius: 8px;
    }

    .text-center h3 {
        font-size: 1.25rem;
    }

    .text-center h5 {
        font-size: 1rem;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        /* Hide the filter sidebar completely on smaller screens */
        .filter-sidebar {
            display: none !important; /* This hides the filter on mobile devices */
        }

        /* Adjust layout for small screens */
        .search-item {
            padding: 15px;
        }

        .custom-product {
            padding: 15px;
        }

        .text-center h3 {
            font-size: 1.1rem;
        }

        .text-center h5 {
            font-size: 0.9rem;
        }
    }

    @media (max-width: 576px) {
        .text-center h3 {
            font-size: 1rem;
        }

        .text-center h5 {
            font-size: 0.8rem;
        }

        .search-item {
            padding: 10px;
        }

        .custom-product {
            padding: 10px;
        }
    }
</style>
