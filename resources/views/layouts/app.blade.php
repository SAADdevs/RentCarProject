<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Default Title')</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css" integrity="sha256-mmgLkCYLUQbXn0B1SRqzHar6dCnv9oZFPEC1g1cwlkk=" crossorigin="anonymous" />
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #ffffff;
            color: #000000;
            padding-top: 70px;
        }

        .custom-navbar {
            background-color: #ffffff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 10px 20px;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            width: 100%;
            z-index: 1000;
        }

        .btn-custom
        {
            border-radius: 10px;
            padding: 10px 20px;
            font-size: 16px;
            margin: 5px;
        }

        .custom-navbar .navbar-brand img {
            height: 40px;
        }

        .ms-2
        {
            background-color: #5fc7cc;
        }

        .navbar-nav .nav-link {
            color: #000000;
            font-weight: 500;
            margin-right: 10px;
            padding: 5px;
            margin-top: 5px;
        }

        .navbar-nav .nav-link:hover {
            color: #00cdbc;
        }

        .btn-outline-light{
            background-color: #5fc7cc;
            color: white;
        }
        .btn-outline-light:hover{
            background-color: #0a7d83;
            color: white;
        }


        .btn-outline-secondary {
            border-color: #000000;
            color: #000000;
            border-radius: 8px;
            padding: 10px 15px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            margin: 5px;
        }

        .btn-outline-secondary:hover {
            background-color: #e3e3e3;
            color: #ffffff;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
            transform: translateY(-2px);
        }

        header {
            border-bottom: 1px solid #333333;
        }

        .navbar-nav .nav-item.separator {
            border-right: 1px solid #333333;
            margin-right: 15px;
            padding-right: 15px;
        }

        .navbar-nav .nav-item.separator:last-child {
            border-right: none;
        }


        .d {
            background-color:#138496 ;
            color: #fff;
            border: none;
        }

        .d:hover {
            background-color:#197584 ;
            color: black;
        }

        .c {
            background-color:  #6c757d;
            color: #fff;
            border: none;
        }

        .c:hover {
            background-color:  #5a6268;
            color: #000000;
        }

        .b {
            background-color: #ffc107;
            color: #ffffff;
            border: none;
        }

        .b:hover {
            background-color: #e0a800;
            color: #000000;
        }

        .a {
            background-color: #28a745;
            color: #fff;
            border: none;
        }

        .a:hover {
            background-color: #218838;
            color: rgb(0, 0, 0);
        }
        .C {
            background-color: #17a2b8;
            color: #fff;
            border: none;
        }

        .C:hover {
            background-color: #138496;
            color: #000000;
        }

        .B {
            background-color: #00d4ff;
            color: #ffffff;
            border: none;
        }

        .B:hover {
            background-color: #73c7d8;
            color: #000000;
        }

        .A {
            background-color: #5d6ed7;
            color: #fff;
            margin-top: 10px;
            padding: 10px;
        }

        .A:hover {
            background-color: #5261c5;
            color: white;

        }
        .admin-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 15px;
        color: #fff;
    }
    </style>
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg custom-navbar">
            <div class="container-fluid">
                <a class="navbar-brand" href="
                    @auth
                        @if(auth()->user()->role == 'owner')
                            /owners
                        @elseif(auth()->user()->role == 'admin')
                            /admin
                        @elseif(auth()->user()->role == 'customer')
                            /costumers
                        @else
                            /
                        @endif
                    @else
                        /
                    @endauth">
                    <img src="{{ asset('images/logo.png') }}" alt="Logo" width="200px" height="60px">
                </a>
                @auth
                @if(auth()->user()->role == 'owner')
                <li class="nav-item d-inline-block">
                    <a href="{{ route('CreateCar') }}" class="nav-link c btn btn-outline-secondary">Create Your Car</a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="{{ route('myCars') }}" class="nav-link d btn btn-outline-secondary">See All My Cars</a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="{{ route('myRentalCars') }}" class="nav-link b btn btn-outline-secondary">Current Rentals</a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="{{ route('rentalRequests') }}" class="nav-link a btn btn-outline-secondary">Rental Requests</a>
                </li>
                @elseif(auth()->user()->role == 'admin')
                <li class="nav-item d-inline-block">
                    <a href="{{ route('users') }}" class="btn btn-custom A btn-info-custom">Manage Users</a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="{{ route('adminCars') }}" class="btn btn-custom C btn-secondary-custom">Manage Cars</a>
                </li>
                <li class="nav-item d-inline-block">
                    <a href="{{ route('allRetals') }}" class="btn btn-custom B btn-warning-custom">View Rentals</a>
                </li>
                @elseif(auth()->user()->role == 'customer')
                <li class="nav-item d-inline-block">
                    <a href="{{ route('rentalStatus') }}" class="btn C mb-4">View My Rental Status</a>
                </li>
                @endif
                @endauth
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                    <ul class="navbar-nav">
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="/">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#about">About</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#features">Features</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#services">Services</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light" href="{{ route('login') }}">Login</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-light" href="{{ route('register') }}">Register</a>
                        </li>
                        @endguest
                        @auth
                        <li class="nav-item">
                            <a class="nav-link btn btn-outline-secondary ms-2" href="{{ route('logout') }}"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                        </li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
    </header>


<div>
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
