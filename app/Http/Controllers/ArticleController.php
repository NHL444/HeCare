<?php

namespace App\Http\Controllers;

use App\Http\Requests\ArticleRequest;
use App\Imports\ArticleImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\Article;
use App\Models\Atype;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class ArticleController extends Controller
{
    // LOẠI HÌNH 

    public function createType(){
        $adminname= Auth::guard('admin')->user();
        $tp= $this->getParent();
        return view('admin.type.create',[
             'user'=>$adminname,
             'tp'=>$tp
           
        ]);
    }
    
    public function getParent(){
        $typ=Atype::where('atp_status',0)->orderBy('atp_id','DESC')->get();
        $listType=[];
        Atype::recursive($typ , $parent = 0 , $level = 1 , $listType);
        return $listType;
    }
    public function cType(Request $request){
        $request->validate([
            'atp_name' => 'required|unique:atypes',
        ], [
            'required' => 'Tên bộ môn bắt buộc phải nhập',
            'atp_name.unique' => 'Đã tồn tại bộ môn này'
        ]);
        $type = new Atype();
        $type->atp_name= $request->atp_name; 
        $type->atp_slug= Str::slug($request->atp_name);
        $type->atp_parent= $request->atp_parent; 
        if($request->hasFile('atp_photo')){
            $img = $request->atp_photo;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('type/photo'), $upload);
            $type->atp_photo = $upload;
        } 
        if($request->hasFile('atp_logo')){
            $img = $request->atp_logo;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('type/logo'), $upload);
            $type->atp_logo = $upload;
        }                                
        $type->save();
        return redirect()->back()->with('success','Đã Tạo Thành Công');

    }

    public function display(){
        $adminname= Auth::guard('admin')->user();
        $dis = Atype::all();
       
        return view('admin.type.display',[
             'user'=>$adminname,
             'dis'=>$dis
        ]);

    }
    public function getType($id){
        $adminname= Auth::guard('admin')->user();
        $tp= $this->getParent();
        $gettype = Atype::where('atp_id',$id)->get();
        return view('admin.type.gettype',[
            'user'=>$adminname,
            'gettype'=>$gettype,
            'tp'=>$tp
        ]);       
        
    }
    public function postType(Request $request,$id){
        $request->validate([
            'atp_name' => 'required|unique:atypes',
        ], [
            'required' => 'Tên bộ môn bắt buộc phải nhập',
            'atp_name.unique' => 'Đã tồn tại bộ môn này'
        ]);
        $tp= $this->getParent();
        $gettype= Atype::find($id);
        $gettype->atp_name =$request ->input('atp_name');
        $gettype->atp_slug= Str::slug($request->input('atp_name'));
        $gettype->atp_parent= $request->atp_parent;
        if($request->hasFile('atp_photo')){
            $img = $request->atp_photo;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('type/photo'), $upload);
            $gettype->atp_photo = $upload;
        } 
        if($request->hasFile('atp_logo')){
            $img = $request->atp_logo;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('type/logo'), $upload);
            $gettype->atp_logo = $upload;
        }  
        $gettype -> update();   
       return Redirect::back()->with(
        array(
            'gettype'=>$gettype,
            'tp'=>$tp,
            'success'=>'Đã Chỉnh Sửa Đối Tượng!' 
        )
    ); 
    }
    public function delType($id)
    {
        // $del=Atype::find($id);
        $del=Atype::where('atp_id',$id)->orWhere('atp_parent',$id);
        $del->delete();
        return redirect()->back()->with('success','Loại Hình Đã Xóa!');
    }
    /// BÀI VIẾT

    public function writeArticle(){
        $adminname= Auth::guard('admin')->user();
        $type= $this->getParent(); 
        return view('admin.article.write',[
             'user'=>$adminname,
             'type'=>$type
        ]);

    }
    public function postArticle(ArticleRequest $request){
        $articles = new Article();
        $articles->atl_title= $request->atl_title; 
        $articles->atl_slug= Str::slug($request->atl_title);
        $articles->atl_topic= $request->atl_topic;
        $articles->atl_type= $request->atl_type;
        $articles->atl_descript= $request->atl_descript;
        $articles->atl_content= $request->atl_content; 
        if($request->hasFile('atl_photo')){
            $img = $request->atl_photo;
            $upload= $img->getClientOriginalName();        
            $img->move(public_path('photo'), $upload);
            $articles->atl_photo = $upload;                               

        }
        $articles->save();
        return redirect()->back()->with('success','Đã Đăng Bài!');
        

    }
    public function Manage(){
        $adminname= Auth::guard('admin')->user();
        $manage = Article::orderBy('id','desc')->get();
        
        return view('admin.article.manage',[
             'user'=>$adminname,
             'manage'=>$manage,
        ]);  

    }
    public function edit($id){
        $adminname= Auth::guard('admin')->user();
        $edit = Article::find($id);
        $type= $this->getParent();
        return view('admin.article.edit',[
            'user'=>$adminname,
            'edit'=>$edit,
            'type'=>$type
        ]);              
    }

    public function editAr(ArticleRequest $request,$id){
        
        $adminname= Auth::guard('admin')->user();
        $edit = new Article();
        $arr['atl_title'] = $request->atl_title;
        $arr['atl_slug']= Str::slug($request->atl_title);
        $arr['atl_topic'] = $request->atl_topic;
        $arr['atl_type'] = $request->atl_type;
        $arr['atl_descript'] = $request->atl_descript;
        $arr['atl_content'] = $request->atl_content;
       
        if($request->hasFile('atl_photo')){
                    $img = $request->atl_photo;
                    $upload= $img->getClientOriginalName();                 
                    $img->move(public_path('photo'), $upload);
                    $arr['atl_photo'] = $upload;                               

        }
        $edit::where('id',$id)->update($arr);
        return Redirect::back()->with(
            array(
                'user'=>$adminname,
                'edit'=>$edit, 
                'success'=>'Bài Viết Đã Được Chỉnh Sửa!'  
            )
        );  
        
    }
    public function importExcel(Request $request){
        Excel::import(new ArticleImport, $request->excelfile);
        return redirect()->back()->with('success','Đã Đăng Bài!');
    }
    public function delete($id)
    {
        $del=Article::find($id);
        $del->delete();
        return redirect()->back()->with('success','Bài Viết Đã Đã Xóa!');
    }
}
