@extends('layouts.app')

@section('title', $item->name." - ")

@section('content')
  <!-- page path -->
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
            class="pathArrowHead">{{ $item->name }}</p>
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


  

 <!-- product section -->
 <div class="container-fluid mt-1">
    <div class="row gx-2">
      <div class="col-md-6 text-center mb-2 ">
        <img src="{{ asset('itemImages/'.$item->imagePath) }}" class="img-fluid border border-dark itemImage" width="610">
      </div>
      <div class="col-md-6">
        <div class="item-content">
          <div class="instock-tag mb-2">
              @if ($item->quantity > 0)
                 <span class="badge bg-success rounded-0 stocktage">In stock</span>
              @else
              <span class="badge bg-danger rounded-0 outStocktage">Out of stock</span>
              @endif
            
          </div>
          <div class="item-name">
            <h2 class="proItemName m-0">{{ $item->name }}</h2>
          </div>
          <div class="item-category">
            <h5 class="proItemCate">{{ $item->brandName }} 
                @foreach ($item->itemCategory as $oneCate)
                    @foreach ($cate as $oneCateItem)
                        @if ($oneCate->category == $oneCateItem->categoryValue)
                            - {{ $oneCateItem->categoryName}}
                            @break
                        @endif
                    @endforeach
                @endforeach
                </h5>
          </div>
          <div class="item-price mb-3">
            <h5 class="proItemPrice extraPriceMar">Rs.{{ number_format($item->price) }}</h5>
          </div>
          <div class="item-description mb-3 extraDesMar">
            <p class="proItemDescrip ">{{ $item->description }} </p>
          </div>
          <form action="{{ route('user.addtocart') }}" class="row g-3" method="POST" autocomplete="off">
            @csrf
            <div class="col-md-12">
              <div class="sizes">
                <div class="size-label">
                  <h5 class="proSizeLabel">UK SIZE</h5>
                </div>
                <div class="sizes">
                  <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                    <div class="btn-group" role="group" aria-label="First group">
                        @foreach ($item->itemSizes->sortBy('size') as $key=>$oneSizeItem)
                            <div class="me-2">
                                <input type="radio" class="btn-check " name="size" id="size{{ $oneSizeItem->size  }}" autocomplete="off"
                                    value="{{ $oneSizeItem->size }}" @if($key=== 0) checked @endif>
                                <label class="btn btn-outline-dark rounded-0 proSizeCheck" for="size{{ $oneSizeItem->size  }}">{{ $oneSizeItem->size  }}</label>
                          </div>
                        @endforeach
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-12">
              <div class="stock-label">
                <h6 class="proItemStockQu m-0 extraStockMar">{{ $item->quantity }} in stock</h6>
              </div>
            </div>
            <div class="col-md-5">
              <input type="hidden" name="item_id" id="item_id"value="{{ $item->id }}">
              <input type="hidden" name="item_name" id="item_id"value="{{ $item->name }}">
              <input type="hidden" name="item_quantity" id="item_quantity" value="{{ $item->quantity }}">
              @auth
              <input type="hidden" name="user_id" id="user_id"value="{{ Auth::user()->id }}">
              @endauth
              <input name="quantity" type="number" class="form-control rounded-0 proItemQuantity @error('quantity') is-invalid invalidQuantity @enderror" id="quantityinputBox" min="1" max="{{ $item->quantity }}" @if($item->quantity == 0) disabled @endif>
            </div>
            <div class="col-md-6 d-grid">
              <button class="btn  rounded-0 proAddtoCartbtn  @if($item->quantity == 0) proAddtoCartbtn-noStock @endif" type="submit" @if($item->quantity == 0) disabled @endif >ADD TO
                CART</button>
            </div>
          </form>
          <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
          <div class="add-wishlist mt-3 extraWishMar">
              <div class="col-md-12">
                <div class="add-wishlist align-middle extraWishMar">
                  @auth
                    @if(in_array($item->id, Auth::user()->wishlist->items->pluck('id')->toArray()))
                      <a class="proAddToCartlink" href="{{ route('user.removeFromWishlist',['item_id' => $item->id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistRemove-form').submit();"><i class="bi bi-heart-fill me-2 proAddtowishList "></i>REMOVE FROM
                        WISHLIST<form action="{{ route('user.removeFromWishlist',['item_id' => $item->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemove-form" class="d-none">@method('delete')@csrf</form></a>
                    @else
                      <a class="proAddToCartlink" href="{{ route('user.addToWishlist',['item_id' => $item->id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistAdd-form').submit();"><i class="bi bi-heart me-2 proAddtowishList" ></i>ADD TO
                        WISHLIST<form action="{{ route('user.addToWishlist',['item_id' => $item->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistAdd-form" class="d-none">@method('post')@csrf</form></a>   
                    @endif
                  @else
                  <a class="proAddToCartlink" href="{{ route('user.login') }}"><i class="bi bi-heart me-2 proAddtowishList "></i>ADD TO
                    WISHLIST</a>                 
                  @endauth
                </div>
              </div>
          </div>
        </div>

      </div>
    </div>
  </div>

  {{-- Related Items --}}
  <div class="container mt-5 mb-5">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="relatedProductHeading">Related Items</h2>
      </div>
    </div>
  </div>

  <div class="container">
    <div class="row relatedItems justify-content-center">
        @forelse ($related as $Rkey=>$oneRelatedItem)
            <div class="col-md-4 col-lg-4 mb-3">
                <div class="card rounded-0 proItemCard text-center">
                  <a href="/items/{{ $oneRelatedItem->id }}" class="text-decoration-none">
                      <img src="{{ asset('itemImages/'.$oneRelatedItem->imagePath) }}" class="card-img-top">
                  </a>
                  <div class="card-img-overlay text-end">
                    @auth
                      @if(in_array( $oneRelatedItem->id , Auth::user()->wishlist->items->pluck('id')->toArray()))
                      <a class="proAddToCartlink" href="{{ route('user.removeFromWishlist',['item_id' => $oneRelatedItem->id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistRemovecard-form{{  $oneRelatedItem->id }}').submit();"><i class="bi bi-heart-fill me-2 proAddtowishList "></i>
                        <form action="{{ route('user.removeFromWishlist',['item_id' => $oneRelatedItem->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemovecard-form{{  $oneRelatedItem->id }}" class="d-none">@method('delete')@csrf</form></a>               
                      @else
                        <a class="proAddToCartlink" href="{{ route('user.addToWishlist',['item_id' => $oneRelatedItem->id , 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistAddcard-form{{  $oneRelatedItem->id }}').submit();"s><i class="bi bi-heart me-2 proAddtowishList"></i></a>  
                          <form action="{{ route('user.addToWishlist',['item_id' => $oneRelatedItem->id , 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistAddcard-form{{ $oneRelatedItem->id }}" class="d-none">@method('post')@csrf</form></a>               
                      @endif
                    @else
                    <a class="proAddToCartlink" href="{{ route('user.login') }}"><i class="bi bi-heart me-2 proAddtowishList"></i></a>                
                    @endauth
                  </div>
                  <div class="card-body">
                      <a href="/items/{{ $oneRelatedItem->id }}" class="text-decoration-none"><h5 class="proItemCard-title">{{ $oneRelatedItem->name }}</h5></a>
                      <h5 class="proItemCard-price">Rs.{{ number_format($oneRelatedItem->price) }}</h5>
                      <a href="/items/{{ $oneRelatedItem->id }}" class="btn btn-primary ps-5 pe-5 mb-2 rounded-0 proCardaddbtn " role="button" aria-disabled="true">ADD TO CART</a>
                  </div>
                  </div>
            </div>
            @if($Rkey==2)
                @break
            @endif
        @empty
            <div class="container">
                <div class="row">
                <div class="col-md-12 text-center">
                    <h4 class="NorelatedProductHeading">No related items</h4>
                </div>
                </div>
            </div>        
        @endforelse
    </div>
