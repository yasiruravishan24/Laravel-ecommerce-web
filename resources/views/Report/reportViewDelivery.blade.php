@extends('layouts.appAdmin')

@section('title', ' Delivery Report - ')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row  mb-3">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    Delivery Report  <span class="fs-3">{{ $request->fromDate.' to '.$request->toDate }}</span>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="table-responsive-lg">
                <table class="table table-striped table-bordered nowrap adminReportTables" id="inventoryReportTable">
                  <thead class="table-dark tableHead">
                    <tr>
                      <th scope="col">Deliver Id</th>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Order Id</th>
                      <th scope="col">Payment Method</th>
                      <th scope="col">Total Bill</th>
                      <th scope="col">Delivery Status</th>
                      <th scope="col">Notice No</th>
                      <th scope="col">Ordered Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $oneData)
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
                      <td>{{ $oneData->order->created_at }}</td>
                    </tr>  
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-4 mb-5">
            <div class="col-lg-12 text-center">
              <a href="{{ route('admin.printReport',['report' => $request->report, 'fromDate' =>  str_replace("/", "-", $request->fromDate),'toDate' => str_replace("/", "-", $request->toDate)]) }}"  class="btn btn-primary rounded-0 adminOrder-view-btn pt-2 pb-2 pe-4 ps-4">PRINT REPORT</a>
            </div>
          </div>
    </div>
</main>
    
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        var table = $('#inventoryReportTable').DataTable( {
            lengthChange: false,
            buttons: [ 'excel', 'csv', 'pdf']
        } );
     
        table.buttons().container()
            .appendTo( '#inventoryReportTable_wrapper .col-md-6:eq(0)' );
    } );
       </script>   
@endsection