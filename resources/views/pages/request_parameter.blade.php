@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Request Parameter</h1>
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
                    </tr>
                    @forelse($request_parameters as $request_parameter)
                        <tr>
                            <td><strong>{{$request_parameter->hasUser->last_name}}, {{$request_parameter->hasUser->first_name}}</strong> want to access <strong>{{ $request_parameter->hasParameter->name }}</strong> in <strong>{{$request_parameter->hasParameter->hasArea->hasDepartmentAccreditation->hasDepartment->name}}</strong></td>
                            <td align="center">
                                <a type="button" class="btn btn-primary btn-sm" href="#" onClick="this.disabled=true; request_parameter_approve({{$request_parameter->id}});">Approve</a>
                                <a type="button" class="btn btn-danger btn-sm" href="#" onClick="this.disabled=true; request_parameter_decline({{$request_parameter->id}});">Decline</a>
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
        function request_parameter_approve(id)
        {
            //alert(id);
            $.post('/requestParameterApprove', {_token:"{{csrf_token()}}",id: id}, function(data){
                // alert(data);
                window.location.reload();
            });
        };

        function request_parameter_decline(id)
        {
            $.post('/requestParameterDecline', {_token:"{{csrf_token()}}",id: id}, function(data){
                window.location.reload();
            });
        }
    </script>
@stop
