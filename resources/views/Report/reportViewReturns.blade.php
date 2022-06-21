@extends('layouts.appAdmin')

@section('title', 'Orders Return Report - ')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row  mb-3">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    Orders Return Report  <span class="fs-3">{{ $request->fromDate.' to '.$request->toDate }}</span>
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="table-responsive-lg">
                <table class="table table-striped table-bordered nowrap adminReportTables" id="returnsReportTable">
                  <thead class="table-dark tableHead">
                    <tr>
                      <th scope="col">Customer Name</th>
                      <th scope="col">Address</th>
                      <th scope="col">Tele</th>
                      <th scope="col">Order Id</th>
                      <th scope="col">Retured Item</th>
                      <th scope="col">Item Size</th>
                      <th scope="col">Qty</th>
                      <th scope="col">Reason</th>
                      <th scope="col">Order Retured Date</th>
                      <th scope="col">Updated Date</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $oneData)
                    <tr>
                      <td>{{ $oneData->order->user->firstName.' '. $oneData->order->user->firstName}}</th>
                      <td>{{ $oneData->order->user->houseNo.', '.$oneData->order->user->street.', '.$oneData->order->user->city .', '. $oneData->order->user->district }}</td>
                      <td>{{ $oneData->order->user->phoneNo }}</td>
                      <td>{{ $oneData->order->id }}</td>
                      <td>{{ $oneData->items[0]->name.' '.'('.$oneData->items[0]->id.')'}}</td>
                      <td>{{ $oneData->items[0]->pivot->size}}</td>
                      <td>{{ $oneData->items[0]->pivot->quantity}}</td>
                      <td>{{ $oneData->reason}}</td>
                      <td>{{ $oneData->returned_date}}</td>
                      <td>{{ $oneData->created_at}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
            </div>
          </div>
          <div class="row justify-content-center mt-4 mb-5">
            <div class="col-lg-12 text-center">
              <a href="{{ route('admin.printReport',['report' => $request->report, 'fromDate' =>  str_replace("/", "-", $request->fromDate),'toDate' => str_replace("/", "-", $request->toDate)]) }}"  class="btn btn-primary rounded-0 adminOrder-view-btn pt-2 pb-2 pe-4 ps-4" >PRINT REPORT</a>
            </div>
          </div>
    </div>
</main>
    
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
        var table = $('#returnsReportTable').DataTable( {
            lengthChange: false,
            buttons: [ 'excel', 'csv', 'pdf'],
        } );
     
        table.buttons().container()
            .appendTo( '#returnsReportTable_wrapper .col-md-6:eq(0)' );
    } );
</script>
   
@endsection