<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\CartItem;
use App\Models\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;

class CartController extends Controller
{
    public function index(){

        $rates = Rate::get();

        return view('User.cart')->with('rates', $rates);
    }
    public function addToCart(Request $request){

        try{
            $request->validate([
                'size' => 'required',
                'quantity' => 'required|numeric'
            ]);
    
            $cart_id = DB::table('carts')->where('user_id', $request->user_id)->first();
    
            $cart = DB::table('cart_item')->where([
                ['cart_id', $cart_id->id],
                ['item_id', $request->item_id],
                ['size', $request->size]
            ])->first();
    
            if($cart){
    
                if(($cart->quantity + $request->quantity) <= $request->item_quantity){
                    $update = CartItem::where('id', $cart->id)
                    ->update([
                        'quantity' => $cart->quantity + $request->input('quantity')
                    ]);
    
                    return redirect()->route('user.cart')->with('cartAddSuccess', $request->item_name.' has been added to your cart');
                }
                else{
                    return redirect()->route('user.cart')->with('stockError', 'You cannot add that amount to the cart — we have '.$request->item_quantity.' in stock and you already have '.$cart->quantity.' in your cart');
                }

            }else{
                $cartItem = new CartItem();
                $cartItem->cart_id = $cart_id->id;
                $cartItem->item_id = $request->item_id;
                $cartItem->quantity = $request->quantity;
                $cartItem->size = $request->size;
                $save = $cartItem->save();
    
                return redirect()->route('user.cart')->with('cartAddSuccess', $request->item_name.' has been added to your cart');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }
    public function removeFromCart($id){
        
        $delete = CartItem::find($id)->delete();

        if($delete){
            return redirect()->back()->with('cartRemoveSuccess', 'Item Remove successfully');
        }
        else{
            return redirect()->back();
        }
        
    }
    public function updateCart(Request $request){

        try{
            for($c = 0; $c < count($request->cart_item_id); $c++ ){

                $update = CartItem::where('id',$request->cart_item_id[$c])
                    ->update(
                        [ 'quantity' => $request->quantity[$c]]
                    );
            }
            
            return redirect()->back()->with('cartUpdateSuccess',' Cart update successfully');
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
        
    }
}
