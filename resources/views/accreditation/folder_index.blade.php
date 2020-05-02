@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Folders</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-header with-border no-padding-bottom">
            <p class="visible-xs pull-right">
            </p>
            @if(Auth::user()->id != 1)
                <div class="pull-left">
                    <span><strong>ID #:</strong> <?= Auth::user()->id ?></span>
                    <span><strong>Name:</strong> <?= Auth::user()->first_name," ",Auth::user()->last_name?></span>
                    <span><strong>Department:</strong> <?= Auth::user()->office_department->name ?></span>
                    <span><strong>Role:</strong> <?= Auth::user()->role->name ?></span>
                </div>
            @endif
            <div class="btn-group hidden-print pull-right toolbar m-b10 hidden-xs" role="group" aria-label="...">
                {{--                <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print"></i> Print</button>--}}
                {{--                <button type="button" class="btn btn-default btn-download"><i class="fa fa-download"></i> Download</button>--}}
            </div>
        </div>
        <div class="box-body">
            <div class="sked-container table-responsive">
                <table id="sked" class="table table-condensed table-bordered sked align-middle">
                    <tbody>
                    <tr class="active">
                        <th width="20%">Name</th>
                        <th width="60%">Note</th>
                        @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                            <th width="15%">Action</th>
                        @else
                            <th width="10%">Action</th>
                        @endif
                    </tr>
                    @forelse($folder_list as $folder)
                        <tr>
                            <td>{{$folder->name}}</td>
                            <td>{{$folder->note}}</td>
                            @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                                <td align="center">
                                    <a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$folder->id}}">Open</a>
                                    <a type="button" class="btn btn-default btn-sm" href="/accreditation/folder/{{$folder->id}}/edit">Edit</a>
                                </td>
                            @else
                                <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$folder->id}}">Open</a></td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                    @endforelse
                </table>
                <a type="button" class="btn btn-default" href="/accreditation/benchmark/{{$benchmark->parameter_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                    <a type="button" class="btn btn-info btn-download pull-right" href="/accreditation/folder/{{$benchmark->id}}/create"><i class="fa fa-plus"></i> &nbsp; Create Folder</a>
                @endif
            </div>
        </div>
    </div>
@stop
