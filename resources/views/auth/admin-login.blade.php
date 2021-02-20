@extends('layouts.admin-app')

@section('title','Admin Login')

@section('auth')
<form class="col-lg-6 mx-auto text-center" method="POST" action="{{ route('admin.login.submit') }}">
    @csrf
    <h1 class="mb-3">Sign in</h1>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" class="form-control form-control-lg @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required autocomplete="email">
        @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Password</label>
        <input type="password" class="form-control form-control-lg @error('password') is-invalid @enderror" placeholder="Password" name="password" required autocomplete="current-password">
        @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Let me in</button>
</form>
@stop