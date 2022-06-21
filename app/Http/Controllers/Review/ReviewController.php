<?php

namespace App\Http\Controllers\Review;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; 
use App\Models\Item;
use App\Models\Review;
use Illuminate\Database\QueryException;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reviews = Review::with('items')->paginate(10);

        return view('Review.reviewPage')->with('reviews', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
         $item = Item::find($id);
         
         return view('Review.reviewAdd')->with('item' ,$item);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'rating' => 'required',
                'comment' => 'required|max:250',
            ],[
                'rating.required' => 'At least one rating star must be selected.',
            ]);
    
    
            $review = new Review();
            $review->message = $request->comment;
            $review->rating = $request->rating;
            $review->item_id = $request->item_id;
            $review->user_id = $request->user_id;
            $save = $review->save();
    
            if($save){
                return redirect()->route('itemshow',$request->item_id.'#reviewSection')->with('success-add','Your review successfully added');
            }else{
                return redirect()->back();
            }

        }        
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $review = Review::with('items', 'users')->find($id);

        if(!$review){
            return abort(404);
        }
       return view('Review.reviewEdit')->with('review', $review);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try{
            $request->validate([
                'reply' => 'max:250'
            ]);
    
            $update = Review::where('id', $id)
            ->update([
                'reply_message' => $request->input('reply'),
            ]);
    
            if($update){
                return redirect()->back()->with('success-update','Reply successfully added.');
            }else{
                return redirect()->back();
            }

        }        
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $review = Review::find($id)->delete();

        return redirect()->back()->with('success-delete','Review delete successfully.');

    }

}
