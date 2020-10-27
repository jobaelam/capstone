@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Request Files</h1>
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
            </div>
        </div>
        <div class="box-body">
            <div class="sked-container table-responsive">
                <table id="sked" class="table table-condensed table-bordered sked align-middle">
                    <tbody>
                    <tr class="active">
                        <th width="75%">Request</th>
                        <th width="15%">Action</th>
                    @forelse($request_files as $request_file)
                        <tr>
                            <td><strong>{{$request_file->hasUser->last_name}}, {{$request_file->hasUser->first_name}}</strong> want to access file <strong>{{$request_file->hasFile->hasFolder->name}}/{{ $request_file->hasFile->name }}</strong> in <strong>{{$request_file->hasFile->hasFolder->hasBenchmark->hasParameter->hasArea->hasDepartmentAccreditation->hasDepartment->name}}</strong></td>
                            <td align="center">
                                <a type="button" class="btn btn-primary btn-sm" href="#" onClick="this.disabled=true; request_file_approve({{$request_file->id}});">Approve</a>
                                <a type="button" class="btn btn-danger btn-sm" href="#" onClick="this.disabled=true; request_file_decline({{$request_file->id}});">Decline</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                    @endforelse
                </table>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function request_file_approve(id)
        {
            //alert(id);
            $.post('/requestFileApprove', {_token:"{{csrf_token()}}",id: id}, function(data){
                // alert(data);
                window.location.reload();
            });
        };

        function request_file_decline(id)
        {
            $.post('/requestFileDecline', {_token:"{{csrf_token()}}",id: id}, function(data){
                window.location.reload();
            });
        }
    </script>
@stop
