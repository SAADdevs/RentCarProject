@extends('layouts.app')

@section('title', 'Car Details')

@section('content')
<style>
    .car-details-container {
        max-width: 900px;
        margin: 60px auto;
        background-color: #ffffff;
        border-radius: 15px;
        padding: 25px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        display: flex;
        flex-direction: column;
        gap: 25px;
        transition: transform 0.3s, box-shadow 0.3s;
    }

    .car-details-container:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 40px rgba(0, 0, 0, 0.15);
    }

    .car-image {
        width: 45%;
        border-radius: 15px;
        object-fit: cover;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    }

    .car-info {
        width: 100%;
    }

    .car-info h2 {
        font-size: 28px;
        font-weight: 700;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
        padding-bottom: 10px;
        background-color: #bfc2c7;
        border-radius: 15px;
        text-align: center;
        width: 50%;
        margin-left: 25%;
    }

    .car-description, .car-price {
        margin-bottom: 20px;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        background-color: #f9f9f9;
    }

    .car-description {
        border-top: 5px solid black;
    }

    .car-price {
        border-top: 5px solid #2574a9;
        text-align: center;
    }

    .car-description p, .car-price p {
        font-size: 16px;
        color: #555;
        margin-bottom: 10px;
        line-height: 1.6;
    }

    .car-price p strong {
        font-size: 24px;
        color: #333;
    }

    .form-group {
        margin-bottom: 20px;
    }

    .form-group label {
        font-weight: bold;
        font-size: 15px;
        color: #555;
    }

    .form-group input[type="date"], .form-group input[type="date"]:focus {
        font-size: 15px;
        padding: 12px;
        border-radius: 8px;
        border: 1px solid #ddd;
        background-color: #ffffff;
        transition: border-color 0.3s, box-shadow 0.3s;
    }

    .form-group input[type="date"]:focus {
        border-color: #3498db;
        box-shadow: 0 0 5px rgba(52, 152, 219, 0.3);
    }

    .btn-primary, .btn-secondary {
        padding: 12px 30px;
        font-size: 16px;
        border-radius: 8px;
        font-weight: 600;
        width: 48%;
        transition: all 0.3s ease;
        box-shadow: 0 3px 5px rgba(0, 0, 0, 0.1);
    }

    .btn-primary {
        background-color: #3498db;
        border-color: #3498db;
        color: #fff;
    }

    .btn-primary:hover {
        background-color: #2980b9;
        border-color: #2574a9;
    }

    .btn-secondary {
        background-color: #e74c3c;
        border-color: #e74c3c;
        color: #fff;
    }

    .btn-secondary:hover {
        background-color: #c0392b;
        border-color: #a93226;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .total-price {
        font-size: 18px;
        font-weight: bold;
        color: #3300b3;
        margin-top: 10px;
        text-align: center;
    }

    @media (max-width: 768px) {
        .button-group {
            flex-direction: column;
            gap: 10px;
        }

        .btn-primary, .btn-secondary {
            width: 100%;
        }
    }
    .container
    {
        margin-top: -45px;
    }
    .alert
    {
        color: rgb(255, 0, 0);
        font-weight: 700;
    }
</style>
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
    <div class="car-details-container">
        <div class="text-center mb-4">
            <img src="{{ asset('images/' . $car->image_url) }}" alt="{{ $car->model }}" class="car-image">
        </div>
        <div class="car-info">
            @if($rental->isNotEmpty())
    @foreach($rental as $r)
        <div class="alert">
            Car is not available from
            <span style="background-color: antiquewhite">{{ \Carbon\Carbon::parse($r->start_date)->format('d/m/Y') }}</span>
            <span style="background-color: white"> to </span>
            <span style="background-color: antiquewhite">{{ \Carbon\Carbon::parse($r->end_date)->format('d/m/Y') }}</span>
        </div>
    @endforeach
@endif
            <h2>{{ $car->model }} ({{ $car->year }})</h2>
            <div class="car-description">
                <p><strong>Description:</strong> {{ $car->description }}</p>
            </div>
            <div class="car-price">
                <p><strong>Price per day:</strong> ${{ number_format($car->price_per_day, 2) }}</p>
            </div>

            <form method="POST" action="{{ route('rentCar', $car->id) }}">
                @csrf
                <div class="form-group">
                    <label for="start_date">Start Date</label>
                    <input type="date" id="start_date" name="start_date" class="form-control" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="form-group">
                    <label for="end_date">End Date</label>
                    <input type="date" id="end_date" name="end_date" class="form-control" min="{{ now()->toDateString() }}" required>
                </div>
                <div class="total-price" id="totalPrice">Total Price: $0.00</div>
                <div class="button-group">
                    <button type="submit" class="btn btn-primary">Rent this Car</button>
                    <a href="{{ route('costumers') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const startDateInput = document.getElementById('start_date');
        const endDateInput = document.getElementById('end_date');
        const totalPriceElement = document.getElementById('totalPrice');
        const pricePerDay = {{ $car->price_per_day }};

        function updateTotalPrice() {
            const startDate = new Date(startDateInput.value);
            const endDate = new Date(endDateInput.value);

            if (startDate && endDate && startDate < endDate) {
                const timeDiff = endDate.getTime() - startDate.getTime();
                const dayDiff = Math.ceil(timeDiff / (1000 * 3600 * 24));
                const totalPrice = dayDiff * pricePerDay;
                totalPriceElement.textContent = `Total Price: $${totalPrice.toFixed(2)}`;
            } else {
                totalPriceElement.textContent = 'Total Price: $0.00';
            }
        }

        startDateInput.addEventListener('change', updateTotalPrice);
        endDateInput.addEventListener('change', updateTotalPrice);
    });
</script>
@endsection
