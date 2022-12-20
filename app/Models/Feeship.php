<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feeship extends Model
{
    use HasFactory;
    // public $timestamps = false;
    protected $fillable = [
        'fee_province', 'fee_district', 'fee_commune', 'fee_payable'
    ];
    protected $table = 'feeships';
    protected $primaryKey = 'fee_id';

    public function Province() {
        return $this->belongsTo('App\Models\Province', 'fee_province', 'province_id');
    }

    public function District() {
        return $this->belongsTo('App\Models\District', 'fee_district', 'district_id');
    }
    public function Commune() {
        return $this->belongsTo('App\Models\Commune', 'fee_commune', 'commune_id');
    }
}
