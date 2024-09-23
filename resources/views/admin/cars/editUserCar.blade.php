@extends('layouts.app')

@section('title', 'Edit Car')

@section('content')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;700;900&display=swap');

        *, body {
            font-family: 'Poppins', sans-serif;
            font-weight: 400;
            -webkit-font-smoothing: antialiased;
            text-rendering: optimizeLegibility;
            -moz-osx-font-smoothing: grayscale;
        }

        html, body {
            height: 100%;
            background-color: #1f699a;
            overflow: hidden;
        }

        .form-holder {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .form-content {
            padding: 60px;
            background-color: #255991;
            border-radius: 10px;
            width: 100%;
            max-width: 600px;
        }

        .form-items h3 {
            color: #fff;
            font-size: 28px;
            font-weight: 600;
            margin-bottom: 10px;
        }

        .form-items p {
            color: #fff;
            font-size: 17px;
            margin-bottom: 30px;
        }

        .form-items label {
            color: #fff;
        }

        .form-items input[type=text],
        .form-items textarea {
            width: 100%;
            padding: 10px 20px;
            border-radius: 6px;
            background-color: #fff;
            border: none;
            color: #8D8D8D;
            margin-top: 16px;
            font-size: 15px;
        }

        .form-items .btn-primary {
            background-color: #59a9ef;
            border-radius: 5px;
            padding: 10px 20px;
            border: none;
            color: #fff;
            cursor: pointer;
        }

        .form-items .btn-primary:hover,
        .form-items .btn-primary:focus {
            background-color: #495056;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group.mt-3.d-flex {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .form-group.mt-3.d-flex a {
            color: #000;
            text-decoration: none;
        }

        .form-group.mt-3.d-flex a:hover {
            color: #000;
            text-decoration: underline;
        }

        .alert {
            margin-bottom: 20px;
        }
    </style>

    <div class="form-holder">
        <div class="form-content">
            <div class="form-items">
                <h3>Update User Car Details</h3>
                <p>Fill in the data below.</p>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="requires-validation" action="{{ route('updateUserCar', $car->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input class="form-control" type="text" name="model" placeholder="Model" value="{{ $car->model }}" required>
                    </div>

                    <div class="form-group">
                        <label for="owner">Owner</label>
                        <input class="form-control" type="text" name="owner" placeholder="owner" value="{{ $car->owner->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="city">city</label>
                        <input class="form-control" type="text" name="city" placeholder="city" value="{{ $car->city }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Car Image</label>
                        <input class="form-control" type="file" name="image_url" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="status">status</label>
                        <select id="status" class="form-control"  name="status" required>
                            <option value="approved" {{ $car->status === 'approved' ? 'selected' : '' }}>approved</option>
                            <option value="rejected" {{ $car->status === 'rejected' ? 'selected' : '' }}>rejected</option>
                            <option value="pending" {{ $car->status === 'pending' ? 'selected' : '' }}>pending</option>
                        </select>
                    </div>

                    <div class="form-group mt-3 d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('adminCars') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    
@endsection
