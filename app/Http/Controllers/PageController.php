<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Carbon;
use App\Models\Item;
use App\Models\Brand;
use App\Models\Size;

class PageController extends Controller
{
    private $brand,$size,$maxPrice,$minPrice;

    function __construct(){
        $this->brand = Brand::all();
        $this->size = Size::all();
        $this->maxPrice = DB::table('items')->max('price');
        $this->minPrice = DB::table('items')->min('price'); 
    }
    function index(){
        $items = Item::with('itemCategory')->get();

        return view('index')->with('items', $items);
    }
    function menPage(){

        $item = DB::table('items')
            ->join('item_categories','item_categories.item_id',  '=','items.id')
            ->where('item_categories.category', 'M')->paginate(9);


        return view('menPage')
            ->with('brand', $this->brand)
            ->with('size', $this->size)
            ->with('maxPrice', $this->maxPrice)
            ->with('minPrice', $this->minPrice)
            ->with('item', $item);
    }
    function womenPage(){
        $item = DB::table('items')
        ->join('item_categories','item_categories.item_id',  '=','items.id')
        ->where('item_categories.category', 'W')->paginate(9);
        
        return view('womenPage')
            ->with('brand', $this->brand)
            ->with('size', $this->size)
            ->with('maxPrice', $this->maxPrice)
            ->with('minPrice', $this->minPrice)
            ->with('item', $item);
    }
    function clearancePage(){
        $item = DB::table('items')
        ->join('item_categories','item_categories.item_id',  '=','items.id')
        ->where('item_categories.category', 'C')->paginate(9);
          
        return view('clearancePage')
            ->with('brand', $this->brand)
            ->with('size', $this->size)
            ->with('maxPrice', $this->maxPrice)
            ->with('minPrice', $this->minPrice)
            ->with('item', $item);
    }
    function kidsPage(){
        $item = DB::table('items')
        ->join('item_categories','item_categories.item_id',  '=','items.id')
        ->where('item_categories.category', 'K')->paginate(9);

        return view('kidsPage')
            ->with('brand', $this->brand)
            ->with('size', $this->size)
            ->with('maxPrice', $this->maxPrice)
            ->with('minPrice', $this->minPrice)
            ->with('item', $item);
    }
}
