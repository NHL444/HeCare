<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = [
        'atl_title', 'atl_slug', 'atl_type', 'atl_topic', 'atl_photo' , 'atl_descript', 'atl_content'
    ];
    protected $table = 'articles';
    public function Type() {
        return $this->belongsTo('App\Models\Atype', 'atl_type', 'atp_id');
    }
}
