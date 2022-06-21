<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\Size;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;


class SearchController extends Controller
{
    public function search(Request $request){
        $inputSearch = $request['search'];
        
            $result = DB::table('items')
            ->where('name' , 'LIKE', '%'.$inputSearch.'%')
            ->Orwhere('brandName', 'LIKE','%'.$inputSearch.'%')
            ->Orwhere('price', 'LIKE','%'.$inputSearch.'%')
            ->get();


            echo $result;

    }
    public function filter(){

        $brand = Brand::all();
        $size = Size::all();
        $maxPrice = DB::table('items')->max('price');
        $minPrice = DB::table('items')->min('price'); 
        
        if(!empty(request('brand'))){
            $item = DB::table('items')
            ->join('item_categories','item_categories.item_id',  '=','items.id')
            ->join('item_sizes','item_sizes.item_id',  '=','items.id')
            ->where('item_categories.category', request('page'))
            ->where('item_sizes.size', request('size'))
            ->whereIn('brandName', request('brand'))
            ->whereBetween('price', [request('minPrice'), request('price')])->paginate(9);
        }
        else{
            $item = DB::table('items')
            ->join('item_categories','item_categories.item_id',  '=','items.id')
            ->join('item_sizes','item_sizes.item_id',  '=','items.id')
            ->where('item_categories.category',request('page'))
            ->where('item_sizes.size', request('size'))
            ->whereBetween('price', [request('minPrice'), request('price')])->paginate(9);
        }


        return view('filter')
            ->with('brand', $brand)
            ->with('size', $size)
            ->with('maxPrice', $maxPrice)
            ->with('minPrice', $minPrice)
            ->with('item', $item)
            ->with('request', request());
    }
}
