<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{
    use HasFactory;
    protected $fillable = [
        'commune_name', 'commune_type', 'district_code'
    ];
    protected $table = 'tbl_commune';
    protected $primaryKey = 'commune_id';

    public function District() {
        return $this->belongsTo('App\Models\District', 'district_code', 'district_id');
    }
    public function Fee(){
        return $this->hasMany('App\Models\Feeship', 'fee_commune');
    }
    public function Shipping(){
        return $this->hasMany('App\Models\Shipping', 'ship_commune');
    }
}
