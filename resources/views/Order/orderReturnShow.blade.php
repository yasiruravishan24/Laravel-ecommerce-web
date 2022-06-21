@extends('layouts.appAdmin')

@section('title', 'RETURN ITEM - ')

@section('content')
 <!-- main -->
 <main class="mt-5 pt-3 mb-5">
    <div class="container-fluid">
      <div class="row">
        <div class="col-md-12 mb-3">
          <h2 class="adminHeading">
            Returned Item
          </h2>
        </div>
      </div>
      <div class="row">
        @if (Session::get('stock-problem'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('stock-problem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (Session::get('cant-find-item'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('cant-find-item') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (Session::get('size-problem'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            {{ Session::get('size-problem') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (Session::get('same-item'))
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            {{ Session::get('same-item') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif

        @if (Session::get('exception-error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
          <span class="loginError"> {{ Session::get('exception-error') }}<span>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>
        @endif
      </div>
      <div class="row">
        <div class="col-md-12 mb-4">
          <div class="btn-group returnActionbtn-group" role="group">
            <input type="radio" class="btn-check returnAction" name="btnradio" id="btnradio1" autocomplete="off" value="size" checked>
            <label class="btn btn-outline-dark rounded-0 returnActionbtn" for="btnradio1">Change Ordered Size</label>
          
            <input type="radio" class="btn-check returnAction" name="btnradio" id="btnradio2" autocomplete="off" value="quantity">
            <label class="btn btn-outline-dark rounded-0 returnActionbtn" for="btnradio2">Change Damage Item</label>
          </div>
        </div>
      </div>
      <div  id="sizeChange">
        <div class="row">
          <div class="col-md-12">
            <form class="row g-3" method="post" autocomplete="off" action="{{ route('admin.returnItemSizeUpdate') }}">
              @csrf
              <div class="col-md-2">
                <label for="validationCustom01" class="form-label changeItemLable">Order ID</label>
                <a href="{{ route('admin.ordershow', $orderItem->order_id) }}" class="form-control rounded-0 changeItemInput changeItemInput-link text-decoration-none" readonly target="_black">{{ $orderItem->order_id }}</a>
                <input type="hidden" name="orderId" value="{{$orderItem->order_id   }}">
                <input type="hidden" name="orderItemsId" value="{{ $orderItem->id   }}">
              </div>
              <div class="col-md-2">
                <label for="validationCustom01" class="form-label changeItemLable">Item ID</label>
                <a href="/items/{{ $orderItem->item_id  }}" class="form-control rounded-0 changeItemInput changeItemInput-link text-decoration-none" readonly target="_black">{{ $orderItem->item_id}}</a>
                <input type="hidden" name="itemId" value="{{$orderItem->item_id   }}">
              </div>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label changeItemLable">Item Name</label>
                <input type="text" class="form-control rounded-0 changeItemInput" readonly value="{{ $item->name }}">
              </div>
              <div class="col-md-4">
                <label for="validationCustom01" class="form-label changeItemLable">Brand</label>
                <input type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $item->brandName }}">
              </div>
              <div class="col-md-3">
                <label for="validationCustom01" class="form-label changeItemLable">Ordered Size</label>
                <input name="orderedSize" type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $orderItem->size  }}">
              </div>
              <div class="col-md-3">
                <label for="validationCustom01" class="form-label changeItemLable">Ordered Quantity</label>
                <input name="orderedQuantity" type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $orderItem->quantity  }}">
              </div>
              <div class="col-md-2">
                <label for="validationCustom02" class="form-label changeItemLable">Available Stock</label>
                <input type="text" class="form-control rounded-0 changeItemInput"  readonly  value="{{ $item->quantity  }}">
              </div>
              <div class="col-md-2">
                <label for="validationCustom02" class="form-label changeItemLable @error('sizeExchange') is-invalid @enderror">Change Size</label>
                <select name="sizeExchange" class="form-select changeItemInput rounded-0 @error('sizeExchange') is-invalid @enderror" aria-label="Default select example">
                  <option value="" selected>Select Size</option>
                  @foreach ($item->itemSizes as $oneSizeItem)

                  @if($orderItem->size == $oneSizeItem->size)
                    @continue
                  @endif
                  
                    <option value="{{ $oneSizeItem->size }}">{{ $oneSizeItem->size }}</option>            
                  @endforeach
                </select>
                <span class="text-danger">@error('sizeExchange'){{ $message }}@enderror</span>
              </div>
              <div class="col-md-2">
                <label for="validationCustom02" class="form-label changeItemLable @error('sizeExchangeQuantity') is-invalid @enderror">Quantity</label>
                <input name="sizeExchangeQuantity" type="number" class="form-control rounded-0 changeItemInput @error('sizeExchangeQuantity') is-invalid @enderror"  max="{{ $orderItem->quantity  }}" min="1" value="{{ old('sizeExchangeQuantity') }}">
                <span class="text-danger">@error('sizeExchangeQuantity'){{ $message }}@enderror</span>
              </div>
  
              <div class="col-12 mt-4 changeItemSubmitGrid">
                <button class="btn btn-primary rounded-0 changeItemSubmit" type="submit">UPDATE</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    <div  id="quantityChange">
      <div class="row">
        <div class="col-md-12">
          <form class="row g-3 needs-validation" method="post" autocomplete="off" action="{{ route('admin.returnItemUpdate') }}">
            @csrf
            <div class="col-md-2">
              <label for="validationCustom01" class="form-label changeItemLable">Order ID</label>
              <a href="{{ route('admin.ordershow', $orderItem->order_id) }}" class="form-control rounded-0 changeItemInput changeItemInput-link text-decoration-none" readonly target="_black">{{ $orderItem->order_id }}</a>              <input type="hidden" name="orderId" value="{{$orderItem->order_id   }}">
              <input type="hidden" name="orderItemsId" value="{{ $orderItem->id   }}">
            </div>
            <div class="col-md-2">
              <label for="validationCustom01" class="form-label changeItemLable">Item ID</label>
              <a href="/items/{{ $orderItem->item_id  }}" class="form-control rounded-0 changeItemInput changeItemInput-link text-decoration-none" readonly target="_black">{{ $orderItem->item_id }}</a>
              <input type="hidden" name="itemId" value="{{$orderItem->item_id   }}">
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label changeItemLable">Item Name</label>
              <input type="text" class="form-control rounded-0 changeItemInput" readonly value="{{ $item->name }}">
            </div>
            <div class="col-md-4">
              <label for="validationCustom01" class="form-label changeItemLable">Brand</label>
              <input type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $item->brandName }}">
            </div>
            <div class="col-md-3">
              <label for="validationCustom01" class="form-label changeItemLable">Ordered Size</label>
              <input name="orderedSize" type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $orderItem->size  }}">
            </div>
            <div class="col-md-3">
              <label for="validationCustom01" class="form-label changeItemLable">Ordered Quantity</label>
              <input name="orderedQuantity" type="text" class="form-control rounded-0 changeItemInput"  readonly value="{{ $orderItem->quantity  }}">
            </div>
            <div class="col-md-3">
              <label for="validationCustom02" class="form-label changeItemLable">Available Stock</label>
              <input type="text" class="form-control rounded-0 changeItemInput"  readonly  value="{{ $item->quantity  }}">
              <input type="hidden" name="price" value="{{ $item->price }}">
            </div>
            <div class="col-md-3">
              <label for="validationCustom02" class="form-label changeItemLable @error('exchangeQuantity') is-invalid @enderror">No of Items Exchange</label>
              <input name="exchangeQuantity" type="number" class="form-control rounded-0 changeItemInput @error('exchangeQuantity') is-invalid @enderror" id="inp3" max="{{ $orderItem->quantity  }}" min="1" value="{{ old('exchangeQuantity') }}">
              <span class="text-danger">@error('exchangeQuantity'){{ $message }}@enderror</span>
            </div>
            <div class="col-12 mt-4 changeItemSubmitGrid">
              <button class="btn btn-primary rounded-0 changeItemSubmit" type="submit">UPDATE</button>
            </div>
          </form>
        </div>
      </div>
    </div>
    </div>
  </main>

@endsection



@section('javascript')

    <script type="text/javascript">
      $("#quantityChange").hide();
      $(document).on('click', '.returnAction', function (){
        var inputValue = $(this).attr("value");
        if (inputValue == "size") {
          $("#sizeChange").show();
          $("#quantityChange").hide();
        } else {
          $("#sizeChange").hide();
          $("#quantityChange").show();
        }
      });
    </script>
    
@endsection