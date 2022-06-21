@extends('layouts.appAdmin')

@section('title', 'ORDERS - ')

@section('content')
<main class="mt-5 pt-3">
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    ORDERS
                </h2>
            </div>
        </div>
    </div>
    <div class="container mb-3">
        <div class="row">
            @if (Session::get('success-update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success-update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('cant-update'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('cant-update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('success-order-item-update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success-order-item-update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('exception-error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <span class="loginError"> {{ Session::get('exception-error') }}<span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-6">
                <table class="table table-borderless adminOrderViewTables">
                    <tbody>
                        <tr>
                            <td><b>Order No</b></th>
                            <td class="adminOrderViewTable-data">{{ $order->id }}</td>
                        </tr>
                        <tr>
                            <td><b>Ordered Date</b></td>
                            <td class="adminOrderViewTable-data">{{ $order->created_at }}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>
                              @if($order->deliver->deliver_status == "P")
                                <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                              @elseif($order->deliver->deliver_status == "Pr")
                                <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                              @elseif($order->deliver->deliver_status == "C")
                                <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                              @else 
                                <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                              @endif
                        </tr>
                        <tr>
                            <td><b>Customer Name</b></td>
                            <td class="adminOrderViewTable-data">{{ $order->user->firstName.' '.$order->user->lastName }}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Email</b></td>
                            <td class="adminOrderViewTable-data">
                                <a class="text-decoration-none text-black" href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $order->user->email }}" target="_blank">{{ $order->user->email }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Customer Telephone</b></td>
                            <td class="adminOrderViewTable-data">{{ $order->user->phoneNo }}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Address</b></td>
                            <td class="adminOrderViewTable-data">{{ $order->user->houseNo.', '.$order->user->street.', '.$order->user->city .', '. $order->user->district}}</td>
                        </tr>
                        <tr>
                            <td><b>Zip Code</b></td>
                            <td class="adminOrderViewTable-data">{{ $order->user->zipCode }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <form action="{{ route('admin.updateorder',$order->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <table class="table table-borderless adminOrderViewTables">
                        <tbody>
                            <tr>
                                <td><b>Deliver Id</b></td>
                                <td class="adminOrderViewTable-data"><a href="{{ route('admin.delivershow',$order->deliver->id ) }}" class="text-decoration-none text-black">{{ $order->deliver->id  }}</a></td>
                            </tr>
                            <tr>
                                <td><b>Delivery Notice No</b></td>
                                <td class="adminOrderViewTable-data">
                                    @if($order->deliver->notice_no == null)
                                        <b >-</b>
                                    @else
                                        <a class="text-decoration-none text-black" href="https://www.domex.lk/tracking.php?wbno={{ $order->deliver->notice_no }}" target="_blank">{{ $order->deliver->notice_no }}</a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Invoice No</b></td>
                                <td class="adminOrderViewTable-data">{{ $order->invoice->id }}</td>
                            </tr>
                            <tr>
                                <td><b>Total Bill</b></td>
                                <td class="adminOrderViewTable-data">Rs.{{ number_format(($order->invoice->total_bill - $order->invoice->discountAmount) + $order->invoice->taxAmount) }}</td>
                            </tr>
                            <tr>
                                <td><b>Payment Method</b></th>
                                <td class="adminOrderViewTable-data">
                                    <select name="payment_method" class="form-select form-select-md  rounded-0 adminOrderInput" aria-label=".form-select-lg example">
                                        <option @if($order->payment_method == 'C')selected @endif value="C">Cash on Deliver</option>
                                        <option @if($order->payment_method == 'B')selected @endif value="B">Bank Transaction</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Payment Status</b></th>
                                <td class="adminOrderViewTable-data">
                                    <select name="payemnt_status" class="form-select form-select-md rounded-0 adminOrderInput" aria-label=".form-select-lg example">
                                        <option @if($order->invoice->payment_status == 'P')selected @endif value="P">Paid</option>
                                        <option @if($order->invoice->payment_status == 'N')selected @endif value="N">Not Paid</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b class="@error('bankReciptNo') is-invalid @enderror">Bank Receipt No</b></td>
                                <td class="adminOrderViewTable-data">
                                    <input type="hidden" name="invoiceNo" value="{{ $order->invoice->id }}">
                                    <input type="text" name="bankReciptNo" class="form-control rounded-0 adminOrderInput @error('bankReciptNo') adminOrderInput-invalid  @enderror" value="{{ old('bankReciptNo',$order->invoice->bank_receipt)  }}">
                                </td>
                            </tr>
                            <tr>
                                <td class="adminOrderViewTable-data">
                                    <td><span class="text-danger">@error('bankReciptNo'){{ $message }}@enderror</span></td>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="orderUpdate-btn">
                        <button class="btn btn-primary rounded-0 adminOrder-view-btn">UPDATE ORDER</button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row mt-4">
            <div class="col-lg-12 mb-2">
                <h5 class="profile-heading">Ordered Items</h5>
            </div>
            <div class="col-lg-12">
                <div class="table-responsive-md">
                    <table class="table adminOrderTables text-wrap">
                        <thead class="table-dark tableHead">
                            <tr>
                                <th scope="col">Item id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">SKU No</th>
                                <th scope="col">Price</th>
                                <th scope="col">Selected Size</th>
                                <th scope="col">Quantity</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order->items as $oneItem)
                                <tr>
                                    <td>{{ $oneItem->id }}</th>
                                    <td>
                                        <a href="/items/{{ $oneItem->id }}" class="text-decoration-none" target="_black">
                                            <img src="{{ asset('itemImages/'.$oneItem->imagePath) }}" width="70" height="45">
                                        </a>
                                    </td>
                                    <td>{{ $oneItem->name }}</td>
                                    <td>{{ $oneItem->skuNo }}</td>
                                    <td>Rs.{{ number_format($oneItem->price) }}</td>
                                    <td>{{ $oneItem->pivot->size }}</td>
                                    <td>{{ $oneItem->pivot->quantity }}</td>
                                    <td>
                                        @if($order->deliver->deliver_status == "R") 
                                        <a href="{{ route('admin.returnItem', $oneItem->pivot->id) }}" class="text-decoration-none text-black fs-3"><i class="bi bi-pencil-square"></i></a>
                                        @endif
                                    </td>
                                </tr>     
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row justify-content-center mt-4 mb-5">
            <div class="col-lg-12 text-center">
                <a href="{{ route('admin.invoicegenarate',$order->id ) }}" target="_blank" class="btn btn-primary rounded-0 adminOrder-view-btn pt-2 pb-2 pe-4 ps-4">GENERATE INVOICE</a>
            </div>
        </div>
    </div>

</main>
    
@endsection