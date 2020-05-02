@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Edit Folder</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('folder.update', $folder->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group has-feedback {{ $errors->has('folder_name') ? 'has-error' : '' }}">
                    <label for="folder_name">Name</label>
                    <input width="70px" type="text" name="folder_name" class="form-control" value="{{ $folder->name }}">
                    @if ($errors->has('folder_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('folder_name') }}</strong>
                            </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('folder_note') ? 'has-error' : '' }}">
                    <label for="folder_name">note</label>
                    <input type="text" name="folder_note" class="form-control" maxlength="250" value="{{ $folder->note }}">
                    @if ($errors->has('folder_note'))
                        <span class="help-block">
                            <strong>{{ $errors->first('folder_note') }}</strong>
                        </span>
                    @endif 
                </div>
                <a type="button" class="btn btn-default" href="/accreditation/folder/{{$folder->benchmark_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Update</button>
            </form>
        </div>
    </div>
@stop