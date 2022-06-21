@extends('layouts.app')

@section('title', 'REGISTER - ')

@section('content')
   {{-- page path  --}}
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">REGISTER</p>
        </div>
      </div>
    </div>
    <div class="row">
      @if (Session::get('exception-error'))
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <span class="loginError"> {{ Session::get('exception-error') }}<span>
          <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
      @endif
    </div>
  </div>
  {{--  page path end --}}

  {{-- register  --}}
  <div class="container mb-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-8 shadow registerBox">
        <div class="p-5 registerPading">
          <form action="{{ route('user.create') }}"  method="POST" autocomplete="off" class="row">
            @if (Session::get('success')    )
            <div class="alert alert-success">
                {{ Session::get('success') }} <a class="goBackLogin"href="{{ route('user.login') }}">Click here to login</a>
            </div>
            @endif
            @if (Session::get('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
            @endif
            @csrf
            <div class="mb-3 registerHeadingBox col-md-12">
              <h2 class="registerHeding">Personal Data</h2>
            </div>
            <div class="form-group mb-2  me-4 ms-4 registerGroup">
              <label for="firstName" class="form-label registerLable">First Name</label>
              <input type="text" name="firstName"class="form-control form-control-md rounded-0 registerInput @error('firstName') is-invalid @enderror"  placeholder="Enter Your First Name" value="{{ old('firstName') }}" autofocus>
              <span class="text-danger">@error('firstName'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4  registerGroup">
              <label for="lastName" class="form-label registerLable">Last Name</label>
              <input type="text" name="lastName" class="form-control form-control-md rounded-0 registerInput @error('lastName') is-invalid @enderror" placeholder="Enter Your Last Name" value="{{ old('lastName') }}">
              <span class="text-danger">@error('lastName'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4  registerGroup">
              <label for="houseNo" class="form-label registerLable">House No</label>
              <input type="text" name="houseNo"class="form-control form-control-md rounded-0 registerInput @error('houseNo') is-invalid @enderror" placeholder="Enter Your House No" value="{{ old('houseNo') }}">
              <span class="text-danger">@error('houseNo'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="street" class="form-label registerLable">Street</label>
              <input type="text" name="street"class="form-control form-control-md rounded-0 registerInput @error('street') is-invalid @enderror" placeholder="Enter Your Street Name" value="{{ old('street') }}">
              <span class="text-danger">@error('street'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="city" class="form-label registerLable">City</label>
              <input type="text"name="city" class="form-control form-control-md rounded-0 registerInput @error('city') is-invalid @enderror" placeholder="Enter Your City Name" value="{{ old('city') }}">
              <span class="text-danger">@error('city'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="district" class="form-label registerLable">District</label>
              <input type="text" name="district" class="form-control form-control-md rounded-0 registerInput @error('district') is-invalid @enderror" placeholder="Enter Your district Name" value="{{ old('district') }}">
              <span class="text-danger">@error('district'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="zipCode" class="form-label registerLable">Zip Code</label>
              <input type="text" name="zipCode" class="form-control form-control-md rounded-0 registerInput @error('zipCode') is-invalid @enderror" placeholder="Enter Your Zip Code" value="{{ old('zipCode') }}">
              <span class="text-danger">@error('zipCode'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-3 me-4 ms-4 registerGroup">
              <label for="phoneNo" class="form-label registerLable">Phone</label>
              <input type="text" name="phoneNo" class="form-control form-control-md rounded-0 registerInput @error('phoneNo') is-invalid @enderror" placeholder="Enter Your Phone Number" value="{{ old('phoneNo') }}">
              <span class="text-danger">@error('phoneNo'){{ $message }}@enderror</span>
            </div>
            <div class="registerHeadingBox">
              <h2 class="mb-3 registerHeding"> Login Data</h2>
            </div>
            <div class="form-group me-4 ms-4 registerGroup">
              <p class="loginInfo">Please enter your e-mail address and choose a password to create an account.</p>
            </div>
            
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="email" class="form-label registerLable">Email</label>
              <input type="email" name="email" class="form-control form-control-md rounded-0 registerInput @error('email') is-invalid @enderror" placeholder="Enter Your Email" value="{{ old('email') }}">
              <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-2 me-4 ms-4 registerGroup">
              <label for="password" class="form-label registerLable">Password</label>
              <input type="password" name="password" class="form-control form-control-md rounded-0 registerInput @error('password') is-invalid @enderror" placeholder="Enter password" value="{{ old('password') }}" >
              <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-4 me-4 ms-4 registerGroup">
              <label for="conpassword" class="form-label registerLable ">Confirm Password</label>
              <input type="password" name="conpassword" class="form-control form-control-md rounded-0 registerInput @error('conpassword') is-invalid @enderror" placeholder="Enter Confirm Password" value="{{ old('conpassword') }}">
              <span class="text-danger">@error('conpassword'){{ $message }}@enderror</span>
            </div>
            <div class="form-group mb-4 me-4 ms-4 registerGroup">
              {!! NoCaptcha::renderJs() !!}
              {!! NoCaptcha::display() !!}
              <span class="text-danger">@error('g-recaptcha-response'){{ $message }}@enderror</span>
            </div>
            
            <div class="d-grid mb-2 me-4 ms-4 registerGroup ">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0 registerSubmit">SUBMIT</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
 {{-- register end --}}


@endsection
