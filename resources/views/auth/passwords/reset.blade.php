@extends('layouts.appAdminLogin')
@section('title', 'PASSWORD RESET - ')

@section('content')
<!-- reset password  -->
<div class="container">
    <div class="row contentReset d-flex justify-content-center align-items-center">
      <div class="col-md-5 loginSection ">
        <div class="Loginbox shadow p-5">
            <h3 class="mb-3 text-start loginHeading">Reset Password</h3>
          <form action="{{ route('password.update') }}" method="post" autocomplete="off">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="form-group mb-2 ">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control form-control-md rounded-0  @error('email') is-invalid @enderror" name="email" id="email" placeholder="Enter Email" value="{{ $email ?? old('email') }}" readonly>
              <span class="text-danger inputErrors">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group  mb-4">
              <label for="password" class="form-label">New Password</label>
              <input id="password" type="password" class="form-control form-control-md rounded-0 @error('password') is-invalid @enderror" name="password" placeholder="Enter New Password">
              <span class="text-danger inputErrors">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="form-group  mb-4">
                <label for="password-confirm" class="form-label">Confirm Password</label>
                <input id="password-confirm" type="password" class="form-control form-control-md rounded-0 @error('password-confirm') is-invalid @enderror" name="password_confirmation" placeholder="Enter Confirm Password">
                <span class="text-danger inputErrors">@error('password-confirm'){{ $message }}@enderror</span>
              </div>
            <div class="d-grid mb-2">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0">RESET PASSWORD</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- reset password end -->
@endsection
