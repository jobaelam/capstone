<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    //
    public function hasFolder(){
        return $this->belongsTo(Folder::class, 'folder_id', 'id');
    }
}
