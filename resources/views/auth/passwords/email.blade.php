@extends('layouts.app')

@section('content')


<!-- page path -->
<div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">RESET PASSWORD</p>
        </div>
      </div>
    </div>
  </div>
  <!-- page path end -->

  <!-- password reset -->
  <div class="container">
    <div class="row d-flex justify-content-center">
      <div class="col-md-6">
        <div class="Loginbox shadow p-5 mb-5">
          <h3 class="mb-3 text-start loginHeading">Reset Password</h3>
          <form action="{{ route('password.email') }}" method="POST" autocomplete="off">
            @if (Session::get('status')    )
            <div class="alert alert-success">
                {{ Session::get('status') }}
            </div>
            @endif
            @csrf
            <div class="form-group mb-4 ">
              <label for="email" class="form-label">Email</label>
              <input type="text" name="email" class="form-control form-control-md rounded-0 registerInput @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{ old('email') }}"  autofocus>
              <span class="text-danger inputErrors">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="d-grid mb-3">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0">SEND PASSWORD RESET LINK</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- password reset end -->
@endsection
