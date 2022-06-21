<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 


class checkoutBlock
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $checkout = DB::table('cart_item')->where('cart_id', Auth::user()->cart->id)->first();

        if($checkout){

            foreach(Auth::user()->cart->items as $oneItem){
                $item = DB::table('items')->where('id', $oneItem->id)->first();

                if($item->quantity <= 0){
                    return redirect()->route('user.cart')->with('cartEmpty', ' Not enough stock in '.$item->name.'.');
                }

            }
            return $next($request);
        }


        return redirect()->route('user.cart')->with('cartEmpty', 'Checkout is not available whilst your cart is empty');

    }
}
