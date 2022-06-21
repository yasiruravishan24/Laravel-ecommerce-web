<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use App\Models\WishlistItem;
use App\Models\Category;
use App\Models\Size;
use App\Models\Item;
use App\Models\ItemSize;

class WishlistController extends Controller
{
    public function index(){
        $cate = Category::all();
        
        return view('User.myWishlist')->with('cate', $cate);
    }
    public function addToWishlist($item_id, $user_id){
        $wishlist_id = DB::table('wishlists')->where('user_id', $user_id)->first();

        $wishlist_item = new  Wishlistitem();
        $wishlist_item->item_id = $item_id;
        $wishlist_item->wishlist_id = $wishlist_id->id;
        $save = $wishlist_item->save();

        if($save){
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }


    }

    public function removeFromWishlist($item_id, $user_id){

        $wishlist_id = DB::table('wishlists')->where('user_id', $user_id)->first();

        $delete = DB::table('wishlist_items')->where([
            ['item_id', $item_id],
            ['wishlist_id', $wishlist_id->id]
        ])->delete();

        if($delete){
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }

    }
}
