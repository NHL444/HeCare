<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GalleryController extends Controller
{
    public function addGallery($product_id){
        $adminname= Auth::guard('admin')->user();
        $pro_id=$product_id;
        return view('admin.product.gallery',[
             'user'=>$adminname,
             'pro_id'=>$pro_id
        ]);

    }
    public function loadGallery(Request $request){
        // $adminname= Auth::guard('admin')->user();
        $pro_id=$request->gl_product;
        $gl= Gallery::where('gl_product',$pro_id)->get();
        $gl_count= $gl->count();
        $show = '<form>
                '.@csrf_field().'
                <table class="table table-striped" >
                    <thead>                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tên Hình Ảnh</th>
                            <th style="text-align: center">Hình Ảnh</th>                                           
                            <th style="text-align: center">Thao Tác</th>
                        </tr>                  
                    </thead>
                    <tbody>
                    ';
        if($gl_count > 0){
            $i = 0;
            foreach($gl as $val){
                $i++;
                $show.='<tr style="border: 1px solid lightgray;text-align:center;"> 
                            <td style="font-size:20px;">'.$i.'</td>
                            <td contenteditable class="edit" style="font-size:20px;" data-gly_id="'.$val->gl_id.'">'.$val->gl_name.'</td>
                            <td><img src="'.url('gallery/'.$val->gl_image).'" style="width: 115px; height: 80px; border-radius: 10%;"/></td>
                            <td>            
                                <button type="button" data-gly_id="'.$val->gl_id.'" class="btn btn-secondary delete"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></button>
                            </td>
                        </tr>
                    ';
            }
        }else{
            $show.='<tr style="text-align:center;">
                        <td colspan="4">Thư viện ảnh rỗng</td>
                    </tr> 
                  ';
        }
        $show.='
            </tbody>
            </table>
            </form>
        ';
        echo $show;

    }
    public function insertGallery(Request $request,$id){
        $insert = $request->file('file');
        if($insert){
            foreach($insert as $img){
                $get_name = $img->getClientOriginalName();
                $name_img = current(explode('.',$get_name));
                $new_img = $name_img.rand(0,99).'.'.$img->getClientOriginalExtension();
                $img->move('gallery',$new_img);
                $gl = new Gallery();
                $gl->gl_name = $name_img;
                $gl->gl_image = $new_img;
                $gl->gl_product = $id;
                $gl->save();
            }
        }
        return redirect()->back()->with('success','Thêm Ảnh Thành Công!');
    }
    public function updateGallery(Request $request){
        $gly_id = $request->gly_id;
        $new_name = $request->new_name;
        $gl = Gallery::find($gly_id);
        $gl->gl_name = $new_name;
        $gl->save();
    }

    public function deleteGallery(Request $request){
        $gly_id = $request->gly_id;
        $gl = Gallery::find($gly_id);
        unlink('gallery/'.$gl->gl_image);
        $gl->delete();
    }
    
}
