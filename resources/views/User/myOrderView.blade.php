@extends('layouts.app')

@section('title', 'MY ORDER - ')

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

        <div class="container-fluid px-5 mt-4 profile-container mb-5">
  
          <div class="row">
            <div class="col-lg-6">
              <table class="table table-borderless myOrderViewTables">
                <tbody>
                  <tr>
                    <td><b>Order No</b></th>
                    <td class="myOrderViewTable-data">{{ $order->id}}</td>
                  </tr>
                  <tr>
                    <td><b>Ordered Date</b></td>
                    <td class="myOrderViewTable-data">{{ $order->created_at}}</td>
                  </tr>
                  <tr>
                    <td><b>Status</b></td>
                    <td>
                      @if($order->deliver->deliver_status == "P")
                        <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span>
                      @elseif($order->deliver->deliver_status == "Pr")
                        <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                      @elseif($order->deliver->deliver_status == "C")
                        <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                      @else
                        <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td><b>Customer Name</b></td>
                    <td class="myOrderViewTable-data">{{ $order->user->firstName.' '.$order->user->lastName }}</td>
                  </tr>
                  <tr>
                    <td><b>Customer Email</b></td>
                    <td class="myOrderViewTable-data">{{ $order->user->email }}</td>
                  </tr>
                  <tr>
                    <td><b>Customer Telephone</b></td>
                    <td class="myOrderViewTable-data">{{ $order->user->phoneNo }}</td>
                  </tr>
                  <tr>
                    <td><b>Customer Address</b></td>
                    <td class="myOrderViewTable-data">{{ $order->user->houseNo.', '.$order->user->street.', '.$order->user->city .', '. $order->user->district}}</td>
                  </tr>
                  <tr>
                    <td><b>Zip Code</b></td>
                    <td class="adminOrderViewTable-data">{{ $order->user->zipCode }}</td>
                </tr>
                </tbody>
              </table>
            </div>
            <div class="col-lg-6">
              <table class="table table-borderless myOrderViewTables">
                <tbody>
                  <tr>
                    <td><b>Invoice No</b></td>
                    <td class="myOrderViewTable-data">{{ $order->invoice->id }}</td>
                  </tr>
                  <tr>
                    <td><b>Payment Method</b></th>
                    <td class="myOrderViewTable-data">
                      @if ($order->payment_method == 'C')
                           Cash on Deliver
                      @else
                          Bank Transaction
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td><b>Total Bill</b></td>
                    <td class="myOrderViewTable-data">Rs.{{ number_format(($order->invoice->total_bill - $order->invoice->discountAmount) + $order->invoice->taxAmount) }}</td>
                  </tr>
                  <tr>
                    <td><b>Payment Status</b></td>
                    <td class="myOrderViewTable-data">
                      @if ($order->invoice->payment_status == 'N')
                          Not Paid
                      @else
                          Paid
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td><b>Bank Receipt No</b></td>
                    <td class="myOrderViewTable-data">
                      @if($order->invoice->bank_receipt == null)
                          <b class="ps-4">-</b>
                      @else
                        {{ $order->invoice->bank_receipt }}
                      @endif
                    </td>
                  </tr>
                  <tr>
                    <td><b>Delivery Notice No</b></td>
                    <td class="myOrderViewTable-data">
                      <a class="text-decoration-none text-black" href="https://www.domex.lk/tracking.php?wbno={{ $order->deliver->notice_no }}" target="_blank">{{ $order->deliver->notice_no }}</a>
                    </td>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>
          <div class="row mt-4">
            <div class="col-lg-12 mb-2">
              <h5 class="profile-heading">Ordered Items</h5>
            </div>
            <div class="col-lg-12">
              <div class="table-responsive-md">
                <table class="table myOrderTables text-wrap">
                  <thead class="table-dark tableHead">
                    <tr>
                      <th scope="col">Item id</th>
                      <th scope="col">Image</th>
                      <th scope="col">Name</th>
                      <th scope="col">Price</th>
                      <th scope="col">Selected Size</th>
                      <th scope="col">Quantity</th>
                    </tr>
                  </thead>
                  <tbody>
                      @foreach ($order->items as $oneOrderitem)
                        <tr>
                            <td>{{ $oneOrderitem->id }}</th>
                            <td>
                                <a href="/items/{{ $oneOrderitem->id  }}" class="text-decoration-none">
                                    <img class="border  td-image" src="{{ asset('itemImages/'.$oneOrderitem->imagePath ) }}" width="70" height="45">
                                </a>
                            </td>
                            <td>
                                <a href="/items/{{ $oneOrderitem->id  }}" class="text-decoration-none text-black">{{ $oneOrderitem->name }}</a>
                            </td>
                            <td>Rs.{{ number_format($oneOrderitem->price) }}</td>
                            <td>{{ $oneOrderitem->pivot->size }}</td>
                            <td>{{ $oneOrderitem->pivot->quantity }}</td>
                        </tr> 
                      @endforeach
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
      </script>
@endsection