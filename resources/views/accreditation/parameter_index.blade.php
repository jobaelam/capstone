@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Parameter</h1>
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
                        <th width="25%">Name</th>
                        <th width="35%">Description</th>
                        <th width="20%">Status</th>
                        @if(Auth::user()->role->id == '1')
                            <th width="15%">Action</th>
                        @else
                            <th width="10%">Action</th>
                        @endif
                    </tr>
                    @forelse($parameter_list as $parameter)
                        <tr>
                            <td>{{$parameter->name}}</td>
                            <td>{{$parameter->description}}</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" data-toggle="tooltip" title="{{100*$parameter->status}}%" style="width: {{100*$parameter->status}}%"></div>
                                </div>
                            </td>
                            {{-- <script type="text/javascript">alert('{{$parameter->hasArea->hasDepartmentAccreditation->id}}');</script> --}}
                            @if(Auth::user()->role->id == '1')
                                <td align="center">
                                    <a type="button" class="btn btn-primary btn-sm" href="/accreditation/benchmark/{{$parameter->id}}">Open</a>
                                    <a type="button" class="btn btn-default btn-sm" href="/accreditation/parameter/{{$parameter->id}}/edit">Edit</a>
                                </td>
                            @elseif(Auth::user()->id == $area->head OR Auth::user()->role->id == '2')
                                <td align="center">
                                    <a type="button" class="btn btn-primary btn-sm" href="/accreditation/benchmark/{{$parameter->id}}">Open</a>
                                </td>
                            @else
                                @if(in_array($parameter->id, $request_parameter))
                                    @foreach($flags as $request)
                                        @if($request->parameter_id == $parameter->id AND $request->flag == 1)
                                            <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/benchmark/{{$parameter->id}}">Open</a></td>
                                        @elseif($request->parameter_id == $parameter->id AND $request->flag == 2)
                                            <td align="center"><a type="button" class="btn btn-warning btn-sm" href="#" disabled="true">Pending</a></td>
                                        @endif
                                    @endforeach
                                @else
                                    <td align="center"><button class="btn btn-danger btn-sm" href="#" onClick="this.disabled=true; request_parameter({{$parameter->id}});">Request</button></td>
                                @endif
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                    @endforelse
                </table>
                <a type="button" class="btn btn-default" href="/accreditation/area/{{$area->department_accreditation_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::user()->role->id == '1')
                    <a type="button" class="btn btn-info btn-download pull-right" href="/accreditation/parameter/{{$area->id}}/create"><i class="fa fa-plus"></i> &nbsp; Add Parameter</a>
                @endif
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function request_parameter(id)
        {
            alert(id);
            $.post('/requestParameter', {_token:"{{csrf_token()}}",parameter: id, user:'{{Auth::user()->id}}'}, function(data){
                window.location.reload();
            });
        };
    </script>
@stop
