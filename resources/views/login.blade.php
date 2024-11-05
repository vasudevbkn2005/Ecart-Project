@extends('master')

@section('content')
    <div class="container custom-login mt-5">
        <div class="row justify-content-center">
            <div class="col-sm-6 col-md-4">
                <div class="card shadow-sm">
                    <div class="card-body" style="margin-bottom: 200px">
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
        </div>
    </div>
@endsection

@push('styles')
    <style>
        /* Custom styles for the login page */
        .custom-login {
            background-color: #f9f9f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .card {
            border-radius: 10px;
            width: 100%;
            max-width: 400px;
        }

        .card-body {
            padding: 30px;
        }

        .btn-primary {
            padding: 12px;
            font-size: 16px;
            border-radius: 5px;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border-radius: 5px;
            padding: 10px;
        }

        .text-center a {
            font-size: 14px;
        }

        /* Mobile responsiveness */
        @media (max-width: 576px) {
            .custom-login {
                padding: 15px;
            }

            .card-body {
                padding: 20px;
            }

            .btn-primary {
                font-size: 14px;
                padding: 10px;
            }
        }
    </style>
@endpush
