@extends('layouts.app')

@section('content')
    <!-- slider -->
    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
      <div class="carousel-indicators">
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active"
          aria-current="true" aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-current="true"
          aria-label="Slide 1"></button>
        <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-current="true"
          aria-label="Slide 1"></button>
      </div>
      <div class="carousel-inner">
        <div class="carousel-item active" data-interval="1000">
          <video src="{{ asset('img/slider1.mp4') }}" class="d-block w-100" muted
            autoplay="autoplay" loop="loop" preload="auto"></video>
          <div class="carousel-caption  justify-content-start overflow-hidden">
            <div class="drop-in">
              <h5 class="text-white">airMax<span>supai</span></h5>
            </div>
            <div class="drop-in-2">
              <p>Run with airMax supai,designed to move you forward.</p>
              <div class="slider-btn ">
                <a class="btn btn-outline-light slider-btn-btn1 rounded-0" href="{{ route('men') }}">Shop Men<i
                    class="bi bi-arrow-right m-2"></i></a>
              </div>
            </div>
          </div>
        </div>
  
        <div class="carousel-item" data-interval="1000">
          <video src="{{ asset('img/slider2.mp4') }}" class="d-block w-100" muted autoplay="autoplay" loop="loop"
            preload="auto"></video>
          <div class="carousel-caption   justify-content-start overflow-hidden">
            <div class="drop-in">
              <h5 class="text-black">nike<span>pegasue<b class="fs-4">38</b></span></h5>
            </div>
            <div class="drop-in-2">
              <p class="text-black">Run with airMax supai,designed to move you forward.</p>
              <div class="slider-btn slider-btn2">
                <a class="btn btn-outline-dark slider-btn-btn2 rounded-0" href="{{ route('women') }}">Shop Women<i
                    class="bi bi-arrow-right m-2"></i></a>
              </div>
            </div>
          </div>
        </div>
  
        <div class="carousel-item" data-interval="1000">
          <video src="{{ asset('img/slider3.mkv') }}" class="d-block w-100"
            muted autoplay="autoplay" loop="loop" preload="auto"></video>
          <div class="carousel-caption overflow-hidden">
            <div class="drop-in">
              <h5 class="text-black">zoom<span>bubble</span></h5>
            </div>
            <div class="drop-in-2">
              <p class="text-black">Run with airMax supai,designed to move you forward.</p>
              <div class="slider-btn slider-btn2">
                <a class="btn btn-outline-dark slider-btn-btn2 rounded-0" href="{{ route('kids') }}">Shop Kids<i
                    class="bi bi-arrow-right m-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
  
      <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
      </button>
      <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
      </button>
    </div>
    <!-- slider end-->
  
    <!-- NEW ARRIVALS heading -->
    <div class="container mt-5 mb-4" id="arrivals">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="homeHeading m-0">NEW ARRIVALS</h2>
        </div>
      </div>
    </div>
    <!-- NEW ARRIVALS heading end-->
  
    <!-- NEW ARRIVALS tab -->
    <div class="container">
      <div class="row homeItemSection">
        <div class="col-lg-12">
          <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
              <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-0 ps-4 pe-4 pt-1 pb-1" id="pills-nike-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-nike" type="button" role="tab" aria-controls="pills-nike"
                  aria-selected="true">NIKE</button>
              </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1 " id="pills-addidas-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-addidas" type="button" role="tab" aria-controls="pills-addidas"
                  aria-selected="false">ADIDAS</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1" id="pills-puma-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-puma" type="button" role="tab" aria-controls="pills-puma"
                  aria-selected="false">PUMA</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1" id="pills-timberland-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-timberland" type="button" role="tab" aria-controls="pills-timberland"
                  aria-selected="false">TIMBERLAND</button>
              </li>
              <li class="nav-item" role="presentation">
                <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1 " id="pills-fila-tab" data-bs-toggle="pill"
                  data-bs-target="#pills-fila" type="button" role="tab" aria-controls="pills-fila"
                  aria-selected="false">FILA</button>
              </li>
          </ul>
          <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-nike" role="tabpanel" aria-labelledby="pills-nike-tab">
              <div class="row g-0 justify-content-center">
                @php $c = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("A",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Nike")
                      @include('layouts.homeitemcard')

                      @if($c == 3)
                        @break
                      @endif

                      @php $c += 1 @endphp
                    @endif
                @endforeach

                @if($c == 0)
                <div class="container">
                  <div class="row">
                  <div class="col-md-12 text-center">
                      <h4 class="NorelatedProductHeading">No items</h4>
                  </div>
                  </div>
                </div>  
              @endif
                
              </div>
            </div>
            <div class="tab-pane fade" id="pills-addidas" role="tabpanel" aria-labelledby="pills-addidas-tab">
              <div class="row g-0 justify-content-center">
                @php $c = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("A",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Adidas")
                      @include('layouts.homeitemcard')

                      @if($c == 3)
                        @break
                      @endif

                      @php $c += 1 @endphp
                    @endif
                @endforeach

                @if($c == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-puma" role="tabpanel" aria-labelledby="pills-puma-tab">
              <div class="row g-0 justify-content-center">
                @php $c = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("A",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Puma")
                      @include('layouts.homeitemcard')

                      @if($c == 3)
                        @break
                      @endif

                      @php $c += 1 @endphp
                    @endif
                @endforeach

                @if($c == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-timberland" role="tabpanel" aria-labelledby="pills-timberland-tab">
              <div class="row g-0 justify-content-center">
                @php $c = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("A",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Timberland")
                      @include('layouts.homeitemcard')

                      @if($c == 3)
                        @break
                      @endif

                      @php $c += 1 @endphp
                    @endif
                @endforeach

                @if($c == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-fila" role="tabpanel" aria-labelledby="pills-fila-tab">
              <div class="row g-0 justify-content-center">
                @php $c = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("A",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Fila")
                      @include('layouts.homeitemcard')

                      @if($c == 3)
                        @break
                      @endif

                      @php $c += 1 @endphp
                    @endif
                @endforeach

                @if($c == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- NEW ARRIVALS tab end -->
  
    <!--  WHAT'S TRENDING heading -->
    <div class="container mt-5 mb-4" id="trending">
      <div class="row">
        <div class="col-md-12 text-center">
          <h2 class="homeHeading m-0"> WHAT'S TRENDING</h2>
        </div>
      </div>
    </div>
    <!--  WHAT'S TRENDING heading end-->
  
    <!--  WHAT'S TRENDING tab -->
    <div class="container">
      <div class="row homeItemSection">
        <div class="col-lg-12">
          <ul class="nav nav-pills mb-3 justify-content-center" id="pills-tab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active rounded-0 ps-4 pe-4 pt-1 pb-1" id="pills-nike-tabb" data-bs-toggle="pill"
                data-bs-target="#pills-nikee" type="button" role="tab" aria-controls="pills-nikee"
                aria-selected="true">NIKE</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1 " id="pills-addidas-tabb" data-bs-toggle="pill"
                data-bs-target="#pills-addidass" type="button" role="tab" aria-controls="pills-addidass"
                aria-selected="false">ADIDAS</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1" id="pills-puma-tabb" data-bs-toggle="pill"
                data-bs-target="#pills-pumaa" type="button" role="tab" aria-controls="pills-pumaa"
                aria-selected="false">PUMA</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1" id="pills-timberland-tabb" data-bs-toggle="pill"
                data-bs-target="#pills-timberlandd" type="button" role="tab" aria-controls="pills-timberlandd"
                aria-selected="false">TIMBERLAND</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link rounded-0 btn ps-4 pe-4 pt-1 pb-1 " id="pills-fila-tabb" data-bs-toggle="pill"
                data-bs-target="#pills-filaa" type="button" role="tab" aria-controls="pills-filaa"
                aria-selected="false">FILA</button>
            </li>
          </ul>
          <div class="tab-content mt-5" id="pills-tabContent">
            <div class="tab-pane fade show active" id="pills-nikee" role="tabpanel" aria-labelledby="pills-nike-tabb">
              <div class="row g-0 justify-content-center">
                @php $cc = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("T",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Nike")
                      @include('layouts.homeitemcardT')

                      @if($cc == 3)
                        @break
                      @endif

                      @php $cc += 1 @endphp
                    @endif
                @endforeach

                @if($cc == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-addidass" role="tabpanel" aria-labelledby="pills-addidas-tabb">
              <div class="row g-0">
               @php $cc = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("T",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Adidas")
                      @include('layouts.homeitemcardT')

                      @if($cc == 3)
                        @break
                      @endif

                      @php $cc += 1 @endphp
                    @endif
                @endforeach

                @if($cc == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-pumaa" role="tabpanel" aria-labelledby="pills-puma-tabb">
              <div class="row g-0">
                @php $cc = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("T",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Puma")
                      @include('layouts.homeitemcardT')

                      @if($cc == 3)
                        @break
                      @endif

                      @php $cc += 1 @endphp
                    @endif
                @endforeach

                @if($cc == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-timberlandd" role="tabpanel" aria-labelledby="pills-timberland-tabb">
              <div class="row g-0">
                @php $cc = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("T",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Timberland")
                      @include('layouts.homeitemcardT')

                      @if($cc == 3)
                        @break
                      @endif

                      @php $cc += 1 @endphp
                    @endif
                @endforeach

                @if($cc == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
            <div class="tab-pane fade" id="pills-filaa" role="tabpanel" aria-labelledby="pills-fila-tabb">
              <div class="row g-0">
                @php $cc = 0 @endphp
                @foreach ($items->sortBy('updated_at') as $key=>$oneitem)
                    @if(in_array("T",$oneitem->itemCategory->pluck('category')->toArray() ) && $oneitem->brandName == "Fila")
                      @include('layouts.homeitemcardT')

                      @if($cc == 3)
                        @break
                      @endif

                      @php $cc += 1 @endphp
                    @endif
                @endforeach

                @if($cc == 0)
                  <div class="containe mt-5 mb-5">
                    <div class="row">
                    <div class="col-md-12 text-center">
                        <h4 class="NorelatedProductHeading">No items</h4>
                    </div>
                    </div>
                  </div>  
                @endif
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!--  WHAT'S TRENDING tab end -->
  
    <div class="container mt-4">
      <div class="row align-items-md-stretch">
        <div class="col-md-6 mb-3">
          <div class="p-5 text-white bg-dark rounded-0 homeBanner"
            style="background-image:linear-gradient(to bottom, rgba(245, 246, 252, 0), rgba(14, 13, 13, 0.829)),url('{{ asset('img/layer 23.png') }}');">
            <div class="bannerconnent ">
              <h2>buy selected<br>nike shoe</h2>
              <p>GET FREE DRI-FIT SHIRT TODAY</p>
              <a class="btn btn-outline-light rounded-0 homeBanner1" type="button" href="{{ route('men') }}">Shop Now<i
                  class="bi bi-arrow-right m-2"></i></a>
            </div>
          </div>
        </div>
        <div class="col-md-6 mb-3">
          <div class="p-5 text-white bg-dark border rounded-0  homeBanner"
            style="background-image:linear-gradient(to bottom, rgba(245, 246, 252, 0), rgba(255, 110, 243, 0.473)),url('{{ asset('img/layer 24.png') }}');">
            <div class="bannerconnent">
              <h2>yeezy boost<br>350 pink</h2>
              <p>AVAILABLE SOON</p>
              <a class="btn btn-outline-light rounded-0 homeBanner2" type="button" href="{{ route('women') }}">Reserved Today<i
                  class="bi bi-arrow-right m-2"></i></a>
            </div>
          </div>
        </div>
      </div>
    </div>
    </div>
  
    <div class="container mt-1 mb-3">
      <div class="row align-items-md-stretch">
        <div class="col-md-12">
          <div class="p-3 text-dark rounded-0" style="background:#E0E32B">
            <div class="row">
              <div class="col-8 ">
                <h5 class="signUpbannerH">SIGN UP TODAY AND<br>GET 10% OFF</h5>
              </div>
              <div class="col-4">
                <a class="btn btn-outline-dark signUpbannerbtn rounded-0" type="button" href="{{ route('user.register') }}">Sign up free<i
                  class="bi bi-arrow-right m-2"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

@endsection
