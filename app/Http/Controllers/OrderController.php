<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Order;
use App\Models\Ordetail;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Revenue;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OrderController extends Controller
{
    public function orderManage(){
        $adminname= Auth::guard('admin')->user(); 
        $data= Order::join('customers', 'orders.order_cus', '=', 'customers.cus_id')
        // ->join('ordetails', 'orders.order_id', '=', 'ordetails.odl_ord')
        ->select('orders.*','customers.*')
        ->orderBy('orders.order_date','desc')
        ->get();
        
        // $manageorder = view('admin.ordermanage')->with('data',$data);
        return view('admin.order.manage',[
            'data'=>$data,
            
             'user'=>$adminname
        ]);

    }
    public function orderStatus($id){
        $order = Order::select('order_status')->where('order_id',$id)->first();
        if($order->order_status == '0'){
            $status = '1' || $status = '2' ;
        }else{
            $status = '0';
        }
        $value =array('order_status'=> $status, 'order_staff'=>Session::get('staff_id'));
        Order::where('order_id',$id)->update($value);
        session()->flash('msg','Đã xem!');
        return redirect()->back();
    }

    public function orderDetail($order_code){
        $adminname= Auth::guard('admin')->user();
        $code = Order::where('order_code',$order_code)->get();
        $ship = Shipping::join('orders', 'orders.order_ship', '=', 'shippings.ship_id')  
            ->where('orders.order_code', '=',$order_code)                 
            ->select('orders.*','shippings.*')
            ->first();
        $data = Order::join('customers', 'orders.order_cus', '=', 'customers.cus_id')
            ->where('orders.order_code', '=',$order_code)  
            ->select('orders.*','customers.*')
            ->first();
        $pay = Order::join('payments', 'orders.order_pay', '=', 'payments.pay_id')
            ->where('orders.order_code', '=',$order_code)  
            ->select('orders.*','payments.*')
            ->first();
        $cart=Ordetail::join('orders', 'ordetails.odl_order', '=', 'orders.order_code')
            // ->rightJoin('products', 'orders.order_code', '=', 'ordetails.odl_order')
            ->where('orders.order_code', '=',$order_code)
            ->select('orders.*','ordetails.*')
            ->get();
        return view('admin.order.detail',[
            'data'=>$data,
            'cart'=>$cart,
            'ship'=>$ship,
            'user'=>$adminname,
            'code'=>$code,
            'pay'=>$pay
        ]);

    }
    public function updateStock(Request $request){

        // Thay đổi trạng thái đơn hàng
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['status'];
        $order->order_staff = Session::get('staff_id');
        $order->save();
        
        // Cập nhật doanh thu ngày
        $order_date = $order->order_date;
        $revenue = Revenue::where('rev_date',$order_date)->get();
        if($revenue){
            $rev_count = $revenue->count();
        }else{
            $rev_count = 0;
        }

        if($order->order_status == 1){

            $rev_order_total = 0;
            $rev_cost_price = 0;
            $rev_profit = 0;
            $rev_qty = 0;

            foreach($data['order_pro'] as $key => $total){
                $stock = Product::find($total);
                $product_qty = $stock->pro_qty;
                $product_sold = $stock->pro_sold;
                $product_sell = $stock->pro_sell;
                $product_price = $stock->pro_price;
                // $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

                foreach($data['qty'] as $key2 => $qty){
                    if($key == $key2){
                        $stock_update = $product_qty - $qty;
                        $stock->pro_qty = $stock_update;
                        $stock->pro_sold = $product_sold + $qty;
                        $stock->save();

                        // Cập nhật doanh thu
                        $rev_qty += $qty;
                        $rev_order_total+=1;
                        $rev_cost_price+=$product_sell*$qty;
                        $rev_profit = $rev_cost_price - $product_price*$qty;
                    }
                }
            }
            // Cập nhật bảng revenue
            if($rev_count>0){
                $rev = Revenue::where('rev_date',$order_date)->first();
                $rev->rev_cost_price = $rev->rev_cost_price + $rev_cost_price;
                $rev->rev_profit = $rev->rev_profit + $rev_profit;
                $rev->rev_order_total = $rev->rev_order_total + $rev_order_total;
                $rev->rev_qty = $rev->rev_qty + $rev_qty;
                $rev->save();
            }else{
                $rev_new = new Revenue();
                $rev_new->rev_order_total = $rev_order_total;                
                $rev_new->rev_cost_price = $rev_cost_price;
                $rev_new->rev_profit = $rev_profit;
                $rev_new->rev_date = $order_date;
                $rev_new->rev_qty =  $rev_qty;
                $rev_new->save();
            }

        }elseif($order->order_status != 1){
            
            $rev_order_total = 0;
            $rev_cost_price = 0;
            $rev_profit = 0;
            $rev_qty = 0;
            foreach($data['order_pro'] as $key => $total){
                $stock = Product::find($total);
                $product_qty = $stock->pro_qty;
                $product_sold = $stock->pro_sold;
                $product_sell = $stock->pro_sell;
                $product_price = $stock->pro_price;

                foreach($data['qty'] as $key2 => $qty){
                    if($key == $key2){
                        $stock_update = $product_qty + $qty;
                        $stock->pro_qty = $stock_update;
                        $stock->pro_sold = $product_sold - $qty;
                        $stock->save();

                        // Cập nhật doanh thu
                        $rev_qty += $qty;
                        $rev_order_total+=1;
                        $rev_cost_price+=$product_sell*$qty;
                        $rev_profit = $rev_cost_price - $product_price*$qty;
                    }
                }
            }
            // Cập nhật bảng revenue
                $rev = Revenue::where('rev_date',$order_date)->first();
                $rev->rev_cost_price = $rev->rev_cost_price - $rev_cost_price;
                $rev->rev_profit = $rev->rev_profit - $rev_profit;
                $rev->rev_order_total = $rev->rev_order_total - $rev_order_total;
                $rev->rev_qty = $rev->rev_qty - $rev_qty;
                $rev->save();
        }
    }
    public function orderDel($id){

        $data=Order:: join('ordetails', 'orders.order_code', '=', 'ordetails.odl_order')->where('orders.order_code', '=',$id);
        Order::where('order_code',$id)
                ->delete(); 
        Ordetail::where('odl_order',$id)
                ->delete();                   
        $data->delete();
        return redirect()->back();
    }
    public function manageCustomer(){
        $adminname= Auth::guard('admin')->user(); 
        $data=Customer::all();
        // $ordered=;
        return view('admin.customer.manage',[
            'data'=>$data,
             'user'=>$adminname,
            //  'ordered'=>$oredered
        ]);

    }
    public function delete($id){
        $del=Customer::find($id);
        $del->delete();
        return redirect()->back()->with('success','Tài Khoản Đã Được Xóa!');
    }


}
