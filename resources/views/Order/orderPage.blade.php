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
      
    {{-- delete confirmation --}}
    <div class="modal fade" id="orderDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete Order</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <strong class="deleteMessage">Are you sure that you want to delete this order?</strong> 
                    <form  method="POST" id="orderdeleteForm" class="mt-3"> 
                        @csrf
                        @method('delete')
                        <div class="modal-footer">
                        <button type="submit" class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 adminOptionBtn">YES</button>
                        <button type="reset" class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 adminOptionBtn" data-bs-dismiss="modal">NO</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{-- delete confirmation end --}}
    <div class="container mt-3 mb-3">
        <div class="row">
            @if (Session::get('success-delete'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success-delete') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table adminTables text-wrap" id="orderTableMain">
                        <thead class="table-dark tableHead">
                            <tr>
                                <th scope="col">Order id</th>
                                <th scope="col">Total bill</th>
                                <th scope="col">Payment</th>
                                <th scope="col">Status</th>
                                <th scope="col">Ordered date</th>
                                <th colspan="3" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders  as $oneOrder)
                                <tr>
                                    <td>{{ $oneOrder->id }}</th>
                                    <td>Rs.{{ number_format(($oneOrder->invoice->total_bill - $oneOrder->invoice->discountAmount) + $oneOrder->invoice->taxAmount) }}</td>
                                    <td>
                                        @if ($oneOrder->invoice->payment_status == 'N')
                                            Not Paid
                                        @else
                                            Paid
                                        @endif
                                    </td>
                                    <td>
                                      @if($oneOrder->deliver->deliver_status == "P")
                                        <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                                      @elseif($oneOrder->deliver->deliver_status == "Pr")
                                        <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                                      @elseif($oneOrder->deliver->deliver_status == "C")
                                        <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                                      @else
                                        <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>                      
                                      @endif
                                    </td>
                                    <td>{{ $oneOrder->created_at }}</td>
                                    <td colspan="2">
                                        <a class="text-black text-decoration-none" href="{{ route('admin.ordershow',$oneOrder->id) }}">
                                            <i class="bi bi-eye-fill actionIcon me-2"></i>
                                        </a>
                                        @if($oneOrder->deliver->deliver_status == "P")
                                            <a id="orderTrashbutton" class="text-black text-decoration-none orderTrashbutton"><i class="bi bi-trash actionIcon "></i></i></a>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <td colspan="7">There are no records to display</th>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
        {{-- pagination --}}
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="d-flex justify-content-center">
                        {{  $orders->links();  }}
                    </div>
                </div>
            </div>
        </div>
        {{--end pagination --}}
</main>

    
@endsection

@section('javascript')
    <script>
        // delete order
        $(document).ready(function (){
          $('#orderTableMain').on('click','.orderTrashbutton',function(){ 
              $tr = $(this).closest('tr');
              var data = $tr.children("td").map(function() {
                  return $(this).text();
              }).get();

              console.log(data[0])

              $('#orderdeleteForm').attr('action', '/admin/orders/' + data[0]);
              $('#orderDeleteModal').modal('show');
          });
        });
        // delete review end
      </script>
@endsection