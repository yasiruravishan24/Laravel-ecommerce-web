<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Rate;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\App;

class AttributeController extends Controller
{
    public function index(){


        $sizes = Size::all();
        $brands = Brand::all();

        $rates = Rate::get();

        return view('Attribute.attribute')->with('sizes', $sizes)->with('brands', $brands)->with('rates', $rates);
    }
    
    public function addSize(Request $request){
        
        try{
            $request->validate([
                'size' => 'required|numeric|digits_between:1,2|unique:sizes,size'
            ],[
                'size.digits_between' => 'The size must not be greater than 3 characters'
            ]);

            $size = new Size();
            $size->size = $request->size;
            $save = $size->save();

            if($save ){
                return redirect()->route('admin.attributes')->with('successAddSize','Size add successfully.');
            }else{
                return redirect()->back()->with('fail-size', 'Something went wrong, failed to add size');
            }

        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    public function dropSize($id){
        Size::find($id)->delete();

        return redirect()->route( 'admin.attributes')->with('success-deleteSize','Size id '.$id.' delete successfully.');
    }

    public function addBrand(Request $request){
        
        try{
            $request->validate([
                'brand' => 'required|alpha|max:10|unique:brands,brand'
            ]);

            $brand = new Brand();
            $brand->brand = $request->brand;
            $save = $brand->save();

            if($save ){
                return redirect()->route('admin.attributes')->with('successAddBrand','Brand add successfully.');
            }else{
                return redirect()->back()->with('fail-brand', 'Something went wrong, failed to add brand');
            }

        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    public function dropBrand($id){
        Brand::find($id)->delete();

        return redirect()->route( 'admin.attributes')->with('success-deleteBrand','Brand id '.$id.' delete successfully.');

    }


    public function updateOthers(Request $request){
        
        try{
            $request->validate([
                'taxRate' => 'required|numeric',
                'discountRate' => 'required|numeric'
            ]);

            $update = Rate::where('rateName','Tax')
            ->update([
                'rate' => $request->taxRate
            ]);

            $update = Rate::where('rateName','Discount')
            ->update([
                'rate' => $request->discountRate
            ]);

            if($update){
                return redirect()->route('admin.attributes')->with('successUpdateOthers','Other details update successfully.');
            }else{
                return redirect()->back()->with('fail-others', 'Something went wrong, failed to update other details');
            }

        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }
}
