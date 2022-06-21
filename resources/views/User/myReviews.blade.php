@extends('layouts.app')

@section('title', 'MY REVIEWS - ')

@section('content')
   {{-- page path  --}}
   <div class="container" class="pagePath">
    <div class="row">
      <div class="col-mb-12">
        <div class="pagePathText">
          <p class="currentPage"><a class="pathHomeLink" href="/">HOME</a><img src="{{ asset('img/rigthArrow.png') }}"
              class="pathArrowHead">MY REVIEWS</p>
        </div>
      </div>
    </div>
  </div>
  {{--  page path end --}}

  
    {{-- delete confirmation --}}
    <div class="modal fade" id="reviewDeleteModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog">
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title deleteTitle" id="staticBackdropLabel">Delete review</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
                  <strong class="deleteMessage">Are you sure that you want to delete this review?</strong> 
              <form  method="POST" id="reviewdeleteForm" class="mt-3"> 
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

  <div class="d-flex" id="wrapper">
    <!-- Sidebar -->
    @include('layouts.myaccount-slidebar')
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper" class="mb-5">
      <div class="d-flex align-items-center ms-5 mt-5 my-account-heading">
        <i class="bi bi-text-left me-4" id="menu-toggle"></i>
        <h2 class="m-0">My reviews</h2>
      </div>

      <div class="container-fluid px-5 mt-4 profile-container">
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

        <div class="table-responsive-md ">
          <table id="reviewTableMain" class="table reviewTables text-wrap" >
            <tbody>
              @forelse(Auth::user()->reviews as $oneUserReview)
                <tr>
                  <td class="d-none">{{ $oneUserReview->id }}</td>
                  <td class="tb-image-column" >
                    <a href="/items/{{ $oneUserReview->items->id }}" class="text-decoration-none">
                      <img class="border  td-image" src="{{ asset('itemImages/'.$oneUserReview->items->imagePath ) }}">
                    </a>
                  </th>
                  <td class="td-content">
                  <a href="/items/{{$oneUserReview->items->id}}" class="text-decoration-none"><h5>{{ $oneUserReview->items->name }}</h5></a>
                    <div class="d-inline mb-2">
                        @for ($i = 0; $i < $oneUserReview->rating; $i++)
                          <i class="bi bi-star-fill"></i>
                        @endfor
                        @for ($i = 0; $i < 5-$oneUserReview->rating; $i++)
                            <i class="bi bi-star"></i>
                        @endfor
                    </div>
                    <p class="reviewmessage">{{ $oneUserReview->message }}</p>

                      @if ($oneUserReview->reply_message)
                        <div class="reviewItemName proItemReviewContent">
                          <h5 class="reviewProName">Reply</h5>
                          <div class="reviewBody mt-2">
                            <p class="reviewmessage">{{ $oneUserReview->reply_message }}</p>
                          </div>
                        </div>
                      @endif
                  </td>
                  <td class="td-option">
                    <a id="moveReviewTrashbutton" class="text-black text-decoration-none reviewDropIcon moveReviewTrashbutton" ><i class="bi bi-x-circle-fill reviewDropIcon"></i></a>
                  </td>
                </tr>
              @empty  
                <div class="container">
                  <div class="row">
                  <div class="col-md-12 text-center mt-5 mb-5">
                      <h4 class="NorelatedProductHeading">No reviews</h4>
                  </div>
                  </div>
                </div>  
                @endforelse
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
  
@endsection

@section('javascript')
    <script>
        // wrapper
        var el = document.getElementById("wrapper");
        var toggleButton = document.getElementById("menu-toggle");

        toggleButton.onclick = function () {
        el.classList.toggle("toggled");
        };
        // wrapper

        // delete review
        $(document).ready(function (){
          $('#reviewTableMain').on('click','.moveReviewTrashbutton',function(){ 
              $tr = $(this).closest('tr');
              var data = $tr.children("td").map(function() {
                  return $(this).text();
              }).get();


              $('#reviewdeleteForm').attr('action', '/user/reviews/' + data[0]);
              $('#reviewDeleteModal').modal('show');
          });
        });
        // delete review end

        $("#reviewTableMain").simplePagination({

          // the number of rows to show per page
          perPage: 3,

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
