@extends('layouts.app')

@section('title', 'WOMEN - ')
    
@section('content')
  {{-- page path  --}}
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-lg-6">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}""
              class="pathArrowHead">WOMEN</p>
        </div>
      </div>
    </div>
  </div>
  {{-- page path end --}}
  @php $page = 'W' @endphp
  @include('layouts.categoryPage')
  
@endsection