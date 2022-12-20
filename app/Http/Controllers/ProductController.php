<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Type;
use Illuminate\Support\Facades\Redirect;

class ProductController extends Controller
{
    // LOẠI
    public function createType(){
        $adminname= Auth::guard('admin')->user();
        return view('admin.product.create',[
             'user'=>$adminname,
           
        ]);
    }   
    public function saveType(Request $request){
        $request->validate([
            'name' => 'required',
        ], [
            'required' => 'Tên loại bắt buộc phải nhập',
        ]);
        if($request->choose==0){
            $type = new Type();
            $type->tp_name= $request->name; 
            $type->tp_slug= Str::slug($request->name);               
            $type->save();
        }else{
            
            $br = new Brand();
            $br->br_name= $request->name; 
            $br->br_slug= Str::slug($request->name);
            $br->br_image= 'no_image.png';                
            $br->save();
        }
        return redirect()->back()->with('success','Đã Tạo Thành Công');

    }

    public function display(){
        $adminname= Auth::guard('admin')->user();
        $dis = Type::all(); 
        return view('admin.product.type',[
             'user'=>$adminname,
             'dis'=>$dis
        ]);

    }
    public function getType($id){
        $adminname= Auth::guard('admin')->user();
        $gettype = Type::find($id);
        return view('admin.product.gettype',[
            'user'=>$adminname,
            'gettype'=>$gettype,
        ]);       
        
    }
    public function postType(Request $request,$id){
        $request->validate([
            'tp_name' => 'required|unique:types',
        ], [
            'required' => 'Tên loại bắt buộc phải nhập',
            'tp_name.unique' => 'Đã tồn tại loại này'
        ]);
        $adminname= Auth::guard('admin')->user();
        $gettype= Type::find($id);
        $gettype->tp_name =$request ->input('tp_name');
        $gettype->tp_slug= Str::slug($request->tp_name);     
        $gettype -> update();   
       return Redirect::back()->with(
        array(
            'user'=>$adminname,
            'gettype'=>$gettype,
            'success'=>'Đã Chỉnh Sửa Đối Tượng!' 
        )
    ); 
    }
    public function delType($id)
    {
        $del=Type::find($id);
        $del->delete();
        return redirect()->back()->with('success','Loại Hình Đã Xóa!');
    }

    // Thương Hiệu

