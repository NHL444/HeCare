<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    public $timestamps =false;
    protected $fillable = ['wr_code', 'wr_total','wr_staff','wr_provider', 'wr_date', 'wr_status'];
    protected $table = 'warehouse_receipt';
    protected $primaryKey = 'wr_id';
    public function Staff() {
        return $this->belongsTo('App\Models\Admin', 'wr_staff', 'id');
    }
    public function Detail(){
        return $this->hasMany('App\Models\Warehouse_detail', 'wrd_code');
    }
}
