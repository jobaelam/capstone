@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Department</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('department.update', $department_accreditation->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback {{ $errors->has('department_accreditation_head') ? 'has-error' : '' }}">
                    <label for="area_head">Head</label>
                    <select type="dropdown" name="department_accreditation_head" class="form-control" value="{{ old('department_accreditation_head') }}"
                           placeholder="Accreditation Head">
                        @if($department_accreditation->head != null)
                            <option value="{{$department_accreditation->head}}" selected disabled>{{$department_accreditation->hasUser->first_name}} {{$department_accreditation->hasUser->last_name}}</option>
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
                <a type="button" class="btn btn-default" href="/accreditation/department/{{$department_accreditation->agency_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Update</button>
            </form>
        </div>
    </div>
@stop
