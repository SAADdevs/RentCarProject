@extends('layouts.app')
@section('title', 'register page')
@section('content')
<style>
     body {
        background-color: #d6dbdf	;
     }
    .btn {

    }
    .btn:hover{
        background-color:#378589;
        color: white;
    }
</style>
 <section class="vh-100 ">
   <div class="mask d-flex align-items-center h-100 gradient-custom-3 mt-5">
    <div class="container h-100">
      <div class="row d-flex justify-content-center align-items-center h-100">
        <div class="col-12 col-md-9 col-lg-7 col-xl-6">
          <div class="card" style="border-radius: 15px; background-color:#aeb6bf">
            <div class="card-body p-5">
              <b><h1 class="text-uppercase text-center mb-5">Create an account</h1></b>

              <form method="POST" action="{{ route('register') }}" >
                @csrf
                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form3Example1cg" class="form-control form-control-lg" :value="old('name')"  name="name" required />
                    <label class="form-label" for="form3Example1cg">Your Name</label>
                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>role required</strong>
                        </span>
                    @enderror
                </div>


                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form3Example1cg" class="form-control form-control-lg @error('phone_number') is-invalid @enderror" :value="old('phone_number')"  name="phone_number" required />
                    <label class="form-label" for="form3Example1cg">Your phone number</label>
                    @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>phone number required</strong>
                        </span>
                    @enderror
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="text" id="form3Example4cdg" class="form-control form-control-lg @error('city') is-invalid @enderror" :value="old('city')"  name="city" required />
                    <label class="form-label" for="form3Example4cdg">your city</label>
                    @error('city')
                        <span class="invalid-feedback" role="alert">
                            <strong>city required</strong>
                        </span>
                    @enderror
                </div>

                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="email" id="form3Example3cg" class="form-control form-control-lg @error('email') is-invalid @enderror" :value="old('email')" name="email" required />
                    <label class="form-label" for="form3Example3cg">Your Email</label>
                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>email required</strong>
                        </span>
                    @enderror
                </div>


                <div data-mdb-input-init class="form-outline mb-4">
                    <input type="password" id="form3Example4cg" class="form-control form-control-lg @error('password') is-invalid @enderror"   name="password" required />
                    <label class="form-label" for="form3Example4cg">Password</label>
                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>password required</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="role">Role</label>
                    <select id="role" class="form-control"  name="role" required>
                        <option value="owner">Owner</option>
                        <option value="customer">Customer</option>
                    </select>
                </div>


                <div class="d-flex justify-content-center mt-5">
                    <button style="background-color:#808b96;color:white;" type="submit" data-mdb-button-init data-mdb-ripple-init class="btn  btn-block btn-lg gradient-custom-4 text-body">
                        Register
                    </button>
                </div>
            </form>
                <p class="text-center text-muted mt-5 mb-0">I Have already an account <a href="/login"
                    class="fw-bold text-body"><u>Login here</u></a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
@endsection
