<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    //
    protected $fillable = ['from', 'to', 'message', 'is_read'];

        public function hasFrom(){
        return $this->belongsTo(User::class, 'from', 'id');
    }

    public function hasTo(){
        return $this->belongsTo(User::class, 'to', 'id');
    }
}
