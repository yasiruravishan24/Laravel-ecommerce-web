@extends('layouts.app')
@section('title', 'CART -' )
@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">CART</p>
        </div>
      </div>
    </div>
  </div>
  {{--  page path end --}}

    {{-- delete confirmation --}}
    <div class="modal fade" id="cartDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Remove cart item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  <strong class="deleteMessage">Are you sure that you want to remove this item from cart?</strong> 
              <form  method="POST" id="cartdeleteForm" class="mt-3"> 
                  @csrf
                  @method('delete')
                  <div class="modal-footer">
                  <button type="submit" class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 adminOptionBtn">YES</button>
                  <button type="reset" class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 adminOptionBtn" data-bs-dismiss="modal">NO</button>
                  </div>
              </form>
          </div>
          </div>
      </div>
    </div>
  {{-- delete confirmation end --}}

        @php $subTotal = 0 ;@endphp

      <div class="container mb-5">
                {{--  alerts--}}
                @if (Session::get('cartRemoveSuccess'))
                <div class="row">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('cartRemoveSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              @endif
      
              @if (Session::get('stockError'))
                <div class="row">
                  <div class="col-md-12">
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                      {{ Session::get('stockError') }}
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                  </div>
                </div>
              @endif
      
              @if (Session::get('cartAddSuccess'))
                <div class="row">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('cartAddSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              @endif
      
              @if (Session::get('cartUpdateSuccess'))
                <div class="row">
                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('cartUpdateSuccess') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              @endif
             
              @if (Session::get('cartEmpty'))
                <div class="row">
                  <div class="alert alert-warning alert-dismissible fade show" role="alert">
                    {{ Session::get('cartEmpty') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div>
                </div>
              @endif

              @if (Session::get('exception-error'))
              <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="loginError"> {{ Session::get('exception-error') }}<span>
                  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
              @endif
              
        <div class="row">
          <div class="col-lg-12">
            <h3 class="cart-page-head">CART</h3>
          </div>
        </div>
        
        <div class="row">
          <div class="table-responsive-md">
            <form action="{{ route('user.updateCart') }}" method="POST" autocomplete="off" id="cart-update-form">
              @csrf
              <table class="table  cartTables text-wrap mb-5" id="cartTableMain">
                <thead>
                  <tr>
                    <th scope="col" colspan="2" class="text-start">Item details</th>
                    <th scope="col">Quantity</th>
                    <th scope="col">Sub Total</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse (Auth::user()->cart->items as $key => $oneCartitem)
                  <tr>
                    <td class="d-none">{{ $oneCartitem->pivot->id}}</td>
                    <td class="cart-tb-image-column">
                      <a href="/items/{{ $oneCartitem->id }}" class="text-decoration-none">
                        <img class="border  cart-td-image" src="{{ asset('itemImages/'.$oneCartitem->imagePath ) }}">
                      </a>
                    </td>
                    <td class="cart-td-content">
                      @if($oneCartitem->quantity <= 0)
                        <span class="badge bg-success rounded-0 cart-out-stocktage mb-1">Out of stock</span>
                      @else
                        <span class="badge bg-success rounded-0 cart-stocktage mb-1">In stock</span>
                      @endif
                      <h2 class="mb-1">{{ $oneCartitem->name }}</h2>
                      <h4 class="mb-1">Rs.{{ number_format($oneCartitem->price) }}</h4>
                      <h5 class="mb-3">Size - {{$oneCartitem->pivot->size  }}</h5>
                      <a id="cartTrashbutton"  class="text-decoration-none cart-items-DropIcon cartTrashbutton" ><i class="bi bi-trash"></i>Remove</a>                         
                    </td>
                    <td class="cart-td-quantity">
                      <input type="hidden" name="cart_item_id[]" value="{{ $oneCartitem->pivot->id  }}">
                      <input type="number" name="quantity[]" class="form-control rounded-0 text-center cart-quantity"  max="{{ $oneCartitem->quantity }}" min="1" value="{{ $oneCartitem->pivot->quantity  }}" @if($oneCartitem->quantity <= 0) disabled @endif>
                    </td>
                    <td class="cart-td-total">
                      @php $subTotal = $subTotal + $oneCartitem->price * $oneCartitem->pivot->quantity @endphp
                      <h4>Rs.{{ number_format($oneCartitem->price * $oneCartitem->pivot->quantity ) }}</h4>
                    </td>
                  </tr>
                  @empty
                    <td colspan="10" class="cart-td-content text-center"><h4>There are no items in your cart</h4></th>  
                  @endforelse
                </tbody>
              </table>
              <div class="text-center">
                @if (!is_null(Auth::user()->cart->items->first()))
                  <button type="submit" class="btn btn-primary rounded-0 ps-5 pe-5 cart-summery-btn" id="cart-update-btn" disabled>UPDATE CART</button>
                @else
                  <a type="button" href="/men" class="btn btn-primary rounded-0 ps-5 pe-5 cart-summery-btn" id="cart-update-btn">RETURN SHOP</a>
                @endif
              </div>
            </form>   
          </div>
        </div>
    </div>

    <div class="container mb-5">
      <div class="row justify-content-center">
        <div class="col-md-6">
          <div class="cart-box p-5">
            <h3 class="mb-3 ">Cart Summery</h3>
           <table class="table table-borderless cart-summery-Tables">
            <tbody>
              <tr>
                <td>Sub Total</th>
                <td class="cart-summery-Tables-data">Rs.{{ number_format($subTotal) }}</td>
              </tr>
              <tr>
                <td>Amount discounted {{ $rates[1]->rate }}%</td>
                <td class="cart-summery-Tables-data">Rs.{{ number_format( $subTotal * $rates[1]->rate / 100 ) }}</td>
              </tr>
              <tr>
                <td>Tax {{ $rates[0]->rate }}%</td>
                <td class="cart-summery-Tables-data">Rs.{{ number_format(($subTotal - ($subTotal * $rates[1]->rate / 100)) * $rates[0]->rate / 100) }}</td>
              </tr>
              <tr>
                <td colspan="2"><hr></td>
              </tr>
              <tr>
                <td>Grand Total</td>
                <td class="cart-summery-Tables-data">Rs.{{ number_format(($subTotal  - ($subTotal * $rates[1]->rate / 100 )) + (($subTotal - ($subTotal * $rates[1]->rate / 100)) * $rates[0]->rate / 100)) }}</td>
              </tr>
            </tbody>
          </table>
          <div class="text-center mt-5">
            <a href="{{ route('user.checkout') }}" class="btn btn-primary rounded-0 cart-summery-btn  ps-4 pe-4">PROCREED TO CHECKOUT</a>
          </div>
          </div>
        </div>
      </div>
    </div>   

@endsection    
@section('javascript')
    <script>
        // delete review
        $(document).ready(function (){
          $('#cartTableMain').on('click','.cartTrashbutton',function(){ 
              $tr = $(this).closest('tr');
              var data = $tr.children("td").map(function() {
                  return $(this).text();
              }).get();

              console.log(data[0]);

              $('#cartdeleteForm').attr('action', '/user/cart/'+ data[0]);
              $('#cartDeleteModal').modal('show');
          });
        });
        // delete review end

      </script>
@endsection
