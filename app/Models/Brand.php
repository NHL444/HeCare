<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;
    protected $table = 'brands';
    protected $primaryKey = 'br_id';
    public function Products(){
        return $this->hasMany('App\Models\Product', 'pro_brand');
    }
}
