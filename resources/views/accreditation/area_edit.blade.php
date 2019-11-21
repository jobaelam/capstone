@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Area</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('area.update', $area->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback {{ $errors->has('area_name') ? 'has-error' : '' }}">
                    <label for="area_name">Name</label>
                    <input width="70px" type="text" name="area_name" class="form-control" value="{{ $area->name }}">
                    @if ($errors->has('area_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('area_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('area_description') ? 'has-error' : '' }}">
                    <label for="area_name">Description</label>
                    <input type="text" name="area_description" class="form-control" value="{{ $area->description }}">
                    @if ($errors->has('area_description'))
                        <span class="help-block">
                                <strong>{{ $errors->first('area_description') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('area_head') ? 'has-error' : '' }}">
                    <label for="area_head">Head</label>
                    <select type="dropdown" name="area_head" class="form-control" value="{{ old('area_head') }}"
                           placeholder="Area Head">
                        @if($area->head != null)
                            <option value="{{$area->head}}" selected disabled>{{$area->hasUser->first_name}} {{$area->hasUser->last_name}}</option>
                        @else
                            <option value="">-- Select Area Head --</option>
                        @endif
                        @foreach($faculty_list as $faculty)
                            <option value="{{ $faculty->id }}">{{ $faculty->first_name }} {{ $faculty->last_name }}</option>
                        @endforeach
                        </select>
                    @if ($errors->has('area_head'))
                        <span class="help-block">
                            <strong>{{ $errors->first('area_head') }}</strong>
                        </span>
                    @endif
                </div>
                <input type="hidden" >
                <a type="button" class="btn btn-default" href="/area/{{$area->agency_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Update</button>
            </form>
        </div>
    </div>
@stop