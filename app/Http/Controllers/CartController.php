<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addCart($id){
        $product = Product::find($id);      
        $data['id'] = $product->pro_id;
        $data['name']= $product->pro_name;
        $data['qty']= 1;
        $data['weight']= $product->pro_price;
        $data['price']= $product->pro_sell;
        $data['options']['img']=$product->pro_image;
        Cart::add($data);
        return redirect()->back()->with('success','Đã Thêm Vào Giỏ Hàng!');
    }
    public function addfromDetail(Request $request){
        $product = Product::find($request->pro_id);  
        if ($product->pro_qty >= $request->quantity){

            if ($request->quantity >= 1){
                $data['id'] = $product->pro_id;
                $data['name']= $product->pro_name;
                $data['qty']= $request->quantity;
                $data['weight']= $product->pro_price;
                $data['price']= $product->pro_sell;
                $data['options']['img']=$product->pro_image;
                Cart::add($data);
                return redirect()->back()->with('success','Đã Thêm Vào Giỏ Hàng!');
            } else{
            return redirect()->back()
                ->with('warn', "Số Lượng Phải Lớn Hơn 0");
            }
        }else {
            return redirect()->back()
                ->with('warn', "Số lượng trong kho không đủ! Quý khách thông cảm!");
        }

    }
    public function popup(){
        $data['cart']= Cart::content();
        $data['total']= Cart::total(0);
        $data['ptotal']= Cart::priceTotal(0);
        Cart::setGlobalTax(0);
        return view('shop.cart',$data);
    }
    public function showCart(){
        $data['cart']= Cart::content();
        $total = Session::get('fee');

        foreach(Cart::content() as $tt){
            $total += $tt->price * $tt->qty;
        }
        $data['total']= $total;
        $data['ptotal']= Cart::priceTotal(0);
        Cart::setGlobalTax(0);
        return view('shop.cart',$data);
    }
    public function deleteCart($id){
        if($id=='all'){
            Cart::destroy();
        }else{
            Cart::remove($id);
        }
        return back();
    }
    public function updateCart(Request $request){
        $id = $request->rowId_cart;
        $qty = $request->quantity;
        Cart::update($id,$qty);
        return redirect('cart/show');  
    }
    public function cartIncrement($id, $qty, $pro_id)
    {
        $product = Product::find($pro_id);

        if($product->pro_qty> $qty)
        {
            Cart::update($id, $qty+1);
            return redirect()->back();
        }
        else
        {
            return redirect()->back()
                ->with('warn', "Không Đủ Hàng Trong Kho");
        }

    }


    public function cartDecrement($id, $qty)
    {
        Cart::update($id, $qty-1);
        return redirect()->back();
    }
}
