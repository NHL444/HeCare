<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';
    protected $primaryKey = 'cate_id';

    public function child(){
        return $this->hasMany(Category::class,'cate_parent','cate_id');
    }
    
    public static function recursive($cate , $parent = 0 , $level = 1 ,&$listCate){
        if(count($cate)>0){
            foreach($cate as $key => $data){
                if($data->cate_parent == $parent){
                    $data->level = $level;
                    $listCate[] = $data;
                    unset($cate[$key]);
                    $parents = $data->cate_id;
                    self::recursive($cate , $parents , $level + 1 , $listCate);
                }
            }
        }
    }

    public function Products(){
        return $this->hasMany('App\Models\Product', 'pro_cate');
    }
}
