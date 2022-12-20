<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatbotAdvice extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'keyword', 'reply', 'parent'
    ];
    protected $table = 'chatbot_advices';
    protected $primary ='id';

    // public function child(){
    //     return $this->hasMany(ChatbotAdvice::class,'parent','id');
    // }
    
    // public static function recursive($cate , $parent = 0 , $level = 1 ,&$listCate){
    //     if(count($cate)>0){
    //         foreach($cate as $key => $data){
    //             if($data->cate_parent == $parent){
    //                 $data->level = $level;
    //                 $listCate[] = $data;
    //                 unset($cate[$key]);
    //                 $parents = $data->cate_id;
    //                 self::recursive($cate , $parents , $level + 1 , $listCate);
    //             }
    //         }
    //     }
    // }
}
