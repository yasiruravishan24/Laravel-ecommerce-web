<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Orders Report</title>
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
            <h2>Orders Report</h2>
            <h3>{{ $fromDate }} To {{ $toDate }}</h3>
        </div>

        <div class="row">
            <table class="sign-table">
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
                        <th scope="col">Order Id</th>
                        <th scope="col">Customer Name</th>
                        <th scope="col"># of Items in Order</th>
                        <th scope="col">Payment Method</th>
                        <th scope="col">Total Bill</th>
                        <th scope="col">Payment Status</th>
                        <th scope="col">Deliver Id</th>
                        <th scope="col">Ordered Date</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($data as $oneData)
                        <tr>
                            <td>{{ $oneData->id }}</th>
                            <td>{{ $oneData->user->firstName.' '. $oneData->user->lastName}}</td>
                            <td>{{ count($oneData->items) }}</td>
                            <td>
                                @if ($oneData->payment_method == 'C')
                                Cash on Deliver
                                @else
                                Bank Transaction
                                @endif
                            </td>
                            <td>Rs.{{ number_format(($oneData->invoice->total_bill-$oneData->invoice->discountAmount) + $oneData->invoice->taxAmount) }}</td>
                            <td>
                                @if ($oneData->invoice->payment_status == 'P')
                                    Paid
                                @else
                                    Not Paid
                                @endif
                            </td>
                            <td>{{ $oneData->deliver->id }}</td>
                            <td>{{ $oneData->created_at->format('Y-m-d') }}</td>

                        @if ( $n % 25 == 0 )
                            <div style="page-break-before:auto;"></div>
                        @endif
                        @php $n++ @endphp 
                    </tr>     
                    @empty 
                    <tr>
                        <td colspan="7" style="">There are no records</th>
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