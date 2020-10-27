<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FileFlag extends Model
{
    //
    public function hasUser(){
        return $this->belongsTo(User::class, 'user', 'id');
    }

    public function hasFile(){
        return $this->belongsTo(File::class, 'file_id', 'id');
    }
}
