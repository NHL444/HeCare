<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'rating_cus', 'rating_pro', 'rating_vote'
    ];
    protected $table = 'rating';
    protected $primaryKey = 'rating_id';
    public function Rating() {
        return $this->belongsTo('App\Models\Product', 'rating_pro', 'pro_id');
    }
}
