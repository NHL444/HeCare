<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Product;
use App\Models\Warehouse;
use App\Models\Warehousedetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WarehouseController extends Controller
{
    public function index(){
        $adminname= Auth::guard('admin')->user(); 
        $product =Product::all();
        $staff =Admin::all();
        return view('admin.receipt.create',[
            'product'=>$product,
             'user'=>$adminname,
             'staff' =>$staff
        ]);

    }
    public function createReceipt(Request $request){
        $receipt = new Warehouse();
        $rand_code = substr(md5(microtime()),rand(0,26),5);
        $receipt->wr_code = $rand_code; 
        $receipt->wr_total = 0;
        $receipt->wr_staff = $request->staff;
        $receipt->wr_provider = $request->provider;
        $receipt->wr_date = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
        $receipt->wr_status = 0;
        $receipt->save();
        // $receipt_id=Shipping::insertGetId($data);
        Session::put('wr_code',$rand_code);
        return redirect()->back()->with('success','Đã Tạo Phiếu Mới!');;

    }
    public function update(Request $request){
        if(Session::get('wr_code')){
        for($i=0;$i< count($request->group_a);$i++){
            $data = [
                'wrd_code' => Session::get('wr_code'),
                'wrd_product' =>$request->group_a[$i]['pro_name'],
                'wrd_qty' =>$request->group_a[$i]['qty'],
                'price' =>$request->group_a[$i]['price'],
            ];
            // dd($data);
            DB::table('warehouse_receipt_detail')->insert($data);
        };
    
            return redirect()->back()->with('success','Nội Dung Phiếu Mới Đã Được Cập Nhật!');
        }
        return redirect()->back()->with('error','Chưa tạo mã phiếu mới! Kiểm tra lại!');;

    }
    public function manage(){
        $adminname= Auth::guard('admin')->user(); 
        $receipt =Warehouse::all();
        // $staff =Admin::all();
        return view('admin.receipt.manage',[
            'receipt'=>$receipt,
             'user'=>$adminname,
            //  'staff' =>$staff
        ]);
    }
    public function detail($id){
        $adminname= Auth::guard('admin')->user(); 
        // $receipt =Warehouse::find($id);
        $receipt =Warehouse::where('wr_code',$id)->first();
        $staff = Warehouse::join('admins', 'warehouse_receipt.wr_staff', '=', 'admins.id')
            ->where('warehouse_receipt.wr_code', '=',$id)  
            ->select('warehouse_receipt.*','admins.*')
            ->first();
        $detail=Warehousedetail::join('warehouse_receipt', 'warehouse_receipt_detail.wrd_code', '=', 'warehouse_receipt.wr_code')
            ->where('warehouse_receipt.wr_code', '=',$id)
            ->select('warehouse_receipt.*','warehouse_receipt_detail.*')
            ->get();

        return view('admin.receipt.detail',[
            'receipt'=>$receipt,
             'user'=>$adminname,
             'staff' =>$staff,
             'detail'=>$detail
        ]);
    }
    public function status(Request $request,$id){
        $data= $request->all();
        $receipt = Warehouse::find($id);
        $receipt->wr_status = 1;
        $receipt->wr_total = $data['total'];
        $receipt->save();
        foreach($data['product'] as $key => $total){
            $stock = Product::find($total);
                $product_qty = $stock->pro_qty;
                foreach($data['qty'] as $key2 => $qty){
                    if($key == $key2){
                        $stock_update = $product_qty + $qty;
                        $stock->pro_qty = $stock_update;
                        $stock->save();
                    }
                    foreach($data['price'] as $key3 => $price){
                        if($key == $key3){
                            $stock->pro_price = $price;
                            $profit = $stock->pro_profit;
                            $stock->pro_sell = $price + ($price*$profit/100);
                            $stock->save();
                        }
                    }
                }
        }
        return redirect()->back()->with('success','Hàng Hóa Đã Được Thêm Vào Kho Thành Công!');
    }
    public function delete($id){
        $del=Warehouse::find($id);
        $del->delete();
        return redirect()->back()->with('success','Phiếu Nhập Hàng Đã Được Xóa!');
    }

}
