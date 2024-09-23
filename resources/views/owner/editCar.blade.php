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
        margin: 0;
        padding: 0;
        background-color: #f4f7f6;
        overflow-y: auto;
    }

    .form-holder {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        padding: 20px;
        box-sizing: border-box;
        position: relative;
    }

    .form-content {
        padding: 40px;
        background: #2c3e50;
        border-radius: 12px;
        width: 100%;
        max-width: 700px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.3);
        border: 1px solid #34495e;
        position: fixed;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        overflow-y: auto;
        max-height: calc(100vh - 40px);
        box-sizing: border-box;
        margin-top: 80px;
    }

    .form-items h3 {
        margin-top: 10px;
        color: #ecf0f1;
        font-size: 30px;
        font-weight: 700;
        margin-bottom: 15px;
    }

    .form-items p {
        color: #bdc3c7;
        font-size: 18px;
        margin-bottom: 20px;
    }

    .form-items label {
        color: #ecf0f1;
    }

    .form-items input[type=text],
    .form-items textarea {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        background-color: #34495e;
        border: 1px solid #7f8c8d;
        color: #ecf0f1;
        margin-top: 8px;
        font-size: 16px;
    }

    .form-items input[type=file] {
        margin-top: 8px;
    }

    .form-items .btn-primary {
        background-color: #17a2b8;
        border-radius: 5px;
        padding: 12px 20px;
        border: none;
        color: #fff;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s;
    }

    .form-items .btn-primary:hover,
    .form-items .btn-primary:focus {
        background-color: #058c9b; /
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
        font-size: 16px;
    }

    .form-group.mt-3.d-flex a:hover {
        color: #fbfbfb;
    }

    .alert {
        margin-bottom: 20px;
        background-color: #e74c3c;
        color: #fff;
        border-color: #c0392b;
        padding: 15px;
        border-radius: 5px;
    }
</style>


    <div class="form-holder">
        <div class="form-content">
            <div class="form-items">
                <h3>Update Your Car Details</h3>
                <p>Fill in the data below.</p>

                @if ($errors->any())
                    <div class="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="requires-validation" action="{{ route('update', $car->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="model">Model</label>
                        <input class="form-control" type="text" name="model" placeholder="Model" value="{{ $car->model }}" required>
                    </div>

                    <div class="form-group">
                        <label for="year">Year</label>
                        <input class="form-control" type="text" name="year" placeholder="Year" value="{{ $car->year }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_day">Price Per Day</label>
                        <input class="form-control" type="text" name="price_per_day" placeholder="Price per day" value="{{ $car->price_per_day }}" required>
                    </div>

                    <div class="form-group">
                        <label for="image_url">Car Image</label>
                        @if ($car->image_url) <!-- Check if there's a current image -->
                            <div class="mb-3">
                                <img src="{{ asset('images/' . $car->image_url) }}" alt="Current Car Image" class="img-thumbnail" style="max-width: 200px;">
                                <p class="mt-2">Current Image</p>
                            </div>
                        @endif
                        <input class="form-control" type="file" name="image_url" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label for="description">Car Description</label>
                        <textarea name="description" class="form-control" rows="3">{{ $car->description }}</textarea>
                    </div>

                    <div class="form-group mt-3 d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('myCars') }}" class="btn btn-primary">Back</a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict';
            const forms = document.querySelectorAll('.requires-validation');
            Array.from(forms).forEach(function (form) {
                form.addEventListener('submit', function (event) {
                    if (!form.checkValidity()) {
                        event.preventDefault();
                        event.stopPropagation();
                    }
                    form.classList.add('was-validated');
                }, false);
            });
        })();
    </script>
@endsection
