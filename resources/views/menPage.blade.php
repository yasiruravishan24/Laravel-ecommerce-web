@extends('layouts.app')

@section('title', 'MEN - ')

@section('content')

  {{-- page path  --}}
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-lg-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"class="pathArrowHead">MEN</p>
        </div>
        
      </div>
    </div>
  </div>
  {{-- page path end --}}
  @php $page = 'M' @endphp
  @include('layouts.categoryPage')

@endsection
