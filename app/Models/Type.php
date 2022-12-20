<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;
    protected $table = 'types';
    protected $primaryKey = 'tp_id';

    public function Products(){
        return $this->hasMany('App\Models\Product', 'pro_type');
    }
}
