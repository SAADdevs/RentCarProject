@extends('layouts.app')
@section('title', 'All Cars')

@section('content')
    @if(session('success'))
        <div class="alert alert-success mt-5">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-5" style="margin-top: 120px;">
        <h2 class="mb-4 text-center">All My Cars</h2>

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">Car ID</th>
                        <th scope="col">Year</th>
                        <th scope="col">Model</th>
                        <th scope="col">Image</th>
                        <th scope="col">Price Per Day</th>
                        <th scope="col">Status</th>
                        <th scope="col">Renting Status</th>
                        <th scope="col">Manage</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cars as $car)
                    <tr>
                        <td>{{ $car->id }}</td>
                        <td>{{ $car->year }}</td>
                        <td>{{ $car->model }}</td>
                        <td>
                            <img src="{{ asset('images/' . $car->image_url) }}" alt="{{ $car->model }}" class="car-image">
                        </td>
                        <td>${{ $car->price_per_day }}</td>
                        <td>
                            <span class="badge {{ $car->status == 'approved' ? 'bg-success' : ($car->status == 'pending' ? 'bg-warning' : 'bg-danger') }}">
                                {{ ucfirst($car->status) }}
                            </span>
                        </td>
                        <td>
                            @if($car->availabilty_status === '0')
                                <span class="badge bg-success">Currently Renting</span>
                            @else
                                <span class="badge bg-secondary">Not Renting</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('editCar', $car->id) }}" class="btn btn-sm btn-edit">Edit</a>
                            <form action="{{ route('deleteCar', $car->id) }}" method="POST" style="display:inline;" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-delete">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmDelete() {
            return confirm("Are you sure you want to delete this item? This action cannot be undone.");
        }
    </script>

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f4f7f6;
            color: #333;
        }

        .container {
            background-color: #ffffff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            overflow: hidden;
        }

        h2 {
            color: #333;
            font-size: 34px;
            font-weight: 700;
            margin-bottom: 30px;
        }

        .table-container {
            overflow-x: auto;
        }

        .table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .table thead th {
            background-color: #17a2b8;
            color: #ffffff;
            text-align: center;
            font-weight: 600;
            border-bottom: 2px solid #0056b3;
        }

        .table tbody tr {
            background-color: #ffffff;
            transition: background-color 0.3s ease;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody td {
            vertical-align: middle;
            padding: 15px;
            text-align: center;
        }

        .car-image {
            width: 120px;
            height: auto;
            border-radius: 8px;
            border: 2px solid #d7dadd;
        }

        .btn-edit {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-edit:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }

        .btn-delete {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            border-radius: 6px;
            padding: 8px 12px;
            font-size: 14px;
            font-weight: 500;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-delete:hover {
            background-color: #c82333;
            transform: scale(1.05);
        }

        .alert {
            border-radius: 8px;
            padding: 15px;
            font-size: 16px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #28a745;
            color: #ffffff;
        }
    </style>
@endsection
