@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Profile</h1>
@stop

@section('content')
<div class="col-lg-6">
<table class="table table-bordered table-condensed">
<tbody>
<tr>
<td class="active" colspan="2"><strong>Personal</strong></td>
</tr>
<tr>
<td class="warning">Faculty ID No.</td>
<td>{{Auth::user()->id}}</td>
</tr>
<tr>
<td class="warning">Name</td>
<td>{{Auth::user()->first_name}} {{Auth::user()->last_name}}</td>
</tr>
<tr>
<td class="warning">Gender</td>
<td>M</td>
</tr>
<tr>
<td class="warning">Civil Status </td>
<td>Single</td>
</tr>
<tr>
<td class="warning">Citizenship </td>
<td></td>
</tr>
<tr>
<td class="warning">Religion </td>
<td>Islam</td>
</tr>
<tr>
<td class="warning">Ethnic Group </td>
<td></td>
</tr>
<tr>
<td class="warning">Date of Birth</td>
<td>October 30, 1997</td>
</tr>
<tr>
<td class="warning">Place of Birth</td>
<td>Piyagapo, Lanao Del Sur</td>
</tr>
<tr>
<td class="warning">Name of Father</td>
<td></td>
</tr>
<tr>
<td class="warning">Name of Mother</td>
<td></td>
</tr>
<tr>
<td class="warning">Address of Parents</td>
<td></td>
</tr>
<tr>
<td class="warning">Name of Spouse</td>
<td></td>
</tr>
<tr>
<td class="warning">Permanent Address</td>
<td></td>
</tr>
</tbody>
</table>
</div>
</div>

@stop
