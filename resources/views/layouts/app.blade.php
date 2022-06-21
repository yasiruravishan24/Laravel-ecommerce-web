<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token()}}">
  
  <title>@yield('title') {{ env('APP_NAME') }}</title>
  <!-- bootstrap css link -->
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  <!-- style css link -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  {{-- j query link --}}
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css">

  <link rel="stylesheet" href="{{ asset('css/jquery.readall.css') }}">
</head>

<body>
  {{-- preloader --}}
  <div id="preloader"></div>
   {{-- preloader  end--}}
   
  {{-- go top btn --}}
  <button class="go-top-btn">
    <img src="{{ asset('img/upload.png') }}" alt="arrow up">
  </button>
   {{-- go top btn end--}}


{{-- search  canvas --}}
  <div class="offcanvas offcanvas-end searchOffcan" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 id="offcanvasRightLabel" class="searchBlockhead">SEARCH</h5>
      <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <input id="search" name="search" class="form-control me-2 rounded-0 searchInput mb-3" type="search" placeholder="Search" aria-label="Search" autofocus autocomplete="new-password">
        <div id="search-result"></div>
    </div>
  </div>
  {{-- search canvas end --}}
  @php $page = null @endphp
  <!-- nav bar -->
  <nav class="navbar navbar-expand-lg" aria-label="Fifth navbar example">
    <div class="container">
      <a class="navbar-brand" href="{{ route('home') }}"><img src="{{ asset('img/logo 1.png') }}" class="LogoImg"></a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample05"
        aria-controls="navbarsExample05" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"><img src="{{ asset('img/menu.png') }}" class="navbar-toggler-img"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExample05">
        <ul class="navbar-nav m-auto mb-2 mb-lg-0">
          <li class="nav-item navItemBold">
            <a class="nav-link {{ request()->is('men') ? 'Active' : '' }}" href="{{ route('men') }}">MEN</a>
          </li>
          <li class="nav-item navItemBold">
            <a class="nav-link {{ request()->is('women') ? 'Active' : '' }}" href="{{ route('women') }}">WOMEN</a>
          </li>
          <li class="nav-item navItemBold">
            <a class="nav-link {{ request()->is('kids') ? 'Active' : '' }}" href="{{ route('kids') }}">KIDS</a>
          </li>
          <li class="nav-item ">
            <a class="nav-link {{ request()->is('stock-clearance') ? 'Active' : '' }}" href="{{ route('stockclearance') }}">STOCK CLEARANCE</a>
          </li>
        </ul>
        @auth
        <ul class="nav">
          <li><a href="{{ route('user.myaccount') }}" class="nav-icon"><img src="{{ asset('img/user1.png') }}"></i></a></li>
          <li><a class="nav-icon" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="#offcanvasRight"><img src="{{ asset('img/loupe.png') }}"></a></li>
          <li><a href="{{ route('user.wishlist') }}" class="nav-icon position-relative"><img src="{{ asset('img/heart.png') }}">
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-light" style="background-color: black !importend; margin: inherit">
              {{ Auth::user()->wishlist->items->count() }}
            </span>
          </a></li>
          <li><a href="{{ route('user.cart') }}" class="nav-icon position-relative"><img src="{{ asset('img/shopping-bag.png') }}"></i>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-dark text-light" style="background-color: black !importend; margin: inherit">
              {{ Auth::user()->cart->items->count() }}
            </span>
          </a></li>
        </ul>
        @else
        <ul class="nav">
          <li><a href="{{ route('user.login') }}" class="nav-icon"><img src="{{ asset('img/user.png') }}"></i></a></li>
          <li><a class="nav-icon" data-bs-toggle="offcanvas" href="#offcanvasRight" role="button" aria-controls="#offcanvasRight"><img src="{{ asset('img/loupe.png') }}"></a></li>
          <li><a href="{{ route('user.login') }}" class="nav-icon "><img src="{{ asset('img/heart.png') }}"></i></a></li>
          <li><a href="{{ route('user.login') }}" class="nav-icon"><img src="{{ asset('img/shopping-bag.png') }}"></i></a></li>
        </ul>
        @endauth
      </div>
    </div>
  </nav>
  <!-- nav bar end -->


 @yield('content')

  <!-- footer -->
  <footer>
    <div class="container py-2">
      <div class="row pt-3">
        <div class="col-lg-12 m-auto">
          <div class="row">
            <div class="col-md-2 py-3">
              <h5 class="footerLinkHeading">PRODUCTS</h5>
              <a class="footerLinks" href="/men">Men shoes</a>
              <a class="footerLinks" href="/women">Women Shoes</a>
              <a class="footerLinks" href="/kids">Kids Shoes</a>
              <a class="footerLinks" href="/#arrivals">New Arrivals</a>
              <a class="footerLinks" href="/#trending">Top Trending</a>
              <a class="footerLinks" href="/stock-clearance">Clearance</a>
            </div>
            <div class="col-md-2 py-3">
              <h5 class="footerLinkHeading">BRANDS</h5>
              <a class="footerLinks" href="#">Nike</a>
              <a class="footerLinks" href="#">Adidas</a>
              <a class="footerLinks" href="#">Puma</a>
              <a class="footerLinks" href="#">Fila</a>
              <a class="footerLinks" href="#">Timberland</a>
              <a class="footerLinks" href="#">New Balance</a>
              <a class="footerLinks" href="#">Lacoste</a>
              <a class="footerLinks" href="#">Yezzy</a>
            </div>
            <div class="col-md-2 py-3">
              <h5 class="footerLinkHeading">COLLECTION</h5>
              <a class="footerLinks" href="#">Zoom</a>
              <a class="footerLinks" href="#">Zoom X</a>
              <a class="footerLinks" href="#">AirForce</a>
              <a class="footerLinks" href="#">Air Jordan</a>
              <a class="footerLinks" href="#">airMax</a>
              <a class="footerLinks" href="#">RSX</a>
              <a class="footerLinks" href="#">Bounce</a>
              <a class="footerLinks" href="#">Boost</a>
              <a class="footerLinks" href="#">Outdoor</a>
            </div>
            <div class="col-md-2 py-3">
              <h5 class="footerLinkHeading">SUPPORT</h5>
              <a class="footerLinks" href="{{ route('support') }}#contact">Contact</a>
              <a class="footerLinks" href="{{ route('support') }}#exchange">Return & Exchanges</a>
              <a class="footerLinks" href="{{ route('support') }}#size">Size Charts</a>
              <a class="footerLinks" href="https://www.domex.lk/tracking.php" target="_blank">Order Tracker</a>
            </div>
            <div class="col-md-4 py-3 footerCopyRigth">
              <a href="https://www.facebook.com/flipflopLK/" target="_blank"><img src="{{ asset('img/facebook.png') }}" alt=""></a>
              <a href="https://instagram.com/flipflop.colombo?utm_medium=copy_link" target="_blank"><img src="{{ asset('img/intagram.png') }}" alt=""></i></a>
              <br>
              <p class="copyrigth">&copy;2021 - 2022 FlipFlopLK.All Rigth Reserved <br>Sri Lanka</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </footer>
  <!-- footer end -->

  <!-- bootstrap js link -->
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('js/jquery.simplePagination.js') }}"></script>

  <script src="{{ asset('js/jquery.readall.js') }}"></script>
  
  {{-- js --}}
  <script>
  // preloader
    var loader = document.getElementById("preloader");

    window.addEventListener("load", function(){
      loader.style.display = "none";
    })
   // preloader end
   
    // go top btn 
    const goTopBtn = document.querySelector('.go-top-btn');
    window.addEventListener('scroll', checkHeight)
    function checkHeight(){
      if(window.scrollY > 200){
        goTopBtn.style.display = "flex"
      }else{
        goTopBtn.style.display = "none"
        goTopBtn.style.opacity = "75%"
      }
    }

    goTopBtn.addEventListener('click', () => {
      window.scrollTo({
        top:0,
        behavior:"smooth"
      })
      goTopBtn.style.opacity = "100%"
    });
    // go top btn js end

    // search box
    $(document).ready(function (){
      $(document.body).on("click", "tr[data-href]", function(){
        window.location.href = this.dataset.href;
      });
    });
      $.ajaxSetup({
        headers:{
         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
       }
     });

      $('#search').on('keyup', function(){
        $search = $(this).val();
        if($search == ''){
          $('#search-result').html('');
          $('#search-result').hide();
        }
        else{
          $.ajax({
            method:"post",
            url:"search*",
            data:JSON.stringify({
              search:$search
            }),
            headers:{
              'Accept':'application/json',
              'Content-Type':'application/json'
            },
            success:function(data){
              data = JSON.parse(data);
              $('#search-result').show();
              var searchResultAjax = '';
              if(data.length == 0){    
                  searchResultAjax += `<div class="alert alert-secondary" role="alert">No result</div>`
                 
              }else{
                  for(let c=0;c < data.length;c++){
                    searchResultAjax +=`
                    <table class="table table-hover searchTable  ">
                      <tbody>
                        <tr data-href="/items/`+data[c].id+`">
                          <td class="text-start" colspan="3"><img src="{{ asset('itemImages/`+data[c].imagePath+`') }}" width="170" heigth="100"  class="img-fluid"></td>
                          <td class="text-center">`+data[c].name+`</td>
                          <td class="text-center">`+data[c].brandName+`</td>
                        </tr>
                      </tbody>
                    </table>`
                  }
              }
              $('#search-result').html(searchResultAjax);
            }
          })
        }
      })
     // search box end

    // alert auto hide
     $(document).ready(function () {
       
       window.setTimeout(function() {
           $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
               $(this).remove(); 
           });
       }, 10000);
        
       });


      // my account save btn
      $(document).ready(function() {
      $('#profile-form').on('input change', function() {
        $('#profile-save-btn').attr('disabled', false);
      });
    })

     // my address save btn
    $(document).ready(function() {
      $('#profile-address-form').on('input change', function() {
        $('#profile-address-save-btn').attr('disabled', false);
      });
    })

    // cart update  btn
    $(document).ready(function() {
      $('#cart-update-form').on('input change', function() {
        $('#cart-update-btn').attr('disabled', false);
      });
    })

  </script>
    {{-- js end--}}

    @yield('javascript')



</body>

</html>