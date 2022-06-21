<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Invoice;
use App\Models\Item;
use App\Models\Order;
use App\Models\Deliver;
use App\Models\User;
use App\Models\Returns;
use PDF;
use Illuminate\Database\QueryException;

class ReportController extends Controller
{
    function genarateReport(Request $request){

        try{
            $request->validate([
                'report' => 'required',
                'fromDate' => 'required',
                'toDate' => 'required',
            ],[
                'fromDate.required' => 'The From date field is required',
                'toDate.required' => 'The To date field is required',
            ]);
    
            if($request->report == "SR"){

                $data = DB::table('items')
                ->join('order_item','items.id','=','order_item.item_id')
                ->join('orders','orders.id','=','order_item.order_id')
                ->selectRaw('items.*, COALESCE(sum(order_item.quantity),0) total')
                ->groupBy(DB::raw('items.id'))
                ->orderBy('total','desc')
                ->whereBetween('orders.created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])
                ->get();

                 if($data->isEmpty()){
                     return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
                 }
    
                return view('Report.reportViewSales')->with('data',  $data)->with('request', $request);
            }
            else if($request->report == "OR"){
                $data = Order::with('user','deliver','invoice')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

                if($data->isEmpty()){
                    return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
                }
    
                return view('Report.reportViewOrders')->with('data',  $data)->with('request', $request);
            }
            else if($request->report == "IR"){
                $data = Item::with('itemSizes')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

                if($data->isEmpty()){
                    return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
                }
    
                return view('Report.reportViewInventory')->with('data',  $data)->with('request', $request);
            }
            else if($request->report == "DR"){
                $data = Deliver::with('order','order.user','order.invoice')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

                if($data->isEmpty()){
                    return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
                }
    
                return view('Report.reportViewDelivery')->with('data',  $data)->with('request', $request);
            }
            else{
                $data = Returns::with('order','items')->whereBetween('created_at', [Carbon::parse($request->fromDate)->toDateTimeString(),Carbon::parse($request->toDate)->toDateTimeString()])->get();

                if($data->isEmpty()){
                    return redirect()->back()->with('report-empty', 'No data found. Please check FromDate and ToDate');
                }

                return view('Report.reportViewReturns')->with('data',  $data)->with('request', $request);
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }
    
    function printReport($report, $fromDate, $toDate){

        if($report == "SR"){

            $data = DB::table('items')
                ->join('order_item','items.id','=','order_item.item_id')
                ->join('orders','orders.id','=','order_item.order_id')
                ->selectRaw('items.*, COALESCE(sum(order_item.quantity),0) total')
                ->groupBy(DB::raw('items.id'))
                ->orderBy('total','desc')
                ->whereBetween('orders.created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])
                ->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];
    
            $pdf  = PDF::loadView('Report.sales', $reportData)->setPaper('A4');
            return $pdf->download('SalesReport.pdf');

        }
        else if($report == "OR"){
            $data = Order::with('user','deliver','invoice')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];
    
            $pdf  = PDF::loadView('Report.orders', $reportData)->setPaper('A4');
            return $pdf->download('OrdersReport.pdf');        
        }
        else if($report == "IR"){
            $data = Item::with('itemSizes')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];
    
            $pdf  = PDF::loadView('Report.inventory', $reportData)->setPaper('A4');
            return $pdf->download('InventoryReport.pdf');

        }
        else if(($report == "DR")){
            $data = Deliver::with('order','order.user','order.invoice')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];
    
            $pdf  = PDF::loadView('Report.deliver', $reportData)->setPaper('A4');
            return $pdf->download('DeliverStatusReport.pdf');
        }
        else{
            $data = Returns::with('order','items')->whereBetween('created_at', [Carbon::parse(str_replace("-", "/", $fromDate))->toDateTimeString(),Carbon::parse(str_replace("-", "/", $toDate))->toDateTimeString()])->get();

            $reportData = [
                'data' => $data,
                'fromDate' => $fromDate,
                'toDate' => $toDate
            ];
    
            $pdf  = PDF::loadView('Report.returns', $reportData)->setPaper('A4');
            return $pdf->download('ordersReturnReport.pdf');
        }

    }
}
