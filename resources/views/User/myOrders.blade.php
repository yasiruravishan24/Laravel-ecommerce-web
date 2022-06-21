@extends('layouts.app')

@section('title', 'MY ORDERS - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">MY ORDERS</p>
        </div>
      </div>
    </div>
  </div>
  {{--  page path end --}}

  {{-- order conform message --}}
  @if (Session::get('order-conform'))
    <div class="modal fade" id="order-conform" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <img src="{{ asset('img/logo 1.png') }}" width="40" height="32">
            <h5 class="modal-title ms-2 orderConform-title" id="staticBackdropLabel">Thank you for your order!</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <h5 class="orderConform-message-head">{{ Session::get('order-conform') }}</h5>
            <p class="orderConform-message-message">We will email you, your order details and tracking information</p>
          </div>
          <div class="modal-footer">
            <a href="/" type="button" class="btn btn-primary rounded-0 orderConform-message-btn">Continue shopping</a>
          </div>
        </div>
      </div>
    </div>
  @endif


  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    @include('layouts.myaccount-slidebar')
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">
      <div class="d-flex align-items-center ms-5 mt-5 my-account-heading">
        <i class="bi bi-text-left me-4" id="menu-toggle"></i>
        <h2 class="m-0">My orders</h2>
      </div>

      <div class="container-fluid px-5 mt-4 profile-container">
        <div class="row">
          <div class="col-lg-12">
            <div class="table-responsive-md">
              <table class="table myOrderTables text-wrap" id="ordersTable">
                <thead class="table-dark tableHead">
                  <tr>
                    <th scope="col">Order id</th>
                    <th scope="col">Payment</th>
                    <th scope="col">Total bill</th>
                    <th scope="col">Status</th>
                    <th scope="col">Ordered date</th>
                    <th colspan="2" scope="col">Action</th>
                  </tr>
                </thead>
                <tbody>
                  @forelse (Auth::user()->order as $oneOrder)
                  <tr>
                    <td>{{ $oneOrder->id }}</th>
                    <td>
                      @if ($oneOrder->invoice->payment_status == 'N')
                          Not Paid
                      @else
                          Paid
                      @endif
                    </td>
                    <td>Rs.{{ number_format(($oneOrder->invoice->total_bill - $oneOrder->invoice->discountAmount) + $oneOrder->invoice->taxAmount) }}</td>
                    <td>
                      @if($oneOrder->deliver->deliver_status == "P")
                        <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                      @elseif($oneOrder->deliver->deliver_status == "Pr")
                        <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                      @elseif($oneOrder->deliver->deliver_status == "C")
                        <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                      @else
                        <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                      @endif
                    <td>{{ $oneOrder->created_at }}</td>
                    <td colspan="2">
                      <a href="{{ route('user.myOrderView',$oneOrder->id) }}" class="text-decoration-none text-black"><i class="bi bi-eye-fill"></i></a>
                    </td>
                  </tr>
                  @empty
                  <tr>
                    <td colspan="6">There are no orders to display</th>  
                  </tr>                 
                  @endforelse    
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- /#page-content-wrapper -->
    
@endsection

@section('javascript')
    <script>
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
        el.classList.toggle("toggled");
        };

        $("#ordersTable").simplePagination({

          // the number of rows to show per page
          perPage: 8,

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

      @if (Session::get('order-conform'))
        <script type="text/javascript">
            $(window).on('load', function() {
                $('#order-conform').modal('show');
            });
        </script> 
      @endif


@endsection