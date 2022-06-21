<div id="sidebar-wrapper" class="sidebar-wrapper">
    <div class="sidebar-heading text-center  py-4 mb-3">
      <div class="profile">
        <div class="text-center">
          <span class="myaccount-dot"><span class="myaccount-profileName">{{  Auth::user()->firstName[0].''. Auth::user()->lastName[0] }}</span></span>
          <h5 class="myaccount-Name">{{ Auth::user()->firstName.' '. Auth::user()->lastName }}</h5>
          <h5 class="myaccount-customerEmail">{{ Auth::user()->email }}</h5>
        </div>
      </div>


    </div>
    <div class="list-group list-group-flush">
      <a type="button" class="btn btn-white btn-lg rounded-0 myaccountBtn {{ request()->is('user/my-account') ? 'SliderActive' : '' }}" type="button" href="{{ route('user.myaccount') }}">PROFILE</a>
      <a type="button" class="btn btn-white btn-lg rounded-0 myaccountBtn {{ request()->is('user/my-orders*') ? 'SliderActive' : '' }}" type="button" href="{{ route('user.myorders') }}">ORDERS</a>
      <a type="button" class="btn btn-white btn-lg rounded-0 myaccountBtn {{ request()->is('user/my-wishlist') ? 'SliderActive' : '' }}" type="button" href="{{ route('user.wishlist') }}">WISHLIST</a>
      <a type="button" class="btn btn-white btn-lg rounded-0 myaccountBtn {{ request()->is('user/my-reviews') ? 'SliderActive' : '' }}" type="button" href="{{ route('user.myreviews') }}">REVIEWS</a>
      <a type="button" class="btn btn-white btn-lg rounded-0 myaccountBtn {{ request()->is('user/my-address') ? 'SliderActive' : '' }}" type="button" href="{{ route('user.myaddress') }}">ADDRESS</a>
      <a class="btn btn-white btn-lg rounded-0 myaccountBtn" type="button" href="{{ route('user.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">LOGOUT
        <form action="{{ route('user.logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form></a>
    </div>

  </div>

  