<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title', 'Katering Portal')</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    @stack('styles')
    <style>
        html, body {
            height: 100%;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #e0e0e0;
            background-color: #121212;
        }
        body {
            display: flex;
            flex-direction: column;
        }
        .content {
            flex: 1;
        }
        .hero {
            background: url('/bg.jpg') no-repeat center center;
            background-size: cover;
            color: #e0e0e0;
            padding: 60px 0;
            text-align: center;
            background-color: #333;
        }
        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            color: #e0e0e0;
        }
        .hero p {
            font-size: 1.25rem;
            color: #b0b0b0;
        }
        .navbar {
            background-color: #1f1f1f;
        }
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #e0e0e0;
        }
        .navbar-nav {
            margin-left: auto;
        }
        .navbar-nav .nav-link {
            font-size: 1rem;
            color: #e0e0e0;
        }
        .navbar-nav .nav-link:hover {
            color: #007bff;
        }
        .footer {
            background-color: #1f1f1f;
            padding: 20px 0;
            font-size: 0.875rem;
            color: #e0e0e0;
        }
        .footer p {
            margin: 0;
        }
        .btn-primary {
            background-color: #007bff;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
            border-color: #004085;
        }
        .btn-link {
            color: #e0e0e0;
        }
        .btn-link:hover {
            color: #007bff;
        }
        .card {
            background-color: #2c2c2c;
            border: 1px solid #444;
        }
        .card-header {
            background-color: #333;
            color: #e0e0e0;
        }
        .card-body {
            color: #e0e0e0;
        }
        .form-control {
            background-color: #333;
            color: #e0e0e0;
            border: 1px solid #444;
        }
        .form-control::placeholder {
            color: #888;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: none;
        }
        .invalid-feedback {
            color: #dc3545;
        }
        .list-group {
            background-color: #2c2c2c;
            border-radius: 0.25rem;
        }

        .list-group-item {
            background-color: #333;
            color: #e0e0e0;
            border: 1px solid #444;
        }

        .list-group-item:hover {
            background-color: #444;
            color: #fff;
        }

        .list-group-item.active {
            background-color: #007bff;
            color: #fff;
            border-color: #007bff;
        }

    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark">
            <a class="navbar-brand" href="{{ route('home') }}">Katering Portal</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    @auth
                        @if (Auth::user()->role_name === 'merchant')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('merchants.index') }}">Dashboard Merchant</a>
                            </li>
                        @elseif (Auth::user()->role_name === 'customer')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customers.index') }}">Dashboard Customer</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('customers.orders.index') }}">Orders</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a class="nav-link" href="{{ route('customers.profile') }}">Profile</a>
                            </li> --}}
                        @endif
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" style="display: inline;">
                                @csrf
                                <button type="submit" class="nav-link btn btn-link">Logout</button>
                            </form>
                        </li>
                    @else
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('/') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('register.form') }}">Register</a>
                        </li>
                    @endauth
                </ul>
            </div>
        </nav>
    </header>

    <main class="container mt-4 content">
        @yield('content')
    </main>

    <footer class="footer text-center">
        <div class="container">
            <p>&copy; {{ date('Y') }} Katering Portal. All rights reserved.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
