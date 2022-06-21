@extends('layouts.app')

@section('title', 'LOGIN - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">LOGIN</p>
        </div>
      </div>
    </div>
  </div>
  {{--  page path end --}}
  <!-- login -->
  <div class="container">
    <div class="row contentUser d-flex justify-content-center">
      <div class="col-md-5 mt-2">
        <div class="Loginbox shadow p-5 mb-5">
          <h3 class="mb-3 text-start loginHeading">Login</h3>
          <form action="{{ route('user.check') }}" method="post" autocomplete="off">
            @csrf
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
            <div class="form-group mb-2 ">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control form-control-md rounded-0 @error('email') is-invalid @enderror" name="email" placeholder="Enter Email"  autofocus @if(Cookie::has('userEmail')) value="{{ Cookie::get('userEmail') }}" @else value="{{ old('email') }}" @endif)>
              <span class="text-danger inputErrors">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group  mb-2">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control form-control-md rounded-0 @error('password') is-invalid @enderror" name="password" placeholder="Enter password"  @if(Cookie::has('UserPsd')) value="{{ Cookie::get('UserPsd') }}" @else  value="{{ old('password') }}" @endif >
              <span class="text-danger inputErrors">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2">
              <div class="form-check">
                <div class="container">
                  <input type="checkbox" class="form-check-input rounded-0" name="remember" id="remember"  @if(Cookie::has('userEmail')) checked @else {{ old('rememberme') ? 'checked' : '' }} @endif>
                  <label for="checkbox" class="form-check-lable">Remember me</label>
                  <span class="fogotPass"><a href="{{ route('password.request') }}" class="forgotLink">Lost Your Password?</a></span>
                </div>
              </div>
            </div>
            <div class="d-grid mb-4">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0">LOGIN</button>
            </div>
            <div class="sign-up-accounts">
              <p class="text-center signInLinkText">Don’t have an account? <a href="{{ route('user.register') }}" class="signInLink">Sign up</a></p>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- login end -->
@endsection