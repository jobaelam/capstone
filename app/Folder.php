<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Folder extends Model
{
    //
    public function hasBenchmark(){
        return $this->belongsto(Benchmark::class, 'benchmark_id', 'id');
    }
}
