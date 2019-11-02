@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Benchmark Status</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('benchmark.update', $benchmark->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback {{ $errors->has('benchmark_status') ? 'has-error' : '' }}">
                    <label for="benchmark_name">Status</label>
                    <output id="range_out">{{ $benchmark->status*100 }}</output>
                    <input type="range" min="0" max="100" name="benchmark_status" class="form-control" id="range_in" value="{{ $benchmark->status*100 }}" oninput="range_out.value = range_in.value">
                    @if ($errors->has('benchmark_status'))
                        <span class="help-block">
                                <strong>{{ $errors->first('benchmark_status') }}</strong>
                            </span>
                    @endif
                </div>
                <input type="hidden" >
                <a type="button" class="btn btn-default" href="/accreditation/benchmark/{{$benchmark->parameter_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Update</button>
            </form>
        </div>
    </div>
@stop