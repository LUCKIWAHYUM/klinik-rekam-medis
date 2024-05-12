@extends('layouts.app')

@section('content')
<div class="container" id="layoutLogin">
    <input type="checkbox" id="check">
    <div class="login form" id="layoutLogin">
        <header>LOGIN</header>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
                @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Enter your password" required>
                @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
                @enderror
            </div>
            <!-- <div class="form-group">
                <a href="{{ route('password.request') }}"><b>Forgot password?</b></a>
            </div> -->
            <div class="form-group d-flex justify-content-center">
                <button type="submit" id="buttonLogin" class="btn btn-primary">Masuk</button>
            </div>

        </form>
        <!-- <div class="signup">
            <span class="signup">Belum Punya Akun ?
                <a href="{{ route('register') }}">Signup</a>
            </span>
        </div>
    </div> -->

    {{-- <div class="registration form">
        <header>Signup</header>
        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div class="form-group">
                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="{{ old('name') }}" required>
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="Enter your email" value="{{ old('email') }}" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="Create a password" required>
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password_confirmation" placeholder="Confirm your password" required>
            </div>
            <div class="form-group">
                <button type="submit" id="buttonLogin" class="btn btn-primary">Signup</button>
            </div>
        </form>
        <div class="signup">
            <span class="signup"> Sudah Punya Akun ?
                <label for="check">Login</label>
            </span>
        </div>
    </div> --}}


    </div>
</div>
@endsection
