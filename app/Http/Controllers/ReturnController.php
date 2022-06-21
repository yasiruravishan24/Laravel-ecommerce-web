<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\OrderItem;
use App\Models\Order;
use App\Models\Invoice;
use App\Models\Deliver;
use App\Models\Item;
use App\Models\Rate;
use App\Models\Returns;
use App\Models\ReturnsItem;
use App\Models\InvoiceItem;
use Illuminate\Database\QueryException;

class ReturnController extends Controller
{
    public function returnItem($id){

        $orderItem = OrderItem::find($id);

        $item = Item::with('itemSizes')->find($orderItem->item_id);

        return view('Order.orderReturnShow')->with('orderItem', $orderItem)->with('item' ,$item);
    }
    public function returnItemUpdate(Request $request){

        try{

            $request->validate([
                'exchangeQuantity' => 'required|numeric',
            ]);

            $item = Item::find($request->itemId);

            if($request->exchangeQuantity <= $item->quantity && $item->quantity != 0 ){
                $update = Item::where('id', $item->id)
                ->update([
                    'quantity' => $item->quantity - $request->exchangeQuantity
                ]);

                //return update
                $order = Order::with('deliver')->find($request->orderId);
                $nextReturnId=DB::table('returns')->max('id') + 1;

                $returns = new Returns();
                $returns->id = $nextReturnId;
                $returns->order_id = $request->orderId;
                $returns->reason = "Damaged Item";
                $returns->returned_date = $order->deliver->updated_at;
                $returns->save();

                $returnItem = new ReturnsItem();
                $returnItem->returns_id = $nextReturnId;
                $returnItem->item_id = $request->itemId;
                $returnItem->quantity = $request->exchangeQuantity;
                $returnItem->size = $request->orderedSize;
                $returnItem->save();

                if($update){
                    return redirect()->route('admin.ordershow',$request->orderId)->with('success-order-item-update','Order details update successfully');
                }else{
                    return redirect()->back()->with('cant-update','Cant update order.please try again later.');;
                }
    
            }else{
                return redirect()->back()->with('stock-problem','Not enough stock in that item.');
            }
            
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }


    }
    public function returnItemSizeUpdate(Request $request){


        try{
            $request->validate([
                'sizeExchange' => 'required',
                'sizeExchangeQuantity' =>  'required|numeric'
            ],[
                'sizeExchange.required' => 'Select size',
                'sizeExchangeQuantity.required' => 'Enter quantity'
            ]);
    
            $item = Item::find($request->itemId);
    
            if($request->sizeExchangeQuantity <= $item->quantity && $item->quantity != 0 ){
                if($request->orderedQuantity == $request->sizeExchangeQuantity){

                    $order_items_check = DB::table('order_item')->where([
                        ['order_id', $request->orderId],
                        ['item_id', $request->itemId],
                        ['size', $request->sizeExchange]
                    ])->first();


                    $invoice = Invoice::where('order_id',$request->orderId)->first();


                    $invoice_items_check = DB::table('invoice_item')->where([
                        ['invoice_id', $invoice->id],
                        ['item_id', $request->itemId],
                        ['size', $request->sizeExchange]
                    ])->first();

                   

                    $invoice_items_pervious = DB::table('invoice_item')->where([
                        ['invoice_id', $invoice->id],
                        ['item_id', $request->itemId],
                        ['size', $request->orderedSize]
                    ])->first();

                   

                    if($order_items_check){

                        $update = OrderItem::where('id', $order_items_check->id)
                        ->update([
                            'quantity' => $order_items_check->quantity + $request->input('sizeExchangeQuantity')
                        ]);

                        $delete = OrderItem::find($request->orderItemsId)->delete();

                        $updateInvoice = InvoiceItem::where('id', $invoice_items_check->id)
                        ->update([
                            'quantity' => $invoice_items_check->quantity + $request->input('sizeExchangeQuantity')
                        ]);

                        $deleteInvoice = InvoiceItem::find($invoice_items_pervious->id)->delete();

                    }else{

                        $update = OrderItem::where('id', $request->orderItemsId)
                        ->update([
                            'size' =>  $request->sizeExchange
                        ]);

                        
                        $updateinvoice = InvoiceItem::where('id', $invoice_items_pervious->id)
                        ->update([
                            'size' =>  $request->sizeExchange
                        ]);
                    }
    
                    $order = Order::with('deliver')->find($request->orderId);
                    $nextReturnId=DB::table('returns')->max('id') + 1;

                    $returns = new Returns();
                    $returns->id = $nextReturnId;
                    $returns->order_id = $request->orderId;
                    $returns->reason = "Size Change";
                    $returns->returned_date = $order->deliver->updated_at;
                    $returns->save();

                    $returnItem = new ReturnsItem();
                    $returnItem->returns_id = $nextReturnId;
                    $returnItem->item_id = $request->itemId;
                    $returnItem->quantity = $request->sizeExchangeQuantity;
                    $returnItem->size = $request->orderedSize;
                    $returnItem->save();

        
                    if($update){
                        return redirect()->route('admin.ordershow',$request->orderId)->with('success-order-item-update','Order details update successfully');
                    }else{
                        return redirect()->back()->with('cant-update','Cant update order.please try again later.');;
                    }
        
                }else{

                    $orderItem = OrderItem::find($request->orderItemsId);
            
                    $update = OrderItem::where('id', $request->orderItemsId)
                    ->update([
                        'quantity' => $orderItem->quantity-$request->sizeExchangeQuantity
                    ]);
    
                    $orderItem = new OrderItem();
                    $orderItem->order_id = $request->orderId;
                    $orderItem->item_id = $request->itemId;
                    $orderItem->quantity = $request->sizeExchangeQuantity;
                    $orderItem->size = $request->sizeExchange;
                    $save = $orderItem->save();

                    $invoice = Invoice::where('order_id',$request->orderId)->first();

                    $invoice_items_pervious = DB::table('invoice_item')->where([
                        ['invoice_id', $invoice->id],
                        ['item_id', $request->itemId],
                        ['size', $request->orderedSize]
                    ])->first();
            
                    $updateInvoive = InvoiceItem::where('id', $invoice_items_pervious->id)
                    ->update([
                        'quantity' => $invoice_items_pervious->quantity-$request->sizeExchangeQuantity
                    ]);

                    
                    $invoiceItem = new InvoiceItem();
                    $invoiceItem->invoice_id = $request->orderId;
                    $invoiceItem->item_id = $request->itemId;
                    $invoiceItem->quantity = $request->sizeExchangeQuantity;
                    $invoiceItem->size = $request->sizeExchange;
                    $save = $invoiceItem->save();


                    //return update
                    $order = Order::with('deliver')->find($request->orderId);
                    $nextReturnId=DB::table('returns')->max('id') + 1;

                    $returns = new Returns();
                    $returns->id = $nextReturnId;
                    $returns->order_id = $request->orderId;
                    $returns->reason = "Size Change";
                    $returns->returned_date = $order->deliver->updated_at;
                    $returns->save();

                    $returnItem = new ReturnsItem();
                    $returnItem->returns_id = $nextReturnId;
                    $returnItem->item_id = $request->itemId;
                    $returnItem->quantity = $request->sizeExchangeQuantity;
                    $returnItem->size = $request->orderedSize;
                    $returnItem->save();
    
                    if($save){
                        return redirect()->route('admin.ordershow',$request->orderId)->with('success-order-item-update','Order details update successfully');
                    }else{
                        return redirect()->back()->with('cant-update','Cant update order.please try again later.');;
                    }
                }
            }else{
                return redirect()->back()->with('stock-problem','Not enough stock in that item.');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }
}
