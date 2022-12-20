<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;
    protected $fillable = [
        'province_name', 'province_type'
    ];
    protected $table = 'tbl_province';
    protected $primaryKey = 'province_id';

    public function District(){
        return $this->hasMany('App\Models\District', 'province_code');
    }

    public function Fee(){
        return $this->hasMany('App\Models\Feeship', 'fee_province');
    }
    public function Shipping(){
        return $this->hasMany('App\Models\Shipping', 'province');
    }
}
