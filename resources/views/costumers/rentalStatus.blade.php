@extends('layouts.app')

@section('title', 'Rental Status')

@section('content')
<br>
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css');

    body {
        background-color: #f4f4f9;
        font-family: 'Roboto', sans-serif;
    }

    .container {
        max-width: 1200px;
        margin-top: 30px;
    }

    h1 {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 20px;
        text-align: center;
    }

    .btn-back {
    background-color: #1c5490;
    color: #e4e3e3;
    padding: 12px 30px;
    border-radius: 25px;
    border: none;
    font-size: 16px;
    font-weight: 500;
    margin-bottom: 30px;
    display: block;
    width: fit-content;
    margin-left: auto;
    margin-right: auto;
    box-shadow: 0 4px 10px rgba(0, 105, 217, 0.3);
    text-transform: uppercase;
    letter-spacing: 1px;
    transition: background-color 0.5s, transform 0.5s, box-shadow 0.5s;
    cursor: pointer;
    text-decoration: none;
}

.btn-back:hover {
    background-color: #0067d5;
    transform: translateY(-2px);
    box-shadow: 0 8px 16px rgba(0, 105, 217, 0.5);
}

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        height: 100%;
        width: 370px;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
        background: linear-gradient(145deg, #e6e6e6, #ffffff);
        box-shadow: 8px 8px 16px #e8dfdf, -8px -8px 16px #ffffff;
        margin-right: 60px;
    }

    .card:hover {
        transform: scale(1.05);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
        background-color: #fff;
        border-radius: 0 0 10px 10px;
        text-align: center;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }

    .card-title {
        font-size: 1.6rem;
        color: #343a40;
        font-weight: 700;
        margin-bottom: 15px;
        font-family: 'Poppins', Monospace;
        text-transform: uppercase;
        letter-spacing: 1px;
        background-color: #b6b7b8;
        width: auto%;
        text-align: center;
        border-radius: 20px;
    }




    .status {
        font-weight: bold;
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        text-transform: capitalize;
        font-size: 1rem;
    }

    .status.pending {
        background-color: #ffc107;
    }

    .status.cancelled {
        background-color: #ff4d07;
    }

    .status.ongoing {
        background-color: #28a745;
    }

    .status.rejected {
        background-color: #dc3545;
    }

    .status.completed {
        background-color: #17a2b8;
    }

    .btn-cancel {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        transition: background 0.3s ease;
        font-weight: 500;
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        cursor: pointer;
    }

    .btn-cancel:hover {
        background-color: #c82333;
    }

    .button-group {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }

    .rental-info {
        color: #007bff;
        font-weight: 600;
        font-size: 1rem;
        margin: 5px 0;
    }

    .rental-dates {
        font-style: italic;
        font-weight: 500;
        color: #5a5a5a;
    }

    .price-info {
        font-weight: bold;
        color: #e85d04;
    }
    .card-text {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 15px;
    }
</style>
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

<div class="container">
    <h1>Your Rental Status</h1>

    <a href="{{ route('costumers') }}" class="btn-back">Back to Home Page</a>

    <div class="row">
        @forelse ($rentedCars as $rental)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/' . $rental->car->image_url) }}" alt="{{ $rental->car->model }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title"><i class="fas fa-car"></i> {{ $rental->car->model }}</h5>
                        <p style="color: black" class="card-text rental-info"><i class="fas fa-city"></i> <span style="font-weight: 50px"> City</span>  : <b style="color:#343a40">{{ $rental->car->city }}</b></p>
                        <p class="card-text rental-dates"><i class="fas fa-calendar-alt"></i><span style="font-weight: 50px"> Rental Period  :  </span>  <b><span style="background-color: antiquewhite">{{ $rental->start_date }}</b></span>   to   <b><span style="background-color: antiquewhite"> {{ $rental->end_date }}</b></span></p>
                        <p style="color: black" class="card-text price-info"><i class="fas fa-dollar-sign"></i> Price per day:  ${{ number_format($rental->car->price_per_day, 2) }}</p>
                        <p class="card-text"> Status :
                            <span class="status {{ strtolower($rental->status) }}">
                                {{ $rental->status }}
                            </span>
                        </p>

                        <div class="button-group">
                            @if($rental->status == 'pending')
                                <form method="POST" action="{{ route('cancelRental', $rental->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-cancel">Cancel Request</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    You have no rented cars at the moment.
                </div>
            </div>
        @endforelse
    </div>
</div>

@endsection
