<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehousedetail extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = ['wrd_code','wrd_product', 'wrd_qty', 'price'];
    protected $table = 'warehouse_receipt_detail';
    protected $primaryKey = 'id';
    public function Product() {
        return $this->belongsTo('App\Models\Product', 'wrd_product', 'pro_name');
    }
}
