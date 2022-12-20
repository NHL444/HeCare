<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;

class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'cus_name', 'cus_email', 'cus_password', 'cus_phone'
    ];
    protected $table = 'customers';
    protected $primaryKey = 'cus_id';

    public function orders(){
        return $this->hasMany('App\Models\Order', 'order_cus');
    }
    // public function orderSuccess(){
    //     $cus = Customer::where('cus_id','order_cus')->count();
    //     return $cus;
    // }
    public function Shipping(){
        return $this->hasMany('App\Models\Shipping', 'ship_cus');
    }
}
