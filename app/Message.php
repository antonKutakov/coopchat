<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['text', 'user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function create($fields){
        $message = new static;
        $message->fill($fields);
        $message->save();
        return $message;
    }
}
