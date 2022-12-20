<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Atype extends Model
{
    use HasFactory;
    protected $table = 'atypes';
    protected $primaryKey = 'atp_id';

    public function Articles(){
        return $this->hasMany('App\Models\Article', 'atl_type');
    }

    public function child(){
        return $this->hasMany(Atype::class,'atp_parent','atp_id');
    }
    
    public static function recursive($typ , $parent = 0 , $level = 1 ,&$listType){
        if(count($typ)>0){
            foreach($typ as $key => $data){
                if($data->atp_parent == $parent){
                    $data->level = $level;
                    $listType[] = $data;
                    unset($typ[$key]);
                    $parents = $data->atp_id;
                    self::recursive($typ , $parents , $level + 1 , $listType);
                }
            }
        }
    }
    
}
