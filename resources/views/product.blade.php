@extends('master')

@section('content')
<!-- Search Form visible only on mobile -->
<form class="d-flex d-md-none mb-3" action="/search" method="GET">
    <input type="text" class="form-control" name="query" placeholder="Search products..." required>
    <button class="btn btn-success" type="submit">Search</button>
</form>

<div class="custom-product">
    <div class="container mb-4">
        <h1 class="text-center">Products</h1>
    </div>
    <div class="row">
        <div class="col-md-3 mb-4">
            <!-- Optionally, you can include a mobile search bar here too if you want it to be on the side -->
        </div>
        <div class="col-md-9">
            <div class="trending-wrapping">
                <div class="d-flex flex-wrap justify-content-center">
                    @foreach ($products as $item)
                    <div class="trending-item col-md-4 col-sm-6 mb-4">
                        <a href="detail/{{ $item['id'] }}" class="text-decoration-none">
                            <img class="trending-image img-fluid" src="{{ asset('storage/' . $item['gallery']) }}" alt="{{ $item['name'] }}">
                            <div class="p-3">
                                <h5 class="text-black">{{ $item['name'] }}</h5>
                                <p class="text-muted">{{ Str::limit($item['description'], 50) }}</p>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<hr>
@endsection

<style>
    .custom-product {
        padding: 40px 15px;
        background-color: #f8f9fa; /* Light background for better contrast */
    }

    .trending-image {
        height: 200px; /* Set a fixed height for trending images */
        object-fit: cover; /* Ensures images cover the area */
        transition: transform 0.3s; /* Smooth image transition */
    }

    .trending-item {
        transition: transform 0.3s, box-shadow 0.3s; /* Add transition for effects */
        width: 100%; /* Ensures the item uses full width in the flex container */
        max-width: 250px; /* Sets a maximum width for each item */
    }

    .trending-item:hover {
        transform: scale(1.05); /* Slight zoom effect */
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1); /* Subtle shadow on hover */
    }

    .btn-success {
        background-color: #28a745; /* Green color for buttons */
        border-color: #28a745; /* Border color matching button */
    }

    .btn-success:hover {
        background-color: #218838; /* Darker green on hover */
        border-color: #1e7e34; /* Darker border on hover */
    }

    @media (max-width: 768px) {
        .trending-item {
            margin-bottom: 20px; /* Extra margin for smaller screens */
        }
    }
</style>
