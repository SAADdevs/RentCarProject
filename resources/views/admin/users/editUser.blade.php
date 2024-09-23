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
            background-color: #22493c;
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
            background-color: #21bb5f;
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
            background-color: #3cad78;
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
                <h3>Update User Details</h3>

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="requires-validation" action="{{ route('updateUser', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="model">name</label>
                        <input class="form-control" type="text" name="name" placeholder="name" value="{{ $user->name }}" required>
                    </div>

                    <div class="form-group">
                        <label for="year">phone number</label>
                        <input class="form-control" type="text" name="phone_number" placeholder="phone" value="{{ $user->phone_number }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_day">city</label>
                        <input class="form-control" type="text" name="city" placeholder="city" value="{{ $user->city }}" required>
                    </div>

                    <div class="form-group">
                        <label for="price_per_day">email</label>
                        <input class="form-control" type="text" name="email" placeholder="email" value="{{ $user->email }}" required>
                    </div>

                    <div class="form-group">
                        <label for="role">Role</label>
                        <select id="role" class="form-control" name="role" required>
                            <option value="owner" {{ $user->role === 'owner' ? 'selected' : '' }}>Owner</option>
                            <option value="customer" {{ $user->role === 'customer' ? 'selected' : '' }}>Customer</option>
                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                    </div>


                    <div class="form-group mt-3 d-flex">
                        <button type="submit" class="btn btn-primary">Save</button>
                        <a href="{{ route('users') }}" class="btn btn-primary">Back</a>
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
