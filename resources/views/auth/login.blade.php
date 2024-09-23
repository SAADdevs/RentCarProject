@extends('layouts.app')
@section('title', 'Login Page')
@section('content')
<style>
    body {
        background-color: #d6dbdf	;
    }
    .btn {
        background-color:#808b96;
        color: black;
    }
    .btn:hover{
        background-color:#6d767f;
        color: white;
    }
</style>
<section class="vh-100">
  <div class="mask d-flex align-items-center h-100 gradient-custom-3">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card shadow-lg" style="border-radius: 15px; background: #aeb6bf ;">
            <div class="card-body p-5">
              <h1 class="text-uppercase  text-center mb-5" style="color: #333333;">Login</h1>
              <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-outline mb-4">
                    <input type="email" id="form3Example3cg" name="email"
                        class="form-control form-control-lg @error('email') is-invalid @enderror"
                        value="{{ old('email') }}" required />
                    <label class="form-label" for="form3Example3cg">Your Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div class="form-outline mb-4">
                    <input type="password" id="form3Example4cg" name="password"
                        class="form-control form-control-lg @error('password') is-invalid @enderror"
                        value="{{ old('password') }}" required />
                    <label class="form-label" for="form3Example4cg">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="d-flex justify-content-center">
                    <button type="submit" class="btn btn-lg">
                        Login
                    </button>
                </div>
                <p class="text-center text-muted mt-5 mb-0">Don't have an account? <a href="/register" class="fw-bold text-body" style="color: #007bff;"><u>Register here</u></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
