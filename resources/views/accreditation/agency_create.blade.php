@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Add Agency</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('accreditation.store') }}" method="POST">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('agency_name') ? 'has-error' : '' }}">
                    <label for="agency_name">Name</label>
                    <input width="70px" type="text" name="agency_name" class="form-control" value="{{ old('agency_name') }}">
                    @if ($errors->has('agency_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('agency_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('agency_description') ? 'has-error' : '' }}">
                    <label for="agency_name">Description</label>
                    <input type="text" name="agency_description" class="form-control" value="{{ old('agency_description') }}">
                    @if ($errors->has('agency_description'))
                        <span class="help-block">
                                <strong>{{ $errors->first('agency_description') }}</strong>
                            </span>
                    @endif
                </div>
                <a type="button" class="btn btn-default" href="/accreditation" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Submit</button>
            </form>
        </div>
    </div>
@stop
