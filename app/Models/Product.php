<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $primaryKey = 'pro_id';

    public function Category() {
        return $this->belongsTo('App\Models\Category', 'pro_cate', 'cate_id');
    }

    public function Type() {
        return $this->belongsTo('App\Models\Type', 'pro_type', 'tp_id');
    }
    public function Ordetail(){
        return $this->hasMany('App\Models\Ordetail', 'odl_pro');
    }
    public function Rating(){
        return $this->hasMany('App\Models\Rating', 'rating_pro');
    }
}
