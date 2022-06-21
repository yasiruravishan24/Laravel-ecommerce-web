@extends('layouts.appAdmin')

@section('title', 'Sales Report - ')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row  mb-3">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    Sales Report  <span class="fs-3">{{ $request->fromDate.' to '.$request->toDate }}</span>
                </h2>
            </div>
        </div>
        @php
          $subTotal = 0;
          $allTotal = 0;
        @endphp
        <div class="row">
            <div class="col-md-12">
              <div class="table-responsive-lg">
                <table class="table table-striped table-bordered nowrap adminReportTables" id="salesReportTable">
                  <thead class="table-dark tableHead">
                    <tr>
                      <th scope="col">Item Id</th>
                      <th scope="col">Item Name</th>
                      <th scope="col">Brand</th>
                      <th scope="col">Available Stock</th>
                      <th scope="col">Price</th>
                      <th scope="col"># Of Items Sold</th>
                      <th scope="col">Total Sale</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($data as $oneData)
                    <tr>
                      <td>{{ $oneData->id }}</th>
                      <td>{{ $oneData->name }}</td>
                      <td>{{ $oneData->brandName }}</td>
                      <td>{{ $oneData->quantity }}</td>
                      <td>{{ $oneData->price}}</td>
                      <td>{{ $oneData->total}}</td>
                      <td style="text-align: right">Rs.{{ number_format(($oneData->price * $oneData->total)) }}</td>
                    </tr>
                      @php 
                        $subTotal = $subTotal + ($oneData->price * $oneData->total);
                        $allTotal = $allTotal +  $oneData->total ;
                      @endphp
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
        var table = $('#salesReportTable').DataTable( {
            lengthChange: false,
            buttons: [ 'excel', 'csv', 'pdf'],
        } );
     
        table.buttons().container()
            .appendTo( '#salesReportTable_wrapper .col-md-6:eq(0)' );
    } );
</script>
   
@endsection