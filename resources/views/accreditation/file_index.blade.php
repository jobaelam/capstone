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
                            @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                                <td align="center">
                                <a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$file->id}}" onClick="window.open('http://docs.google.com/gview?url=https://accreditationrepository.xyz/storage/files/'+{{$file->name}}+'&embedded=true/');">Open</a>
                                    <a type="button" class="btn btn-default btn-sm" href="/accreditation/file/{{$file->id}}/edit">Edit</a>
                                    {{-- <a type="button" class="btn btn-danger btn-sm" href="/accreditation/file/{{$file->id}}/destroy" onClick="refreshPage();">Delete</a> --}}
                                </td>
                            @else
                                <td align="center"><a type="button" class="btn btn-primary btn-sm" href="/accreditation/file/{{$file->id}}">Open</a></td>
                            @endif
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4">No Data Available</td>
                        </tr>
                    @endforelse
                </table>
                <a type="button" class="btn btn-default" href="/accreditation/folder/{{$folder->benchmark_id}}" ><i class="fa fa-arrow-left"></i> Back</a>
                @if(Auth::user()->role->id == ('1' OR '2' OR '3'))
                    <a type="button" class="btn btn-info btn-download pull-right" href="/accreditation/file/{{$folder->id}}/upload"><i class="fa fa-plus"></i> &nbsp; Upload File</a>
                @endif
            </div>
        </div>
    </div>

    <script>
        function refreshPage(){
            window.location.reload();
        } 
    </script>

    <script>
        $(document).ready(function(){
            $('.open').click(function() {
            var open = $(this).val();
            $.get('/openFile', {file:open, access: "{{$area->id}}"},function(data){
                // window.open('/storage/files/'+data);
                window.open('http://docs.google.com/gview?url=https://myiit.pagekite.me/storage/files/'+data+'&embedded=true/');
            })
    })

        });
    </script>
@stop
