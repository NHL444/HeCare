<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Revenue extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'rev_order_total', 'rev_cost_price', 'rev_profit', 'rev_date', 'rev_qty'
    ];
    protected $table = 'revenues';
    protected $primaryKey = 'rev_id';
}
