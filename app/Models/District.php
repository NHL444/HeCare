<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class District extends Model
{
    use HasFactory;
    protected $fillable = [
        'district_name', 'district_type', 'province_code'
    ];
    protected $table = 'tbl_district';
    protected $primaryKey = 'district_id';

    public function Commune(){
        return $this->hasMany('App\Models\Commune', 'district_code');
    }
    public function Province() {
        return $this->belongsTo('App\Models\Province', 'province_code', 'province_id');
    }
    public function Fee(){
        return $this->hasMany('App\Models\Feeship', 'fee_district');
    }
}
