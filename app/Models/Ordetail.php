<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ordetail extends Model
{
    use HasFactory;
    protected $table = 'ordetails';
    protected $primaryKey = 'odl_id';

    public function Product() {
        return $this->belongsTo('App\Models\Product', 'odl_pro', 'pro_id');
    }
}
