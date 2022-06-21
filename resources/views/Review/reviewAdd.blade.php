 @extends('layouts.app')

 @section('title', 'REVIEW ADD - ')
     
 @section('content')

   <!-- page path -->
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">REVIEW ADD</p>
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

  {{-- review add --}}
 <div class="container mb-5">
    <div class="row justify-content-center align-items-center">
      <div class="col-lg-7 shadow reviewBox">
        <div class="p-5 reviewPading">
          <form action="{{ route('user.storereviews') }}" method="POST" autocomplete="off">
              @csrf
            <div class="mb-4 reviewHeadingBox">
              <h2 class="reviewHeding">Write Review</h2>
            </div>
            <div class="itemDetails">
              <img src="{{ asset('itemImages/'.$item->imagePath) }}" class="img-fluid mx-auto d-block border border-dark mb-2" width="400">
              <div class="itemDetails text-center">
                <h5 class="reviewItemName">{{ $item->name }}</h5>
                <h6 class="reviewItemPrice">Rs.{{ number_format($item->price) }}</h6>
              </div>
            </div>

            <div class="form-group mb-2  me-4 ms-4 reviewGroup">
              <label  class="form-label reviewLable">Rating</label>

              <div class="rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <input  type="radio" name="rating" class="rating__control screen-reader" id="rc{{ $i }}" value="{{  $i }}">                      
                    @endfor

                    @for ($i = 1; $i <= 5; $i++)
                        <label for="rc{{ $i }}" class="rating__item">
                            <svg class="rating__star">
                                <use xlink:href="#star"></use>
                            </svg>
                            <span class="screen-reader">{{ $i }}</span>
                    </label>
                    @endfor
              </div>
              <span class="text-danger">@error('rating'){{ $message }}@enderror</span>
            <svg xmlns="http://www.w3.org/2000/svg" style="display: none">
              <symbol id="star" viewBox="0 0 26 28">
                <path
                  d="M26 10.109c0 .281-.203.547-.406.75l-5.672 5.531 1.344 7.812c.016.109.016.203.016.313 0 .406-.187.781-.641.781a1.27 1.27 0 0 1-.625-.187L13 21.422l-7.016 3.687c-.203.109-.406.187-.625.187-.453 0-.656-.375-.656-.781 0-.109.016-.203.031-.313l1.344-7.812L.39 10.859c-.187-.203-.391-.469-.391-.75 0-.469.484-.656.875-.719l7.844-1.141 3.516-7.109c.141-.297.406-.641.766-.641s.625.344.766.641l3.516 7.109 7.844 1.141c.375.063.875.25.875.719z" />
              </symbol>
            </svg>
            </div>
            
            <div class="form-group mb-4 me-4 ms-4  reviewGroup">
              <label for="comment" class="form-label reviewLable">Comment</label>
              <textarea type="text" name="comment" class="form-control form-control-md rounded-0 reviewInput @error('comment') is-invalid @enderror"
                style="height: 150px;">{{ old('comment') }}</textarea>
                <span class="text-danger">@error('comment'){{ $message }}@enderror</span>
            </div>

            <div class="d-grid mb-2 me-4 ms-4 reviewGroup ">
                <input type="hidden" name="item_id" value="{{ $item->id }}">
                <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
              <button type="submit" class="btn btn-lg btn-primary boarder-0 rounded-0 reviewSubmit">SUBMIT
                REVIEW</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
     
 @endsection
 
 


 