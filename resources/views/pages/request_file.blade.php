@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Request File</h1>
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
                        <th width="20%">Action</th>
                    </tr>
                    {{-- @foreach($department_accreditation_list as $department_accreditation)
                        <tr>
                            <td>{{$department_accreditation->hasDepartment->name}}</td>
                            <td></td>
                            <td>
                                <div class="progress progress-xs">
                                    <div class="progress-bar progress-bar-success" data-toggle="tooltip" title="{{100*$department_accreditation->status}}%" style="width: {{100*$department_accreditation->status}}%"></div>
                                </div>
                            </td>
                            <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/area/{{$department_accreditation->id}}">Open</a></td>
                        </tr>
                    @endforeach --}}

                </table>
                <a type="button" class="btn btn-default" href="/accreditation" ><i class="fa fa-arrow-left"></i> Back</a>
            </div>
        </div>
    </div>
@stop
