<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Redirect;

class CategoryController extends Controller
{

    public function store(Request $request){
        $request->validate([
            'cate_name' => 'required|unique:categories',
        ], [
            'required' => 'Tên danh mục bắt buộc phải nhập',
            'cate_name.unique' => 'Đã tồn tại danh mục này'
        ]);
        $cate = new Category();
        $cate->cate_name= $request->cate_name; 
        $cate->cate_slug= Str::slug($request->cate_name);
        $cate->cate_parent= $request->cate_parent;                                
        $cate->save();
        return redirect()->back()->with('success','Đã Tạo Thành Công');

    }
    
    public function getParent(){
        $cate=Category::where('cate_status',0)->orderBy('cate_id','DESC')->get();
        $listCate=[];
        Category::recursive($cate , $parent = 0 , $level = 1 , $listCate);
        return $listCate;
    }
    public function display(){
        $adminname= Auth::guard('admin')->user();
        $cate= $this->getParent();
        $dis = Category::where('cate_parent','!=',0)->get();
        $all = Category::all();
       
        return view('admin.category.display',[
             'user'=>$adminname,
             'dis'=>$dis,
             'all'=>$all,
             'cate'=>$cate
        ]);

    }
    public function getCate($id){
        $adminname= Auth::guard('admin')->user();
        $cate= $this->getParent();
        $getcate = Category::where('cate_id',$id)->get();
        return view('admin.category.getcate',[
            'user'=>$adminname,
            'getcate'=>$getcate,
            'cate'=>$cate
        ]);       
        
    }
    public function postCate(Request $request,$id){
        $request->validate([
            'cate_name' => 'required|unique:categories',
        ], [
            'required' => 'Tên danh mục bắt buộc phải nhập',
            'cate_name.unique' => 'Đã tồn tại danh mục này'
        ]);
        $adminname= Auth::guard('admin')->user();
        $cate= $this->getParent();
        $getcate= Category::find($id);
        $getcate->cate_name =$request ->input('cate_name');
        $getcate->cate_slug= Str::slug($request->input('cate_name'));
        $getcate->cate_parent= $request->cate_parent; 
        $getcate -> update();   
       return Redirect::back()->with(
        array(
            'user'=>$adminname,
            'getcate'=>$getcate,
            'cate'=>$cate,
            'success'=>'Đã Chỉnh Sửa Đối Tượng!' 
        )
    ); 
    }
    public function delCate($id)
    {
        // $del=Category::find($id);
        $del=Category::where('cate_id',$id)->orWhere('cate_parent',$id);
        $del->delete();
        return redirect()->back()->with('success','Danh Mục Đã Xóa!');
    }
}
