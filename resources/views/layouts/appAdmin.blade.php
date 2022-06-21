<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title') {{ env('APP_NAME') }}</title>
  <!-- bootstrap css link -->
  {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> --}}
  <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
  {{-- bootstrap icons --}}
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.1/font/bootstrap-icons.css">
  <!-- style css link -->
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
  <!-- google font link -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"rel="stylesheet">
    {{-- j query link --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  
    {{-- datepicker --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

    {{-- dataTable --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.5.2/css/buttons.bootstrap4.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap4.min.css">
    <style>
        /* slider media */
        @media (min-width:992px){
            .offcanvas-backdrop.show {
                display: none !important;
            }
        }        
    </style>

</head>

<body>
    <div id="preloaderAdmin"></div>
   <!-- nav bar -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark adminNav">
        <div class="container-fluid">
            <button class="navbar-toggler me-2 text-end" type="button" data-bs-toggle="offcanvas"
                 data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
            </button>
        </div>
    </nav>
<!-- navbar end -->


<!-- offcanvas -->
<div class="offcanvas offcanvas-start slideBar  text-white " tabindex="-1" id="offcanvasExample"
    aria-labelledby="offcanvasExampleLabel">
    <div class="m-4 text-center">
        <img src=" {{ asset('img/logoSlidebar.png') }}" class="sliderImage" >
    </div>
    <div class="offcanvas-body p-0 text-center">
        <a href="{{ route('admin.dashboard') }}">
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn {{ request()->is('admin/dashboard') ? 'SliderActive' : '' }}">DASHBOARD</button>
        </a>
        <a href="{{ route('admin.items') }}">
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn {{ request()->is('admin/items*') ? 'SliderActive' : '' }}">ITEMS</button>
        </a>
        <a href="{{ route('admin.orders') }}">
            <button id="orderNotification"  type="button" class="btn btn-white btn-lg rounded-0 position-relative adminBtn {{ request()->is('admin/orders*') ? 'SliderActive' : '' }}">ORDERS
            </button>
        </a>
        <a href="{{ route('admin.delivers') }}">
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn {{ request()->is('admin/delivers*') ? 'SliderActive' : '' }}">DELIVERS</button>
        </a>
        <a href="{{ route('admin.reviews') }}">
            <button id="reviewNotification"  type="button" class="btn btn-white btn-lg rounded-0 position-relative adminBtn {{ request()->is('admin/reviews*') ? 'SliderActive' : '' }}">REVIEWS
            </button>
        </a>
        <a href="{{ route('admin.reports') }}">
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn {{ request()->is('admin/reports*') ? 'SliderActive' : '' }}">REPORTS</button>
        </a>
        <a href="{{ route('admin.attributes') }}">
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn {{ request()->is('admin/attributes*') ? 'SliderActive' : '' }}">ATTRIBUTES</button>
        </a>
    </div>
        <a href="{{ route('admin.logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
            <form action="{{ route('admin.logout') }}" method="POST" id="logout-form" class="d-none">@csrf</form>
            <button type="button" class="btn btn-white btn-lg rounded-0 adminBtn">LOGOUT</button></a>

</div>
<!-- offcanvas end-->
  @yield('content')

  <!-- bootstrap js link -->
  {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script> --}}
  <script src="{{ asset('bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    {{-- datatable --}}
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.bootstrap4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.5.2/js/buttons.colVis.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap4.min.js"></script>

    <!-- charts -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.0.2/dist/chart.min.js"></script>
    <script src="{{ asset('js/jquery.simplePagination.js') }}"></script>

  <script type="text/javascript">

        // alert hide
        $(document).ready(function () {
        
            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 5000);
        
        });

    // preloader
        var loader = document.getElementById("preloaderAdmin");

            window.addEventListener("load", function(){
            loader.style.display = "none";
        })
    // preloader end
 
    </script>


  @yield('javascript')

</body>

</html>