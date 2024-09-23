@extends('layouts.app')

@section('title', 'Customer Page')

@section('content')
<br>
<style>
    body {
        background-color: #FAF9F6;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        max-width: 1200px;
    }

    h1 {
        color: #343a40;
        font-weight: bold;
        text-transform: uppercase;
        margin-bottom: 20px;
    }

    .hero-section {
        background-image: url('{{ asset('images/bgcus.jpg') }}');
        background-size: cover;
        background-position: center;
        height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        margin-top: -70px;
    }

    .hero-text {
        color: white;
        font-size: 2rem;
        font-weight: bold;
        text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
        text-align: center;
        margin-bottom: 20px;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        background-color: #ffffff;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 20px;
        background-color: #fff;
        border-top: 5px solid #2E5090;
        border-radius: 0 0 10px 10px;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.25rem;
        color: #343a40;
        margin-bottom: 10px;
    }

    .card-text {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 15px;
    }

    .btn-primary {
        background: linear-gradient(45deg, #2774AE,#2E5090);
        border: none;
        border-radius: 20px;
        padding: 10px 20px;
        text-transform: uppercase;
        letter-spacing: 1px;
        transition: background 0.2s ease;
        margin-top: 20px;
    }

    .btn-primary:hover {
        background: linear-gradient(45deg, #007bff, #4676a9);
    }

    .btn-secondary {
        background-color: #6c757d;
        color: #ffffff;
        border-radius: 20px;
        padding: 10px 20px;
        border: none;
        transition: background 0.3s ease;
    }

    .btn-secondary:hover {
        background-color: #5a6268;
    }

    .search-form {
        border: 1px solid #ddd;
        border-radius: 30px;
        padding: 20px;
        background-color: rgba(255, 255, 255, 0.9);
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        margin-bottom: 40px;
    }

    .search-form label {
        font-weight: bold;
        color: #343a40;

    }

    .search-form .form-control {
        border-radius: 20px;
        padding: 10px;
    }

    .search-form .date-input {
        background-color: #ffffff;
        border: 1px solid #ced4da;
        border-radius: 50px;
        padding: 10px 20px;
        font-size: 1rem;
        color: #495057;
        width: 100%;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
        position: relative;
    }

    .search-form .date-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
        outline: none;
    }

    .alert {
        border-radius: 20px;
        padding: 15px 20px;
        font-size: 1.1rem;
        margin-bottom: 20px;
    }

    .info-text {
        font-size: 1rem;
        color: #6c757d;
        text-align: center;
    }
    h1.text-center {
    font-size: 2.5rem;
    font-weight: bold;
    color: #333;
    margin-top: 20px;
    margin-bottom: 20px;
    text-align: center;
    text-transform: uppercase;
    letter-spacing: 1px;
    line-height: 1.2;
    font-family: 'Arial', sans-serif;
    background-color: #73c7d8;
    border-radius: 20px;
    width: 800px;
    margin: 60px;
}

</style>
<div class="hero-section">
    <form method="POST" action="{{ route('searchingCar') }}" class="search-form mb-4">
        @csrf
        <div class="row">
            <div class="col-md-3 mb-3">
                <label for="city">Search by City</label>
                <input type="text" id="city" name="city" class="form-control" placeholder="City" value="{{ request('city') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="start_date">Starting Date</label>
                <input type="date" id="start_date" name="start_date" class="form-control date-input" value="{{ request('start_date') }}">
            </div>
            <div class="col-md-3 mb-3">
                <label for="end_date">Ending Date</label>
                <input type="date" id="end_date" name="end_date" class="form-control date-input" value="{{ request('end_date') }}">
            </div>
            <div class="col-md-3 mb-3">
                <button type="submit" class="btn btn-primary w-100">Search</button>
            </div>
        </div>
    </form>
</div>

<br>
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="container mt-5">
    <h1 class="text-center">Available Cars</h1>

    @if(request()->has('city') || request()->has('start_date') || request()->has('end_date'))
        <div class="alert alert-info">
            Showing results for cars in
            <strong>{{ request('city') ? request('city') : 'all cities' }}</strong>
            @if(request('start_date') && request('end_date'))
                from <strong>{{ request('start_date') }}</strong>
                to <strong>{{ request('end_date') }}</strong>.
            @elseif(request('city'))
                .
            @endif
        </div>
    @endif

    <div class="row">
        @forelse ($availableCars as $car)
            <div class="col-md-4 mb-4">
                <div class="card">
                    <img src="{{ asset('images/' . $car->image_url) }}" class="card-img-top" alt="{{ $car->model }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $car->model }}</h5>
                        <p class="card-text"><i class="fas fa-map-marker-alt"></i> from <b> {{ $car->city }}</b></p>
                        <p class="card-text"><i class="fas fa-dollar-sign"></i> Price per day:<b> ${{ number_format($car->price_per_day, 2) }}</b></p>
                        <a href="{{ route('viewCarDetails', $car->id) }}" class="btn btn-primary w-100">View Details</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No cars available for the selected criteria.
                </div>
            </div>
        @endforelse
    </div>
</div>

<script>
      document.addEventListener('DOMContentLoaded', function() {
        const today = new Date().toISOString().split('T')[0];
        document.getElementById('start_date').setAttribute('min', today);
        document.getElementById('end_date').setAttribute('min', today);
    });
</script>

@endsection
