<?php

namespace App\Http\Controllers;

use App\Http\Requests\CustomerRequest;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Comment;
use App\Models\Customer;
use App\Models\Product;
use App\Models\Gallery;
use App\Models\Order;
use App\Models\Ordetail;
use App\Models\Rating;
use App\Models\Shipping;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ShopController extends Controller
{
    public function index(){
        
        return view("shop.homepage");
    }
    public function showCate($id){
        $data['catename']=Category::find($id);
        // $data['items'] = Product::where('pro_cate',$id)->orderBy('id','desc')->paginate(3);
        return view("shop.showCate",$data);
    }

    public function shopping(Request $request){
        
        if($request->ajax() && isset($request->start)){
            $start = $request->start;
            $end = $request->end;
            $data['product']= Product::where('pro_sell','>=',$start)->where('pro_sell','<=',$end)->orderBy('pro_id','desc')->paginate(6);
            response()->json($data['product']);
            return view("shop.filter",$data);
            
        }else if($request->ajax() && isset($request->brand)){
            $brand = $request->brand;
            $data['product']= Product::whereIn('pro_brand',explode(',',$brand))->orderBy('pro_id','desc')->paginate(6);
            response()->json($data['product']);
            return view("shop.filter",$data);

 
       }else{
            $data['product']= Product::orderBy('pro_id','desc')->paginate(6);
            // $data['product']= Product::inRandomOrder()->limit(3)->get();
            $data['brand']=Brand::all();
            return view("shop.shop",$data);
       }
    }

    public function detail($id){
        $data['item']= Product::find($id);
        // dd($data['item']);
        $cat_id= $data['item']->pro_cate;
        $data['related']=Product::where('pro_cate',$cat_id)->where('pro_id', '!=', $data['item']->pro_id)->get();
        $data['near']= Gallery::where('gl_product',$id)->get();
        $data['comment']= Comment::where('comment_pro', $id)->count('comment_id');
        $data['star']= Rating::where('rating_pro',$id)->avg('rating_vote');
        return view("shop.detail",$data);
    }

    public function category($id){
        $data['cat']=Category::find($id);
        $data['product'] = Product::where('pro_cate',$id)->orderBy('pro_id','desc')->paginate(6);
        $data['brand']=Brand::all();
        return view("shop.shop",$data);
    }
    public function discount(){
        $data['discountTitle'] = "Sản Phẩm Đang Giảm Giá";
        $data['product'] = Product::orderBy('pro_discount', 'DESC')
        ->where('pro_discount', '>', 0)
        ->paginate(9);
        $data['brand']=Brand::all(); 
        return view("shop.shop",$data);
    }
    public function selling(){
        $data['product']= Product::orderBy('pro_sold','desc')->paginate(9);
        $data['brand']=Brand::all(); 
        return view("shop.shop",$data);
    }

    public function search(Request $request){
        $data['product']=Product::where('pro_name','like','%'.$request->key.'%')
                    ->orWhere('pro_sell','like','%'.$request->key.'%')
                    ->paginate(6);
        $data['count']=Product::where('pro_name','like','%'.$request->key.'%')
                    ->orWhere('pro_sell','like','%'.$request->key.'%')
                    ->get();
        $data['brand']=Brand::all();
        return view("shop.shop",$data);
    }

    public function comment(Request $request){
        $pro_id = $request->pro_id;
        $comment = Comment::where('comment_pro',$pro_id)->get();
        $count= Comment::where('comment_pro', $pro_id)->count('comment_id');
        $show = '';
        $show .= '<h4 class="mb-4">'.$count.' đánh giá</h4>';
        foreach($comment as $val){
            $show .= '
            
            <div class="media mb-4">
               
                <img src="'.url('/shop/img/user.png').'" alt="Image" class="img-fluid mr-3 mt-1" style="width: 45px;">
                <div class="media-body">
                    <h6>'.$val->Customer->cus_name.'<small> - <i>'.$val->comment_date.'</i></small></h6>
                    <p>'.$val->comment_content.'</p>
                </div>
            </div>
        ';
        }
        echo $show;
    }
    public function getComment(Request $request){
        $pro_id = $request->pro_id;
        $cmt_content = $request->cmt_content; 
        $cmt_name = $request->cmt_name;
        $cmt = new Comment();
        $cmt->comment_content = $cmt_content;
        $cmt->comment_user = $cmt_name;
        $cmt->comment_pro = $pro_id;
        $cmt->comment_date = Carbon::now('Asia/Ho_Chi_Minh')->format('d/m/Y h:i:s');;
        $cmt->save();
        
    }
    public function getRating(Request $request){
        $revote = Rating::where($request->only('rating_cus','rating_pro'))->first();
        if($revote){
            Rating::where($request->only('rating_cus','rating_pro'))
            ->update($request->only('rating_vote'));
        }else{
            Rating::create($request->only('rating_cus','rating_pro','rating_vote'));
           
        } 
        return redirect()->back();       
    }
    public function history(){
        $data['history']=Order::where('order_cus',Session::get('cus_id'))->orderBy('order_id','DESC')->get();
        $data['brand']=Brand::all();
        return view('shop.customer.history',$data);
    }
    public function historyView($id){
        $data['brand']=Brand::all();
        $data['ship'] = Shipping::join('orders', 'shippings.ship_id','=','orders.order_ship' )
            ->where('orders.order_code', '=',$id)                 
            ->select('orders.*','shippings.*')
            ->first();
        $data['pay'] = Order::join('payments', 'orders.order_pay', '=', 'payments.pay_id')
            ->select('orders.*','payments.*')
            ->where('orders.order_code', '=',$id)  
            ->first();
        $data['cart']=Ordetail::join('orders', 'ordetails.odl_order', '=', 'orders.order_code')
            ->where('orders.order_code', '=',$id)
            ->select('orders.*','ordetails.*')
            ->get();
        return view('shop.customer.history_view',$data);
    }
    public function profile(){
        $data['cus'] = Customer::where('cus_id',Session::get('cus_id'))->first();
        $data['ship'] = Shipping::where('ship_id',Session::get('ship_id'))->first();
        return view('shop.customer.profile',$data);
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
        $cus = Customer::where('cus_id',Session::get('cus_id'))->first();
        $current_pass=md5($request->current_password);
        // dd($current_pass);
        if($cus->cus_password == $current_pass){
            $cus->update([
                'cus_password'=>md5($request->new_password)
            ]);
            return redirect()->route('shop.shopping');
        }else{
            return redirect()->back();
        }
        
    }
}
