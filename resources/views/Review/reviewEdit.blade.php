@extends('layouts.appAdmin')

@section('title', 'REVIEWS - ')

@section('content')
<main class="mt-5 pt-3">
    <div class="container mb-1">
        <div class="row">
            <div class="col-md-12">
                <h2 class="adminHeading">
                    REVIEWS
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
    <div class="container mb-3">
        <div class="row">
            @if (Session::get('success-update'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ Session::get('success-update') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-12">
                <form action="{{ route('admin.updatereviews',$review->id) }}" method="POST" autocomplete="off">
                    @csrf
                    <table class="table table-borderless reviewViewTables">
                        <thead>
                            <tr>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><b>Reviewed Item Name</b></th>
                                <td class="reviewViewTable-data">{{ $review->items->name }}</td>
                            </tr>
                            <tr>
                                <td><b>Reviewed Item ID</b></th>
                                <td class="reviewViewTable-data">{{ $review->items->id  }}</td>
                            </tr>
                            <tr>
                                <td><b>Added Date</b></td>
                                <td class="reviewViewTable-data">{{ $review->created_at  }}</td>
                            </tr>
                            <tr>
                                <td><b>Reply Status</b></td>
                                <td>
                                    @if($review->reply_message == null)
                                        <span class="badge bg-secondary adminReview-badge-not rounded-0">Not Reply</span>
                                    @else
                                        <span class="badge bg-secondary adminReview-badge-com rounded-0">Replied</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Customer Name</b></td>
                                <td class="reviewViewTable-data">{{ $review->users->firstName.' '.$review->users->lastName }}</td>
                            </tr>
                            <tr>
                                <td><b>Customer Email</b></td>
                                <td class="reviewViewTable-data">{{ $review->users->email }}</td>
                            </tr>
                            <tr>
                                <td><b>Rating</b></td>
                                <td class="reviewViewTable-data">
                                    <div class="d-inline mb-2 reviewStar">
                                        @for ($i = 0; $i < $review->rating; $i++)
                                            <i class="bi bi-star-fill"></i>
                                        @endfor
                                        @for ($i = 0; $i < 5-$review->rating; $i++)
                                            <i class="bi bi-star"></i>
                                        @endfor
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Review Message</b></td>
                                <td class="reviewViewTable-data-message">{{ $review->message }}</td>
                            </tr>
                            <tr>
                                <td class="@error('reply') is-invalid @enderror"><b>Reply</b></th>
                                <td class="adminOrderViewTable-data">
                                    <textarea name="reply"  class="form-control rounded-0 adminReviewReply @error('reply') adminReviewReply-invalid @enderror">{{ old('reply', $review->reply_message )}}</textarea>
                                </td>
                               
                            </tr>
                            <tr>
                                <td></td>
                                <td><span class="text-danger">@error('reply'){{ $message }}@enderror</span></td>
                            </tr>
                            <tr>
                                <td></td>
                                <td>
                                    <button class="btn btn-primary rounded-0 adminOrder-view-btn pe-4 ps-4">ADD REPLY</button>
                                </td>
                            </tr>

                        </tbody>
                    </table>
                </form>
            </div>

        </div>
    </div>

</main>
    
@endsection