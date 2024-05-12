@extends('layouts.app')

@section('content')

    <div class="container" >
        <div class="login form" id="layoutLogin">
            <div class="card-header"><header style="text-align:center" >{{ __('Register') }}</header><hr> </div>
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
            <div class="form-group mb-3">
                <select  id="pilihan" class="option form-control" placeholder="Pilih User Sebagai" class="form-control  form-select" name="role" id="OptionLevel">
                    <option>Daftar sebagai</option>
                    <option value="admin">Admin</option>
                    <option value="dokter">Dokter</option>
                    <option value="perawat">perawat</option>
                    <option value="apoteker">apoteker</option>
                </select>
            </div>
          
            <div class="form-group">
                <button type="submit" id="buttonLogin" class="btn btn-primary"> {{ __('Register') }}</button>
            </div>
        </form>
        <div class="signup">
            <span class="signup">Sudah Punya Akun?
                <a href="{{ route('login') }}">Login</a>
            </span>
        </div>

    </div>


    </div>
</div>
</div>
@endsection
