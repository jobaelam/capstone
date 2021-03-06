@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Accreditation</h1>
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
                {{--                <button type="button" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>--}}
                {{--                <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print"></i> Print</button>--}}
                {{--                <button type="button" class="btn btn-default btn-download"><i class="fa fa-download"></i> Download</button>--}}
{{--                <a type="button" class="btn btn-default btn-download" href="/agency/create"><i class="fa fa-plus"></i> &nbsp; Add New</a>--}}
            </div>
        </div>
        <div class="box-body">
            <div class="sked-container table-responsive">
                <table id="sked" class="table table-condensed table-bordered sked align-middle">
                    <tbody>
                    <tr class="active">
                        <th width="30%">Department</th>
                        {{-- <th width="30%">Accreditation Head</th> --}}
                        <th width="25%">Status</th>
                        <th width="5%">Action</th>
                    </tr>
                    @foreach($department_accreditation_list as $department_accreditation)
                        @if((Auth::user()->role->id == 1 OR Auth::user()->role->id == 2 OR Auth::user()->role->id == 3) OR Auth::user()->office_department_id == $department_accreditation->id)
                        <tr>
                            <td>{{$department_accreditation->hasDepartment->name}}</td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" data-toggle="tooltip" title="{{100*$department_accreditation->status}}%" style="width: {{100*$department_accreditation->status}}%"></div>
                                </div>
                            </td>
                            <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/area/{{$department_accreditation->id}}">Open</a>
                            </td>
                        </tr>
                        @endif
                    @endforeach

                </table>
                <a type="button" class="btn btn-default" href="/accreditation" ><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
@stop
