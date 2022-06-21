<div class="col-sm-6 col-lg-3 mb-4 homeitems">
    <div class="card rounded-0 homeItemCard text-center border border-1">
      <a href="/items/{{ $oneitem->id }}" class="text-decoration-none">
        <img src="{{ asset('itemImages/'.$oneitem->imagePath) }}" class="card-img-top flashImage">
      </a>
      <div class="card-img-overlay text-end">
        @auth
          @if(in_array( $oneitem->id , Auth::user()->wishlist->items->pluck('id')->toArray()))
          <a class="homeitemAddTowishtlink" href="{{ route('user.removeFromWishlist',['item_id' => $oneitem->id, 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistRemovecard-form2{{  $oneitem->id }}').submit();"><i class="bi bi-heart-fill me-2 homeitemAddTowishtlink "></i>
            <form action="{{ route('user.removeFromWishlist',['item_id' => $oneitem->id, 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistRemovecard-form2{{  $oneitem->id }}" class="d-none">@method('delete')@csrf</form></a>               
          @else
            <a class="homeitemAddTowishtlink" href="{{ route('user.addToWishlist',['item_id' => $oneitem->id , 'user_id' => Auth::user()->id]) }}" onclick="event.preventDefault();document.getElementById('wishlistAddcard-form2{{  $oneitem->id }}').submit();"s><i class="bi bi-heart me-2 homeitemAddTowishtlink"></i></a>  
              <form action="{{ route('user.addToWishlist',['item_id' => $oneitem->id , 'user_id' => Auth::user()->id]) }}" method="POST" id="wishlistAddcard-form2{{ $oneitem->id }}" class="d-none">@method('post')@csrf</form></a>               
          @endif
        @else
          <a class="homeitemAddTowishtlink" href="{{ route('user.login') }}"><i class="bi bi-heart me-2 homeitemAddTowishtlink"></i></a>                
        @endauth
      </div>
      <div class="card-body">
        <div class="row">
          <div class="col-8">
            <a href="/items/{{ $oneitem->id }}" class="text-decoration-none homeItemCard-title"><h5 class="homeItemCard-title">{{ $oneitem->name }}</h5></a>
          </div>
          <div class="col-4">
            <h5 class="homeItemCard-price">Rs.{{ number_format($oneitem->price) }}</h5>
          </div>
        </div>
      </div>
    </div>
  </div>
 
