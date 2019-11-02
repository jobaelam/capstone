@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Add Folder</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('folder.store') }}" method="POST">
                @csrf
                <div class="form-group has-feedback {{ $errors->has('folder_name') ? 'has-error' : '' }}">
                    <label for="folder_name">Name</label>
                    <input width="70px" type="text" name="folder_name" class="form-control" value="{{ old('folder_name') }}">
                    @if ($errors->has('folder_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('folder_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('folder_note') ? 'has-error' : '' }}">
                    <label for="folder_name">Note</label>
                    <input type="text" name="folder_note" class="form-control" value="{{ old('folder_note') }}" maxlength="250">
                    @if ($errors->has('folder_note'))
                        <span class="help-block">
                                <strong>{{ $errors->first('folder_note') }}</strong>
                            </span>
                    @endif
                </div>
                <input type="hidden" name="benchmark_id" value="{{$benchmark_id}}">
                <a type="button" class="btn btn-default" href="/accreditation/folder/{{$benchmark_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Submit</button>
            </form>
        </div>
    </div>
@stop
