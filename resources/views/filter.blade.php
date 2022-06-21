@extends('layouts.app')

@section('title', 'FILTER - ')

@section('content')

  {{-- page path  --}}
  <div class="container" class="pagePath">
    <div class="row">
      <div class="col-lg-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead"> @if(request()->page  == 'M')MEN @elseif(request()->page  == 'W')WOMEN @elseif(request()->page  == 'K')KIDS @else STOCK CLEARANCE @endif <img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">FILTER</p>
        </div>
      </div>
    </div>
  </div>
  {{-- page path end --}}
  @php $page =  request()->page  @endphp

  @include('layouts.categoryPage')

@endsection