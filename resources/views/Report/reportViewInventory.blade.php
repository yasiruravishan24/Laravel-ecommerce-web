@extends('layouts.appAdmin')

@section('title', 'Inventory Report - ')
@section('content')
<main class="mt-5 pt-3">
    <div class="container-fluid">
        <div class="row  mb-3">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    Inventory Report  <span class="fs-3">{{ $request->fromDate.' to '.$request->toDate }}</span>
                </h2>
            </div>
        </div>
      
        <div class="row">
            <div class="col-md-12">
              <div class="table-responsive-lg">
                <table class="table table-striped table-bordered nowrap adminReportTables" id="inventoryReportTable">
                  <thead class="table-dark tableHead">
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
                    @foreach ($data as $oneData)
                    <tr>
                      <td>{{ $oneData->id }}</th>
                      <td>{{ $oneData->name}}</td>
                      <td>{{ $oneData->brandName}}</td>
                      <td>{{ $oneData->skuNo }}</td>
                      <td>Rs.{{ number_format($oneData->price) }}</td>
                      <td>{{ $oneData->quantity }}</td>
                      <td>{{ $oneData->updated_at }}</td>
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