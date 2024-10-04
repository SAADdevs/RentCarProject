@extends('layouts.app')

@section('title', 'Admin Dashboard')

@section('content')
<style>
    body {
        background-color: #f4f4f9;
    }

    .card {
        height: 150px;
    }

    .admin-dashboard {
        margin-top: 100px;
    }

    .car-item span {
        font-size: 16px;
    }

    h4 {
        color: #343a40;
        font-size: 22px;
        border-bottom: 3px solid #6c757d;
        padding-bottom: 10px;
        margin-bottom: 20px;
    }

    .activity-item span {
        font-size: 16px;
        color: #495057;
    }

    .section {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
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

    .admin-card {
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin: 15px;
        color: #fff;
    }

    .card-active-rentals {
        background-image: url('{{ asset('images/bgst.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .card-total-revenue {
        background-image: url('{{ asset('images/bgst2.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .card-new-customers {
        background-image: url('{{ asset('images/bgst1.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .card-pending-requests {
        background-image: url('{{ asset('images/bgst3.jpg') }}');
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
    }

    .admin-card-header {
        font-weight: bold;
        padding: 15px;
        border-radius: 10px 10px 0 0;
    }

    .admin-card-body {
        padding: 30px;
        color: #fff;
    }

    .btn-custom {
        border-radius: 10px;
        padding: 10px 20px;
        font-size: 16px;
    }


    .chart-container {
        margin-top: 30px;
        position: relative;
        width: 100%;
        height: 400px;
    }

    .chart {
        border-radius: 10px;
        background: #fff;
        padding: 20px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        height: 700px;
    }

    .recent-activities {
        background-color: #ffffff;
        padding: 20px;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        width: 60%;
        margin: 20px auto;
    }

    .activity-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 15px;
        background-color: #f8f9fa;
        border-radius: 8px;
        margin-bottom: 10px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .activity-item .activity-icon {
        margin-right: 10px;
        color: #007bff;
    }

    .activity-item .activity-time {
        font-size: 14px;
        color: #6c757d;
        font-style: italic;
    }
</style>

<div class="container admin-dashboard">
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="card card-active-rentals admin-card">
                <div class="card-header admin-card-header">
                    <h5 class="card-title mb-0">Active Rentals</h5>
                </div>
                <div class="card-body">
                    <h2 class="d-flex align-items-center mb-0">{{$activeRentals}}</h2>
                    <div class="progress mt-1" data-height="8" style="height: 8px;">
                        <div class="progress-bar bg-success" role="progressbar" style="width: 55%;"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card card-total-revenue admin-card">
                <div class="card-header admin-card-header">
                    <h5 class="card-title mb-0">Total Users</h5>
                </div>
                <div class="card-body">
                    <h2 class="d-flex align-items-center mb-0">{{$totalUsers}}</h2>
                    <div class="progress mt-1" data-height="8" style="height: 8px;">
                        <div class="progress-bar" role="progressbar" style="width: 70%; background-color: rgb(0, 0, 0);"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card card-new-customers admin-card">
                <div class="card-header admin-card-header">
                    <h5 class="card-title mb-0">Total Cars</h5>
                </div>
                <div class="card-body">
                    <h2 class="d-flex align-items-center mb-0">{{$totalCars}}</h2>
                    <div class="progress mt-1" data-height="8" style="height: 8px;">
                        <div class="progress-bar bg-warning" role="progressbar" style="width: 60%; background-color: rgb(1, 238, 255);"></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="card card-pending-requests admin-card">
                <div class="card-header admin-card-header">
                    <h5 class="card-title mb-0">Pending Requests</h5>
                </div>
                <div class="card-body">
                    <h2 class="d-flex align-items-center mb-0">{{$pendingRequest}}</h2>
                    <div class="progress mt-1" data-height="8" style="height: 8px;">
                        <div class="progress-bar bg-danger" role="progressbar" style="width: 40%;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="recent-activities section">
        <h4>Recent Activities</h4>
        @forelse($recentActivities as $activity)
            <div class="activity-item">
                <span class="activity-icon">
                    <i class="fas fa-bell  text-success }}"> </i>

                </span>
                <h6>{{ $activity->message }}</h6>
                <span class="activity-time">
                    {{ $activity->created_at->isToday() ? 'Today' : $activity->created_at->format('M d, Y') }}
                </span>
            </div>
        @empty
            <p>No recent activities</p>
        @endforelse
    </div>

    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <div class="chart-container">
                <div class="chart">
                    <h4>Car Availability</h4>
                    <canvas id="car-availability-chart"></canvas>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-lg-6">
            <div class="chart-container">
                <div class="chart">
                    <h4>Monthly Rentals</h4>
                    <br><br>
                    <canvas id="car-ownership-chart" height="600px" width="700px"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const carAvailabilityCtx = document.getElementById('car-availability-chart').getContext('2d');
        const carOwnershipCtx = document.getElementById('car-ownership-chart').getContext('2d');

        // Pie Chart for Car Availability
        const carAvailabilityChart = new Chart(carAvailabilityCtx, {
            type: 'pie',
            data: {
                labels: ['Available', 'Rented'],
                datasets: [{
                    data: [{{$availableCars}}, {{$rentedCars}}],
                    backgroundColor: ['#28a745', '#dc3545'],
                    hoverBackgroundColor: ['#28a745', '#dc3545']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                }
            }
        });

        // Bar Chart for Monthly Rentals
        const carOwnershipChart = new Chart(carOwnershipCtx, {
            type: 'bar',
            data: {
                labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
                datasets: [{
                    label: '# of Rentals',
                    data: [
                        {{ $rentalsJanuary }},
                        {{ $rentalsFebruary }},
                        {{ $rentalsMarch }},
                        {{ $rentalsApril }},
                        {{ $rentalsMay }},
                        {{ $rentalsJune }},
                        {{ $rentalsJuly }},
                        {{ $rentalsAugust }},
                        {{ $rentalsSeptember }},
                        {{ $rentalsOctober }},
                        {{ $rentalsNovember }},
                        {{ $rentalsDecember }}
                    ],
                    backgroundColor: '#007bff',
                    hoverBackgroundColor: '#0056b3'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: false
                    },
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>
@endsection
