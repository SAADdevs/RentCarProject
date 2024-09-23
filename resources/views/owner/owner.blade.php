@extends('layouts.app')
@section('title', 'Owner Page')
@section('content')
<br>
<br><br>
<style>
    body {
        background-color: #f4f4f9;
        font-family: 'Arial', sans-serif;
        color: #333;
        margin: 0;
        padding: 0;
    }

    .container {
        padding: 20px;
        max-width: 1200px;
        margin: auto;
    }

    .section {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .stats-container {
        display: flex;
        justify-content: space-between;
        gap: 20px;
    }

    .stats-box {
        flex: 1;
        text-align: center;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .stats-box h4 {
        color: #6c757d;
        margin-bottom: 10px;
        font-size: 18px;
        font-weight: 600;
    }

    .stats-box p {
        font-size: 32px;
        font-weight: 700;
        color: #343a40;
    }

    h4 {
        color: #343a40;
        font-size: 22px;
        border-bottom: 3px solid #6c757d;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .activity-item span {
        font-size: 16px;
        color: #495057;
    }

    .car-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .car-item span {
        font-size: 16px;
        color: #495057;
    }

    .rental-item {
        display: flex;
        justify-content: space-between;
        padding: 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .rental-item span {
        font-size: 16px;
        color: #495057;
    }
    .car-status.section {
    margin-top: 30px;
}

.car-item {
    display: flex;
    justify-content: space-between;
    padding: 10px;
    border-bottom: 1px solid #ddd;
}

.car-item span {
    font-size: 16px;
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
<br>
<div class="container">

    <!-- Statistics Section -->
    <div class="stats-container section">
        <div class="stats-box">
            <h4>Total Cars</h4>
            <p>{{$totalCars}}</p>
        </div>
        <div class="stats-box">
            <h4>Active Rentals</h4>
            <p>{{$activeRentals}}</p>
        </div>
        <div class="stats-box">
            <h4>Pending Requests</h4>
            <p>{{$pendingCars}}</p>
        </div>
        <div class="stats-box">
            <h4>Unapproved Cars</h4>
            <p>{{$unpporvedCars}}</p>
        </div>
    </div>

    <!-- Recent Activities Section -->
    <div class="recent-activities section">
        <h4>Recent Activities</h4>

    <div class="recent-activities section">
        @foreach ($notifications as $notification)
            <div class="activity-item">
                <span>{{ $notification->message }}</span>
                <span>{{ $notification->created_at->diffForHumans() }}</span>
            </div>
        @endforeach
    </div>
    </div>

    <!-- Car Status Section -->
    <div class="car-status section">
        <H4>Cars Status</H4>
        @foreach ($cars as $car)
            <div class="car-item">
                <span>{{ $car->model }}: {{ $car->status }}</span>
                <span>Last Updated: {{ $car->last_updated }}</span>
            </div>
        @endforeach
    </div>

    <!-- Rental Summary Section -->
    <div class="rental-summary section">
        <h4>Rental Summary</h4>
        <div class="rental-item">
            <span>Total Rentals This Month:</span>
            <span>{{$TotalRentalsOfThisMonth}}</span>
        </div>
        <div class="rental-item">
            <span>Total Rentals Last Month:</span>
            <span>{{$TotalRentalsOfLastMonth}}</span>
        </div>
    </div>

</div>
@endsection
