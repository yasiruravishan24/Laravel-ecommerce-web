@extends('layouts.app')

@section('title', 'CHECKOUT - ')

@section('content')

<!-- page path -->
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">CHECKOUT</p>
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
  <!-- page path end -->

  @php
      $subTotal = 0 ;
      foreach (Auth::user()->cart->items as $key => $oneCartitem) {
          $subTotal = $subTotal + $oneCartitem->price * $oneCartitem->pivot->quantity;
      }
  @endphp

  <div class="container mb-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-9 shadow checkoutBox">
        <div class="p-5 checkoutPading">
          <form action="{{route('user.storeorders')}}" autocomplete="off" method="POST">
            @csrf
            <div class="mb-3 checkoutHeadingBox">
              <h2 class="checkoutHeding-main">CHECKOUT</h2>
            </div>
            <div class="checkoutHeadingBox mt-4">
              <h4 class="mb-3 checkoutHeding">Shipping Details</h4>
            </div>

            <div class="form-group mb-2  me-4 ms-4 checkoutGroup">
              <label for="firstName" class="form-label checkoutLable">Name : {{Auth::user()->firstName.' '.Auth::user()->lastName}}</label>
            </div>
            <div class="form-group mb-2  me-4 ms-4 checkoutGroup">
              <label for="firstName" class="form-label checkoutLable">Email : {{Auth::user()->email}}</label>
            </div>
            <div class="form-group mb-2  me-4 ms-4 checkoutGroup">
              <label for="firstName" class="form-label checkoutLable">Phone : {{Auth::user()->phoneNo}}</label>
            </div>
            <div class="form-group mb-2  me-4 ms-4 checkoutGroup">
              <label for="firstName" class="form-label checkoutLable">Address : {{ Auth::user()->houseNo.', '.Auth::user()->street.', '.Auth::user()->city .', '. Auth::user()->district}}</label>
            </div>
            <div class="form-group mb-2  me-4 ms-4 checkoutGroup">
              <label for="firstName" class="form-label checkoutLable">Zip Code : {{Auth::user()->zipCode}} </label>
            </div>
      

            <div class="checkoutHeadingBox mt-4">
              <h4 class="mb-3 checkoutHeding">Select payment method</h4>
            </div>

            <div class="form-group mb-2 me-4 ms-4 checkoutGroup">
              <div class="form-check">
                <input class="form-check-input checkout-check" type="radio" name="paymentMethod" id="paymentMethod1" value="C" checked>
                <label class="form-check-label checkoutLable" for="paymentMethod1">
                  Cash On Deliver
                </label>
              </div>
              <div class="form-check">
                <input class="form-check-input checkout-check" type="radio" name="paymentMethod" id="paymentMethod2" value="B">
                <label class="form-check-label checkoutLable" for="paymentMethod2">
                  Bank Transaction
                </label>
              </div>
            </div>
            <div class="checkoutGroup me-5 ms-5">
              <div class="checkout-box p-5 mt-5 mb-5">
                <h3 class="mb-3 ">Cart Summery</h3>
               <table class="table table-borderless checkout-summery-Tables">
                <tbody>
                  <tr>
                    <td>Sub Total</th>
                    <input type="hidden" name="subTotal" value="{{ $subTotal}}">
                    <td class="checkout-summery-Tables-data">Rs.{{ number_format($subTotal) }}</td>
                  </tr>
                  <tr>
                    <td>Amount discounted {{ $rates[1]->rate }}%</td>
                     <input type="hidden" name="discount" value="{{ $subTotal * $rates[1]->rate / 100 }}">
                    <td class="checkout-summery-Tables-data">Rs.{{ number_format( $subTotal * $rates[1]->rate / 100 ) }}</td>
                  </tr>
                  <tr>
                    <td>Tax {{ $rates[0]->rate }}%</td>
                     <input type="hidden" name="tax" value="{{ ($subTotal - ($subTotal * $rates[1]->rate / 100)) * $rates[0]->rate / 100}}">
                    <td class="checkout-summery-Tables-data">Rs.{{ number_format(($subTotal - ($subTotal * $rates[1]->rate / 100)) * $rates[0]->rate / 100) }}</td>
                  </tr>
                  <tr>
                    <td colspan="2"><hr></td>
                  </tr>
                  <tr>
                    <td>Grand Total</td>
                    <td class="checkout-summery-Tables-data">Rs.{{ number_format(($subTotal  - ($subTotal * $rates[1]->rate / 100 )) + (($subTotal - ($subTotal * $rates[1]->rate / 100)) * $rates[0]->rate / 100)) }}</td>
                  </tr>
                </tbody>
                </table>
              </div>
            </div>

            <div class=" mb-2 me-4 ms-4 checkoutGroup text-center">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0 checkoutSubmit">PLACE ORDER</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
    
@endsection