@extends('master')

@section('content')
<div class="custom-product">
    <div class="row mb-10">
        <div class="col-md-9 col-sm-12 mx-auto">
            <div class="trending-wrapper">
                <h1 class="mb-4 text-center">Shopping Cart</h1>
                @if (count($products) > 0)
                    <div class="mt-4 text-right mb-3">
                        <a href="/" class="btn btn-success">More Shopping</a>
                    </div>
                    <div class="row">
                        @php $totalPrice = 0; @endphp
                        @foreach ($products as $item)
                            @php $totalPrice += $item->price; @endphp
                            <div class="col-12 mb-3">
                                <div class="row border rounded p-3 align-items-center">
                                    <div class="col-md-2 col-sm-4 text-center">
                                        <a href="detail/{{ $item->id }}" class="text-decoration-none">
                                            <img class="img-fluid rounded" src="{{ $item->gallery }}" alt="{{ $item->name }}" height="100px">
                                        </a>
                                    </div>
                                    <div class="col-md-5 col-sm-8">
                                        <h5 class="text-black">{{ $item->name }}</h5>
                                        <p class="text-muted">{{ $item->description }}</p>
                                        <h6 class="text-danger" id="price-{{ $item->cart_id }}">₹{{ $item->price }}</h6>
                                    </div>
                                    <div class="col-md-3 text-center">
                                        <div class="d-flex align-items-center">
                                            <button class="btn btn-custom btn-minus" type="button" data-cart-id="{{ $item->cart_id }}">-</button>
                                            <input type="text" readonly value="1" min="1" class="form-control quantity-input mx-2" data-price="{{ $item->price }}" data-cart-id="{{ $item->cart_id }}" aria-label="Quantity" style="width: 70px;">
                                            <button class="btn btn-custom btn-plus" type="button" data-cart-id="{{ $item->cart_id }}">+</button>
                                        </div>
                                        <a href="/removeCart/{{$item->cart_id}}" class="btn btn-danger mt-2" >Remove</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-4 text-right">
                        <h4 class="font-weight-bold" id="total-price">Total: ₹{{ $totalPrice }}</h4>
                        <a href="/order" class="btn btn-primary">Proceed to Checkout</a>
                    </div>
                @else
                    <div class="text-center">
                        <h3>No items found in the cart.</h3>
                        <a href="/" class="btn btn-primary mt-3">Continue Shopping</a>
                    </div>
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

/* Custom styles for Plus and Minus buttons */
.btn-custom {
    background-color: #007bff; /* Change this to your desired color */
    color: white;
}

.btn-custom:hover {
    background-color: gray; /* Darker shade on hover */
}

@media (max-width: 768px) {
    .img-fluid {
        height: auto; /* Responsive image height */
    }

    .text-right {
        text-align: center; /* Center total price and button on small screens */
    }

    .col-md-3 {
        margin-top: 10px; /* Add some margin on small screens */
    }
}
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInputs = document.querySelectorAll('.quantity-input');
        const totalPriceElement = document.getElementById('total-price');

        quantityInputs.forEach(input => {
            input.addEventListener('input', function() {
                updatePrice(this);
            });
        });

        // Plus and Minus button functionality
        document.querySelectorAll('.btn-plus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.previousElementSibling; // Get the input element
                input.value = parseInt(input.value) + 1; // Increase quantity
                updatePrice(input);
            });
        });

        document.querySelectorAll('.btn-minus').forEach(button => {
            button.addEventListener('click', function() {
                const input = this.nextElementSibling; // Get the input element
                if (parseInt(input.value) > 1) { // Prevent going below 1
                    input.value = parseInt(input.value) - 1; // Decrease quantity
                    updatePrice(input);
                }
            });
        });

        function updatePrice(input) {
            const price = parseFloat(input.dataset.price);
            const quantity = parseInt(input.value);
            const itemPriceElement = document.getElementById('price-' + input.dataset.cartId);

            // Update the individual item price
            itemPriceElement.innerText = '₹' + (price * quantity).toFixed(2);

            // Update the total price
            let totalPrice = 0;
            quantityInputs.forEach(inp => {
                const qty = parseInt(inp.value);
                totalPrice += (parseFloat(inp.dataset.price) * qty);
            });
            totalPriceElement.innerText = 'Total: ₹' + totalPrice.toFixed(2);
        }
    });
</script>
