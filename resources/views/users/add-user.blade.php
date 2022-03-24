@extends('templates.main')

@section('content')
<div class="container w-75">
    <form method="POST" action="/add-user" class="m-3 d-flex justify-content-center">
        @csrf
        <div class="p-5 w-100 row border border-secondary rounded">
            <a href="/" class="text-decoration-none text-danger">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2" style="width: 15px;">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back
            </a>
            {{-- @if(session('success'))
            <div class="alert alert-success d-flex align-items-center alert-dismissible show" role="alert">
                <svg xmlns="http://www.w3.org/2000/svg" style="width:2rem;" class="me-2" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
                <div>
                    {{ session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif --}}
            <h1 class="fw-bold text-center">Add User</h1>
            <p class="text-muted text-center">Please fill in the form below</p>
            <div class="mb-3">
                <label for="fname" class="fw-bold">First Name</label>
                <input name="fname" class="form-control @error('fname') is-invalid @enderror" type="text"
                    value="{{ old('fname') }}" />
                @error('fname')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="lname" class="fw-bold">Last Name</label>
                <input name="lname" class="form-control @error('lname') is-invalid @enderror" type="text"
                    value="{{ old('lname') }}" />
                @error('lname')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="email" class="fw-bold">Email</label>
                <input name="email" class="form-control @error('email') is-invalid @enderror" type="email"
                    value="{{ old('email') }}" />
                @error('email')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="fw-bold">Password</label>
                <input name="password" class="form-control @error('password') is-invalid @enderror" type="password"
                    value="{{ old('password') }}" />
                @error('password')
                <span class="invalid-feedback" role="alert">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="password_confirmation" class="fw-bold">Confirm Password</label>
                <input name="password_confirmation" class="form-control" type="password" />
            </div>
            <div class="mb-3">
                <button type="submit" class="btn-lg form-control bg-brown">
                    Create User
                </button>
            </div>

        </div>
    </form>
</div>
@endsection