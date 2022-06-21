@extends('layouts.appAdmin')

@section('title', 'DELIVERS - ')

@section('content')

<main class="mt-5 pt-3">
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    DELIVERS
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
            
            @if (Session::get('exception-error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="loginError"> {{ Session::get('exception-error') }}<span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="row">
                    <div class="col-lg-12">
                        <form class="row g-3" action="{{ route('admin.updatedelivers',$deliver->id) }}" method="POST" autocomplete="off">
                            @csrf
                            <div class="col-md-4">
                                <label for="firstName" class="form-label adminDelverLabel @error('deliverNotice') is-invalid @enderror">Deliver Notice No</label>
                                <input type="text" name="deliverNotice" class="form-control rounded-0 adminOrderInput @error('deliverNotice') adminOrderInput-invalid  @enderror" value="{{ old('deliverNotice', $deliver->notice_no) }}">
                                <span class="text-danger">@error('deliverNotice'){{ $message }}@enderror</span>
                            </div>
                            <div class="col-md-4">
                                <label for="firstName" class="form-label adminDelverLabel">Status</label>
                                <select name="deliverStatus" class="form-select form-select-md rounded-0 adminOrderInput" aria-label=".form-select-lg example">
                                    <option @if($deliver->deliver_status == "P" ) selected @endif value="P">Pending</option>
                                    <option @if($deliver->deliver_status == "Pr" ) selected @endif value="Pr">Processing</option>
                                    <option @if($deliver->deliver_status == "C" ) selected @endif value="C">Completed</option>
                                    <option @if($deliver->deliver_status == "R" ) selected @endif value="R">Returned</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <label for="firstName" class="form-label adminDelverLabel">Cash Settlement Status</label>
                                <select name="settlementStatus" class="form-select form-select-md rounded-0 adminOrderInput" aria-label=".form-select-lg example">
                                    <option @if($deliver->settlement_status == "NR" ) selected @endif value="NR">Not Received</option>
                                    <option @if($deliver->settlement_status == "R" ) selected @endif value="R">Received</option>
                                </select>
                            </div>
                            <div class="col-md-5">
                                <button class="btn btn-primary rounded-0 adminOrder-view-btn">UPDATE DELIVER DETAILS</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-6">
                <table class="table table-borderless adminOrderViewTables">
                    <tbody>
                        <tr>
                            <td><b>Order No</b></th>
                            <td class="adminOrderViewTable-data"><a href="{{ route('admin.ordershow',$deliver->order->id) }}" class="text-decoration-none text-black">{{ $deliver->order->id }}</a></td>
                        </tr>
                        <tr>
                            <td><b>Ordered Date</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->created_at }}</td>
                        </tr>
                        <tr>
                            <td><b>Status</b></td>
                            <td>
                                @if($deliver->deliver_status == "P")
                                    <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                                @elseif($deliver->deliver_status == "Pr")
                                    <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                                @elseif($deliver->deliver_status == "C")
                                    <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                                @else
                                    <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Customer Name</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->user->firstName.' '.$deliver->order->user->lastName}}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Email</b></td>
                            <td class="adminOrderViewTable-data">
                                <a class="text-decoration-none text-black" href="https://mail.google.com/mail/?view=cm&fs=1&to={{ $deliver->order->user->email }}" target="_blank">{{ $deliver->order->user->email }}</a>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Customer Telephone</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->user->phoneNo }}</td>
                        </tr>
                        <tr>
                            <td><b>Customer Address</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->user->houseNo.', '.$deliver->order->user->street.', '.$deliver->order->user->city .', '. $deliver->order->user->district}}</td>
                        </tr>
                        <tr>
                            <td><b>Zip Code</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->user->zipCode }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-lg-6">
                <table class="table table-borderless adminOrderViewTables">
                    <tbody>
                        <tr>
                            <td><b>Deliver Id</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->id }}</td>
                        </tr>
                        <tr>
                            <td><b>Delivery notice no</b></td>
                            <td class="adminOrderViewTable-data">
                                @if($deliver->notice_no == null)
                                    <b>-</b>
                                @else
                                    <a class="text-decoration-none text-black" href="https://www.domex.lk/tracking.php?wbno={{ $deliver->notice_no }}" target="_blank">{{ $deliver->notice_no }}</a>
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Invoice No</b></td>
                            <td class="adminOrderViewTable-data">{{ $deliver->order->invoice->id }}</td>
                        </tr>
                        <tr>
                            <td><b>Total Bill</b></td>
                            <td class="adminOrderViewTable-data">Rs.{{ number_format(($deliver->order->invoice->total_bill - $deliver->order->invoice->discountAmount) + $deliver->order->invoice->taxAmount) }}</td>
                        </tr>
                        <tr>
                            <td><b>Payment method</b></th>
                            <td class="adminOrderViewTable-data">
                                @if ($deliver->order->payment_method == 'C')
                                    Cash on Deliver
                                @else
                                    Bank Transaction
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Payment status</b></th>
                            <td class="adminOrderViewTable-data">
                                @if ($deliver->order->invoice->payment_status == 'N')
                                    Not Paid
                                @else
                                    Paid
                                @endif
                            </td>
                        </tr>
                        <tr>
                            <td><b>Bank Receipt No</b></td>
                            <td class="adminOrderViewTable-data">
                                @if($deliver->order->invoice->bank_receipt == null)
                                    <b>-</b>
                                @else
                                    {{ $deliver->order->invoice->bank_receipt }}
                                @endif
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
    
@endsection