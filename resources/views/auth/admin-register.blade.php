@extends('layouts.admin-app')

@section('title','Admin Register')

@section('auth')
<form class="col-lg-6 mx-auto text-center" method="POST" action="{{ route('admin.register.submit') }}" enctype="multipart/form-data">
    @csrf
    <h1 class="mb-3">Sign Up</h1>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Username</label>
        <input type="text" class="form-control form-control-lg @error('name') is-invalid @enderror" placeholder="Username" name="name" value="{{ old('name') }}" required autocomplete="name">
        @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
    </div>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Email</label>
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
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Confirm Password</label>
        <input type="password" class="form-control form-control-lg" placeholder="Confirm Password" name="password_confirmation" required autocomplete="new-password">
    </div>
    <div class="form-group">
        <label for="inputEmail" class="sr-only">Avatar</label>
        <input type="file" class="form-control form-control-lg" name="avatar" id="avatar" required>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>
</form>
@stop