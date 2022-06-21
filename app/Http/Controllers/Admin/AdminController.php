<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Admin;
use App\Models\Item;
use App\Models\Order;
use App\Models\Deliver;
use App\Models\Review;
use App\Models\Invoice;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AdminLogin;


class AdminController extends Controller
{
    public function index(){

       
        // barnds
        $brandChart = [];

        $brand = DB::select(DB::raw("select count(*) as total_items,brandName from items group by brandName order by total_items"));
       
        foreach($brand as $row) {
            $brandChart['label'][] = $row->brandName;
            $brandChart['data'][] = (int)$row->total_items;
        }
        $brandChart['brand_chart_data'] = json_encode($brandChart);


        // sales
        $salseChart = [];

        $invoice = Invoice::select(

            DB::raw("SUM((total_bill-discountAmount)) as total"),

            DB::raw("MONTHNAME(created_at) as month_name")

        )->whereYear('created_at', date('Y'))->groupBy('month_name')->orderBy('created_at')->get();


        foreach($invoice as $row) {
            $salseChart['label'][] = substr($row->month_name,0,3);;
            $salseChart['data'][] = (int)$row->total;
        }

        $salseChart['sales_chart_data'] = json_encode($salseChart);



        // order and delivers

        // order 
        $ordersChart = [];

        $ordersCount = Order::select(

            DB::raw("count(*) as total_orders"),

            DB::raw("DATE(created_at) as date_name")

        )->whereMonth('created_at', date('m'))->groupBy('date_name')->orderBy('created_at')->get();

        foreach($ordersCount as $row) {
            $ordersChart['label'][] = $row->date_name;
            $ordersChart['data'][] = (int)$row->total_orders;
        }

        $ordersChart['orders_chart_data'] = json_encode($ordersChart);

        // delivers 
        $deliversChart = [];

        $deliverCount = Deliver::select(

            DB::raw("count(*) as total_delivers"),

            DB::raw("DATE(updated_at) as date_name")

        )->where('deliver_status' ,'=', 'C')->whereMonth('updated_at', date('m'))->groupBy('date_name')->orderBy('updated_at')->get();

           
        
        foreach($deliverCount as $row) {
            $deliversChart['label'][] = $row->date_name;
            $deliversChart['data'][] = (int)$row->total_delivers;
        }

        $deliversChart['delivers_chart_data'] = json_encode($deliversChart);


        $items = Item::count();
        $orders = Order::count();
        $delvers = Deliver::where('deliver_status', 'C')->count();
        $reviews = Review::count();

        return view('Admin.dashboard')->with([
            'items' => $items,
            'orders' =>  $orders,
            'delivers' => $delvers,
            'reviews' => $reviews,
            'brand_chart_data' => $brandChart,
            'sales_chart_data' => $salseChart,
            'orders_chart_data' => $ordersChart,
            'delivers_chart_data' => $deliversChart
        ]);
    }

    function check(Request $request){

        try{
            $request->validate([
                'email' => 'required|email|exists:admins,email',
                'password' => 'required|min:8|max:30'
            ],[
                'email.exists' => 'The email you entered dose not exist.'
            ]);
    
    
            $creds = $request->only('email','password');
            if(Auth::guard('admin')->attempt($creds)){
    
    
                $admin = Admin::select('logout_at')->first();
                $to = Carbon::createFromFormat('Y-m-d H:i:s', Carbon::now());
                $from = Carbon::createFromFormat('Y-m-d H:i:s', $admin->logout_at);

                $notificationData = [
                    'ip' =>  $request->ip(),
                    'time' => Carbon::now()->toDayDateTimeString()
                ];

                $admin = Admin::first();
                
                
                
                 if($to->diffInHours($from) >= 8){
                    Notification::send($admin, new AdminLogin($notificationData) );
                    
                    return redirect()->route('admin.dashboard')->with('howdy', 'Hello, howdy admin');
                 }
                 else{
                    return redirect()->route('admin.dashboard');
                 }
    
                
            }else{
                return redirect()->route('admin.login')->with('fail','The password you entered is incorrect.');
            }
    
        }        
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
        
    }
    function logout(Request $request){
        

        $update = Admin::where('id', Auth::guard('admin')->user()->id)
        ->update([
            'logout_at' => Carbon::now(),
        ]);
        
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }
}
