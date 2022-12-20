<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Article;
use App\Models\Atype;
use App\Models\Category;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(){
        $data['news']= Article::orderBy('id','desc')->take(5)->get();
        $data['tp']=Atype::where('atp_parent',1)->orWhere('atp_parent',2)->orderBy('atp_id','desc')->limit(3)->get();
        return view("master.index",$data);
    }

    public function newsRead($id){
        $data['news']= Article::find($id);
        $data['new']= Article::orderBy('id','desc')->take(1)->get();
        $data['near']= Article::all()->except([Article::max('id')]); 
        return view("master.read",$data);
    }
    public function aboutUs(){
        return view("master.about");
    }

    public function showAtype($id){
        $data['atype']=Atype::find($id);
        $data['news'] = Article::where('atl_type',$id)->orderBy('id','desc')->paginate(4);
        // dd($data);
        return view("master.list",$data);
    }
    public function contact(){
        return view("master.contact");
    }

    public function postContact(ContactRequest $request){
        $contact = new Contact();
        $contact->cont_name= $request->name; 
        $contact->cont_email= $request->email;
        $contact->cont_phone= $request->phone;
        $contact->cont_content= $request->content;
        $contact->save();
        return redirect()->back()->with('success','Đã Gửi Phản Hồi! Cảm Ơn Quí Khách');
    }
}
