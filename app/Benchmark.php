<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Benchmark extends Model
{
    //
    public function hasName(){
        return $this->belongsto(BenchmarkList::class, 'benchmark_name_id', 'id');
    }

    public function hasParameter(){
    	return $this->belongsto(Parameter::class, 'parameter_id', 'id');
    }
}
