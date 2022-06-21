<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Rate;

class InvoiceController extends Controller
{
    public function invoiceGenarate($id){
        $order = Order::with('deliver', 'invoice','items','user')->find($id);
        $rate = Rate::get();

        if(!$order){
            return abort(404);
        }

        return view('Order.invoice')->with('order', $order)->with('rate', $rate);

    }
}
