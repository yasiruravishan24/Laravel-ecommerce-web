<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>DeliverReport</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            text-align: center;
        }

        p {
            margin: 0;
            padding: 0;
        }

        .container {
            margin-right: auto;
            margin-left: auto;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
        }

        .col-6 {
            width: 50%;
            flex: 0 0 auto;
        }

        .heading {
            text-align: center;
        }

        .pageNumber {
            text-align: end;
        }
        .report-table{
            border-collapse: collapse;
            width: 100%;
        }
        .report-table, th, td{
            border: 1px solid black;
            text-align: center;
        }

        .signSection {
            margin-top:4rem;
            margin-bottom: 3rem;
        }
        .sign-table{
            border-collapse: collapse;
            width: 100%;
        }
        .sign-table td{
            border: none;
            text-align: center ;
        }
        .content-table{
            border-collapse: collapse;
            width: 100%;
        }
        .content-table td{
            border: none;
        }
    </style>
</head>

<body>
    @php
       $n=1;
    @endphp
    <div class="container" id="app">

        <div class="heading">
            <h1>FlipFlop Private Ltd</h1>
            <h2>Delivery Status Report</h2>
            <h3>{{ $fromDate }} To {{ $toDate }}</h3>
        </div>

        <div class="row">
            <table class="content-table">
                <tbody>
                    <tr>
                        <td style="text-align: start">
                            <h4>Date :- {{  Carbon\Carbon::now()->format('Y F d') }}</h4>
                        </td>
                        <td style="text-align:right">
                            <h4>Time :- {{  Carbon\Carbon::now()->format('H:i:s') }}</h4>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="row">
            <table class="report-table">
                <thead>
                    <tr>
                        <th>Deliver Id</th>
                        <th>Customer Name</th>
                        <th>Address</th>
                        <th>Order Id</th>
                        <th>Payment Method</th>
                        <th>Total Bill</th>
                        <th>Deliver Status</th>
                        <th>Notice No</th>
                        <th>Ordered Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $oneData)
                        <tr>
                                <td>{{ $oneData->id }}</th>
                                <td>{{ $oneData->order->user->firstName.' '. $oneData->order->user->lastName}}</td>
                                <td>{{ $oneData->order->user->houseNo.', '.$oneData->order->user->street.', '.$oneData->order->user->city .', '. $oneData->order->user->district }}</td>
                                <td>{{ $oneData->order->id}}</td>
                                <td>
                                    @if ($oneData->order->payment_method == 'C')
                                        Cash on Deliver
                                    @else
                                        Bank Transaction
                                    @endif
                                </td>
                                <td>Rs.{{ number_format(($oneData->order->invoice->total_bill-$oneData->order->invoice->discountAmount) + $oneData->order->invoice->taxAmount) }}</td>
                                <td>
                                  @if($oneData->deliver_status == "P")
                                    Pending
                                  @elseif($oneData->deliver_status == "Pr")
                                    Processing
                                  @else
                                    Completed
                                  @endif
                                </td>
                                <td>
                                    @if($oneData->notice_no == null)
                                        <b>-</b>
                                    @else
                                        {{ $oneData->notice_no }}
                                    @endif
                                </td>
                                <td>{{ $oneData->order->created_at->format('Y m d') }}</td>

                        @if ( $n % 25 == 0 )
                            <div style="page-break-before:auto;"></div>
                        @endif

                        @php $n++ @endphp
                    </tr>
                    @empty 
                    <tr>
                        <td colspan="8" style="">There are no records</th>
                    </tr>
                    @endforelse              
                </tbody>
            </table>
        </div>
        <div class="row signSection">
            <table class="sign-table">
                <tbody>
                    <tr>
                        <td>
                            <p>--------------------------------</p>
                            <h5>Signature</h5>
                        </td>
                        <td>
                            <p>--------------------------------</p>
                            <h5>Date</h5>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>

    <script type="text/php">
        if ( isset($pdf) ) {
            $font = $fontMetrics->getFont("helvetica", "bold");
            $pdf->page_text(295, 770, "{PAGE_NUM}", $font, 12, array(0,0,0));
        }
    </script>

</body>

</html>