@extends('layouts.app')
@section('title', 'Rental Requests')
@section('content')
<style>
    body {
        background-color: #f8f9fa;
        font-family: 'Roboto', sans-serif;
        margin-top: 30px;
    }

    .container {
        max-width: 1200px;
        margin: 30px auto;
    }

    h1 {
        color: #343a40;
        font-weight: bold;
        margin-bottom: 40px;
        text-align: center;
    }

    .card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: none;
        border-radius: 10px;
        overflow: hidden;
        margin-bottom: 30px;
    }

    .card:hover {
        transform: scale(1.03);
        box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.15);
    }

    .card-body {
        padding: 20px;
        background-color: #fff;
        border-radius: 0 0 10px 10px;
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
        border-bottom: 1px solid #dee2e6;
    }

    .card-title {
        font-size: 1.5rem;
        color: #343a40;
        margin-bottom: 15px;
    }

    .card-text {
        color: #6c757d;
        font-size: 1rem;
        margin-bottom: 10px;
    }

    .status {
        font-weight: bold;
        padding: 5px 10px;
        border-radius: 20px;
        text-transform: capitalize;
    }

    .status.pending {
        background-color: #ffc107;
        color: #212529;
    }

    .status.approved {
        background-color: #28a745;
        color: #fff;
    }

    .status.rejected {
        background-color: #dc3545;
        color: #fff;
    }

    .status.completed {
        background-color: #17a2b8;
        color: #fff;
    }

    .btn-accept {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        transition: background 0.3s ease;
    }

    .btn-accept:hover {
        background-color: #218838;
    }

    .btn-reject {
        background-color: #dc3545;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        transition: background 0.3s ease;
    }

    .btn-reject:hover {
        background-color: #c82333;
    }

    .btn-back {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        transition: background 0.3s ease;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    .button-group {
        display: flex;
        justify-content: space-between;
        margin-top: 20px;
    }

    .alert-info {
        text-align: center;
        font-size: 1.2rem;
    }
</style>

<div class="container">
    <h1>Rental Requests</h1>
    <div class="row">
        @forelse ($rentalRequests as $request)
            <div class="col-md-4">
                <div class="card">
                    <img src="{{ asset('images/' . $request->car->image_url) }}" alt="{{ $request->car->model }}" class="card-img-top">
                    <div class="card-body">
                        <h5 class="card-title">{{ $request->car->model }}</h5>
                        <p class="card-text"><i class="fas fa-city"></i> <span style="font-family: 'sans-serif">City:</span><b> {{ $request->car->city }}</b></p>
                        <p class="card-text rental-dates"><i class="fas fa-calendar-alt"></i><span style="font-weight: 50px"> Rental Period  :  </span>  <b><span style="background-color: antiquewhite">{{ $request->start_date }}</b></span>   to   <b><span style="background-color: antiquewhite"> {{  $request->end_date }}</b></span></p>
                        <p class="card-text"><i class="fas fa-comment-dots"></i>  Requested By: <span style="font-size: 20px">{{ $request->customer->name }}</span> </p>
                        @if($request->status == 'ongoing')
                            <p class="card-text">Phone number to call: <span style="background-color:#ff7482;padding:5px;border-radius:5px;color:black"> {{ $request->customer->phone_number }}</span></p>
                        @endif
                        <p class="card-text">Status:
                            <span class="status {{ strtolower($request->status) }}">
                                {{ $request->status }}
                            </span>
                        </p>
                        <div class="button-group">
                            @if($request->status == 'pending')
                                <form method="POST" action="{{ route('approveRequest') }}" style="display:inline;">
                                    @csrf
                                    <input type="hidden" name="request_id" value="{{ $request->id }}">
                                    <button type="submit" class="btn-accept">Accept</button>
                                </form>
                                <form method="POST" action="{{ route('rejectRequest', $request->id) }}" style="display:inline;">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn-reject">Reject</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="alert alert-info" role="alert">
                    No rental requests at the moment.
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
