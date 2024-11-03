@extends('master')
@section('content')
    <div class="container custom-login mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4">
                <h2 class="text-center mb-4">Login</h2>
                <form action="/login" method="post">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" autocomplete="off" class="form-control" id="email" name="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Login</button>
                </form>
                <div class="text-center mt-3">
                    <a href="/register">Don't have an account? Register here</a>
                </div>
            </div>
        </div>
    </div>
@endsection
