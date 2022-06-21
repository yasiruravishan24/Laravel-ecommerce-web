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
    </div>
    <div class="container mt-3 mb-3">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive-md">
                    <table class="table adminTables text-wrap">
                        <thead class="table-dark tableHead">
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Product ID</th>
                                <th scope="col">Ratings</th>
                                <th scope="col">Reply Status</th>
                                <th scope="col">Date Added</th>
                                <th colspan="3" scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($reviews->sortByDesc('created_at') as $oneReview)
                                <tr>
                                    <td><a href="{{ route('itemshow',$oneReview->items->id) }}" target="_blank" class="text-decoration-none text-black">{{ $oneReview->items->name }}</a></th>
                                    <td><a href="{{ route('itemshow',$oneReview->items->id) }}" target="_blank" class="text-decoration-none text-black">{{ $oneReview->items->id  }}</a></td>
                                    <td>
                                        <div class="ratingStars d-inline">
                                            @for ($i = 0; $i < $oneReview->rating; $i++)
                                                <i class="bi bi-star-fill"></i>
                                            @endfor
                                            @for ($i = 0; $i < 5-$oneReview->rating; $i++)
                                                <i class="bi bi-star"></i>
                                            @endfor
                                        </div>
                                    </td>
                                    <td>
                                        @if($oneReview->reply_message == null)
                                            <span class="badge bg-secondary adminReview-badge-not rounded-0">Not Reply</span>
                                        @else
                                            <span class="badge bg-secondary adminReview-badge-com rounded-0">Replied</span>
                                        @endif
                                    </td>
                                    <td>{{ $oneReview->created_at}}</td>
                                    <td>
                                        <a href="{{ route('admin.editreviews',$oneReview->id) }}" class="text-black text-decoration-none">
                                            <i class="bi bi-reply-fill actionIcon me-2 fs-3"></i>
                                        </a>
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
                    {{  $reviews->links();  }}
                </div>
            </div>
        </div>
    </div>
    {{--end pagination --}}
</main>
    
@endsection