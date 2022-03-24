@extends('templates.main')

@section('content')
{{-- <form method="POST" action="{{ route('login') }}">
    @csrf
    <div class="mb-3">
        <label for="email" class="form-label">Email address</label>
        <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ old('email') }}">
        @error('email')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">Password</label>
        <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
        @error('password')
            <span class="invalid-feedback" role="alert">{{ $message }}</span>
        @enderror
    </div>
    <button type="submit" class="btn btn-primary">Login</button>
</form> --}}
<div class="">
    <div class="row vh-100 g-0">
        <div class="d-flex justify-content-center align-items-center col">
            <form method="POST" action="{{ route('login') }}" style="width: 23rem;">
                @csrf
                <h1 class="fw-bold">Login Now</h1>
                <p class="text-secondary">Please enter your email</p>
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" placeholder="Enter your email">
                    @error('email')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">Password</label>
                    <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" id="password">
                    @error('password')
                        <span class="invalid-feedback" role="alert">{{ $message }}</span>
                    @enderror
                </div>
                <div class="mb-3 form-check">
                    <div class="d-flex justify-content-between">
                        <div>
                            <input type="checkbox" class="form-check-input" id="remember_me">
                            <label class="form-check-label fw-bold" for="remember_me">Remember me</label>
                        </div>
                        <div>
                            <a href="#" class="fw-bold text-decoration-none">Forgot Password?</a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="primary-btn w-100 text-white py-2 mb-3">Login</button>
                <a href="#" class="text-decoration-none d-block rounded text-center w-100 border bg-white text-black fw-bold py-1 mb-5">
                    <img src="https://img.icons8.com/fluency/96/000000/google-logo.png" style="width:2.5rem;"/>
                    Sign in with Google
                </a>
                <p class="text-secondary text-center">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="fw-bold text-decoration-none">Sign up for free!</a>
                </p>
            </form>
        </div>
        <div class="col bg-secondary d-none d-md-block">
            <img src="https://images.pexels.com/photos/3194524/pexels-photo-3194524.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260" alt="Login image" class="w-100 vh-100" style="object-fit: cover; object-position: left;">
        </div>
    </div>
</div>
@endsection