{{-- filter-small-screen  --}}
    <div class="container filter-small-screen mb-3">
        <div class="row">
        <div class="col-md-12">
            <div class="accordion accordion-flush" id="accordionFlushExample">
            <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                <button class="accordion-button collapsed filter-small-screen-btn rounded-0" type="button"
                    data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                    aria-controls="flush-collapseOne">
                    <div class="card-header filter-header">Filter By</div>
                </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                data-bs-parent="#accordionFlushExample">
                <div class="accordion-body">
                    <aside class="side-area product-side side-shadow">
                    <div class="card filterCard text-dark bg-light mb-3 rounded-0 text-start" style="max-width: 22rem;">
    
                        <div class="card-body filter-body">
                        <form action="{{ route('filter') }}" method="GET" autocomplete="off">
                          <div class="filter-by-brand mb-4">
                            <h5 class="filter-heading">BRANDS</h5>
                            <ul class="list-group">
                              @foreach($brand as $oneBrand)
                                <li class="list-group-item filter-brand">
                                  <input class="form-check-input me-1 rounded-0 filter-brand-input" name="brand[]" type="checkbox" value="{{ $oneBrand->brand }}"
                                  @if(!empty(request()->brand))
                                      @if (in_array($oneBrand->brand,request()->brand))
                                        checked
                                      @endif
                                  @endif>
                                    {{ $oneBrand->brand }}
                                </li>
                              @endforeach
                            </ul>
                          </div>
                          <div class="filter-by-price mb-4">
                            <h5 class="filter-heading mb-2">FILTER BY PRICE</h5>
                            <input type="hidden" name="minPrice" value="{{ $minPrice }}}}" >
                            <input type="hidden" name="page" value="{{ $page}}" >
                            <input type="range" class="form-range" name="price" id="ageInputId" @if(!empty(request()->price)) value="{{ request()->price }}" @else value="{{ $maxPrice / 2 }}" @endif min="{{ $minPrice}}"
                              max="{{ $maxPrice }}" oninput="ageOutputId.value = ageInputId.value">
                            <h6 class="filered-price">PRICE : Rs.{{ number_format($minPrice) }} - Rs.<output name="ageOutputName"
                                id="ageOutputId">{{ number_format($maxPrice / 2 ) }}</output>
                            </h6>
                          </div>
                          <div class="filter-by-size mb-4">
                            <h5 class="filter-heading mb-2">FILTER BY SIZE</h5>
                            <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                              <div class="btn-group" role="group" aria-label="First group">
                                <div class="row">
                                  @foreach($size as $key=>$oneSize)
                                    <div class="col-2 mb-2 me-1">
                                      <input type="radio" class="btn-check " name="size" id="size{{ $oneSize->size }}"
                                      autocomplete="off" value="{{ $oneSize->size }}" 
                                      @if(!empty(request()->size))
                                        @if ($oneSize->size == request()->size))
                                          checked
                                        @endif
                                      @else 
                                        @if($key===0) 
                                          checked
                                        @endif 
                                       @endif>
                                      <label class="btn btn-outline-dark rounded-0 filterSizeCheck" for="ssize{{ $oneSize->size }}">{{ $oneSize->size }}</label>
                                    </div>
                                  @endforeach
                                </div>
                              </div>
                            </div>
                          </div>
                          <div class="filter-option mb-3">
                            <button type="submit" class="btn btn-primary btn-lg ps-5 pe-5 rounded-0 filter-option-btn">FILTER</button>
                          </div>
                        </form>
                    </div>
                    </aside>
                </div>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
  {{-- filter-small-screen  end --}}
   
   {{-- filter-large-screen --}}
  <div class="container ">
    <div class="row">
      <div class="col-lg-3">
        <div class="filter-max-screen">
          <aside class="side-area product-side side-shadow">
            <div class="card filterCard text-dark bg-light mb-3 rounded-0 text-start" style="max-width: 22rem;">
              <div class="card-header filter-header">Filter By</div>
              <div class="card-body filter-body">
                <form action="{{ route('filter') }}" method="GET" autocomplete="off">
                  <div class="filter-by-brand mb-4">
                    <h5 class="filter-heading">BRANDS</h5>
                    <ul class="list-group">
                      @foreach($brand as $oneBrand)
                        <li class="list-group-item filter-brand">
                          <input class="form-check-input me-1 rounded-0 filter-brand-input" name="brand[]" type="checkbox" value="{{ $oneBrand->brand }}"
                          @if(!empty(request()->brand))
                              @if (in_array($oneBrand->brand,request()->brand))
                                checked
                              @endif
                          @endif>
                            {{ $oneBrand->brand }}
                        </li>
                      @endforeach
                    </ul>
                  </div>
                  <div class="filter-by-price mb-4">
                    <h5 class="filter-heading mb-2">FILTER BY PRICE</h5>
                    <input type="hidden" name="minPrice" value="{{ $minPrice }}}}" >
                    <input type="hidden" name="page" value="{{ $page}}" >
                    <input type="range" class="form-range" name="price" id="aageInputId" @if(!empty(request()->price)) value="{{ request()->price }}" @else value="{{ $maxPrice / 2 }}" @endif min="{{ $minPrice}}"
                      max="{{ $maxPrice }}" oninput="aageOutputId.value = aageInputId.value">
                    <h6 class="filered-price">PRICE : Rs.{{ number_format($minPrice) }} - Rs.<output name="aageOutputName"
                        id="aageOutputId">{{ number_format($maxPrice / 2 ) }}</output>
                    </h6>
                  </div>
                  <div class="filter-by-size mb-4">
                    <h5 class="filter-heading mb-2">FILTER BY SIZE</h5>
                    <div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
                      <div class="btn-group" role="group" aria-label="First group">
                        <div class="row">
                          @foreach($size as $key=>$oneSize)
                            <div class="col-2 mb-2 me-1">
                              <input type="radio" class="btn-check " name="size" id="ssize{{ $oneSize->size }}"
                              autocomplete="off" value="{{ $oneSize->size }}" 
                              @if(!empty(request()->size))
                                @if ($oneSize->size == request()->size))
                                  checked
                                @endif
                              @else 
                                @if($key===0) 
                                  checked
                                @endif 
                               @endif>
                              <label class="btn btn-outline-dark rounded-0 filterSizeCheck" for="ssize{{ $oneSize->size }}">{{ $oneSize->size }}</label>
                            </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="filter-option mb-3">
                    <button type="submit" class="btn btn-primary btn-lg ps-5 pe-5 rounded-0 filter-option-btn">FILTER</button>
                  </div>
                </form>
              </div>
            </div>
          </aside>
        </div>
      </div>
       {{-- filter-large-screen  end --}}

        {{-- items content --}}
      <div class="col-lg-9">
        <div class="row allitems g-0 ">
          @forelse ($item as $oneItem)
                <div class="col-sm-6 col-lg-4 mb-4">
                  <div class="card rounded-0 allItemCard text-center">
                    <a href="/items/{{ $oneItem->item_id }}" class="text-decoration-none ">
                      <div class="bg-image hover-zoom">
                        <img src="{{ asset('itemImages/'.$oneItem->imagePath) }}" class="card-img-top flashImage ">
                      </div>
                    </a>
                    <div class="card-img-overlay text-end">
                      @auth
                        @if(in_array( $oneItem->item_id , Auth::user()->wishlist->items->pluck('id')->toArray()))
                        <a class="proAddToCartlink" href="{{ route('user.removeFromWishlist',['item_id' => $oneItem->item_id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistRemovecard-form{{ $oneItem->item_id }}').submit();"><i class="bi bi-heart-fill me-2 proAddtowishList "></i>
                          <form action="{{ route('user.removeFromWishlist',['item_id' => $oneItem->item_id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemovecard-form{{ $oneItem->item_id }}" class="d-none">@method('delete')@csrf</form></a>               
                        @else
                          <a class="proAddToCartlink" href="{{ route('user.addToWishlist',['item_id' => $oneItem->item_id , 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistAddcard-form{{ $oneItem->item_id }}').submit();"><i class="bi bi-heart me-2 proAddtowishList"></i></a>  
                            <form action="{{ route('user.addToWishlist',['item_id' => $oneItem->item_id , 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistAddcard-form{{ $oneItem->item_id }}" class="d-none">@method('post')@csrf</form></a>               
                        @endif
                      @else
                        <a class="allitemAddTowishtlink" href="{{ route('user.login') }}"><i class="bi bi-heart me-2 allitemAddTowishtlink text-dark fs-5"></i></a>                
                      @endauth
                    </div>
                    <div class="card-body">
                      <a href="/items/{{ $oneItem->item_id }}" class="text-decoration-none"><h5 class="proItemCard-title">{{ $oneItem->name }}</h5></a>
                      <h5 class="allItemCard-price">Rs.{{ number_format($oneItem->price) }}</h5>
                      <a href="/items/{{ $oneItem->item_id }}" class="btn btn-primary ps-5 pe-5 mb-2 rounded-0 allItemCardaddbtn" role="button" aria-disabled="true">ADD TO CART</a>
                    </div>
                  </div>
                </div>
            @empty
              <div class="container">
                <div class="row">
                  <div class="col-md-12 text-center pt-5" >
                      <h4 class="NorelatedProductHeading align-self-middle">No items found</h4>
                  </div>
                </div>
             </div>  
            @endforelse
        </div>
      </div>
    </div>
  </div>
  {{-- items content end--}}
    
  {{-- paginate --}}
  <div class="container mt-5 mb-5">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-center">
              {{  $item->links();  }}
            </div>
        </div>
    </div>
  </div>
    {{-- paginate end--}}
