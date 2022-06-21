<?php

namespace App\Http\Controllers\Item;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Item;
use App\Models\ItemCategory;
use App\Models\ItemSize;
use App\Models\Category;
use App\Models\Size;
use App\Models\Brand;
use Illuminate\Database\QueryException;


class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::paginate(10);

        return view('Item.itemPage')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=DB::table('items')->max('id');
        $next_id= $id + 1;
        $cate = Category::all();
        $size = Size::all();
        $brands = Brand::all();

        return view('Item.itemAdd')->with('next_id', $next_id)->with('cate', $cate)->with('size', $size)->with('brands', $brands);
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
                'skuNo' => 'required|max:10|unique:items,skuNo',
                'itemName' => 'required|max:20',
                'brand' => 'required',
                'price' => 'required|numeric|digits_between:0,5',
                'quantity' => 'required|numeric|digits_between:0,3',
                'category' => 'required',
                'size' => 'required',
                'description' => 'required|max:500',
                'imagePath' => 'required|mimes:jpg,png,jpeg|max:5048'
            ],[
                'brand.required' => 'Select item brand.',
                'category.required' => 'At least one category must be selected.',
                'size.required' => 'At least one size must be selected.',
                'skuNo.unique' => 'The SKU No  has already been taken.',
                'price.digits_between' => 'The quantity must not be greater than 5 characters.',
                'quantity.digits_between' => 'The quantity must not be greater than 3 characters.'
    
            ]);
    
            $newImageName = time() . '-' .$request->itemName . '.' . $request->itemID . '.'. $request->imagePath->extension();
    
            $request->imagePath->move(public_path('itemImages'),$newImageName);
    
    
            $item = new Item();
            $item->id = $request->itemId;
            $item->name = $request->itemName;
            $item->brandName = $request->brand;
            $item->skuNo = $request->skuNo;
            $item->price = $request->price;
            $item->quantity = $request->quantity;
            $item->description = $request->description;
            $item->imagePath = $newImageName;
            $save = $item->save();
    
    
            foreach($request->size as $oneSize){
                $itemSize = new ItemSize();
                $itemSize->item_id = $request->itemId;
                $itemSize->size = $oneSize;
                $itemSize->save(); 
            }
            
            foreach($request->category as $oneCate){
                $itemCategory = new ItemCategory();
                $itemCategory->item_id = $request->itemId;
                $itemCategory->category = $oneCate;
                $itemCategory->save(); 
            }
    
            
            if($save ){
                return redirect()->route('admin.items')->with('successAdditem','Item add successfully.');
            }else{
                return redirect()->back()->with('fail', 'Something went wrong, failed to add item');
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
        $item = Item::with('itemSizes', 'itemCategory', 'reviews', 'reviews.users')->find($id);


        if(!$item){
            return abort(404);
        }

        $cate = Category::all();
        $size = Size::all();
        $related = Item::where('brandName', $item->brandName)->whereNotIn('id', [$id])->inRandomOrder()->get();

        return view('Item.itemShow')->with('item', $item)->with('cate', $cate)->with('size', $size)->with('related', $related);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::with('itemSizes', 'itemCategory')->find($id);
        if(!$item){
            return abort(404);
        }
        $cate = Category::all();
        $size = Size::all();
        $brands = Brand::all();

        
        return view('Item.itemEdit')->with('item', $item)->with('cate', $cate)->with('size', $size)->with('brands', $brands);
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
            $validated = $request->validate([
                'skuNo' => 'required|max:10|unique:items,skuNo,' .$id,
                'itemName' => 'required|max:20',
                'brand' => 'required',
                'price' => 'required|numeric|digits_between:0,5',
                'quantity' => 'required|numeric|digits_between:0,3',
                'category' => 'required',
                'size' => 'required',
                'description' => 'required|max:500',
                'imagePath' => 'mimes:jpg,png,jpeg|max:5048'
            ],[
                'brand.required' => 'Select item brand.',
                'category.required' => 'At least one category must be selected.',
                'size.required' => 'At least one size must be selected.',
                'skuNo.unique' => 'The SKU No  has already been taken.',
                'price.digits_between' => 'The quantity must not be greater than 5 characters.',
                'quantity.digits_between' => 'The quantity must not be greater than 3 characters.'
                
            ]);
    
    
            $update = Item::where('id', $id)
                    ->update([
                        'name' => $request->input('itemName'),
                        'brandName' => $request->input('brand'),
                        'skuNo' => $request->input('skuNo'),
                        'price' => $request->input('price'),
                        'quantity' => $request->input('quantity'),
                        'description' => $request->input('description'),
                    ]);
    
    
            if($request->hasfile('imagePath')){
                $newImageName = time() . '-' .$request->itemName . '.' . $request->itemID . '.'. $request->imagePath->extension();
                $request->imagePath->move(public_path('itemImages'),$newImageName);
    
                DB::table('items')
                  ->where('id', $id)
                  ->update(['imagePath' => $newImageName]);
            }
    
            foreach($request->size as $oneSize){
    
                DB::table('item_sizes')
                    ->updateOrInsert(
                        [ 'size' => $oneSize, 'item_id' => $id]
                    );
            }
    
            foreach($request->category as $oneCate){
    
                DB::table('item_categories')
                ->updateOrInsert(
                    [ 'category' => $oneCate, 'item_id' => $id]
                );
            }
    
            // remove not selected sizes
            
            $oldItemSize = DB::table('item_sizes')->select('size','id')->where('item_id', $id)->get();
    
            foreach($oldItemSize as $oneOldItemSize){
    
                if(!in_array($oneOldItemSize->size, $request->size)){
                    
                    DB::table('item_sizes')->where('id', $oneOldItemSize->id)->delete();
                }
                
            }
    
            // remove not selected categorys
    
            $oldItemcate = DB::table('item_categories')->select('category','id')->where('item_id', $id)->get();
    
            foreach($oldItemcate as $oneOldItemCate){
    
                if(!in_array($oneOldItemCate->category, $request->category)){
                    
                    DB::table('item_categories')->where('id', $oneOldItemCate->id)->delete();
                }
                
            }
                
            if($update){
                return redirect()->route('admin.items')->with('successUpdate','Item id '.$id.' update successfully.');
            }else{
                return redirect()->back()->with('fail', 'Something went wrong, failed to update item');
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
        $item = Item::find($id)->delete();

        return redirect()->route('admin.items')->with('success-movetrash','Item id '.$id.' moved to the trash.');
    }

    public function trashPage()
    {
        $items =Item::onlyTrashed()->paginate(10);

        return view('Item.itemTrashPage')->with('items', $items);
    }

    public function restore($id){

        Item::withTrashed()->find($id)->restore();

        return redirect()->route( 'admin.itemstrash')->with('success-restore','Item id '.$id.' recovered from the trash.');
    }

    public function deleteTrash($id){

        Item::withTrashed()->find($id)->forceDelete();

        return redirect()->route( 'admin.itemstrash')->with('success-delete','Item id '.$id.' delete successfully.');
    }
}
