<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Inventory Report</title>
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
            <h2>Inventory Report</h2>
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
                        <th scope="col">Item Id</th>
                        <th scope="col">Item Name</th>
                        <th scope="col">Brand Name</th>
                        <th scope="col">SKU No</th>
                        <th scope="col">Price</th>
                        <th scope="col">Available Stock</th>
                        <th scope="col">Added Date</th>
                    </tr>
                </thead>
                <tbody>

                    @forelse ($data as $oneData)
                        <tr>
                            <td>{{ $oneData->id }}</th>
                            <td>{{ $oneData->name}}</td>
                            <td>{{ $oneData->brandName}}</td>
                            <td>{{ $oneData->skuNo }}</td>
                            <td>Rs.{{ number_format($oneData->price) }}</td>
                            <td>{{ $oneData->quantity }}</td>
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