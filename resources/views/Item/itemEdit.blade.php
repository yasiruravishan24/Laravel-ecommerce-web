@extends('layouts.appAdmin')

@section('title', 'EDIT ITEM - ')

@section('content')
<main class="mt-5 pt-3">
    {{-- heading --}}
    <div class="container mb-4">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    EDIT ITEM
                </h2>
            </div>
        </div>
        <div class="row">         
            @if (Session::get('exception-error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <span class="loginError"> {{ Session::get('exception-error') }}<span>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif
        </div>
    </div>
    {{-- heading end --}}
    
    {{-- input form --}}
    <div class="container mb-5">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-10">
                <form action="/admin/items/{{ $item->id }}" method="POST" class="row g-3" enctype="multipart/form-data" autocomplete="off">
                    @if (Session::get('fail'))
                    <div class="alert alert-danger">
                        {{ Session::get('fail') }}
                    </div>
                    @endif
                    @csrf
                    <div class="col-md-6">
                        <label for="itemId" class="form-label productAddLable">Item Id</label>
                        <input name="itemId" type="number" class="form-control rounded-0 addIteminput" readonly value="{{ $item->id  }}">
                    </div>
                    <div class="col-md-6">
                        <label for="skuNo" class="form-label productAddLable">SKU No</label>
                        <input name="skuNo" type="text" class="form-control rounded-0 addIteminput @error('skuNo') is-invalid @enderror " placeholder="Enter Item SKU No"  value="{{ old('skuNo', $item->skuNo) }}">
                        <span class="text-danger">@error('skuNo'){{ $message }}@enderror</span>
                    </div>

                    <div class="col-12">
                        <label for="itemName" class="form-label productAddLable">Item Name</label>
                        <input name="itemName" type="text" class="form-control rounded-0 addIteminput @error('itemName') is-invalid @enderror" placeholder="Enter Item Name" value="{{ old('itemName', $item->name ) }}">
                        <span class="text-danger">@error('itemName'){{ $message }}@enderror</span>
                    </div>

                    <div class="col-6">
                        <label for="brand" class="form-label productAddLable">Brand</label>
                        <select name="brand" id="brand" class="form-select  rounded-0 addIteminput @error('brand') is-invalid @enderror" >
                            <option value="" selected disabled>Select Brand</option>
                            @foreach ($brands as $oneBrandItem)
                                <option value="{{ $oneBrandItem->brand }}"{{old('brand',$item->brandName) == $oneBrandItem->brand  ? 'selected' : ''}}>
                                    {{ $oneBrandItem->brand }}
                                </option>  
                            @endforeach
                        </select>
                        <span class="text-danger">@error('brand'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-3">
                        <label for="price" class="form-label productAddLable">Price</label>
                        <input name="price" type="text" class="form-control rounded-0 addIteminput @error('price') is-invalid @enderror " placeholder="Enter Item price" value="{{ old('price', $item->price) }}">
                        <span class="text-danger">@error('price'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-3">
                        <label for="quantity" class="form-label productAddLable">Quantity</label>
                        <input name="quantity" type="text" class="form-control rounded-0 addIteminput @error('quantity') is-invalid @enderror " placeholder="Enter Item Quantity" value="{{ old('quantity', $item->quantity) }}">
                        <span class="text-danger">@error('quantity'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-12">
                        <label for="category" class="form-label productAddLable">Category</label>
                        <div class="bd-example ">
                            <div class="accordion  rounded-0 addIteminput @error('category') invalidcollapes @enderror" id="accordionExample">
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingThree">
                                        <button class="accordion-button  rounded-0  collapsed form-control @error('category') is-invalid @enderror" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThree"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Select Category
                                        </button>
                                    </h4>
                                    <div id="collapseThree" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">

                                        <div class="accordion-body ms-4">
                                            <div class="row">
                                                @foreach ($cate as $cateitem)
                                                <div class="col-md-6">
                                                    <div class=" ms-3 mb-3 form-check">
                                                        <input name="category[]" type="checkbox" class="form-check-input @error('category') is-invalid invalidCheck @enderror"  value="{{ $cateitem->categoryValue }}" 
                                                        @if (is_array($category = old('category'))) 
                                                            @foreach ($category as $one)
                                                                {{ $one ==  $cateitem->categoryValue  ? 'checked' : ' '; }}
                                                            @endforeach 
                                                        @else
                                                            @foreach ($item->itemCategory  as $one)
                                                                {{ $one->category == $cateitem->categoryValue ? 'checked' : ' '; }}
                                                            @endforeach
                                                        @endif>
                                                        <label class="form-check-label productAddLable" for="{{ $cateitem->categoryName }}">{{ $cateitem->categoryName }}</label>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">@error('category'){{ $message }}@enderror</span>
                    </div>

                    <div class="col-12">
                        <label for="category" class="form-label productAddLable">Size</label>
                        <div class="bd-example">
                            <div class="accordion  rounded-0 addIteminput @error('size') invalidcollapes @enderror" id="accordionExample">
                                <div class="accordion-item">
                                    <h4 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed form-control @error('size') is-invalid @enderror rounded-0 " type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseThreee"
                                            aria-expanded="false" aria-controls="collapseThree">
                                            Select Size
                                        </button>
                                    </h4>
                                    <div id="collapseThreee" class="accordion-collapse collapse"
                                        aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                        <div class="accordion-body ms-4">
                                            <div class="row">
                                                @foreach ($size as $sizeitem)
                                                    <div class="col-md-4">
                                                        <div class=" ms-2 mb-3 form-check">
                                                            <input name="size[]" type="checkbox" class="form-check-input @error('size') is-invalid invalidCheck @enderror" value="{{ $sizeitem->size }}"
                                                            @if (is_array($size = old('size')))
                                                                @foreach ($size as $one)
                                                                    {{ $one == $sizeitem->size ? 'checked' : ''; }}
                                                                @endforeach
                                                            @else
                                                                @foreach ($item->itemSizes as $one)
                                                                    {{ $one->size == $sizeitem->size ? 'checked' : ''; }}
                                                                @endforeach
                                                            @endif>
                                                            <label class class="form-check-label productAddLable"  for="{{ $sizeitem->size }}">{{ $sizeitem->size }}</label>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <span class="text-danger">@error('size'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label productAddLable">Description</label>
                        <textarea name="description" class="form-control rounded-0 addIteminput productTextArea @error('description') is-invalid @enderror" placeholder="Enter Item Description">{{ old('description',$item->description)}}</textarea>
                        <span class="text-danger">@error('description'){{ $message }}@enderror</span>
                    </div>

                    <div class="col-12">
                        <label for="imagePath" class="form-label productAddLable">Image</label>
                        <div class="text-start" id="preview">
                            <img src="{{ asset('itemImages/'.$item->imagePath) }}" class=" border border-dark img-fluid" width="400" height="200">
                        </div>
                    </div>

                    <div class="col-12  mb-3">
                        <input name="imagePath" class="form-control rounded-0 addIteminput @error('imagePath') is-invalid @enderror" type="file" onchange="getImagePreview(event)" >
                        <span class="text-danger">@error('imagePath'){{ $message }}@enderror</span>
                    </div>
                    <div class="col-6 d-grid">
                        <button type="submit" class="btn btn-dark btn-lg rounded-0 itemPublishBtn">UPDATE</button>
                    </div>
                </form>

            </div>

        </div>
    </div>
   
</main>

    
@endsection

@section('javascript')
<script>
    function getImagePreview(event)
    {
    var image=URL.createObjectURL(event.target.files[0]);
    var imagediv= document.getElementById('preview');
    var newimg=document.createElement('img');
    imagediv.innerHTML='';
    newimg.src=image;
    newimg.width="400";
    newimg.height="200";
    newimg.className = "border border-dark img-fluid";
    imagediv.appendChild(newimg);
    }

</script>

@endsection

