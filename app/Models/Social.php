<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Social extends Model
{
    use HasFactory;
    protected $fillable = [
        'social_user_id', 'social_name', 'social_cus', 'social_email'
    ];
    protected $table = 'socials';
    protected $primaryKey = 'social_id';
 

    public function customer(){
        return $this->belongsTo('App\Models\Customer','social_cus');
    }
}
