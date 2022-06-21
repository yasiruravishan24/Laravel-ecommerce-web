@extends('layouts.appAdmin')

@section('title', 'ITEMS - ')
@section('content')
<main class="mt-5 pt-3">
    {{-- heading --}}
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    ITEMS TRASH
                </h2>
            </div>
        </div>
    </div>
    {{-- heading end--}}

    {{-- delete confirmation --}}
    <div class="modal fade" id="deleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete Item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
             <strong class="deleteMessage">Are you sure that you want to permanently delete the selected item in trash?</strong> 
            <form  method="POST" id="deleteTrashForm" class="mt-3"> 
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


    {{-- alret message --}}
    <div class="container">
        @if (Session::get('success-restore'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    {{ Session::get('success-restore') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>  
            </div>
        </div>
        @endif
        @if (Session::get('success-delete'))
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ Session::get('success-delete') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>  
            </div>
        </div>
        @endif
    </div>
      {{-- alret message end--}}

    {{-- table --}}
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table id="itemTable" class="table adminTables text-wrap">
                        <thead class="table-dark tableHead">
                            <tr>
                                <th scope="col">Item Id</th>
                                <th scope="col">Image</th>
                                <th scope="col">Name</th>
                                <th scope="col">Stock</th>
                                <th scope="col">Brand</th>
                                <th scope="col">Category</th>
                                <th scope="col">Deleted Date</th>
                                <th colspan="2" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @forelse ($items as $oneItem)
                            <tr>
                                <td>{{ $oneItem->id }}</th>
                                <td><img src="{{ asset('itemImages/'.$oneItem->imagePath) }}" width="70" height="45" class="border border-dark zoom"></td>
                                <td>{{ $oneItem->name }}</td>
                                <td>{{ $oneItem->quantity }}</td>
                                <td>{{ $oneItem->brandName }}</td>
                                <td>
                                    @foreach ($oneItem->itemCategory as $category)
                                        <span class="badge bg-dark fw-light">{{ $category->category }}</span>
                                    @endforeach
                                </td>
                                <td>{{ $oneItem->deleted_at }}</td>
                                <td colspan="2">
                                    <a class="text-black text-decoration-none" href="{{ route('admin.restoreitems',$oneItem->id) }}">
                                        <i class="bi bi-arrow-counterclockwise actionIcon"></i>
                                    </a>
                                    <a id="deletebutton" href="javascript:void(0)" class="text-black text-decoration-none deletebutton"><i class="bi bi-trash actionIcon"></i></a>                                    </a>
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
    {{-- end table --}}


    {{-- pagination --}}
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="d-flex justify-content-center">
                    {{  $items->links();  }}
                </div>
            </div>
        </div>
    </div>
    {{--end pagination --}}
</main>

@endsection

@section('javascript')

<script> 
// delete items
    $(document).ready(function (){
        $('#itemTable').on('click','.deletebutton',function(){ 
            $tr = $(this).closest('tr');

            var data = $tr.children("td").map(function() {
                return $(this).text();
            }).get();
            $('#deleteTrashForm').attr('action', '/admin/items/trash/' + data[0]);
            $('#deleteModal').modal('show');
        });
    });
// delete items end
</script>
@endsection
