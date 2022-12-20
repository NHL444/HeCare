<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{
    public function contact(){
        $adminname= Auth::guard('admin')->user();
        $cont = Contact::orderBy('cont_id','desc')->get(); 
        return view('admin.contact.contact',[
             'user'=>$adminname,
             'cont'=>$cont
        ]);
    }
    public function contStatus($id){
        $cont = Contact::select('cont_status')->where('cont_id',$id)->first();

        if($cont->cont_status == '1'){
            $status = '0';
        }else{
            $status = '1';
        }
        $value =array('cont_status'=> $status);
        DB::table('contacts')->where('cont_id',$id)->update($value);
        // dd($value);
        session()->flash('msg','Đã xem!');
        return redirect()->back();
    }
    public function contDel($id)
    {
        $del=Contact::find($id);
        $del->delete();
        return redirect()->back()->with('success','Bình Luận Đã Được Xóa!');
    }
}
