@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Add File</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-body">
            <form action="{{ route('file.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                {{-- <div class="form-group has-feedback {{ $errors->has('file_name') ? 'has-error' : '' }}">
                    <label for="file_name">Name</label>
                    <input width="70px" type="text" name="file_name" class="form-control" value="{{ old('file_name') }}">
                    @if ($errors->has('file_name'))
                        <span class="help-block">
                                <strong>{{ $errors->first('file_name') }}</strong>
                            </span>
                    @endif
                </div> --}}
                <div class="form-group has-feedback {{ $errors->has('file_note') ? 'has-error' : '' }}">                  
                    <label for="file_upload">Upload File</label>
                    <input type="file" name="file_upload">
                    @if ($errors->has('file_upload'))
                        <span class="help-block">
                            <strong>{{ $errors->first('file_upload') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="form-group has-feedback {{ $errors->has('file_note') ? 'has-error' : '' }}">
                    <label for="file_name">Note</label>
                    <input type="text" name="file_note" class="form-control" value="{{ old('file_note') }}" maxlength="250">
                    @if ($errors->has('file_note'))
                        <span class="help-block">
                                <strong>{{ $errors->first('file_note') }}</strong>
                            </span>
                    @endif
                </div>
                <input type="hidden" name="folder_id" value="{{$folder_id}}">
                <input type="hidden" name="user_id" value="{{Auth::user()->id}}">
                <a type="button" class="btn btn-default" href="/accreditation/file/{{$folder_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                <button type="submit" class="btn btn-info pull-right" onClick="this.form.submit(); this.disabled=true; this.value='Processing…';"> Submit</button>
            </form>
        </div>
    </div>
@stop
