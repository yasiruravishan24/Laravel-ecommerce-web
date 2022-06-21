@extends('layouts.app')

@section('title', 'MY ADDRESS - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">MY ADDRESS</p>
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
        <h2 class="m-0">My address</h2>
      </div>

      <div class="container-fluid px-5 mt-4 profile-container">
        <div class="row">
          <div class="col-md-5 profile-para">
            <p >Your usual or principal place of residence</p>
            <p><b>Address - </b>{{ Auth::user()->houseNo.', '.Auth::user()->street.', '.Auth::user()->city .', '. Auth::user()->district}}</p>
            <p><b>Zip Code - </b>{{ Auth::user()->zipCode }}</p>
          </div>
          <div class="col-md-7">
            <div class="row">
              <form action="{{ route('user.updateAddress', Auth::user()->id) }}" method="POST" id="profile-address-form" autocomplete="off">
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
                  <label for="houseNo" class="form-label profile-input-label @error('houseNo') is-invalid @enderror">House No</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('houseNo') is-invalid @enderror" name="houseNo" value="{{ old('houseNo', Auth::user()->houseNo) }}">
                  <span class="text-danger">@error('houseNo'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="street" class="form-label  profile-input-label @error('street') is-invalid @enderror">Street</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('street') is-invalid @enderror" name="street" value="{{ old('street', Auth::user()->street) }}">
                  <span class="text-danger">@error('street'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="city" class="form-label  profile-input-label @error('city') is-invalid @enderror">City</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('city') is-invalid @enderror" name="city" value="{{ old('city', Auth::user()->city) }}">
                  <span class="text-danger">@error('city'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="district" class="form-label  profile-input-label @error('district') is-invalid @enderror">District</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('district') is-invalid @enderror" name="district" value="{{ old('district', Auth::user()->district) }}">
                  <span class="text-danger">@error('district'){{ $message }}@enderror</span>
                </div>
                <div class="mb-3">
                  <label for="zipCode" class="form-label  profile-input-label @error('zipCode') is-invalid @enderror">Zip Code</label>
                  <input type="text" class="form-control rounded-0 profile-input @error('zipCode') is-invalid @enderror" name="zipCode" value="{{ old('zipCode', Auth::user()->zipCode) }}">
                  <span class="text-danger">@error('zipCode'){{ $message }}@enderror</span>
                </div>
                <div class="mb-5">
                  <button type="submit" class="btn btn-dark btn-lg rounded-0  profile-submit-btn" id="profile-address-save-btn" disabled>SAVE</button>
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