</div>

  <div class="container mt-5 mb-3" id="reviewSection">
    <div class="row">
      <div class="col-md-12 text-center">
        <h2 class="relatedProductHeading">Customer Reviews</h2>
      </div>
    </div>
  </div>

  <div class="container">
    @if (Session::get('success-add'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('success-add') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
      </div>
    @endif
    <div class="row readMore">
      @forelse ($item->reviews as $oneReviewItem)
        <hr class="reviewDivider">
        <div class="col-md-6">
          <div class="profile text-end">
            <div class="text-center">
              <span class="dot"><span class="profileName">{{ $oneReviewItem->users->firstName[0].$oneReviewItem->users->lastName[0] }}</span></span>
              <h5 class="ReviewcustomerName">{{ $oneReviewItem->users->firstName.' '.$oneReviewItem->users->lastName }} </h5>
              <h5 class="ReviewcustomerEmail">{{ $oneReviewItem->users->email }}</h5>
            </div>
          </div>
        </div>
        <div class="col-md-6">
          <div class="reviewContent">
            <div class="reviewItemName proItemReviewContent">
              <h5 class="reviewProName">{{ $item->name }}</h5>
              <div class="ratingStars d-inline">
                @for ($i = 0; $i < $oneReviewItem->rating; $i++)
                    <i class="bi bi-star-fill"></i>
                @endfor
                @for ($i = 0; $i < 5-$oneReviewItem->rating; $i++)
                    <i class="bi bi-star"></i>
                @endfor
              </div>
              <div class="reviewBody mt-2">
                <p class="reviewmessage">{{ $oneReviewItem->message }}</p>
              </div>
              @if ($oneReviewItem->reply_message)
                <div class="reviewItemName proItemReviewContent">
                  <h5 class="reviewProName">Flip Flop</h5>
                  <div class="reviewBody mt-2">
                    <p class="reviewmessage">{{ $oneReviewItem->reply_message }}</p>
                  </div>
                </div>
              @endif
            </div>
          </div>
        </div> 
      @empty
        <div class="container">
          <div class="row">
          <div class="col-md-12 text-center">
              <h4 class="NorelatedProductHeading">No reviews</h4>
          </div>
          </div>
        </div>  
      @endforelse
    </div>
  </div>


  <div class="container mt-5 mb-5" id="writeReview">
    <div class="row">
      <div class="col-mb-12 text-center">
        @auth
          <a href="{{ route('user.addreviews',$item->id) }}" class="btn btn-primary btn-lg ps-5 pe-5 mb-2 rounded-0 proWriteReview">Write Review</a>
        @else
          <a href="{{ route('user.login') }}" class="btn btn-primary btn-lg ps-5 pe-5 mb-2 rounded-0 proWriteReview">Write Review</a>
        @endauth
      </div>
    </div>
  </div>
    
@endsection
    
@section('javascript')
    <script>
        $(document).ready(function () {
            $('.readMore').readall({
                // Default values
                showheight: 210,                         // height to show
                showrows: null,                         // rows to show (overrides showheight)
                animationspeed: 200,                    // speed of transition
                btnTextShowmore: 'Read more',           // text shown on button to show more
                btnTextShowless: 'Read less',           // text shown on button to show less
                btnClassShowmore: 'readall-button',     // class(es) on button to show more
                btnClassShowless: 'readall-button'      // class(es) on button to show less
            });
        });
    </script>
@endsection
