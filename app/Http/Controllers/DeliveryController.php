<?php

namespace App\Http\Controllers;

use App\Models\Commune;
use App\Models\District;
use App\Models\Feeship;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class DeliveryController extends Controller
{
    public function index(){
        $adminname= Auth::guard('admin')->user(); 
        $list=Feeship::all();
        return view('admin.delivery.index',[
            'list'=>$list,
             'user'=>$adminname
        ]);
    }
    public function addFee(Request $request){

        $data = $request->all(); 
        $update = Feeship::where('fee_province',$data['province'])->where('fee_district',$data['district'])->where('fee_commune',$data['commune'])->first();
        if($update){
            $fee = Feeship::find($update->fee_id);
            $fee->fee_payable = $data['feeship'];
            $fee->save();
        }else{
            $fee = new Feeship();
            $fee->fee_province = $data['province'];
            $fee->fee_district = $data['district'];
            $fee->fee_commune = $data['commune'];
            $fee->fee_payable = $data['feeship'];
            $fee->save();
        } 
        return redirect()->back()->with('success','Phí Cập Nhật Thành Công');    

    }
    public function feeManage(Request $request){
        $data['user']= Auth::guard('admin')->user();
        $data['province']=Province::orderBy('province_id','ASC')->get();
        return view('admin.delivery.manage',$data);

    }
    public function display(){
        $fee = Feeship::orderBy('fee_id','DESC')->take(7)->get();
        $output ='';
        $output.='<form>
                '.@csrf_field().'              
                <table class="table table-striped" id="myTable">
                    <thead>                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tỉnh/Thành Phố</th>
                            <th style="text-align: center">Quận/Huyện/Thị Xã</th> 
                            <th style="text-align: center">Xã/Phường/Thị Trấn</th>                                            
                            <th style="text-align: center">Phí Vận Chuyển</th>
                            <th style="text-align: center">Xóa</th>
                        </tr>                  
                    </thead>
                    <tfoot>                       
                        <tr style="border: 1px solid lightgray;">
                            <th style="text-align: center">STT</th>
                            <th style="text-align: center">Tỉnh/Thành Phố</th>
                            <th style="text-align: center">Quận/Huyện/Thị Xã</th> 
                            <th style="text-align: center">Xã/Phường/Thị Trấn</th>                                            
                            <th style="text-align: center">Phí Vận Chuyển</th>
                            <th style="text-align: center">Xóa</th>
                        </tr>                  
                    </tfoot>
                    <tbody>
        ';
        $i = 0;
        foreach($fee as $val){
            $i++;
            $output.='<tr style="border: 1px solid lightgray;text-align:center;"> 
                            <td style="font-size:20px;">'.$i.'</td>
                            <td style="font-size:20px;">'.$val->Province->province_name.'</td>
                            <td style="font-size:20px;">'.$val->District->district_name.'</td>
                            <td style="font-size:20px;">'.$val->Commune->commune_name.'</td>
                            <td contenteditable class="editfee" style="font-size:20px;" data-fee_id="'.$val->fee_id.'">'.number_format($val->fee_payable,0,',',',').'</td>
                            <td>            
                                <button type="button" data-fee_id="'.$val->fee_id.'" class="btn btn-secondary deletefee"><i class="mdi mdi-delete" style="font-size: 28px; color: red;"></i></button>
                            </td>
                        </tr>
                
            ';
        }

        $output.='
                </tbody>
            </table>
            </form>
        ';
        echo $output;
    }

    public function parentDelivery(Request $request){
        $data = $request->all();
        if($data['action']){
            $output = '';
            if($data['action'] == 'province'){
                $district = District::where('province_code',$data['parent_id'])->orderBy('district_id','ASC')->get();
                $output.='<option value="0">Chọn quận/huyện/thị xã</option>';
                foreach($district as $val){
                    $output.='<option value="'.$val->district_id.'">'.$val->district_name.'</option>';
                }
            }else{
                $commune = Commune::where('district_code',$data['parent_id'])->orderBy('commune_id','ASC')->get();
                
                foreach($commune as $val){
                    $output.='<option value="'.$val->commune_id.'">'.$val->commune_name.'</option>';
                }

            }
            
        }
        echo $output;
    }
    public function editFee(Request $request){
        $fee_id = $request->fee_id;
        $new_fee = $request->new_fee;
        $fee = Feeship::find($fee_id);
        $fee->fee_payable = $new_fee;
        $fee->save();
    }
    public function deleteFee(Request $request){
        $fee_id = $request->fee_id;
        $fee = Feeship::find($fee_id);
        $fee->delete();
    }
    public function delFee($id)
    {
        $del=Feeship::find($id);
        $del->delete();
        return redirect()->back()->with('success','Phí Vận Chuyển Đã Được Xóa!');
    }

}
