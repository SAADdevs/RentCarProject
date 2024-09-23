@extends('layouts.app')

@section('title', 'Current Rentals')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-5">
            {{ session('success') }}
        </div>
    @endif
    <div class="container mt-5" style="margin-top: 120px;">
        <h2 class="mb-4 text-center">Current Rentals</h2>
        <div class="table-responsive">
            <table class="table table-striped table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Rental ID</th>
                        <th scope="col">Car Model</th>
                        <th scope="col">Customer</th>
                        <th scope="col">image</th>
                        <th scope="col">Start Date</th>
                        <th scope="col">End Date</th>
                        <th scope="col">Price Per Day</th>
                        <th scope="col">Total Price</th>
                        <th scope="col">Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($rentals as $rental)
                        <tr>
                            <td>{{ $rental->id }}</td>
                            <td>{{ $rental->car->model }}</td>
                            <td>{{ $rental->customer->name }}</td>
                            <td>
                                <img class="car-image" src="{{ asset('images/' . $rental->car->image_url) }}" alt="{{ $rental->car->model }}" class="car-image" width="200px" height="100px">
                            </td>
                            <td>{{ $rental->start_date }}</td>
                            <td>{{ $rental->end_date}}</td>
                            <td>${{ number_format($rental->car->price_per_day, 2) }}</td>
                            <td>${{ number_format($rental->car->price_per_day * $rental->durationInDays(), 2) }}</td>
                            <td>
                                <span class="badge badge-{{ $rental->status === 'approved' ? 'success' : ($rental->status === 'completed' ? 'info' : 'warning') }}">
                                    {{ ucfirst($rental->status) }}
                                </span>
                            </td>
                            <td>
                                <form action="{{route('ComplateRental', $rental->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn-sm btn-secondary">Complate</button>
                                </form>
                                <form action="{{route('CancelledRental', $rental->id)}}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">Cancel</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <style>
        .table {
            background-color: #ffffff; /* White background for the table */
            border-radius: 8px;
            overflow: hidden;
        }

        .table th, .table td {
            vertical-align: middle;
        }

        .table thead th {
            background-color: #343a40; /* Dark background for table headers */
            color: #ffffff; /* White text for headers */
            font-weight: bold;
        }
        .car-image {
            width: 120px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #d7dadd;
        }

        .table tbody tr:nth-child(odd) {
            background-color: #f8f9fa; /* Light grey background for odd rows */
        }

        .table tbody tr:hover {
            background-color: #e9ecef; /* Slightly darker grey for row hover effect */
        }

        .badge-success {
            background-color: #28a745; /* Green background for active status */
        }

        .badge-info {
            background-color: #17a2b8; /* Light blue background for completed status */
        }

        .badge-warning {
            background-color: #ffc107; /* Yellow background for warning status */
        }

        .btn-success, .btn-danger {
            font-size: 14px; /* Slightly smaller text for buttons */
        }

        .alert-success {
            margin-top: 20px;
            padding: 15px;
            border-radius: 5px;
            background-color: #d4edda; /* Light green background for success alerts */
            color: #155724; /* Dark green text for success alerts */
            border: 1px solid #c3e6cb; /* Slightly darker green border for success alerts */
        }
    </style>
@endsection
