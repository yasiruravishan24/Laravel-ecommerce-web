@extends('layouts.appAdmin')

@section('title', 'ATTRIBUTES - ')

@section('content')

<div class="modal fade" id="sizeForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Size</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.addSize') }}" method="POST" class="row g-3" >
                @csrf
                <div class="col-12">
                    <label for="validationCustom02" class="form-label att-label">Size</label>
                    <input name="size" type="number" class="form-control att-input rounded-0" min="1">
                </div>
                <div class="col-12">
                    <button class="btn att-model-add-btn rounded-0 ps-3 pe-3" type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

<div class="modal fade" id="brandForm" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog ">
    <div class="modal-content">
        <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Add New Brand</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form method="POST" action="{{ route('admin.addBrand') }}" class="row g-3">
                @csrf
                <div class="col-md-12">
                <label for="validationCustom02" class="form-label att-label">Brand Name</label>
                <input name="brand" type="text" class="form-control att-input rounded-0">
                </div>
                <div class="col-12">
                    <button class="btn att-update-btn rounded-0 ps-3 pe-3" type="submit">ADD</button>
                </div>
            </form>
        </div>
    </div>
    </div>
</div>

{{-- delete confirmation --}}
<div class="modal fade" id="deleteSizeModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete Size</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <strong class="deleteMessage">Are you sure that you want to permanently delete the selected size?</strong> 
            <form  method="POST" id="deleteSizeForm" class="mt-3"> 
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

<div class="modal fade" id="deleteBrandModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete Brand</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
                <strong class="deleteMessage">Are you sure that you want to permanently delete the selected brand?</strong> 
            <form  method="POST" id="deleteBrandForm" class="mt-3"> 
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

