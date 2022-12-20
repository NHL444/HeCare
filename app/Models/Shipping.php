<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Shipping extends Model
{
    use HasFactory;
    protected $table = 'shippings';
    protected $primaryKey = 'ship_id';

    public function Province() {
        return $this->belongsTo('App\Models\Province', 'province', 'province_id');
    }

    public function District() {
        return $this->belongsTo('App\Models\District', 'district', 'district_id');
    }
    public function Commune() {
        return $this->belongsTo('App\Models\Commune', 'commune', 'commune_id');
    }
    public function deliveryAddress(){
        $user_id = Session::get('cus_id');
        $delivery = Shipping::where('ship_cus',$user_id)->orderBy('ship_id','desc')->take(3)->get()->toArray();
        return $delivery;
    }
    public function recentAddress(){
        $user_id = Session::get('cus_id');
        $recent = Shipping::where('ship_cus',$user_id)->orderBy('ship_id','desc')->first();
        return $recent;
    }
}
