<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Http\Requests\ShippingRequest;
use App\Models\Commune;
use App\Models\Customer;
use App\Models\District;
use App\Models\Feeship;
use App\Models\Order;
use App\Models\Ordetail;
use App\Models\Payment;
use App\Models\Province;
use App\Models\Revenue;
use App\Models\Shipping;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CheckOutController extends Controller
{
    // Đăng Nhập - Đăng Ký - Đăng Xuất

    public function signIn(Request $request){
        $email = $request->your_email;
        $password = md5($request->your_pass);
        $signin = Customer::where('cus_email',$email)->where('cus_password',$password)->first();
        if($signin){
            Session::put('cus_id',$signin->cus_id);
            Session::put('cus_name',$signin->cus_name);
            Session::put('cus_pass',$signin->cus_password);
            return Redirect::to('/cart/show');
        }else{
            return Redirect::to('/checkout/logincheck');
        }
    }
    public function loginCheck(){
        return view('/shop/structure/loginshop');
    }

    public function signUp(CustomerRequest $request){
        $data=array();
        $data['cus_name'] = $request->name;
        $data['cus_email'] = $request->cus_email;
        $data['cus_password'] = md5($request->password);
        $data['cus_phone'] = $request->phone;
        
        $cus_id=Customer::insertGetId($data);
        Session::put('cus_id',$cus_id);
        Session::put('cus_name',$request->name);
        return Redirect::to('/checkout/logincheck');
    }
    public function logOut(){
        Session::flush();
        return Redirect::to('/checkout/logincheck');
    }

    public function Shipping(Request $request){     
        $data = Shipping::where('ship_id', $request->address)->first();
        Session::put('province',$data->province);
        Session::put('district',$data->district);
        Session::put('commune',$data->commune);  
        Session::put('ship_id', $request->address);
        $fee = Feeship::where('fee_province',Session::get('province'))->where('fee_district',Session::get('district'))->where('fee_commune',Session::get('commune'))->get();
        if($fee){
            $count = $fee->count();
            if($count>0){
                foreach($fee as $data){
                    Session::put('fee',$data->fee_payable);
                    Session::save();
                }
            }else{
                Session::put('fee',30000);
                Session::save();
            }        
        
        }
        $province = Province::where('province_id',Session::get('province'))->get();
        if($province){
            foreach ($province as $dt){
                Session::put('pro',$dt->province_name);
                Session::save();
            }

        }
        return Redirect::to('/cart/show');
    }
    public function cusInfo(ShippingRequest $request){
        $data=array();
        $data['ship_cus'] = Session::get('cus_id');
        $data['ship_name'] = $request->name;
        $data['ship_email'] = $request->email;
        $data['ship_phone'] = $request->phone;
        $data['province'] = $request->province;
        $data['district'] = $request->district;
        $data['commune'] = $request->commune;
        $data['ship_address'] = $request->address;
        $data['ship_note'] = $request->note;

        $ship_id=Shipping::insertGetId($data);      
        
                                 
        return redirect()->back();
    }
    public function Delivery(Request $request){
        $data = $request->all();
        if($data['chose']){
            $output = '';
            if($data['chose'] == 'province'){
                $district = District::where('province_code',$data['parent_id'])->orderBy('district_id','ASC')->get();
                $output.='<option value="0">Chọn quận/huyện/thị xã</option>';
                foreach($district as $val){
                    $output.='<option value="'.$val->district_id.'">'.$val->district_name.'</option>';
                }
            }else{
                $commune = Commune::where('district_code',$data['parent_id'])->orderBy('commune_id','ASC')->get();
                $output.='<option value="0">Chọn xã/phường/thị trấn</option>';
                foreach($commune as $val){
                    $output.='<option value="'.$val->commune_id.'">'.$val->commune_name.'</option>';
                }

            }
            
        }
        echo $output;
    }

    public function deleteFee(){
        Session::forget('fee');
        return redirect()->back();
    }
      // Thanh Toán

      public function checkOut(){
        $data['cart']= Cart::content();
        $data['total']= Cart::total(0);
        $data['ptotal']= Cart::priceTotal(0);
        $data['province']=Province::orderBy('province_id','ASC')->get();
        $data['delivery']= Shipping::deliveryAddress();
        $data['recent']= Shipping::recentAddress();
        return view('/shop/checkout',$data);
    }
    public function payMent(){  
        $data['cart']= Cart::content();
        $total = Session::get('fee');
        foreach(Cart::content() as $tt){
            $total += $tt->price * $tt->qty;
        }
        $data['ptotal']= Cart::priceTotal(0);   
        $data['total']= $total ;
        $data['province'] =Shipping::join('tbl_province', 'shippings.province', '=', 'tbl_province.province_id')
            ->where('shippings.province','=',Session::get('province'))   
            ->select('shippings.*','tbl_province.*')
            ->first();    
        Cart::setGlobalTax(0); 
        return view('/shop/payment',$data);
    }
     
    // Đặt Hàng
    public function order(Request $request){
        if($request->payment == NULL){
            return redirect()->back()->with('warn', 'Hãy chọn phương thức thanh toán để hoàn tất thanh toán!');
        }else{

            // Phương thức thanh toán
            $arr['pay_method'] = $request->payment;
            $total = 0;
            $arr['pay_status'] = 0;
            $payment_id=Payment::insertGetId($arr);
                

            // Đơn Hàng
            $data['order_cus'] =  Session::get('cus_id');
            $data['order_ship'] =  Session::get('ship_id');
            $data['order_pay'] = $payment_id;
            $data['order_fee'] =  Session::get('fee');
            $total = Session::get('fee');
            foreach(Cart::content() as $tt){
                $total += $tt->price * $tt->qty;
            }
            $data['order_total'] = $total;
            $data['order_date'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d');
            $data['order_status'] = '0';
            $rand_code = substr(md5(microtime()),rand(0,26),5);
            $data['order_code'] = $rand_code;
            $order_code = $data['order_code'];
            $order_id=Order::insertGetId($data);
            
            //Chi Tiết Đơn Hàng
            $content = Cart::content();
            foreach($content as $dt){
                $det['odl_order'] = $order_code;
                $det['odl_pro'] = $dt->id;
                $det['odl_proname'] = $dt->name;
                $det['odl_price'] = $dt->price;
                $det['odl_qty'] = $dt->qty;
                $det['odl_date'] = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d h:i:s');
                Ordetail::insertGetId($det);
            }


            //Mail xac nhan
            
            $now=Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y');
            $data['ship']= Shipping::find(Session::get('ship_id'));
            $email= $data['ship']->ship_email ;     
            $data['cart']=Cart::content();
            $data['total']=Cart::total(0);
            Mail::send('shop.mail',$data,function($message) use($email,$now){
                $message->from('luangreen014@gmail.com','Luan Nguyen');
                $message->to($email,$email);
                $message->cc('luangreen014@gmail.com','Luan Nguyen');
                $message->subject('Xác nhận hóa đơn mua hàng từ HeCare vào'.' '.$now);
            });
            Cart::destroy();
            Session::forget('success_payment_paypal');
            return redirect()->back();
        }
    }

}
