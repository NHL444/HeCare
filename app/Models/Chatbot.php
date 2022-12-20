<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chatbot extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $fillable = [
        'intent_greet', 'intent_model', 'intent_order', 'reply_intent'
    ];
    protected $table = 'chatbots';
    protected $primary ='id';
}
