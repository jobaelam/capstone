@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Files</h1>
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
                        <th width="45%">Note</th>
                        <th width="10%">Date</th>
                        @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                            <th width="15%">Action</th>
                        @else
                            <th width="10%">Action</th>
                        @endif
                    </tr>
                    @forelse($file_list as $file)
                        <tr>
                            <td>{{$file->name}}</td>
                            <td>{{$file->note}}</td>
                            <td>{{date('M d, Y',strtotime($file->created_at))}}</td>
                            @if(((Auth::user()->role->id == 2 OR Auth::user()->role->id == 3) AND Auth::user()->office_department_id == $folder->hasBenchmark->hasParameter->hasArea->hasDepartmentAccreditation->hasDepartment->id) OR Auth::user()->role->id == '1')
                                <td align="center">
                                    <a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$file->id}}/open">Open</a>
                                    <a type="button" class="btn btn-default btn-sm" href="/accreditation/file/{{$file->id}}/edit">Edit</a>
                                    @if(Auth::user()->role->id == 1)
                                        <a type="button" class="btn btn-danger btn-sm" href="/accreditation/file/{{$file->id}}/destroy">Delete</a>
                                    @endif
                                </td>
                            @elseif(Auth::user()->id == $folder->hasBenchmark->hasParameter->hasArea->head OR Auth::user()->role->id == '2')
                                <td align="center">
                                    <a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$file->id}}/open">Open</a>
                                </td>
                            @else
                                @if(in_array($file->id, $request_file))
                                    @foreach($flags as $request)
                                        @if($request->file_id == $file->id AND $request->flag == 1)
                                            <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$file->id}}/open}}">Open</a></td>
                                        @elseif($request->file_id == $file->id AND $request->flag == 2)
                                            <td align="center"><a type="button" class="btn btn-warning btn-sm" href="#" disabled="true">Pending</a></td>
                                        @endif
                                    @endforeach
                                @else
                                    <td align="center"><button class="btn btn-danger btn-sm" href="#" onClick="this.disabled=true; request_file({{$file->id}});">Request</button></td>
                                @endif
                            @endif
                            
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                    @endforelse
                </table>
                <a type="button" class="btn btn-default" href="/accreditation/folder/{{$folder->benchmark_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                @if(((Auth::user()->role->id == 2 OR Auth::user()->role->id == 3) AND Auth::user()->office_department_id == $folder->hasBenchmark->hasParameter->hasArea->hasDepartmentAccreditation->hasDepartment->id) OR Auth::user()->role->id == 1)
                    <a type="button" class="btn btn-info btn-download pull-right" href="/accreditation/file/{{$folder->id}}/upload"><i class="fa fa-plus"></i> &nbsp; Upload File</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        function refreshPage(){
            //window.location.reload();
        } 

        function request_file(id)
        {
            $.post('/requestFile', {_token:"{{csrf_token()}}",file: id, user:'{{Auth::user()->id}}'}, function(data){
                alert('data');
                //window.location.reload();
            });
        };
    </script>
@stop
