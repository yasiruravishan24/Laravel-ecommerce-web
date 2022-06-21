@extends('layouts.app')

@section('title', 'MY WISHLIST - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">MY WISHLIST</p>
        </div>
      </div>
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
        <h2 class="m-0">My wishlist</h2>
      </div>
      <div class="container-fluid px-5 mt-4 profile-container mb-5">

        <div class="table-responsive-md ">
          <table class="table wishlistTables text-wrap" id="wishlistTable">
            <tbody>

              @forelse(Auth::user()->wishlist->items as $oneWishListItem)
                <tr>
                  <td class="wish-tb-image-column" >
                    <a href="/items/{{ $oneWishListItem->id }}" class="text-decoration-none">
                      <img class="border  wish-td-image" src="{{ asset('itemImages/'.$oneWishListItem->imagePath) }}">
                    </a>
                  </th>
                  <td class="wish-td-content">
                    @if($oneWishListItem->quantity <= 0)
                      <span class="badge bg-success rounded-0 wish-out-stocktage">Out of stock</span>
                    @else
                      <span class="badge bg-success rounded-0 wish-stocktage">In stock</span>
                    @endif
                    <a href="/items/{{ $oneWishListItem->id }}" class="text-decoration-none"><h2>{{ $oneWishListItem->name }}</h2></a>
                    <h3>{{ $oneWishListItem->brandName }}
                      @foreach ($oneWishListItem->itemCategory as $oneCate)
                        @foreach ($cate as $oneCateItem)
                            @if ($oneCate->category == $oneCateItem->categoryValue)
                                - {{ $oneCateItem->categoryName}}
                                @break
                            @endif
                        @endforeach
                      @endforeach
                    </h3>
                    <h4>Rs.{{ number_format($oneWishListItem->price ) }}</h4>
                    <h5>Available Sizes</h5>
                    <div class="d-inline">
                      @foreach($oneWishListItem->itemSizes->sortBy('size') as $oneSize)
                        <span class="badge bg-dark rounded-0 wishlistItemSize">{{ $oneSize->size }}</span>
                      @endforeach
                    </div>

                  </td>
                  <td class="wish-td-option">
                    <a class="homeitemAddTowishtlink" href="{{ route('user.removeFromWishlist',['item_id' => $oneWishListItem->id , 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistRemovePage-form{{  $oneWishListItem->id  }}').submit();"><i class="bi bi-x-circle-fill wishlist-DropIcon "></i>
                      <form action="{{ route('user.removeFromWishlist',['item_id' => $oneWishListItem->id , 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemovePage-form{{  $oneWishListItem->id  }}" class="d-none">@method('delete')@csrf</form></a>                         
                  </td>
                </tr>
              @empty  
                <div class="container">
                  <div class="row">
                  <div class="col-md-12 text-center mt-5 mb-5">
                      <h4 class="NorelatedProductHeading">No wishlist items</h4>
                  </div>
                  </div>
                </div>  
              @endforelse
            </tbody>
          </table>
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

        $("#wishlistTable").simplePagination({

            // the number of rows to show per page
            perPage: 3,

            // CSS classes to custom the pagination
            containerClass: '',
            previousButtonClass: 'btn btn-primary border-0',
            nextButtonClass: 'btn btn-primary border-0',

            // text for next and prev buttons
            previousButtonText: 'Previous',
            nextButtonText: 'Next',

            // initial page
            currentPage: 1
        });
        
      </script>
@endsection