    public function brand(){
        $adminname= Auth::guard('admin')->user();
        $br = Brand::all(); 
        return view('admin.product.brand',[
             'user'=>$adminname,
             'br'=>$br
        ]);

    }
    public function getBrand($id){
        $adminname= Auth::guard('admin')->user();
        $brand = Brand::find($id);
        return view('admin.product.getbrand',[
            'user'=>$adminname,
            'brand'=>$brand,
        ]);       
        
    }
    public function postBrand(Request $request,$id){
        $request->validate([
            'br_name' => 'required|unique:brands',
        ], [
            'br_name.unique' => 'Đã tồn tại thương hiệu này',
            'required' => 'Tên loại bắt buộc phải nhập',
        ]);
        $adminname= Auth::guard('admin')->user();
        $brand= Brand::find($id);
        $brand->br_name =$request ->input('br_name');
        $brand->br_slug= Str::slug($request->br_name);
        if($request->hasFile('br_image')){
            $img = $request->br_image;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('type/brand'), $upload);
            $brand->br_image = $upload;
        }      
        $brand -> update();   
       return Redirect::back()->with(
        array(
            'user'=>$adminname,
            'brand'=>$brand,
            'success'=>'Đã Chỉnh Sửa Đối Tượng!' 
        )
    ); 
    }
    public function delBrand($id)
    {
        $del=Brand::find($id);
        $del->delete();
        return redirect()->back()->with('success','Loại Hình Đã Xóa!');
    }
    public function add(){
        $adminname= Auth::guard('admin')->user();
        $add= $this->getParent(); 
        $tpy=Type::all();
        $brand=Brand::all();
        return view('admin.product.add-product',[
             'user'=>$adminname,
             'add'=>$add,
             'tpy'=>$tpy,
             'brand'=>$brand
        ]);

    }
    public function getParent(){
        $typ=Category::where('cate_status',0)->orderBy('cate_id','DESC')->get();
        $listCate=[];
        Category::recursive($typ , $parent = 0 , $level = 1 , $listCate);
        return $listCate;
    }
    public function store(ProductRequest $request){
        $pro = new Product();
        $pro->pro_name= $request->pro_name; 
        $pro->pro_slug= Str::slug($request->pro_name);
        $pro->pro_price= $request->pro_price;
        $pro->pro_profit= $request->pro_profit;
        $pro->pro_discount= $request->pro_discount;
        $sell = $request->pro_price + ($request->pro_price*$request->pro_profit/100);
        $pro->pro_sell = $sell - ($sell*$request->pro_discount/100);
        $pro->pro_qty= $request->pro_qty;
        $pro->pro_origin= $request->pro_origin;
        $pro->pro_type= $request->pro_type;
        $pro->pro_cate= $request->pro_cate;
        $pro->pro_brand= $request->pro_brand;
        $pro->pro_descript= $request->pro_descript;
        $pro->pro_content= $request->pro_content;
        $pro->pro_status= $request->pro_status;
        if($request->hasFile('pro_image')){
            $img = $request->pro_image;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('image'), $upload);
            $pro->pro_image = $upload;                               

        }
        $pro->save();
        return redirect()->back()->with('success','Tạo Sản Phẩm Thành Công!');

    }
    public function show(){
        $adminname= Auth::guard('admin')->user();
        $show = Product::all();
        
        return view('admin.product.manage',[
             'user'=>$adminname,
             'show'=>$show,
        ]);  

    }
    public function edit($id){
        $adminname= Auth::guard('admin')->user();
        $edit = Product::find($id);
        $add= $this->getParent(); 
        $type=Type::all();
        $brand=Brand::all();
        return view('admin.product.edit',[
            'user'=>$adminname,
            'edit'=>$edit,
            'type'=>$type,
            'add'=>$add,
            'brand'=>$brand
        ]);              
    }

    public function editSave(ProductRequest $request,$id){
        
        $adminname= Auth::guard('admin')->user();
        $edit= new Product();
        $arr['pro_name']= $request->pro_name; 
        $arr['pro_slug']= Str::slug($request->pro_name);
        $arr['pro_price']= $request->pro_price;
        $arr['pro_profit']= $request->pro_profit;
        $arr['pro_discount']= $request->pro_discount;
            $sell = $request->pro_price + ($request->pro_price*$request->pro_profit/100);
        $arr['pro_sell'] = $sell - ($sell*$request->pro_discount/100);
        $arr['pro_qty']= $request->pro_qty;
        $arr['pro_origin']= $request->pro_origin;
        $arr['pro_type']= $request->pro_type;
        $arr['pro_cate']= $request->pro_cate;
        $arr['pro_brand']= $request->pro_brand;
        $arr['pro_descript']= $request->pro_descript;
        $arr['pro_content']= $request->pro_content;
        $arr['pro_status']= $request->pro_status;
        if($request->hasFile('pro_image')){
            $img = $request->pro_image;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('image'), $upload);
            $arr['pro_image'] = $upload;                                                        
        }
        $edit::where('pro_id',$id)->update($arr);
        return Redirect::back()->with(
            array(
                'user'=>$adminname,
                'edit'=>$edit, 
                'success'=>'Sản Phẩm Đã Được Chỉnh Sửa!'  
            )
        );  
        
    }
    public function delete($id)
    {
        $del=Product::find($id);
        $del->delete();
        return redirect()->back()->with('success','Sản Phẩm Đã Được Xóa!');
    }
}