<!-- main -->
<main class="mt-5 pt-3">
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    Attributes
                </h2>
            </div>
        </div>
        <div class="row">
            @if ($errors->has('size'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="loginError"> {{ $errors->first('size') }}<span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::get('successAddSize'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('successAddSize') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('fail-size'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('fail-size') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if ($errors->has('brand'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="loginError"> {{ $errors->first('brand') }}<span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::get('successAddBrand'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('successAddBrand') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('fail-brand'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('fail-brand') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if ($errors->has('taxRate'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="loginError"> {{ $errors->first('taxRate') }}<span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if ($errors->has('discountRate'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="loginError"> {{ $errors->first('discountRate') }}<span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if (Session::get('exception-error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="loginError"> {{ Session::get('exception-error') }}<span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if (Session::get('successUpdateOthers'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('successUpdateOthers') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('fail-others'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ Session::get('fail-others') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif

            @if (Session::get('success-deleteSize'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success-deleteSize') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                </div>
            </div>
            @endif

            @if (Session::get('success-deleteBrand'))
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ Session::get('success-deleteBrand') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>  
                </div>
            </div>
            @endif
        </div>
    </div>
    <div class="container mt-1 mb-3">
        <div class="row">
            <div class="col-md-12">

                <div class="bd-example">
                    <nav>
                        <div class="nav nav-tabs mb-3" id="nav-tab" role="tablist">
                            <button class="nav-link active att-btn" id="nav-home-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-home" type="button" role="tab" aria-controls="nav-home"
                                aria-selected="true">Sizes</button>
                            <button class="nav-link att-btn" id="nav-profile-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-profile" type="button" role="tab" aria-controls="nav-profile"
                                aria-selected="false">Brands</button>
                            <button class="nav-link att-btn" id="nav-contact-tab" data-bs-toggle="tab"
                                data-bs-target="#nav-contact" type="button" role="tab" aria-controls="nav-contact"
                                aria-selected="false">Others</button>
                        </div>
                    </nav>
                    <div class="tab-content" id="nav-tabContent">
                        <div class="tab-pane fade show active" id="nav-home">
                            <div class="row mb-3">
                                <div class="col-md-3 buttonBreacks">
                                    <button class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 att-OptionBtn" data-bs-toggle="modal" data-bs-target="#sizeForm">ADD NEW</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive-md">
                                        <table class="table att-Tables text-wrap" id="sizeTable">
                                            <thead class="table-dark tableHead">
                                                <tr>
                                                    <th scope="col">Size Id</th>
                                                    <th scope="col">Size</th>
                                                    <th scope="col">Created at</th>
                                                    <th colspan="1" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($sizes as $oneSizeitem)
                                                    <tr>
                                                        <td>{{ $oneSizeitem->id }}</th>
                                                        <td>{{ $oneSizeitem->size }}</td>
                                                        <td>{{ $oneSizeitem->created_at }}</td>
                                                        <td colspan="1">
                                                            <a id="deleteSizebutton" href="javascript:void(0)" class="text-black text-decoration-none deleteSizebutton"><i class="bi bi-trash actionIcon"></i></a>  
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

                        <div class="tab-pane fade" id="nav-profile">
                            <div class="row mb-3">
                                <div class="col-md-3 buttonBreacks">
                                    <button class="btn btn btn-dark  btn-md rounded-0 ps-4 pe-4 adminOptionBtn" data-bs-toggle="modal" data-bs-target="#brandForm">ADD NEW</button>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <div class="table-responsive-md">
                                        <table class="table adminTables text-wrap" id="brandTable">
                                            <thead class="table-dark tableHead">
                                                <tr>
                                                    <th scope="col">Brand Id</th>
                                                    <th scope="col">Brand Name</th>
                                                    <th scope="col">Created at</th>
                                                    <th colspan="2" scope="col">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @forelse ($brands as $oneCategoriesitem)
                                                    <tr>
                                                        <td>{{ $oneCategoriesitem->id }}</th>
                                                        <td>{{ $oneCategoriesitem->brand }}</td>
                                                        <td>{{ $oneCategoriesitem->created_at }}</td>
                                                        <td colspan="1">
                                                            <a id="deleteBrandbutton" href="javascript:void(0)" class="text-black text-decoration-none deleteBrandbutton"><i class="bi bi-trash actionIcon"></i></a>  
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

                        <div class="tab-pane fade" id="nav-contact">
                            <form action="{{ route('admin.updateOthers') }}" method="POST" class="row g-3" id="others-form">
                                @csrf
                                <div class="col-md-6">
                                    <label for="validationCustom01" class="form-label att-label">Tax Rate %</label>
                                    <input name="taxRate" type="number" class="form-control rounded-0 att-input"  value="{{ $rates[0]->rate }}">
                                    </div>
                                <div class="col-md-6">
                                    <label for="validationCustom02" class="form-label att-label">Discount Rate %</label>
                                    <input name="discountRate" type="number" class="form-control rounded-0 att-input"  value="{{ $rates[1]->rate  }}">
                                </div>
                                <div class="col-12 mt-3">
                                    <button class="btn rounded-0 att-update-btn" type="submit" id="others-update-btn" disabled>UPDATE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@section('javascript')
<script>
    $(document).ready(function() {
    $('#others-form').on('input change', function() {
      $('#others-update-btn').attr('disabled', false);
    });
  })


    // delete items
    $(document).ready(function (){
            $('#sizeTable').on('click','.deleteSizebutton',function(){ 
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#deleteSizeForm').attr('action', '/admin/attributes/size/' + data[0]);
                $('#deleteSizeModal').modal('show');
            });
        });
    // delete items end

    // delete items
    $(document).ready(function (){
            $('#brandTable').on('click','.deleteBrandbutton',function(){ 
                $tr = $(this).closest('tr');

                var data = $tr.children("td").map(function() {
                    return $(this).text();
                }).get();
                $('#deleteBrandForm').attr('action', '/admin/attributes/brand/' + data[0]);
                $('#deleteBrandModal').modal('show');
            });
        });
    // delete items end

    $("#sizeTable").simplePagination({

        // the number of rows to show per page
        perPage: 8,

        // CSS classes to custom the pagination
        containerClass: '',
        previousButtonClass: 'btn btn-primary border-0',
        nextButtonClass: 'btn btn-primary border-0',

        // text for next and prev buttons
        previousButtonText: 'Previous',
        nextButtonText: 'Next',

        // initial page
        currentPage: 1
    });

    $("#brandTable").simplePagination({

        // the number of rows to show per page
        perPage: 8,

        // CSS classes to custom the pagination
        containerClass: '',
        previousButtonClass: 'btn btn-primary border-0',
        nextButtonClass: 'btn btn-primary border-0',

        // text for next and prev buttons
        previousButtonText: 'Previous',
        nextButtonText: 'Next',

        // initial page
        currentPage: 1
    });

</script>
@endsection