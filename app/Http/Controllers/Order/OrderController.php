<?php

namespace App\Http\Controllers\Order;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth; 
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Deliver;
use App\Models\Item;
use App\Models\Rate;
use App\Models\InvoiceItem;
use Illuminate\Database\QueryException;


class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::with('deliver', 'invoice')->paginate(10);

        return  view('Order.orderPage')->with('orders', $orders);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // try{
            $nextInvoiceId=DB::table('invoices')->max('id') + 1;
            $nextOrderId=DB::table('orders')->max('id') + 1;

            
            $cartItems = DB::table('cart_item')->where('cart_id',Auth::user()->cart->id)->get();


            $order = new Order();
            $order->id = $nextOrderId;
            $order->payment_method = $request->paymentMethod;
            $order->user_id = Auth::user()->id;
            $order->save();

            foreach ($cartItems as  $oneCartItem) {
                $orderItem = new OrderItem();
                $orderItem->order_id = $nextOrderId;
                $orderItem->item_id = $oneCartItem->item_id;
                $orderItem->quantity = $oneCartItem->quantity;
                $orderItem->size = $oneCartItem->size;
                $orderItem->save();
            }



            foreach ($cartItems as  $oneCartItem) {

                $item =  Item::find($oneCartItem->item_id);

                $newQuantity =  $item->quantity - $oneCartItem->quantity;

                $update = Item::where('id', $oneCartItem->item_id)
                ->update([
                    'quantity' => $newQuantity
                ]);
            }

            $invoice = new Invoice();
            $invoice->id = $nextInvoiceId;
            $invoice->order_id = $nextOrderId;
            $invoice->total_bill = (int)ceil($request->subTotal);
            $invoice->discountAmount = (int)ceil($request->discount);
            if($request->paymentMethod == "C"){
                $invoice->payment_status = "P";
            }else{
                $invoice->payment_status = "N";
            }
            $invoice->taxAmount = (int)ceil($request->tax);
            $invoice->save();



            foreach ($cartItems as  $oneCartItem) {
                $invoiceItem = new InvoiceItem();
                $invoiceItem->invoice_id = $nextInvoiceId;
                $invoiceItem->item_id = $oneCartItem->item_id;
                $invoiceItem->quantity = $oneCartItem->quantity;
                $invoiceItem->size = $oneCartItem->size;
                $invoiceItem->save();
            }

            $deliver = new Deliver();
            $deliver->order_id = $nextOrderId;
            if($request->paymentMethod == "C"){
                $deliver->settlement_status = 'NR';
            }else{
                $deliver->settlement_status = 'R';
            }
            $deliver->deliver_status = 'P';
            $deliver->save();


            $delete = DB::table('cart_item')->where('cart_id', Auth::user()->cart->id)->delete();

            if($delete){
                return redirect()->route('user.myorders')->with('order-conform','Your order id is #'.$nextOrderId);
            }else{
                return redirect()->back();
            }
        // }
        // catch(QueryException $ex){
        //     return redirect()->back()->with('exception-error','An error occurred, please try again later');
        // }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::with('deliver', 'invoice','items','user')->find($id);

        if(!$order){
            return abort(404);
        }
        
        return view('Order.orderView')->with('order', $order);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
                'bankReciptNo' => 'nullable|max:20|unique:invoices,bank_receipt,' .$request->invoiceNo,
            ],[
                'bankReciptNo.unique' => 'The Bank Receipt No  has already been taken.' 
            ]);
    
            $update = Order::where('id', $id)
            ->update([
                'payment_method' => $request->input('payment_method'),
            ]);
    
            $update = Invoice::where('order_id', $id)
            ->update([
                'payment_status' => $request->input('payemnt_status'),
                'bank_receipt' => $request->input('bankReciptNo'),
            ]);
    
            if($update){
                return redirect()->back()->with('success-update','Order update successfully.');
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
        $order = Order::with('items')->find($id);

        foreach ($order->items as  $oneOrderItem) {

            $item =  Item::find($oneOrderItem->id);

            $newQuantity =  $item->quantity + $oneOrderItem->pivot->quantity;

            $update = Item::where('id', $oneOrderItem->id)
            ->update([
                'quantity' => $newQuantity
            ]);
        }

        

        return redirect()->back()->with('success-delete','Order delete successfully.');
    }

    public function myOrderView($id){

        $checkOrder = DB::table('orders')->where([
            ['id' , $id],
            ['user_id' , Auth::user()->id]
        ])->first();

        if($checkOrder){
            $order = Order::with('deliver','invoice','items')->find($id);
        
            return view('User.myOrderView')->with('order', $order);
        }
        else{
            return abort(404);
        }

    }
    

    public function checkoutPage(){

        $rates = Rate::get();

        return view('Order.checkout')->with('rates', $rates);
    }
}

