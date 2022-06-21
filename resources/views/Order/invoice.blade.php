<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Fira+Sans+Condensed:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">

    <title>INVOICE</title>
    <style>
        body{
            background-color: #F6F6F6; 
            margin: 0;
            padding: 0;
            font-family: 'Fira Sans Condensed', sans-serif;
        }
        h1,h2,h3,h4,h5,h6{
            margin: 0;
            padding: 0;
        }
        p{
            margin: 0;
            padding: 0;
        }
        .container{
            width: 80%;
            margin-right: auto;
            margin-left: auto;
            border: 2px solid black;
        }
        .brand-section{
           padding: 10px 40px;
        }
        .logo{
            width: 50%;
        }

        .row{
            display: flex;
            flex-wrap: wrap;
        }
        .col-6{
            width: 50%;
            flex: 0 0 auto;
        }
        .text-white{
            color: #fff;
        }
        .company-details{
            float: right;
            text-align: right;
            font-weight: 500;
        }
        .header-section{
            padding: 16px;
        }
        .body-section{
            padding: 16px;
            border: 2px solid black;
            border-left: none;
            border-right: none;
        }
        .footer-section{
            padding: 16px;
        }
        .heading{
            font-size: 18px;
            margin-bottom: 08px;
        }
        .sub-heading{
            color: #262626;
            margin-bottom: 05px;
        }
        table{
            width: 100%;
            border-collapse: collapse;
        }
        table thead tr{
            border: 1px solid black;
            background-color: #D8D8D8;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
        }
        table th, table td {
            padding-top: 10px;
            padding-bottom: 10px;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid black;
        }
        .text-right{
            text-align: end;
        }
        .w-20{
            width: 20%;
        }
        .float-right{
            float: right;
        }
    </style>
</head>
<body onload="window.print();">

    <div class="container" id="app">
        <div class="brand-section">
            <div class="row">
                <div class="col-6">
                    <img src="{{ asset('img/logoLogin.png') }}" alt="">
                </div>
                <div class="col-6">
                    <div class="company-details">
                        <p class="text-secondary">Date: {{ Carbon\Carbon::now()->format('Y-m-d') }}</p>
                        <p class="text-black">Flip Flop</p>
                        <p class="text-black">11/A Templers Rd, Mount Lavinia<br> Colombo</p>
                        <p class="text-black">077 136 2142</p>
                    </div>
                </div>
            </div>
        </div>

        <div class="header-section">
            <div class="row">
                <div class="col-6">
                    <h2 class="heading">Invoice No : {{ str_pad($order->id , 4, '0', STR_PAD_LEFT)}}</h2>
                    <p class="sub-heading">Tracking No : @if($order->deliver->notice_no == null) <b>-</b>@else {{ $order->deliver->notice_no }}@endif </p>
                    <p class="sub-heading">Order Date : {{ $order->created_at->format('d/m/Y') }}</p>
                    <p class="sub-heading">Email Address : {{ $order->user->email }}</p>
                </div>
                <div class="col-6">
                    <p class="sub-heading">Full Name : {{ $order->user->firstName.' '. $order->user->lastName }}</p>
                    <p class="sub-heading">Address : {{ $order->user->houseNo.', '.$order->user->street.', '.$order->user->city .', '. $order->user->district}}</p>
                    <p class="sub-heading">zip code : {{ $order->user->zipCode }}</p>
                    <p class="sub-heading">Phone Number: {{ $order->user->phoneNo }} </p>
                </div>
            </div>
        </div>
        @php
            $subTotal = 0 ;
            foreach ($order->items as $key => $oneCartitem) {
                $subTotal = $subTotal + $oneCartitem->price * $oneCartitem->pivot->quantity;
            }
        @endphp
        <div class="body-section">
            <h3 class="heading">Ordered Items</h3>
            <br>
            <table class="table-bordered">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th class="w-20">Price</th>
                        <th class="w-20">Size</th>
                        <th class="w-20">Quantity</th>
                        <th class="w-20">SubTotal</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($order->items as $oneOrderItem)
                        <tr>
                            <td>{{ $oneOrderItem->name }}</td>
                            <td>Rs.{{ number_format($oneOrderItem->price) }}</td>
                            <td>{{ $oneOrderItem->pivot->size }}</td>
                            <td>{{ $oneOrderItem->pivot->quantity }}</td>
                            <td>Rs.{{ number_format($oneOrderItem->price * $oneOrderItem->pivot->quantity ) }}</td>
                        </tr>
                    @endforeach
                    <tr>
                        <td colspan="4" class="text-center"><b>Sub Total</b></td>
                        <td>Rs.{{ number_format( $subTotal) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><b>Discount {{ $rate[1]->rate }}%</b></td>
                        <td>Rs.{{ number_format( $subTotal * $rate[1]->rate / 100 ) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><b>Tax Total {{ $rate[0]->rate }}%</b></td>
                        <td>Rs.{{ number_format(($subTotal - ($subTotal * $rate[1]->rate / 100)) * $rate[0]->rate / 100) }}</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-center"><b>Grand Total</b></td>
                        <td>Rs.{{ number_format(($subTotal  - ($subTotal * $rate[1]->rate / 100 )) + (($subTotal - ($subTotal * $rate[1]->rate / 100)) * $rate[0]->rate / 100)) }}</td>
                    </tr>
                </tbody>
            </table>
            <br>
            <h3 class="heading">Payment Status: @if ($order->invoice->payment_status == 'N')Not Paid @else Paid @endif </h3>
            <h3 class="heading">Payment Method: @if ($order->payment_method == 'C')Cash on Deliver @else Bank Transaction @endif</h3>
        </div>

        <div class="footer-section">
            <p>&copy; Copyright 2022 - Filp FLOP All rights reserved. 
                <a href="https://www.flipflop.lk/" class="float-right">www.flipflop.lk</a>
            </p>
        </div>      
    </div>
</body>
</html>