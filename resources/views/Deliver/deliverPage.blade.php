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
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table adminTables text-wrap">
                        <thead class="table-dark tableHead">
                            <tr>
                                <th scope="col">Deliver id</th>
                                <th scope="col">Order id</th>
                                <th scope="col">Payment Method</th>
                                <th scope="col">Notice Number</th>
                                <th scope="col">Status</th>
                                <th scope="col">Updated date</th>
                                <th colspan="3" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($deliver as $oneDeliver)
                            <tr>
                                <td>{{ $oneDeliver->id }}</th>
                                <td><a href="{{ route('admin.ordershow',$oneDeliver->id) }}" class="text-decoration-none text-black">{{ $oneDeliver->order_id }}</a></td>
                                <td>
                                    @if ($oneDeliver->order->payment_method == 'C')
                                        Cash on Deliver
                                    @else
                                        Bank Transaction
                                    @endif
                                </td>
                                <td>
                                    @if($oneDeliver->notice_no == null)
                                        <b>-</b>
                                    @else
                                        <a class="text-decoration-none text-black" href="https://www.domex.lk/tracking.php?wbno={{ $oneDeliver->notice_no }}" target="_blank">{{ $oneDeliver->notice_no }}</a>
                                    @endif
                                </td>
                                <td>
                                    @if($oneDeliver->deliver_status == "P")
                                        <span class="badge bg-warning myOrder-badge-pen rounded-0">Pending</span></td>
                                    @elseif($oneDeliver->deliver_status == "Pr")
                                        <span class="badge bg-info myOrder-badge-pro rounded-0">Processing</span>
                                    @elseif($oneDeliver->deliver_status == "C")
                                        <span class="badge bg-success myOrder-badge-com rounded-0">Completed</span>
                                    @else
                                        <span class="badge bg-success myOrder-badge-re rounded-0">Returned</span>
                                    @endif
                                </td>
                                <td>{{ $oneDeliver->updated_at }}</td>
                                <td colspan="2">
                                    <a class="text-black text-decoration-none" href="{{ route('admin.delivershow',$oneDeliver->id) }}">
                                        <i class="bi bi-eye-fill actionIcon me-2"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                                <td colspan="8">There are no records to display</th>
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
                        {{  $deliver->links();  }}
                    </div>
                </div>
            </div>
        </div>
        {{--end pagination --}}
</main>
    
@endsection