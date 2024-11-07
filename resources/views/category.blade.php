@extends('master')

@section('content')
<!-- Search Form visible only on mobile -->
<form class="d-flex d-md-none mb-3" action="/search" method="GET">
    <input type="text" class="form-control" name="query" placeholder="Search categories..." required>
    <button class="btn btn-success ms-2" type="submit">Search</button>
</form>

<div class="custom-category">
    <div class="container mb-4">
        <h1 class="text-center display-4">Categories</h1>
    </div>
    <div class="row">
        <!-- Mobile Search Bar Option (on the side) if needed -->
        <div class="col-md-3 mb-4">
            <!-- Optional Side Search or Filters -->
        </div>

        <div class="col-md-9">
            <div class="trending-wrapping">
                <div class="d-flex flex-wrap justify-content-center">
                    @foreach ($category as $item)
                    <div class="trending-item col-md-4 col-sm-6 mb-4">
                        <a href="{{ route('category.products', $item->id) }}" class="text-decoration-none">
                            <div class="category-card">
                                <img class="trending-image img-fluid" src="{{ asset('storage/' . $item->image) }}" alt="{{ $item->name }}">
                                <div class="p-3">
                                    <h5 class="text-dark fw-bold">{{ $item->name }}</h5>
                                    <p class="text-muted">{{ Str::limit($item->description, 70) }}</p>
                                    <button class="btn btn-outline-success mt-2">View Products</button>
                                </div>
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
    