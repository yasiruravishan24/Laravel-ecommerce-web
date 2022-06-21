@extends('layouts.app')

@section('title', 'MY ACCOUNT - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">MY ACCOUNT</p>
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

  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    @include('layouts.myaccount-slidebar')
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="d-flex align-items-center ms-5 mt-5 my-account-heading">
        <i class="bi bi-text-left me-4" id="menu-toggle"></i>
        <h2 class="m-0">My details</h2>
      </div>

      <div class="container-fluid px-5 mt-4 profile-container">
        <div class="row">
          <div class="col-md-12">
            <h5 class="profile-heading">Personal Information</h5>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <p class="profile-para">Personal info and options to manage it. You can make some of this info, like your
              contact details, visible to us so we can reach you easily</p>
          </div>
          <div class="col-md-7">
            <div class="row">
              <form action="{{ route('user.updateProdile', Auth::user()->id) }}" method="POST" id="profile-form" autocomplete="off">
                @csrf

                @if (Session::get('successUpdate'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('successUpdate') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (Session::get('fail'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('fail') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <div class="mb-3">
                  <label for="firstName" class="form-label profile-input-label @error('firstName') is-invalid @enderror">First Name</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('firstName') is-invalid @enderror" name="firstName" value="{{ old('firstName', Auth::user()->firstName) }}">
                  <span class="text-danger">@error('firstName'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="secondName" class="form-label  profile-input-label @error('secondName') is-invalid @enderror">Second Name</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('secondName') is-invalid @enderror"  name="secondName" value="{{ old('secondName', Auth::user()->lastName) }}">
                  <span class="text-danger">@error('secondName'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="phone" class="form-label  profile-input-label @error('phone') is-invalid @enderror">Phone</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone', Auth::user()->phoneNo) }}">
                  <span class="text-danger">@error('phone'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="email" class="form-label  profile-input-label @error('email') is-invalid @enderror">Email</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('email') is-invalid @enderror" name="email" value="{{ old('email', Auth::user()->email) }}">
                  <span class="text-danger">@error('email'){{ $message }}@enderror</span>
                </div>
                <div class="mb-5">
                  <button type="submit" class="btn btn-dark btn-lg rounded-0  profile-submit-btn" id="profile-save-btn" disabled>SAVE</button>
                </div>
              </form>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-md-12">
            <h5 class="profile-heading">Log in Information</h5>
            <hr>
          </div>
        </div>
        <div class="row">
          <div class="col-md-5">
            <p class="profile-para">Make your password stronger, or change it if someone else knows it</p>
          </div>
          <div class="col-md-7">
            <div class="row">
              <form action="{{ route('user.updatePassword', Auth::user()->id) }}" method="POST" autocomplete="off">
                @csrf
                @if (Session::get('successUpdatePass'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('successUpdatePass') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                @if (Session::get('failPass'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{ Session::get('failPass') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                @endif

                <div class="mb-3">
                  <label for="password" class="form-label  profile-input-label @error('password') is-invalid @enderror">Password</label>
                  <input type="password" class="form-control rounded-0 profile-input @error('password') is-invalid @enderror"  name="password">
                  <span class="text-danger">@error('password'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="conpassword" class="form-label  profile-input-label @error('conpassword') is-invalid @enderror">Confirm Password</label>
                  <input type="password" class="form-control rounded-0 profile-input @error('conpassword') is-invalid @enderror" name="conpassword">
                  <span class="text-danger">@error('conpassword'){{ $message }}@enderror</span>
                </div>
                <div class="mb-5">
                  <button type="submit" class="btn btn-dark btn-lg rounded-0  profile-submit-btn">CHANGE
                    PASSWORD</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

@endsection

@section('javascript')
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
        el.classList.toggle("toggled");
        };
      </script>
@endsection
