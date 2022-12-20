<?php

namespace App\Http\Controllers;

use App\Http\Requests\StaffRequest;
use App\Models\Admin;
use App\Models\Article;
use App\Models\Contact;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Product;
use App\Models\Revenue;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    public function loginPost(Request $request){
        $credentials = $request->only('email', 'password');
        if (Auth::guard('admin')->attempt($credentials)) {
            Session::put('staff_id',Auth::guard('admin')->user()->id);
            return redirect()->route('admin.homepage');
     
        }else{
            return redirect('admin/loginad');
        }
       
    }
    public function homepage(){
        $data['user']= Auth::guard('admin')->user();
        $data['product']= Product::all();
        $data['news']= Article::all();
        $data['customers']= Customer::all();
        $data['delivered']= Order::where('order_status','1')->count();
        $data['sold'] = Product::sum('pro_sold');
        $data['profit'] = Revenue::sum('rev_profit');
        $data['total_money'] = Revenue::sum('rev_cost_price');
        $data['total_cost_price'] = $data['total_money'] - $data['profit'];
        $data['cont']=Contact::all();
        $data['data'] =Order::join('customers', 'orders.order_cus', '=', 'customers.cus_id')    
            ->select('orders.*','customers.*')
            ->orderBy('order_id','desc')->take(4)->get();
        $data['lot']=Product::orderBy('pro_sold','DESC')->take(7)->get();
        return view('admin.homepage',$data);
    }
    public function logout(){
        Auth::guard('admin')->logout();
        return redirect('admin/loginad');
    }
    public function createStaff(){
        $data['user']= Auth::guard('admin')->user();
        return view('admin.staff.create',$data);
    }
    public function storeStaff(StaffRequest $request){
        $staff = new Admin();
        $staff->name= $request->staff_name; 
        $staff->email= $request->email;
        $staff->phone= $request->staff_phone; 
        $staff->password = md5($request->staff_pass);
        $staff->role = 2;                                  
        $staff->save();
        return redirect()->back()->with('success','Đã Tạo Thành Công');
    }
    public function manageStaff(){
        $adminname= Auth::guard('admin')->user(); 
        $data=Admin::all();
        return view('admin.staff.manage',[
            'data'=>$data,
             'user'=>$adminname
        ]);

    }
    public function profile(){
        return view('admin.staff.profile');

    }
    public function changePass(Request $request){
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|confirmed|min:8|string'
        ], [
            'required' => 'Trường bắt buộc phải nhập',
            'min' => 'Trường bắt buộc phải nhập ít nhất :min kí tự',
            'confirmed' => 'Mật Khẩu không khớp, kiểm tra lại',
        ]);
       
        $auth = Auth::guard('admin')->user();
        $staff = Admin::find($auth->id);
        $current_pass=md5($request->current_password);
        if($staff->password == $current_pass){
            $staff->update([
                'password'=>md5($request->new_password)
            ]);
            return redirect()->route('admin.homepage')->with('success','Mật Khẩu Đã Thay Đổi!');;
        }else{
            return redirect()->back();
        }
        
    }
    public function roleChange($id){
        $role = Admin::select('role')->where('id',$id)->first();
        if($role->role == '1'){
            $status = '2' ;
        }else{
            $status = '1';
        }
        $value =array('role'=> $status);
        Admin::where('id',$id)->update($value);
        session()->flash('msg','Đã xem!');
        return redirect()->back();
    }
    public function delete($id){
        $del=Admin::find($id);
        $del->delete();
        return redirect()->back()->with('success','Tài Khoản Đã Được Xóa!');
    }

    public function filterRevenue(Request $request){
        $data = $request->all();
        $from = $data['fromdate'];
        $to = $data['todate'];
        $filter = Revenue::whereBetween('rev_date',[$from,$to])->orderBy('rev_date','ASC')->get();
        
        foreach($filter as $key => $val){
            $chart_data[] = array(
                'date' => $val->rev_date,
                'order' => $val->rev_order_total,
                'price' => $val->rev_cost_price,
                'profit' => $val->rev_profit,
                'quantity'=> $val->rev_qty
            );         
        }
        echo $data = json_encode($chart_data);

    }
    public function filterTime(Request $request){
        $data = $request->all();
        $thangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->toDateString();
        $thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->toDateString();
        $cuoithangtruoc =Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->toDateString();
        $sub3thang = Carbon::now('Asia/Ho_Chi_Minh')->subMonth(3)->toDateString();
    
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subDays(7)->toDateString();
        $subyear = Carbon::now('Asia/Ho_Chi_Minh')->subDays(365)->toDateString();
    
        $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();

        if($data['time'] =='7ngay'){
            $filter = Revenue::whereBetween('rev_date',[$sub7days,$now])->orderBy('rev_date','ASC')->get();
        }elseif($data['time'] =='thangtruoc'){
            $filter = Revenue::whereBetween('rev_date',[$thangtruoc,$cuoithangtruoc])->orderBy('rev_date','ASC')->get();
        }elseif($data['time'] =='thangnay'){
            $filter = Revenue::whereBetween('rev_date',[$thangnay,$now])->orderBy('rev_date','ASC')->get();
        }elseif($data['time'] =='3thang'){
            $filter = Revenue::whereBetween('rev_date',[$sub3thang,$now])->orderBy('rev_date','ASC')->get();
        }else{
            $filter = Revenue::whereBetween('rev_date',[$subyear,$now])->orderBy('rev_date','ASC')->get();
        }

        foreach($filter as $key => $val){
            $chart_data[] = array(
                'date' => $val->rev_date,
                'order' => $val->rev_order_total,
                'price' => $val->rev_cost_price,
                'profit' => $val->rev_profit,
                'quantity'=> $val->rev_qty
            );         
        }
        echo $data = json_encode($chart_data);
    }   
}
