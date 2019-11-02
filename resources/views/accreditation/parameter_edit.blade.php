@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Parameter</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('parameter.update', $parameter->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback {{ $errors->has('parameter_name') ? 'has-error' : '' }}">
                    <label for="parameter_name">Name</label>
                    <input width="70px" type="text" name="parameter_name" class="form-control" value="{{ $parameter->name }}">
                    @if ($errors->has('parameter_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('parameter_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('parameter_description') ? 'has-error' : '' }}">
                    <label for="parameter_name">Description</label>
                    <input type="text" name="parameter_description" class="form-control" value="{{ $parameter->description }}">
                    @if ($errors->has('parameter_description'))
                        <span class="help-block">
                                <strong>{{ $errors->first('parameter_description') }}</strong>
                            </span>
                    @endif
                </div>
                <input type="hidden" >
                <a type="button" class="btn btn-default" href="/accreditation/parameter/{{$parameter->area_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Update</button>
            </form>
        </div>
    </div>
@stop