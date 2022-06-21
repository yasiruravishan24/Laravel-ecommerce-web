@extends('layouts.appAdminLogin')
@section('title', 'ADMIN LOGIN - ')

@section('content')
<!-- login -->
<div class="container">
    <div class="row content d-flex justify-content-center align-items-center">
      <div class="col-md-5 loginSection ">
        <div class="Loginbox shadow p-5 mb-5">
            <div class="mb-4 text-center">
                <a href="#"><img src="{{ asset('img/logoLoginBack.png') }}"></a>
            </div>
            <h3 class="mb-3 text-start loginHeading">Login</h3>
          <form action="{{ route('admin.check') }}" method="post" autocomplete="on">
        @if (Session::get('fail'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="loginError"> {{ Session::get('fail') }}<span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
        @endif
        @if (Session::get('exception-error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="loginError"> {{ Session::get('exception-error') }}<span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
        @csrf
            <div class="form-group mb-2 ">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control form-control-md rounded-0  @error('email') is-invalid @enderror" name="email" placeholder="Enter Email" value="{{ old('email') }}">
              <span class="text-danger inputErrors">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group  mb-4">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-md rounded-0 @error('password') is-invalid @enderror" name="password" placeholder="Enter password" value="{{ old('password') }}">
              <span class="text-danger inputErrors">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="d-grid mb-2">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0">LOGIN</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- login end -->
@endsection