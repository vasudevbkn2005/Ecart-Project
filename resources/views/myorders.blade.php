@extends('master')
@section('content')
<div class="custom-product">
    <div class="row mb-10">
        <div class="col-md-9 col-sm-12 mx-auto">
            <div class="trending-wrapper">
                <h1 class="mb-4">Order List</h1>
                @if (count($orders) > 0)
                    <div class="mt-4 text-right mb-3">
                        <a href="/" class="btn btn-success">More Shopping</a>
                    </div>
                    <div class="row">
                        @php $totalPrice = 0; @endphp
                        @foreach ($orders as $item)
                            @php $totalPrice += $item->price; @endphp
                            <div class="col-12 mb-3">
                                <div class="row border rounded p-3 align-items-center shadow-sm">
                                    <div class="col-md-2 col-sm-4 text-center">
                                        <a href="detail/{{ $item->id }}" class="text-decoration-none">
                                            <img class="img-fluid rounded" src="{{ $item->gallery }}" alt="{{ $item->name }}">
                                        </a>
                                    </div>
                                    <div class="col-md-5 col-sm-8">
                                        <h5 class="text-black">{{ $item->name }}</h5>
                                        <p class="text-muted">Delivery Status: {{ $item->status }}</p>
                                        <p class="text-muted">Payment Status: {{ $item->payment_status }}</p>
                                        <p class="text-muted">Payment Method: {{ $item->payment_method }}</p>
                                        <p class="text-muted">Delivery Address: {{ $item->address }}</p>
                                        <h6 class="text-muted">Price: ₹{{ $item->price }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="text-right">
                        <h5>Total Price: ₹{{ $totalPrice }}</h5>
                    </div>
                @else
                    <p>No orders found.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

<style>
.custom-product {
    padding: 40px;
    background-color: #f4f4f4;
}

.trending-wrapper {
    background-color: #f9f9f9;
    border: 1px solid #ddd;
    border-radius: 5px;
    padding: 15px;
}

.border {
    border: 1px solid #eaeaea;
}

.rounded {
    border-radius: 5px;
}

.img-fluid {
    border-radius: 5px;
    object-fit: cover;
    transition: transform 0.2s;
    height: 100px; /* Ensure consistent height */
}

.img-fluid:hover {
    transform: scale(1.05);
}

h1, h4 {
    font-weight: bold;
}

.text-danger {
    font-size: 1.25rem;
    font-weight: bold;
}

button {
    width: 100%;
}

button:hover {
    background-color: #0056b3; /* Darker blue */
}

@media (max-width: 768px) {
    .img-fluid {
        height: auto; /* Responsive image height */
    }

    .text-right {
        text-align: center; /* Center elements on small screens */
    }
}
</style>
