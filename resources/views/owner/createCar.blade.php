@extends('layouts.app')
@section('title', 'Register Your Car')

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
            background-color: #343a40;
            overflow: hidden;
        }

        .form-holder {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-content {
            padding: 40px;
            background-color: #495057;
            border-radius: 12px;
            width: 100%;
            max-width: 600px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }

        .form-items h3 {
            color: #ffffff;
            font-size: 26px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-items p {
            color: #ced4da;
            font-size: 16px;
            margin-bottom: 30px;
        }

        .form-items label {
            color: #ffffff;
            font-size: 14px;
        }

        .form-items input[type=text],
        .form-items textarea {
            width: 100%;
            padding: 12px 16px;
            border-radius: 6px;
            background-color: #ffffff;
            border: 1px solid #ced4da;
            color: #495057;
            margin-top: 8px;
            font-size: 15px;
        }

        .form-items .btn-primary {
            background-color: #007bff;
            border-radius: 6px;
            padding: 12px 20px;
            border: none;
            color: #ffffff;
            cursor: pointer;
            font-size: 16px;
            font-weight: 500;
        }

        .form-items .btn-primary:hover,
        .form-items .btn-primary:focus {
            background-color: #0056b3;
            outline: none;
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
            color: #ffffff;
            text-decoration: none;
            background-color: #6c757d;
            padding: 12px 20px;
            border-radius: 6px;
            text-align: center;
        }

        .form-group.mt-3.d-flex a:hover {
            background-color: #5a6268;
        }

        .alert {
            background-color: #dc3545;
            color: #ffffff;
            padding: 15px;
            border-radius: 6px;
            margin-bottom: 20px;
        }

        .alert ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .alert li {
            margin-bottom: 5px;
        }
    </style>

    <div class="form-holder">
        <div class="form-content">
            <div class="form-items">
                <h3>Register Your Car</h3>
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

                <form class="requires-validation" action="{{ route('CreateCar') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input class="form-control" type="text" name="model" placeholder="Model" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Year</label>
                        <input class="form-control" type="text" name="year" placeholder="Year" required>
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input class="form-control" type="text" name="city" placeholder="City" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_day">Price Per Day</label>
                        <input class="form-control" type="text" name="price_per_day" placeholder="Price per day" required>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Car Image</label>
                        <input class="form-control" type="file" name="image_url" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label for="description">Car Description</label>
                        <textarea name="description" class="form-control" rows="3"></textarea>
                    </div>

                    <div class="form-group mt-3 d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('owners') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
