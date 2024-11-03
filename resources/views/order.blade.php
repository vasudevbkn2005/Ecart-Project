@extends('master')

@section('content')
<div class="custom-product">
    <h1 class="mb-4 text-center">Order Summary</h1>
    <table class="table table-bordered table-striped">
        <tbody>
            <tr>
                <th>Price</th>
                <td>₹{{ $total }}</td>
            </tr>
            <tr>
                <th>Tax</th>
                <td>₹0</td>
            </tr>
            <tr>
                <th>Delivery</th>
                <td>₹100</td>
            </tr>
            <tr class="font-weight-bold">
                <th>Total Amount</th>
                <td>₹{{ $total + 100 }}</td>
            </tr>
        </tbody>
    </table>
    
    <form action="/orderplace" method="POST">
        @csrf
        <div class="form-group">
            <textarea class="form-control" name="address" placeholder="Enter Your Address" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="">Payment Method</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" value="online" name="payment" id="online" required>
                <label class="form-check-label" for="online">Online Payment</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" value="emi" name="payment" id="emi">
                <label class="form-check-label" for="emi">EMI Payment</label>
            </div>
            <div class="form-check">
                <input type="radio" class="form-check-input" value="delivery" name="payment" id="delivery">
                <label class="form-check-label" for="delivery">Payment On Delivery</label>
            </div>
        </div>
        
        <button type="submit" class="btn btn-primary">Confirm Order</button>
    </form>
</div>

<style>
.custom-product {
    padding: 40px;
    background-color: #f4f4f4;
}

.table {
    background-color: white;
    border-radius: 5px;
    overflow: hidden;
}

.table th, .table td {
    padding: 15px;
    text-align: left;
}

.table-striped tbody tr:nth-of-type(odd) {
    background-color: #f9f9f9;
}

button {
    margin-top: 20px;
    width: 100%;
}

button:hover {
    background-color: #0056b3; /* Darker blue */
}

@media (max-width: 576px) {
    .custom-product {
        padding: 20px; /* Reduce padding for smaller screens */
    }
}
</style>

@endsection 