@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Messages</h1>
@stop

@section('content')
    <div class="box box-default ">
        <div class="box-header with-border no-padding-bottom">
            <p class="visible-xs pull-right">
            </p>
            <h3 class="visible-print">Class Schedule</h3>
            <div class="pull-left">
                <span><strong>ID #:</strong> 2015-2485</span>
                <span><strong>Name:</strong> BARI, JOBAEL D.</span>
                <span><strong>Course/Year:</strong> BSIT - 4</span>
                <span><strong>Sem/SY:</strong> 1 / 2019-2020</span>
            </div>
            <div class="clearfix visible-print"></div>
            <div class="btn-group hidden-print pull-right toolbar m-b10 hidden-xs" role="group" aria-label="...">
                <button type="button" class="btn btn-default" onclick="history.back()"><i class="fa fa-arrow-left"></i> Back</button>
                <button type="button" class="btn btn-default" onclick="window.print()"><i class="fa fa-print"></i> Print</button>
                <button type="button" class="btn btn-default btn-download"><i class="fa fa-download"></i> Download</button>
            </div>
        </div>
        <div class="box-body" id="dom2png">
            <p id="dom2png-title" class="hidden">
                <strong>ID #:</strong> 2015-2485 <strong>Name:</strong> BARI, JOBAEL D. <strong>Course/Year:</strong> BSIT - 4 <strong>Sem/SY:</strong> 1 / 2019-2020 </p>
            <table id="sked-time-col-xs" class="table table-condensed table-bordered visible-xs">
                <thead class="hidden-print">
                <tr class="active">
                    <th width="5%">Time</th>
                </tr>
                </thead>
                <tbody class="hidden-print">
                <tr>
                    <td class="sked-time-col">07:30AM-08:00AM</td>
                </tr>
                </tbody>
            </table>
            <div class="sked-container table-responsive">
                <table id="sked" class="table table-condensed table-bordered sked">
                    <tbody>
                    <tr class="active">
                        <th class="sked-time-col" width="5%">Time</th>
                        <th width="30%">Monday</th>
                        <th width="50%">Tuesday</th>
                        <th width="15%">Wednesday</th>
                    </tr>
                    <tr>
                        <td class="sked-time-col">07:30AM-08:00AM</td>
                        <td align="center"></td>
                        <td align="center"></td>
                        <td align="center"></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@stop
